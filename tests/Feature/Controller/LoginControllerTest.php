<?php

namespace Tests\Feature;

use App\Models\Genero;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;
    private $ususarioTeste;
    protected function setUp(): void
    {
        parent::setUp();
        $this->ususarioTeste = User::factory()->create([
            'password' => Hash::make('123456'),
        ]);

        Genero::factory(3)->create();
    }

    public function test_devo_conseguir_criar_usuario(): void
    {
        $usuario = User::factory()->create();

        $this->assertDatabaseHas('users', [
            'email' => $usuario->email,
        ]);
    }

    public function test_devo_conseguir_fazer_login_usuario_com_sessao(): void
    {

        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token(), //n funfa sem  
        ])->actingAs($this->ususarioTeste)->post(route('login'), [
            'login_email' => $this->ususarioTeste->email,
            'login_password' => '123456',
        ]);

        $response->assertRedirect('/generos/lista');
    }

    public function test_usuario_nao_autenticado_nao_pode_visualizar_os_generos(): void
    {
        $response = $this->get('/generos/lista');

        $response->assertRedirect('/');
    }

    public function test_usuario_autenticado_pode_visualizar_formulario_editar_genero(): void
    {
        $genero = Genero::first();

        $response = $this->actingAs($this->ususarioTeste)->get(route('generos.edit', ['genero' => $genero->id]));

        $response->assertViewIs('generos.edit');
    }

    public function test_usuario_nao_autenticado_nao_pode_visualizar_formulario_editar_genero(): void
    {
        $genero = Genero::first();

        $response = $this->get(route('generos.edit', ['genero' => $genero->id]));

        $response->assertRedirect('/');
    }
}
