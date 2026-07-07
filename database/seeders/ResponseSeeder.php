<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\Response;
use App\Models\User;
use Illuminate\Database\Seeder;

class ResponseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', User::ROLE_ADMIN)->first();
        $complaints = Complaint::all();

        Response::factory()
            ->count(20)
            ->state(fn () => [
                'admin_id' => $admin->id,
                'complaint_id' => $complaints->random()->id,
            ])
            ->create();
    }
}
