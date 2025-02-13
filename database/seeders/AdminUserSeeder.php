<?php

namespace Database\Seeders;
use app\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'adm@gmail.com',
            'password' => Hash::make('kubicokubico'),
        ]);
    }
}
