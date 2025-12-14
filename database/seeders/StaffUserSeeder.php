<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class StaffUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin Staff',
            'email' => 'admin@mellow.com',
            'password' => Hash::make('password123'),
            'role' => 'staff', // IMPORTANT
        ]);
    }
}
