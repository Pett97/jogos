<?php

namespace Tests\Unit;

use App\Models\Genero;
use App\Models\Jogo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JogoTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    use RefreshDatabase;

    private $jogo;

    private $generoTesteJogo;
    private $generoTesteJogo2;

    protected function setUp(): void
    {
        parent::setUp();

        $this->generoTesteJogo = Genero::factory()->make(['nome' => 'GeneroTesteJogo']);
        $this->generoTesteJogo2 = Genero::factory()->make(['nome' => 'GeneroTesteJogo2']);

        $this->artisan('migrate');
        $this->jogo = Jogo::factory()->make(['nome' => 'JogoTeste', 'id_genero' => 1]);
    }

    public function test_posso_obter_o_nome__do_jogo()
    {
        $this->assertEquals('JOGOTESTE', $this->jogo->getNome());
    }

    public function test_posso_alterar_o_nome_do_jogo()
    {

        $this->assertEquals('JOGOTESTE', $this->jogo->getNome());
        $this->jogo->setNome("joGo2");

        $this->assertEquals('JOGO2', $this->jogo->getNome());
    }

    public function test_devo_conseguir_obter_o_id_genero()
    {
        $this->assertEquals(1, $this->jogo->getIdGenero());
    }

    public function test_devo_conseguir_alterar_o_id_genero()
    {
        $this->assertEquals(1, $this->jogo->getIdGenero());

        $this->jogo->setIdGenero(2);

        $this->assertEquals(2, $this->jogo->getIdGenero());
    }

    public function test_devo_obter_o_nome_genero()
    {
        $generoRpg = Genero::create(['nome' => "RPG"]);

        $this->jogo->setIdGenero($generoRpg->getId());

        $this->jogo->save();

        $this->assertEquals('RPG', $this->jogo->getGenero->getNome());
    }

    //teste banco

    public function test_banco_devo_ter_jogo_salvo()
    {
        $generoRpg = Genero::create(['nome' => "RPG"]);

        $jogo = Jogo::create(['nome' => 'Diablo2', 'id_genero' => $generoRpg->getId()]);

        $this->assertDatabaseHas('jogos', ['nome' => $jogo->getNome()]);
    }

    public function test_devo_conseguir_alterar_o_nome_do_genero_no_banco()
    {
        $generoRpg = Genero::create(['nome' => "RPG"]);

        $jogoShandowFlare = Jogo::create(['nome' => 'ShandowFlare', 'id_genero' => $generoRpg->getId()]);

        $this->assertDatabaseHas('jogos', ['nome' => $jogoShandowFlare->getNome()]);

        $jogoShandowFlare->update(['nome' => "ShandowFlare2"]);

        $this->assertDatabaseHas('jogos', ['nome' => 'ShandowFlare2']);

        $this->assertDatabaseMissing('jogos', ['nome' => 'ShandowFlare']);
    }

    public function test_devo_conseguir_deletar_o_jogo_do_banco(): void
    {
        $generoRpg = Genero::create(['nome' => "RPG"]);

        $jogoShandowFlare = Jogo::create(['nome' => 'ShandowFlare', 'id_genero' => $generoRpg->getId()]);

        $this->assertDatabaseHas('jogos', ['nome' => $jogoShandowFlare->getNome()]);

        $jogoShandowFlare->delete();

        $this->assertDatabaseMissing('jogos', ['nome' => 'ShandowFlare']);
    }

    public function test_devo_conseguir_alterar_o_id_banco():void
    {
        $generoTeste = Genero::create(['nome' => "TESTE"]);
        $generoAtualizar = Genero::create(['nome' => "TESTE"]);

        $jogoShandowFlare = Jogo::create(['nome' => 'ShandowFlare', 'id_genero' => $generoTeste->getId()]);

        $jogoShandowFlare->update(['id_genero'=>$generoAtualizar->id]);        

        $this->assertDatabaseHas('jogos',['nome'=>$jogoShandowFlare->nome,'id_genero'=>$generoAtualizar->id]);
    }
}
