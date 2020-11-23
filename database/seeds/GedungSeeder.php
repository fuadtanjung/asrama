<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'gender' => 'perempuan',
        ]);
        DB::table('gedungs')->insert([
            'nama_gedung' => 'roesma',
            'gender' => 'perempuan',
        ]);
        DB::table('gedungs')->insert([
            'nama_gedung' => 'msyaff',
            'gender' => 'laki-laki',
        ]);
        DB::table('gedungs')->insert([
            'nama_gedung' => 'rpx',
            'gender' => 'perempuan',
        ]);
        DB::table('gedungs')->insert([
            'nama_gedung' => 'oren',
            'gender' => 'perempuan',
        ]);
    }
}
