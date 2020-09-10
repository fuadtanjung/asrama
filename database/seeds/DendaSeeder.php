<?php

use Illuminate\Database\Seeder;
use App\Denda;
class DendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Denda::create([
            'nama_denda' => 'denda sholat subuh',
            'denda' => '12000'
        ]);
    }
}
