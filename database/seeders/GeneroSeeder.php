<?php

namespace Database\Seeders;

use App\Models\Genero;
use Illuminate\Database\Seeder;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genero::insert([
            ['nome'=>"VISUAL NOVEL"],
            ['nome'=>"ACTION RPG"],
            ['nome'=>"MOBA"],
            ['nome'=>"SIMULADOR"]
        ]);
    }
}
