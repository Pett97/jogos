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
    private $usuarioApiTeste;
    protected function setUp(): void
    {
        parent::setUp();
        $this->ususarioTeste = User::factory()->create([
            'password' => Hash::make('123456'),
        ]);

        $this->usuarioApiTeste = User::create([
            'name' => 'usuarioAPITESTE',
            'email' => 'usuario138@teste.com',
            'password' => Hash::make('123456')
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

    //API
    public function test_api_devo_conseguir_cadastrar_um_novo_usuario(): void
    {
        $response = $this->post('api/user/create', [
            'name' => 'usuarioAPI',
            'email' => 'usuario@teste.com',
            'password' => '123456',
            'password_confirmation' => '123456'
        ]);
        $response->assertStatus(200);
    }

    public function test_api_nao_devo_conseguir_cadastrar_um_novo_usuario_com_parametro_errado(): void
    {
        $response = $this->post('api/user/create', [
            'name' => 'usuarioAPI',
        ]);
        $response->assertStatus(302);
    }

    public function test_api_devo_conseguir_logar(): void
    {
        $response = $this->post('api/user/login', [
            'email' => $this->usuarioApiTeste->email,
            'password' => '123456'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'token',
        ]);
    }

    public function test_api__nao_devo_conseguir_logar_com_parametro_errado(): void
    {
        $response = $this->post('api/user/login', [
            'email' => $this->usuarioApiTeste->email,
        ]);

        $response->assertStatus(302);
    }

    public function test_api_devo_conseguir_fazer_logout(): void
    {
        $token = $this->usuarioApiTeste->createToken('Test Token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->post('api/user/logout');
        
        $response->assertStatus(201);

        $response->assertJson([
            'message' => 'Logout Realizado com sucesso',
        ]);

        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $this->usuarioApiTeste->id,
        ]);
    }

    //WEB

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
