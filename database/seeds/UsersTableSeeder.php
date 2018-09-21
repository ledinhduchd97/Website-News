<?php

use Illuminate\Database\Seeder;
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
        DB::table('users')->insert([
            'name' => 'Lê Đình Đức',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'level' => 2,
            'active' => 1,
        ]);
		
		DB::table('users')->insert([
            'name' => 'Trần Văn A',
            'email' => 'member@gmail.com',
            'password' => Hash::make('123456'),
            'level' => 0,
            'active' => 1,
        ]);
    }
}
