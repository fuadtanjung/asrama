<?php

use Illuminate\Database\Seeder;


class StatusRumahSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_rumahs')->insert([
            'nama_status' => 'rumah_keluarga',
        ]);
        DB::table('status_rumahs')->insert([
            'nama_status' => 'rumah_sendiri',
        ]);
        DB::table('status_rumahs')->insert([
            'nama_status' => 'kontrak',
        ]);
        DB::table('status_rumahs')->insert([
            'nama_status' => 'rumah_warisan',
        ]);
    }
}
