<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('tugas')->insert([
            'nama_tugas' => 'Hafalan Surah Al-Mulk'
        ]);
        DB::table('tugas')->insert([
            'nama_tugas' => 'Tulis Kaligrafi alquran surat juz 30'
        ]);
    }
}
