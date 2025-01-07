<?php

namespace Database\Seeders;

use App\Models\Jogo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jogo::insert([
            ['nome' => 'DOKI DOKI ', 'id_genero' => 1],
            ['nome' => 'GOF OF WAR ', 'id_genero' => 2],
            ['nome' => 'DOTA 2  ', 'id_genero' => 3],
        ]);
    }
}
