<?php

namespace Database\Seeders;

use App\Models\Profil;
use Database\Factories\ProfilFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //creation de profils fictifs
        Profil::factory(10)->create();
    }
}
