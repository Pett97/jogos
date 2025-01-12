<?php

namespace Tests\Feature\Feature;
use App\Models\Jogo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JogoControllerTest extends TestCase
{
    private $generoTesteJogo;
    private $jogo;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Jogo::factory(2)->create();
    }


    public function test_devo_conseguir_listar_todos_os_jogos()
    {
        $response = $this->getJson('/api/jogos/list');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'nome', 'id_genero']
        ]);
    }


    public function test_devo_conseguir_buscar_um_jogo()
    {
        $jogo = Jogo::first();
        $response = $this->getJson('api/jogos/get/' . $jogo->id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'nome',
            'id_genero'
        ]);
    }

    public function test_devo_conseguir_atualizar_um_jogo(): void
    {
        $jogo = Jogo::first();
        $dadosAtualizados = [
            'nome' => 'Novo Nome Atualizado'
        ];
        $response = $this->putJson('api/jogos/update/' . $jogo->id, $dadosAtualizados);
        $response->assertStatus(200);
    }

    public function test_devo_conseguir_deletar_um_jogo(): void
    {
        $jogo  = Jogo::first();
        $response = $this->deleteJson('api/jogos/delete/' . $jogo->id);
        $response->assertStatus(202);
    }


    public function test_nao_devo_conseguir_listar_um_jogo_nao_cadastrado(): void
    {
        $id = '99';
        $response = $this->getJson('api/jogos/get/' . $id);
        $response->assertStatus(404);
    }
}
