<?php

use Illuminate\Database\Seeder;
use App\Goldar;
class GoldarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Goldar::create([
            'nama_goldar' => 'A',
        ]);
        Goldar::create([
            'nama_goldar' => 'B',
        ]);
        Goldar::create([
            'nama_goldar' => 'AB',
        ]);
        Goldar::create([
            'nama_goldar' => 'O',
        ]);
    }
}
