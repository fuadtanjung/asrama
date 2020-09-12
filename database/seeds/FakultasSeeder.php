<?php

use Illuminate\Database\Seeder;
use App\Fakultas;
class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fakultas::create([
            'nama_fakultas' => 'Teknologi Informasi'
        ]);
        Fakultas::create([
            'nama_fakultas' => 'Ekonomi'
        ]);
        Fakultas::create([
            'nama_fakultas' => 'Hukum'
        ]);
        Fakultas::create([
            'nama_fakultas' => 'teknik'
        ]);
    }
}
