<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'fuad',
            'nim' => '1611523004',
            'password' => bcrypt('pembina'),
            'role_id'   => 1,
            'remember_token' => Str::random(30),
        ]);
        DB::table('users')->insert([
            'name' => 'yori',
            'nim' => '1611521022',
            'password' => bcrypt('mahasiswa'),
            'role_id'   => 2,
            'remember_token' => Str::random(30),
        ]);
    }
}
