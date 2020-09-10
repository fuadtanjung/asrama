<?php

use Illuminate\Database\Seeder;
use App\Gedung;
class GedungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gedung::create([
            'nama_gedung' => 'hijau',
            'jenis_kelamin' => 'laki-laki',
        ]);
        Gedung::create([
            'nama_gedung' => 'oren',
            'jenis_kelamin' => 'laki-laki',
        ]);
        Gedung::create([
            'nama_gedung' => 'rpx',
            'jenis_kelamin' => 'perempuan',
        ]);
        Gedung::create([
            'nama_gedung' => 'msyaff',
            'jenis_kelamin' => 'perempuan',
        ]);
        Gedung::create([
            'nama_gedung' => 'roesma',
            'jenis_kelamin' => 'perempuan',
        ]);
    }
}
