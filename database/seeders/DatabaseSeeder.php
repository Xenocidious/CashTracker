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
        DB::table('users')->insert([
            'username' => 'User2',
            'email' => 'user2@user.com',
            'password' => Hash::make('password'),
            'rights' => 'user'
        ]);
        DB::table('users')->insert([
            'username' => 'User3',
            'email' => 'user3@user.com',
            'password' => Hash::make('password'),
            'rights' => 'user'
        ]);
        DB::table('users')->insert([
            'username' => 'User4',
            'email' => 'user4@user.com',
            'password' => Hash::make('password'),
            'rights' => 'user'
        ]);
        DB::table('users')->insert([
            'username' => 'User5',
            'email' => 'user5@user.com',
            'password' => Hash::make('password'),
            'rights' => 'user'
        ]);
        DB::table('users')->insert([
            'username' => 'User6',
            'email' => 'user6@user.com',
            'password' => Hash::make('password'),
            'rights' => 'user'
        ]);
        DB::table('users')->insert([
            'username' => 'User7',
            'email' => 'user7@user.com',
            'password' => Hash::make('password'),
            'rights' => 'user'
        ]);
        DB::table('users')->insert([
            'username' => 'User8',
            'email' => 'user8@user.com',
            'password' => Hash::make('password'),
            'rights' => 'user'
        ]);
        DB::table('users')->insert([
            'username' => 'User9',
            'email' => 'user9@user.com',
            'password' => Hash::make('password'),
            'rights' => 'user'
        ]);
        DB::table('users')->insert([
            'username' => 'User10',
            'email' => 'user10@user.com',
            'password' => Hash::make('password'),
            'rights' => 'user'
        ]);
        DB::table('users')->insert([
            'username' => 'User11',
            'email' => 'user11@user.com',
            'password' => Hash::make('password'),
            'rights' => 'user'
        ]);
        DB::table('users')->insert([
            'username' => 'User12',
            'email' => 'user12@user.com',
            'password' => Hash::make('password'),
            'rights' => 'user'
        ]);

        DB::table('groups')->insert([
            'name' => 'Group 1',
            'owner_id' => 1
        ]);
        DB::table('groups')->insert([
            'name' => 'Group 2',
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
        DB::table('group_members')->insert([
            'group_id' => 2,
            'user_id' => 3
        ]);
        DB::table('group_members')->insert([
            'group_id' => 2,
            'user_id' => 4
        ]);
        DB::table('group_members')->insert([
            'group_id' => 2,
            'user_id' => 5
        ]);
        DB::table('group_members')->insert([
            'group_id' => 2,
            'user_id' => 6
        ]);
        DB::table('group_members')->insert([
            'group_id' => 2,
            'user_id' => 7
        ]);
        DB::table('group_members')->insert([
            'group_id' => 2,
            'user_id' => 8
        ]);
        DB::table('group_members')->insert([
            'group_id' => 2,
            'user_id' => 9
        ]);
        DB::table('group_members')->insert([
            'group_id' => 2,
            'user_id' => 10
        ]);
        DB::table('group_members')->insert([
            'group_id' => 2,
            'user_id' => 11
        ]);
        DB::table('group_members')->insert([
            'group_id' => 2,
            'user_id' => 12
        ]);
    }
}
