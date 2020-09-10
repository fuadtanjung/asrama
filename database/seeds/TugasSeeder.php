<?php

use Illuminate\Database\Seeder;
use App\Tugas;
class TugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tugas::create([
            'nama_tugas' => 'Hafalan Surah Al-Mulk'
        ]);
        Tugas::create([
            'nama_tugas' => 'Tulis Kaligrafi alquran surat juz 30'
        ]);
    }
}
