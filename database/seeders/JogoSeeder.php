<?php

namespace Database\Seeders;

use App\Models\Genero;
use App\Models\Jogo;
use Illuminate\Database\Seeder;

class JogoSeeder extends Seeder
{
    /**
     * Run the database seeds.  
     */
    public function run(): void
    {
        $genero1 = Genero::create(['nome' => 'Genero 1']);
        $genero2 = Genero::create(['nome' => 'Genero 2']);
        Jogo::insert([
            ['nome' => 'DOKI DOKI', 'id_genero' => $genero1->id],
            ['nome' => 'GOF OF WAR', 'id_genero' => $genero1->id],
            ['nome' => 'DOTA 2', 'id_genero' => $genero2->id],
        ]);
    }
}
