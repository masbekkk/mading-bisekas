<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Mading Bisekas',
            'email' => 'mading@bisekas.com',
            'role' => 'admin',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Approver Mading Bisekas',
            'email' => 'approver@bisekas.com',
            'role' => 'approver',
            'password' => Hash::make('password')
        ]);
    }
}
