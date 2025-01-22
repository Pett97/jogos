<?php

namespace Tests\Feature\Controller;

use App\Models\Genero;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GeneroControllerTest extends TestCase
{
    use RefreshDatabase;

    private $usuarioTeste;
    protected function setUp(): void
    {
        parent::setUp();
        Genero::factory(3)->create();
        $this->usuarioTeste = User::factory()->create();
    }

    public function test_url_base_retorna_a_view_login()
    {
        $response = $this->actingAs($this->usuarioTeste)->get("/");

        $response->assertStatus(200)
                 ->assertViewIs('login');
    }

    public function test_nao_posso_acesar_sem_logar()
    {  

        $genero = Genero::first();
        $response = $this->get("generos/lista");  

        $response->assertStatus(302);

        $response->assertRedirect(route('login'));
        
        $response = $this->get("generos/criar");  

        $response->assertStatus(302);

        $response->assertRedirect(route('login'));

        $response= $this->get("generos/{$genero->id}/edit");

        $response->assertStatus(302);

        $response->assertRedirect(route('login'));
    }
}
