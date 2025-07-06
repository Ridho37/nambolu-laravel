<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::where('email', 'admin@nambolu.com')->delete();

        User::Create(
        [
            'name' => 'Super Admin 1',
            'email' => 'admin1@example.com',
            'username' => 'admin1',
            'password' => Hash::make('admin123'),
        ],
        [
            'name' => 'Super Admin 2',
            'email' => 'admin2@example.com',
            'username' => 'admin2',
            'password' => Hash::make('admin123'),
        ]
    );
    }
}
