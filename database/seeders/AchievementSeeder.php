<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $achievements = [
            [
                'title' => 'Juara 1 Turnamen Futsal Antar Akademi Se-Jawa Barat 2025',
                'description' => 'Tim U-16 Duber Futsal Academy berhasil keluar sebagai juara pertama setelah menaklukkan perlawanan sengit di babak final.',
                'photos' => [
                    'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=800&q=80',
                ],
            ],
            [
                'title' => 'Medali Emas Kejuaraan Futsal Pelajar Tingkat Kabupaten Garut',
                'description' => 'Dominasi penuh ditunjukkan oleh anak-anak didikan Duber Academy yang menyapu bersih kemenangan dari babak penyisihan.',
                'photos' => [
                    'https://images.unsplash.com/photo-1543326727-cf6c39e8f84c?auto=format&fit=crop&w=800&q=80',
                ],
            ],
            [
                'title' => 'Best Academy Performance Piala Menpora Cup',
                'description' => 'Penghargaan bergengsi atas konsistensi pembinaan usia dini dan kedisiplinan taktik di lapangan.',
                'photos' => [
                    'https://images.unsplash.com/photo-1563841930606-63e2b18c7283?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1518091043644-c1d4457512c6?auto=format&fit=crop&w=800&q=80',
                ],
            ],
            [
                'title' => 'Juara 2 Kompetisi Futsal U-12 Regional Priangan',
                'description' => 'Perjuangan luar biasa tim kelompok usia 12 tahun yang sukses menduduki podium kedua.',
                'photos' => [
                    'https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=800&q=80',
                ],
            ],
            [
                'title' => 'Top Scorer Award - Turnamen Futsal Kemerdekaan',
                'description' => 'Siswa akademi kami sukses memborong gelar pencetak gol terbanyak sepanjang turnamen.',
                'photos' => [
                    'https://images.unsplash.com/photo-1526232761682-d26e03ac148e?auto=format&fit=crop&w=800&q=80',
                ],
            ],
            [
                'title' => 'Fair Play Team Award Piala Gubernur',
                'description' => 'Diberikan kepada tim atas junjungan tinggi sportivitas, etika, dan kerjasama tim yang luar biasa.',
                'photos' => [
                    'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1551958219-acbc608c6377?auto=format&fit=crop&w=800&q=80',
                ],
            ],
            [
                'title' => 'Juara 1 Futsal Championship Kategori Usia 14 Tahun',
                'description' => 'Aksi gemilang penjaga gawang dan lini serang mengantarkan trofi utama pulang ke basecamp.',
                'photos' => [
                    'https://images.unsplash.com/photo-1517466787929-bc90951d0974?auto=format&fit=crop&w=800&q=80',
                ],
            ],
            [
                'title' => 'Piala Bergilir Festival Futsal Pemuda Mandiri',
                'description' => 'Meraih juara umum setelah mendominasi di berbagai kategori kelompok usia.',
                'photos' => [
                    'https://images.unsplash.com/photo-1431324155629-1a6deb1dec8d?auto=format&fit=crop&w=800&q=80',
                ],
            ],
            [
                'title' => 'Runner Up Kompetisi Futsal Antar Klub Pro-Amateur',
                'description' => 'Pengalaman berharga bertanding melawan tim-tim senior dengan strategi permainan modern.',
                'photos' => [
                    'https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=800&q=80',
                ],
            ],
            [
                'title' => 'Penghargaan Akademi Futsal Paling Produktif 2025',
                'description' => 'Diapresiasi atas keberhasilan melahirkan bibit-bibit muda potensial yang masuk ke level profesional.',
                'photos' => [
                    'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=800&q=80',
                ],
            ],
        ];

        foreach ($achievements as $item) {
            Achievement::create($item);
        }
    }
}
