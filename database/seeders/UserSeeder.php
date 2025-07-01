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

        User::Create([
            'name' => 'Admin Nambolu',
            'email' => 'admin@example.com',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
        ]);
    }
}
