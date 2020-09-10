<?php

use Illuminate\Database\Seeder;
use App\Jalur_masuk;
class JalurMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jalur_masuk::create([
            'nama_jalur' => 'SNMPTN',
        ]);
        Jalur_masuk::create([
            'nama_jalur' => 'SBMPTN',
        ]);
    }
}
