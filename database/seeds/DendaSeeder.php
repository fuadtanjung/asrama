<?php

use Illuminate\Database\Seeder;

class DendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('dendas')->insert([
            'nama_denda' => 'denda sholat subuh',
            'denda' => '12000'
        ]);
    }
}
