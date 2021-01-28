<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'status_ruangan'  => 'Baik',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.02',
            'status_ruangan'  => 'Baik',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.03',
            'status_ruangan'  => 'Baik',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.04',
            'status_ruangan'  => 'Baik',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.05',
            'status_ruangan'  => 'Baik',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.06',
            'status_ruangan'  => 'Baik',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.07',
            'status_ruangan'  => 'Baik',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.08',
            'status_ruangan'  => 'Baik',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.09',
            'status_ruangan'  => 'Baik',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.10',
            'status_ruangan'  => 'Baik',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.11',
            'status_ruangan'  => 'Baik',
        ]);
        DB::table('ruangans')->insert([
            'gedung_id'  => '1',
            'nama_ruangan'  => '2A.12',
            'status_ruangan'  => 'Baik',
        ]);
    }
}
