<?php

namespace Tests\Feature\Feature;

use App\Models\Jogo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JogoApiControllerTest extends TestCase
{
    private $usuarioTestJogo;
    private $generoTesteJogo;
    private $jogo;
    use RefreshDatabase;

    protected function setUp(): void
    {;
        parent::setUp();
        Jogo::factory(2)->create();
        $this->usuarioTestJogo = User::factory()->create();
    }

    public function test_devo_conseguir_listar_todos_os_jogos()
    {
        $response = $this->actingAs($this->usuarioTestJogo)->getJson('/api/jogos/list');
        $response->assertStatus(200);
    }

    public function test_nao_devo_conseguir_listar_todos_os_jogos_sem_autenticacao(): void
    {
        $response = $this->getJson('/api/jogos/list');
        $response->assertStatus(401);
    }

    public function test_devo_conseguir_buscar_um_jogo()
    {
        $jogo = Jogo::first();
        $response = $this->actingAs($this->usuarioTestJogo)->getJson('api/jogos/get/' . $jogo->id);
        $response->assertStatus(200);
    }

    public function test_nao_devo_conseguir_buscar_um_jogo_sem_autenticacao(): void
    {
        $jogo = Jogo::first();
        $response = $this->getJson('api/jogos/get/' . $jogo->id);
        $response->assertStatus(401);
    }

    public function test_devo_conseguir_atualizar_um_jogo(): void
    {
        $jogo = Jogo::first();
        $dadosAtualizados = [
            'nome' => 'Novo Nome Atualizado'
        ];
        $response = $this->actingAs($this->usuarioTestJogo)->putJson('api/jogos/update/' . $jogo->id, $dadosAtualizados);
        $response->assertStatus(200);
    }

    public function test_nao_devo_conseguir_atualizar_um_jogo_sem_autenticacao(): void
    {
        $jogo = Jogo::first();
        $dadosAtualizados = [
            'nome' => 'Novo Nome Atualizado'
        ];
        $response = $this->putJson('api/jogos/update/' . $jogo->id, $dadosAtualizados);
        $response->assertStatus(401);
    }

    public function test_devo_conseguir_deletar_um_jogo(): void
    {
        $jogo  = Jogo::first();
        $response = $this->actingAs($this->usuarioTestJogo)->deleteJson('api/jogos/delete/' . $jogo->id);
        $response->assertStatus(202);
    }

    public function test_nao_devo_conseguir_deletar_um_jogo_sem_autenticacao(): void
    {
        $jogo  = Jogo::first();
        $response = $this->deleteJson('api/jogos/delete/' . $jogo->id);
        $response->assertStatus(401);
    }

    public function test_nao_devo_conseguir_listar_um_jogo_nao_cadastrado(): void
    {
        $id = '99';
        $response = $this->actingAs($this->usuarioTestJogo)->getJson('api/jogos/get/' . $id);
        $response->assertStatus(404);
    }

    public function test_nao_devo_conseguir_listar_um_jogo_nao_cadastrado_sem_autenticacao(): void
    {
        $id = '99';
        $response = $this->getJson('api/jogos/get/' . $id);
        $response->assertStatus(401);
    }
}
