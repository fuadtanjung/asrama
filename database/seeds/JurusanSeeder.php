<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jurusans')->insert([
            'nama_jurusan' => 'Sistem Informasi',
            'fakultas_id' => '1'
        ]);
        DB::table('jurusans')->insert([
            'nama_jurusan' => 'Teknik Komputer',
            'fakultas_id' => '1'
        ]);
        DB::table('jurusans')->insert([
            'nama_jurusan' => 'Ilmu Hukum',
            'fakultas_id' => '3'
        ]);
        DB::table('jurusans')->insert([
            'nama_jurusan' => 'Manajemen',
            'fakultas_id' => '2'
        ]);
        DB::table('jurusans')->insert([
            'nama_jurusan' => 'Teknik Industri',
            'fakultas_id' => '4'
        ]);
        DB::table('jurusans')->insert([
            'nama_jurusan' => 'Teknik Elektro',
            'fakultas_id' => '4'
        ]);
        DB::table('jurusans')->insert([
            'nama_jurusan' => 'Teknik Sipil',
            'fakultas_id' => '4'
        ]);
        DB::table('jurusans')->insert([
            'nama_jurusan' => 'Teknik Mesin',
            'fakultas_id' => '4'
        ]);
        DB::table('jurusans')->insert([
            'nama_jurusan' => 'Peternakan',
            'fakultas_id' => '5'
        ]);
        DB::table('jurusans')->insert([
            'nama_jurusan' => 'Sastra Indonesia',
            'fakultas_id' => '6'
        ]);
        DB::table('jurusans')->insert([
            'nama_jurusan' => 'Ilmu Hubungan International',
            'fakultas_id' => '7'
        ]);
        DB::table('jurusans')->insert([
            'nama_jurusan' => 'Ilmu Keperawatan',
            'fakultas_id' => '8'
        ]);
    }
}
