<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', User::ROLE_MASYARAKAT)->get();
        $categories = Category::all();

        Complaint::factory()
            ->count(30)
            ->state(fn () => [
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
            ])
            ->create();
    }
}
