<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //insert user Admin by default
        DB::table('admins')->insert([
            [
                'name' => 'admin',
                'email' => 'admin',
                'password' => Hash::make('123456'),
                'role' => 'admin',
                'status' => 'active',
            ],
            [
                'name' => 'editor',
                'email' => 'editor',
                'password' => Hash::make('123456'),
                'role' => 'editor',
                'status' => 'active',
            ]

        ]);
    }
}
