<?php

namespace Tests\Unit;

use App\Models\Genero;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GeneroTest extends TestCase
{
    use RefreshDatabase; // Reseta o banco de teste

    private $novoGenero;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->novoGenero = Genero::factory()->make(['nome' => 'GeneroTeste']);
    }

    public function test_o_nome_deve_retornar_em_maisculo(): void
    {
        $this->assertEquals("GENEROTESTE", $this->novoGenero->getNome());
    }

    public function test_devo_conseguir_alterar_o_nome(): void
    {
        $this->assertEquals("GENEROTESTE", $this->novoGenero->getNome());

        $this->novoGenero->setNome("novoNome");

        $this->assertEquals("NOVONOME", $this->novoGenero->getNome());
    }


    //testes bancos 

    public function test_registrou_no_banco():void
    {
        $this->novoGenero = Genero::create(['nome' => 'GeneroTesteBanco']);
        $this->assertDatabaseHas('generos', ['nome' => 'GeneroTesteBanco',]);

    }

    public function test_devo_conseguir_alterar_nome_genero_no_banco():void
    {
        $this->novoGenero = Genero::create(['nome'=>'GeneroAtualizarNome']);
        $this->assertDatabaseHas('generos',['nome'=>'GeneroAtualizarNome']);

        $this->novoGenero->update(['nome'=>'NomeAtualizado']);

        $this->assertDatabaseHas('generos',['nome'=>'NomeAtualizado']);
        
        $this->assertDatabaseMissing('generos', ['nome' => 'GeneroAtualizarNome']);
    }

    public function test_devo_conseguir_deletar_o_genero_no_banco() : void 
    {
        $this->novoGenero = Genero::create(['nome'=>'GeneroParaDeletar']);
        $this->assertDatabaseHas('generos',['nome'=>'GeneroParaDeletar']);

        $this->novoGenero->delete();
        $this->assertDatabaseMissing('generos', ['nome' => 'GeneroParaDeletar']);
    }
}
