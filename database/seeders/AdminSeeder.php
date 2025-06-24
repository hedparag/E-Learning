<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create(
            [
                'name' => 'Indrani Dey',
                'email' => 'idey@gmail.com',
                'password' => bcrypt('123456789'),
                'gender' => 'female',
                'phone' => '7439700836'
            ],
        );

        Admin::create([
            'name' => 'Titir Singh',
            'email' => 'titir@gmail.com',
            'password' => bcrypt('123456789'),
            'gender' => 'female',
            'phone' => '1234567890'
        ]);
    }
}
