<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
        ]);

        User::factory()->count(10)->create();

        $this->call([
            ComplaintSeeder::class,
            ResponseSeeder::class,
        ]);
    }
}
