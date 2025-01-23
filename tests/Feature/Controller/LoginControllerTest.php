<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_devo_conseguir_criar_usuario(): void
    {
        $usuario = User::factory()->create();
        
        $this->assertDatabaseHas('users', [
            'email' => $usuario->email,
        ]);
    }

    public function test_devo_conseguir_fazer_login(): void
    {
        $usuario2 = User::factory()->create([
            'password' => Hash::make('123456'),
        ]);

        $response = $this->post('/login', [
            'login_email' => $usuario2->email,
            'login_password' => '123456',
        ], [
            'X-CSRF-TOKEN' => csrf_token(),
        ]);

        //$response->assertRedirect('/generos/list');
    }
}
