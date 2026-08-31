<?php

namespace Database\Seeders;

use App\Models\Coach;
use Illuminate\Database\Seeder;

class CoachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coaches = [
            ['Coach Budi Santoso, M.Pd.', '081234567890', 'Lisensi A Nasional', 'S2 Pendidikan Olahraga', 'Guru Olahraga / Dosen', '8 Tahun'],
            ['Coach Siti Aminah, S.Or.', '081345678901', 'Lisensi B AFC', 'S1 Ilmu Keolahragaan', 'Pelatih Profesional', '6 Tahun'],
            ['Coach Joko Anwar, S.Pd.', '082156789012', 'Lisensi C PSSI', 'S1 Pendidikan Jasmani', 'Mantan Atlet / Coach', '5 Tahun'],
            ['Coach Dewi Lestari', '085678901234', 'Lisensi A AFC', 'S1 Manajemen', 'Pelatih Kepala', '10 Tahun'],
            ['Coach Eko Prasetyo, M.Or.', '087890123456', 'Lisensi B Nasional', 'S2 Olahraga Prestasi', 'Akademisi / Praktisi', '7 Tahun'],
            ['Coach Rina Melati, S.Pd.', '081298765432', 'Lisensi C PSSI', 'S1 Pend. Kepelatihan', 'Guru PJOK', '4 Tahun'],
            ['Coach Ahmad Fauzi', '081387654321', 'Lisensi A AFC', 'S1 Hubungan Internasional', 'Pelatih Klub', '9 Tahun'],
            ['Coach Dian Sastro Wardoyo', '082233445566', 'Lisensi B Nasional', 'S1 Ilmu Komunikasi', 'Pelatih & Motivator', '5 Tahun'],
            ['Coach Hendra Setiawan', '085711223344', 'Lisensi C PSSI', 'SMA / Diploma', 'Mantan Atlet Nasional', '12 Tahun'],
            ['Coach Maya Sofa, S.Pd.', '087799887766', 'Lisensi A Nasional', 'S1 Keguruan', 'Guru & Pelatih', '6 Tahun'],
            ['Coach Reza Rahadian', '081211223344', 'Lisensi B AFC', 'S1 Seni & Olahraga', 'Pelatih Fisik', '7 Tahun'],
            ['Coach Citra Scholastika', '081355667788', 'Lisensi C PSSI', 'S1 Psikologi', 'Sport Psychologist / Coach', '4 Tahun'],
            ['Coach Fajar Alfian', '082199887766', 'Lisensi A AFC', 'S1 Ekonomi', 'Pelatih Prestasi', '8 Tahun'],
            ['Coach Intan Nuraini', '085644332211', 'Lisensi B Nasional', 'S1 Sastra', 'Pelatih Pendamping', '5 Tahun'],
            ['Coach Galih Ginanjar', '087812345678', 'Lisensi C PSSI', 'SMA', 'Instruktur Lapangan', '3 Tahun'],
            ['Coach Tiara Andini', '081233221100', 'Lisensi A Nasional', 'S1 Ilmu Keolahragaan', 'Pelatih Muda', '4 Tahun'],
            ['Coach Rizky Febian', '081377889900', 'Lisensi B AFC', 'S1 Manajemen Bisnis', 'Wiraswasta & Pelatih', '6 Tahun'],
            ['Coach Marissa Haque', '082255443322', 'Lisensi C PSSI', 'S2 Hukum Olahraga', 'Konsultan & Coach', '10 Tahun'],
            ['Coach Deddy Corbuzier', '085799881122', 'Lisensi A AFC', 'S2 Psikologi', 'Trainer Profesional', '11 Tahun'],
            ['Coach Agnez Mo', '087833445566', 'Lisensi B Nasional', 'S1 Seni Pertunjukan', 'Pelatih Kebugaran', '9 Tahun'],
            ['Coach Raffi Ahmad', '081266554433', 'Lisensi C PSSI', 'S1 Ekonomi', 'Enterpreneur & Coach', '5 Tahun'],
            ['Coach Najwa Shihab', '081322334455', 'Lisensi A Nasional', 'S2 Hukum', 'Praktisi & Pelatih', '7 Tahun'],
            ['Coach Pandji Pragiwaksono', '082144556677', 'Lisensi B AFC', 'S1 Seni Rupa', 'Pelatih Publik', '6 Tahun'],
            ['Coach Cinta Laura', '085611223344', 'Lisensi C PSSI', 'S1 Sastra Jerman', 'Fitness & Skills Coach', '4 Tahun'],
            ['Coach Iko Uwais', '087855667788', 'Lisensi A AFC', 'SMA', 'Mantan Atlet & Pelatih Utama', '13 Tahun'],
            ['Coach Joe Taslim', '081288990011', 'Lisensi B Nasional', 'S1 Kedokteran Gigi', 'Praktisi Kesehatan & Coach', '8 Tahun'],
            ['Coach Chelsea Islan', '081344556677', 'Lisensi C PSSI', 'S1 Hub. Internasional', 'Pelatih Muda', '3 Tahun'],
            ['Coach Reza Arap', '082177889900', 'Lisensi A Nasional', 'Diploma', 'Content Creator & Coach', '5 Tahun'],
            ['Coach Maudy Ayunda', '085622334455', 'Lisensi B AFC', 'S2 Education (Stanford)', 'Akademisi & Pelatih', '6 Tahun'],
            ['Coach Vidi Aldiano', '087899001122', 'Lisensi C PSSI', 'S2 Manajemen', 'Pelatih Eksekutif', '4 Tahun'],
        ];

        foreach ($coaches as $index => $data) {
            // Menggunakan foto dummy acak dari pravatar.cc berdasarkan index looping
            $photoId = $index + 1;

            Coach::create([
                'name' => $data[0],
                'phone' => $data[1],
                'license' => $data[2],
                'photo' => "https://i.pravatar.cc/150?img={$photoId}",
                'education' => $data[3],
                'profession' => $data[4],
                'experience' => $data[5],
            ]);
        }
    }
}
