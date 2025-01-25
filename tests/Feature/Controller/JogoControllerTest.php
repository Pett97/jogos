<?php

namespace Tests\Feature;

use App\Models\Jogo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JogoControllerTest extends TestCase
{
    private $usuarioTestJogo2;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Jogo::factory(2)->create();
        $this->usuarioTestJogo2 = User::factory()->create();
    }

    public function test_nao_posso_acesar_sem_logar()
    {

        $jogo = Jogo::first();
        $response = $this->get("jogos/lista");

        $response->assertStatus(302);

        $response->assertRedirect(route('login'));

        $response = $this->get("jogos/criar");

        $response->assertStatus(302);

        $response->assertRedirect(route('login'));

        $response = $this->get("jogos/{$jogo->id}/edit");

        $response->assertStatus(302);

        $response->assertRedirect(route('login'));
    }

    public function test_posso_acesar_logado()
    {

        $jogo = Jogo::first();
        $response = $this->actingAs($this->usuarioTestJogo2)->get("jogos/lista");

        $response->assertStatus(200);

        $response = $this->actingAs($this->usuarioTestJogo2)->get("jogos/criar");

        $response->assertStatus(200);

        $response = $this->actingAs($this->usuarioTestJogo2)->get("jogos/{$jogo->id}/edit");

        $response->assertStatus(200);
    }
}
