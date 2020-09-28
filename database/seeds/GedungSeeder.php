<?php

use Illuminate\Database\Seeder;

class GedungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gedungs')->insert([
            'nama_gedung' => 'hijau',
            'jenis_kelamin' => 'perempuan',
        ]);
        DB::table('gedungs')->insert([
            'nama_gedung' => 'roesma',
            'jenis_kelamin' => 'perempuan',
        ]);
        DB::table('gedungs')->insert([
            'nama_gedung' => 'msyaff',
            'jenis_kelamin' => 'laki-laki',
        ]);
        DB::table('gedungs')->insert([
            'nama_gedung' => 'rpx',
            'jenis_kelamin' => 'perempuan',
        ]);
        DB::table('gedungs')->insert([
            'nama_gedung' => 'oren',
            'jenis_kelamin' => 'perempuan',
        ]);
    }
}
