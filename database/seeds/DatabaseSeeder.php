<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            DendaSeeder::class,
            GedungSeeder::class,
            GoldarSeeder::class,
            JalurMasukSeeder::class,
            StatuRumahSeeder::class,
            TugasSeeder::class,
            FakultasSeeder::class,
        ]);
    }
}
