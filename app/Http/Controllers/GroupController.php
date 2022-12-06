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

        // Collect all groups
        $group_ids = GroupMember::where('user_id', $user_id)->pluck('group_id');
        $groups = Group::whereIn('id', $group_ids)->get();

        foreach ($groups as $group) {
            $group['owner'] = User::where('id', $group['owner_id'])->value('username');
        }
        
        return view('app.home', ['groups' => $groups]);
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

        return redirect('home');
    }
    

    public function create()
    {
        $attributes = request()->validate([
            'name' => 'required|min:3|max:20'
        ]);

        $attributes['owner_id'] = auth()->user()->id;

        $group = Group::create($attributes);
        Group::where('id', $group->id)->update(['invite_code' => STR::random(7).$group->id.STR::random(7)]);

        GroupMember::create([
            'group_id' => $group->id,
            'user_id' => $group->owner_id,
        ]);

        return redirect('home');
    }

    public function edit()
    {
        
    }

    public function delete()
    {
        
    }
}