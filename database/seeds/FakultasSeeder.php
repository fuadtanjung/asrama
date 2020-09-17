<?php

use Illuminate\Database\Seeder;

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
            'nama_fakultas' => 'teknik'
        ]);
    }
}
