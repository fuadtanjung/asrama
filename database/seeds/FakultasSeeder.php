<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fakultas')->insert([
            'nama_fakultas' => 'Teknologi Informasi'
        ]);
        DB::table('fakultas')->insert([
            'nama_fakultas' => 'Ekonomi'
        ]);
        DB::table('fakultas')->insert([
            'nama_fakultas' => 'Hukum'
        ]);
        DB::table('fakultas')->insert([
            'nama_fakultas' => 'Teknik'
        ]);
        DB::table('fakultas')->insert([
            'nama_fakultas' => 'Peternakan'
        ]);
        DB::table('fakultas')->insert([
            'nama_fakultas' => 'Ilmu Budaya'
        ]);
        DB::table('fakultas')->insert([
            'nama_fakultas' => 'Ilmu Sosial dan Politik'
        ]);
        DB::table('fakultas')->insert([
            'nama_fakultas' => 'Keperawatan'
        ]);
    }
}
