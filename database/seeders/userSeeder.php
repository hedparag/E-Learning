<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Priya Sen',
                'email' => 'priya@gmail.com',
                'password' => bcrypt('123456789'),
                'logged_in_as' => 'student'
            ],
            [
                'name' => 'Ishita Sen',
                'email' => 'ishita@gmail.com',
                'password' => bcrypt('123456789'),
                'logged_in_as' => 'teacher'
            ]
        ];
        User::insert($users);
    }
}
