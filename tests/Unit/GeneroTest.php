<?php

namespace Tests\Unit;

use App\Models\Genero;
use PHPUnit\Framework\TestCase;

class GeneroTest extends TestCase
{
    private $novoGenero;

    protected function setUp():void{
        parent::setUp();
        $this->novoGenero = new Genero(['nome'=>"GeneroTeste"]);
    }

    public function test_o_nome_deve_retornar_em_maisculo(): void
    {
        $this->assertEquals($this->novoGenero->getNome(),"GENEROTESTE");
    }

    public function test_devo_conseguir_alterar_o_nome():void
    {
        $this->assertEquals($this->novoGenero->getNome(),"GENEROTESTE");

        $this->novoGenero->setNome("novoNome");

        $this->assertEquals($this->novoGenero->getNome(),"NOVONOME");
    }
}
