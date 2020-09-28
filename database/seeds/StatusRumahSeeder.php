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
            'nama_status' => 'Rumah Keluarga',
        ]);
        DB::table('status_rumahs')->insert([
            'nama_status' => 'Rumah Sendiri',
        ]);
        DB::table('status_rumahs')->insert([
            'nama_status' => 'Kontrak',
        ]);
        DB::table('status_rumahs')->insert([
            'nama_status' => 'Rumah Warisan',
        ]);
    }
}
