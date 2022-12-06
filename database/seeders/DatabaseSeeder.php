<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Admin',
            'email' => 'admin@user.com',
            'password' => Hash::make('password'),
            'rights' => 'admin'
        ]);
        DB::table('users')->insert([
            'username' => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('password'),
            'rights' => 'user'
        ]);

        DB::table('groups')->insert([
            'name' => 'Group 1',
            'invite_code' => 'u1g1randomstring',
            'owner_id' => 1
        ]);
        DB::table('groups')->insert([
            'name' => 'Group 2',
            'invite_code' => 'u2g2randomstring',
            'owner_id' => 2
        ]);

        DB::table('group_members')->insert([
            'group_id' => 1,
            'user_id' => 1
        ]);
        DB::table('group_members')->insert([
            'group_id' => 2,
            'user_id' => 1
        ]);
        DB::table('group_members')->insert([
            'group_id' => 2,
            'user_id' => 2
        ]);
    }
}
