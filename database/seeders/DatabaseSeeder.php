<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Seller;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Customer::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Seller::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}