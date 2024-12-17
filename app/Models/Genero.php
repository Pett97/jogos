<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{

    protected $fillable = [
        'nome'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (isset($attributes['nome'])) {
            $this->attributes['nome'] = strtoupper($attributes['nome']);
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($novoNome){
        $this->nome = strtoupper($novoNome);
    }
}
