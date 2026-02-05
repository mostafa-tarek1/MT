<?php

namespace Database\Seeders;

use App\Modules\Auth\Models\Manager;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manager = Manager::query()->updateOrCreate(
            ['email' => 'admin@Elryad.com'],
            [
                'name' => 'Admin',
                'phone' => '+96650000000',
                'password' => bcrypt('123123123'),
            ]
        );

        // Attach role if not already attached
        if (! $manager->roles()->where('id', 1)->exists()) {
            $manager->addRole(1);
        }
    }
}
