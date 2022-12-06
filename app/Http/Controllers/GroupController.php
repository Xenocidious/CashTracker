<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupMember;

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
        // ALSO COLLECT PURCHASES

        return view('app.group', ['group' => $group, 'members' => $members]);
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

        return view('app.group');
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

        return redirect('app.home');
    }

    public function edit()
    {
        
    }

    public function delete()
    {
        
    }

    public function generateInvite($id)
    {
        Group::where('id', $id)->update(['invite_code' => STR::random(7).$id.STR::random(7)]);
        
        return redirect('group/'.$id);
    }
}