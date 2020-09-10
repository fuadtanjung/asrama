<?php

use Illuminate\Database\Seeder;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'fuad',
            'nim' => '1611523004',
            'password' => bcrypt('admin123'),
            'role_id'   => 1,
            'remember_token' => Str::random(30),
        ]);

        User::create([
            'name' => 'yori',
            'nim' => '1611521022',
            'password' => bcrypt('mahasiswa123'),
            'role_id'   => 2,
            'remember_token' => Str::random(30),
        ]);
    }
}
