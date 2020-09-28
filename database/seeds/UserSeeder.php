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
            'name' => 'Fuad Ali Tanjung',
            'nim' => '1611523004',
            'password' => bcrypt('pembina'),
            'role_id'   => 1,
            'remember_token' => Str::random(30),
        ]);
        DB::table('users')->insert([
            'name' => 'Anggia Okta Yorizka',
            'nim' => '1611521022',
            'password' => bcrypt('mahasiswa'),
            'role_id'   => 2,
            'remember_token' => Str::random(30),
        ]);
        DB::table('users')->insert([
            'name' => 'Nadhita Afiah',
            'nim' => '1910111001',
            'password' => bcrypt('1910111001'),
            'role_id'   => 2,
            'remember_token' => Str::random(30),
        ]);
        DB::table('users')->insert([
            'name' => 'Febria Yolanda Jasrul',
            'nim' => '1910611007',
            'password' => bcrypt('1910611007'),
            'role_id'   => 2,
            'remember_token' => Str::random(30),
        ]);
        DB::table('users')->insert([
            'name' => 'Fauzia Anisa Rahma',
            'nim' => '1910721008',
            'password' => bcrypt('1910721008'),
            'role_id'   => 2,
            'remember_token' => Str::random(30),
        ]);
        DB::table('users')->insert([
            'name' => 'Gina Sonia',
            'nim' => '1910851004',
            'password' => bcrypt('1910851004'),
            'role_id'   => 2,
            'remember_token' => Str::random(30),
        ]);
        DB::table('users')->insert([
            'name' => 'Sri Reski Radiansy',
            'nim' => '1910921005',
            'password' => bcrypt('1910921005'),
            'role_id'   => 2,
            'remember_token' => Str::random(30),
        ]);
        DB::table('users')->insert([
            'name' => 'Monika Diara Putri',
            'nim' => '1911311014',
            'password' => bcrypt('1911311014'),
            'role_id'   => 2,
            'remember_token' => Str::random(30),
        ]);
    }
}
