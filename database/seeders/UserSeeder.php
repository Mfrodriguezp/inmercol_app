<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Create([
            'name'=>'Miller Rodriguez',
            'email'=>'sa@inmercol.com',
            'password'=>bcrypt('DevFull2024.')
        ])->assignRole('Admin');
        User::Create([
            'name'=>'David Arroyo',
            'email'=>'admin@inmercol.com',
            'password'=>bcrypt('Admin2024..')
        ])->assignRole('Admin');
        User::Create([
            'name'=>'Liz',
            'email'=>'manager@inmercol.com',
            'password'=>bcrypt('Manager2024.')
        ])->assignRole('Manager');
        User::Create([
            'name'=>'Jueces',
            'email'=>'juez@inmercol.com',
            'password'=>bcrypt('Juez2024.')
        ])->assignRole('Judge');
    }
}
