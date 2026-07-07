<?php

namespace Database\Factories;

use App\Models\Complaint;
use App\Models\Response;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Response>
 */
class ResponseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'complaint_id' => Complaint::factory(),
            'admin_id' => User::factory()->admin(),
            'response' => fake()->randomElement([
                'Pengaduan telah kami terima dan akan diverifikasi oleh petugas.',
                'Tim terkait sedang melakukan pengecekan ke lokasi.',
                'Laporan sudah diteruskan kepada instansi terkait.',
                'Pengaduan telah selesai ditindaklanjuti. Terima kasih atas partisipasinya.',
            ]),
            'response_date' => now()->subDays(fake()->numberBetween(0, 30))->toDateString(),
        ];
    }
}
