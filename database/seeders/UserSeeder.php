<?php

namespace Database\Seeders;

use App\Modules\Auth\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "User $i",
                'email' => "user$i@elryad.com",
                'phone' => '0100000000'.str_pad($i, 2, '0', STR_PAD_LEFT), // e.g., 010000000001, 010000000002
                'password' => Hash::make('elryad1256!#'),
            ]);
        }
    }
}
