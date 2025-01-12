<?php

namespace Tests\Feature\Controller;

use App\Models\Genero;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GeneroControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Genero::factory(3)->create();
    }

    public function test_devo_conseguir_listar_todos_os_generos()
    {

        $response = $this->getJson('/api/generos/list');


        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => ['id', 'nome']
        ]);
    }

    public function test_devo_conseguir_buscar_um_genero()
    {

        $genero = Genero::first();

        $response = $this->getJson('/api/generos/get/' . $genero->id);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'id',
            'nome'
        ]);
    }

    public function test_devo_conseguir_atualizar_um_genero(): void
    {
        $genero = Genero::first();

        $dadosAtualizados = [
            'nome' => 'Novo Nome Atualizado'
        ];

        $response = $this->putJson('api/generos/update/' . $genero->id, $dadosAtualizados);

        $response->assertStatus(200);
    }

    public function test_devo_conseguir_deletar_um_genero(): void
    {
        $genero  = Genero::first();

        $response = $this->deleteJson('api/generos/delete/' . $genero->id);

        $response->assertStatus(200);
    }

    public function test_nao_devo_conseguir_listar_um_genero_nao_cadastrado(): void
    {
        $id = '99';
        $response = $this->getJson('api/generos/get/' . $id);

        $response->assertStatus(404);
    }
}
