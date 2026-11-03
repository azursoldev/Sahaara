<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Default Admin User
        User::updateOrCreate(
            ['email' => 'admin@sahaara.com'],
            [
                'name' => 'Admin Sahaara',
                'password' => Hash::make('admin123'),
            ]
        );

        $this->call([
            SahaaraSeeder::class,
        ]);
    }
}
