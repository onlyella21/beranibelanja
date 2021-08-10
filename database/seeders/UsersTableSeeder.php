<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Ela Wangi',
            'username' => 'elwa',
            'password' => bcrypt('password'),
            'email' => 'ella21w@gmail.com',
        ]);
    }
}
