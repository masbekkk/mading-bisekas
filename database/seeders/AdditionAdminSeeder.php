<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdditionAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Project',
            'email' => 'project@biseka.id',
            'role' => 'admin',
            'password' => Hash::make('project123#')
        ]);
        
        User::create([
            'name' => 'Sales',
            'email' => 'sales@biseka.id',
            'role' => 'admin',
            'password' => Hash::make('sales123#')
        ]);
        
        User::create([
            'name' => 'Procurement',
            'email' => 'procurement@biseka.id',
            'role' => 'admin',
            'password' => Hash::make('procurement123#')
        ]);
        
        User::create([
            'name' => 'Tax',
            'email' => 'tax@biseka.id',
            'role' => 'admin',
            'password' => Hash::make('tax123#')
        ]);
        
        User::create([
            'name' => 'Sales Smg',
            'email' => 'sales.smg@biseka.id',
            'role' => 'admin',
            'password' => Hash::make('salessmg123#')
        ]);
        
        User::create([
            'name' => 'Info',
            'email' => 'info@biseka.id',
            'role' => 'approver',
            'password' => Hash::make('info123#')
        ]);
    }
}
