<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoldarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goldars')->insert([
            'nama_goldar' => 'O',
        ]);
        DB::table('goldars')->insert([
            'nama_goldar' => 'AB',
        ]);
        DB::table('goldars')->insert([
            'nama_goldar' => 'B',
        ]);
        DB::table('goldars')->insert([
            'nama_goldar' => 'A',
        ]);

    }
}
