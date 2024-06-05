<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // on lance les seeders l'ordre des seeders ici ne compte pas
        $this->call([
            ProfilSeeder::class,
            AdministrateurSeeder::class,
        ]);
    }
}
