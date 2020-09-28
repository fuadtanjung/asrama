<?php

use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.01',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.02',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.03',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.04',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.05',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.06',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.07',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.08',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.09',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.10',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.11',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.12',
        ]);
    }
}
