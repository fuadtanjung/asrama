<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JalurMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jalur_masuks')->insert([
            'nama_jalur' => 'SBMPTN',
        ]);
        DB::table('jalur_masuks')->insert([
            'nama_jalur' => 'SNMPTN',
        ]);
    }
}
