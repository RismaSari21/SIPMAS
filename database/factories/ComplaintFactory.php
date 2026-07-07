<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Complaint>
 */
class ComplaintFactory extends Factory
{
    private array $wilayah = [
        ['11', 'ACEH', '1101', 'KABUPATEN SIMEULUE', '1101010', 'TEUPAH SELATAN', '1101010001', 'LATALING'],
        ['31', 'DKI JAKARTA', '3171', 'KOTA JAKARTA SELATAN', '3171010', 'JAGAKARSA', '3171010001', 'CIPEDAK'],
        ['32', 'JAWA BARAT', '3273', 'KOTA BANDUNG', '3273010', 'SUKASARI', '3273010001', 'SUKARASA'],
        ['33', 'JAWA TENGAH', '3374', 'KOTA SEMARANG', '3374010', 'MIJEN', '3374010001', 'CANGKIRAN'],
        ['35', 'JAWA TIMUR', '3578', 'KOTA SURABAYA', '3578010', 'KARANG PILANG', '3578010001', 'WARUGUNUNG'],
        ['51', 'BALI', '5171', 'KOTA DENPASAR', '5171010', 'DENPASAR SELATAN', '5171010001', 'SANUR'],
    ];

    public function definition(): array
    {
        $wilayah = fake()->randomElement($this->wilayah);

        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'province_id' => $wilayah[0],
            'province_name' => $wilayah[1],
            'regency_id' => $wilayah[2],
            'regency_name' => $wilayah[3],
            'district_id' => $wilayah[4],
            'district_name' => $wilayah[5],
            'village_id' => $wilayah[6],
            'village_name' => $wilayah[7],
            'title' => fake()->randomElement(['Jalan Rusak Parah', 'Lampu Jalan Mati', 'Sampah Menumpuk', 'Drainase Tersumbat', 'Fasilitas Umum Rusak']),
            'description' => fake()->paragraph(3),
            'photo' => null,
            'address' => fake()->streetAddress(),
            'latitude' => fake()->randomFloat(7, -8.5, 5.5),
            'longitude' => fake()->randomFloat(7, 96, 141),
            'complaint_date' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'status' => fake()->randomElement(Complaint::STATUSES),
        ];
    }
}
