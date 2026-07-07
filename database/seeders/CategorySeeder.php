<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['Jalan Rusak', 'Pengaduan terkait jalan berlubang, retak, atau tidak layak.'],
            ['Sampah', 'Pengaduan sampah menumpuk dan pengelolaan kebersihan.'],
            ['Drainase', 'Pengaduan saluran air tersumbat atau rusak.'],
            ['Lampu Jalan', 'Pengaduan lampu penerangan jalan umum mati atau rusak.'],
            ['Air Bersih', 'Pengaduan akses dan kualitas air bersih.'],
            ['Keamanan', 'Pengaduan keamanan dan ketertiban lingkungan.'],
            ['Pohon Tumbang', 'Pengaduan pohon tumbang atau rawan tumbang.'],
            ['Fasilitas Umum', 'Pengaduan kerusakan fasilitas umum.'],
            ['Lainnya', 'Pengaduan lain yang belum masuk kategori tersedia.'],
        ];

        foreach ($categories as [$name, $description]) {
            Category::updateOrCreate(['category_name' => $name], ['description' => $description]);
        }
    }
}
