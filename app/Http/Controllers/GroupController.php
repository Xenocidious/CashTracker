<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Expense;

class GroupController extends Controller
{
    public function home()
    {
        $user_id = auth()->user()->id;

        // Collect all the current user's groups
        $group_ids = GroupMember::where('user_id', $user_id)->pluck('group_id');
        $groups = Group::whereIn('id', $group_ids)->get();

        foreach ($groups as $group) {
            $group['owner'] = User::where('id', $group['owner_id'])->value('username');
        }
        
        return view('app.home', ['groups' => $groups]);
    }

    public function group($group_id)
    {
        $group = Group::where('id', $group_id)->first();
        $member_ids = GroupMember::where('group_id', $group_id)->pluck('user_id');
        $members = User::whereIn('id', $member_ids)->get();
        $expenses = Expense::where('group_id', $group_id)->get();

        $userExpenses = [];
        foreach ($members as $member) {
            $userExpenses[$member->id] = Expense::select('id', 'title', 'amount')->where(['user_id' => $member->id, 'group_id' => $group_id])->get();

            $userExpenses[$member->id]['total'] = 0;
            foreach ($userExpenses[$member->id] as $expense) {
                $userExpenses[$member->id]['total'] += $expense['amount'];
            }
        }

        return view('app.group', ['group' => $group, 'members' => $members, 'expenses' => $userExpenses]);
    }

    public function join()
    {
        $attributes = request()->validate([
            'invite_code' => 'required|exists:groups,invite_code'
        ]);
        
        $group_id = Group::where('invite_code', request()->invite_code)->value('id');

        GroupMember::updateOrCreate([
            'group_id' => $group_id,
            'user_id' => auth()->user()->id,
        ]);

        return $this->group($group_id);
    }
    

    public function create()
    {
        $attributes = request()->validate([
            'name' => 'required|min:3|max:20'
        ]);

        $attributes['owner_id'] = auth()->user()->id;

        $group = Group::create($attributes);

        GroupMember::create([
            'group_id' => $group->id,
            'user_id' => $group->owner_id,
        ]);

        return $this->group($group->id);
    }

    public function generateInvite($id)
    {
        Group::find($id)->update(['invite_code' => STR::random(7).$id.STR::random(7)]);
        
        return redirect('group/'.$id);
    }
}