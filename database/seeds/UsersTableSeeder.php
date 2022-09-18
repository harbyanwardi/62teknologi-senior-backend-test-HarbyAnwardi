<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'fullname' => "Akun Owner",
                'username' => 'owner1',
                'password' => Hash::make('123456'),
                'type' => 'owner',
                'credit' => 0
            ],
            [
                'fullname' => "Akun Regule",
                'username' => 'reguler1',
                'password' => Hash::make('123456'),
                'type' => 'reguler',
                'credit' => 20
            ],
            [
                'fullname' => "Akun Premium",
                'username' => 'premium1',
                'password' => Hash::make('123456'),
                'type' => 'premium',
                'credit' => 40
            ],

        ];

        DB::table('users')->insert($users);
    }
}
