<?php

namespace Tests\Feature\Controller;

use App\Models\Genero;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GeneroApiControllerTest extends TestCase
{
    use RefreshDatabase;

    private $usuarioTeste;
    protected function setUp(): void
    {
        parent::setUp();
        Genero::factory(3)->create();
        $this->usuarioTeste = User::factory()->create();
    }

    public function test_devo_conseguir_listar_todos_os_generos()
    {

        //$response = $this->getJson('/api/generos/list');
        $response = $this->actingAs($this->usuarioTeste)->getJson('/api/generos/list');


        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => ['id', 'nome']
        ]);
    }

    public function test_devo_conseguir_buscar_um_genero()
    {

        $genero = Genero::first();

        $response = $this->actingAs($this->usuarioTeste)->getJson('/api/generos/get/' . $genero->id);
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


        $response = $this->actingAs($this->usuarioTeste)->putJson('api/generos/update/' . $genero->id, $dadosAtualizados);

        $response->assertStatus(200);
    }

    public function test_devo_conseguir_deletar_um_genero(): void
    {
        $genero  = Genero::first();

        $response = $this->actingAs($this->usuarioTeste)->deleteJson('api/generos/delete/' . $genero->id);

        $response->assertStatus(200);
    }

    public function test_nao_devo_conseguir_listar_um_genero_nao_cadastrado(): void
    {
        $id = '99';
        $response = $this->actingAs($this->usuarioTeste)->getJson('api/generos/get/' . $id);

        $response->assertStatus(404);
    }
}
