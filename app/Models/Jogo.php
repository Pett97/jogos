<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    /** @use HasFactory<\Database\Factories\JogoFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'nome',
        'id_genero'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (isset($attributes['nome'])) {
            $this->attributes['nome'] = strtoupper($attributes['nome']);
        }
    }

    public function getGenero(){
        return $this->belongsTo(Genero::class,'id_genero');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($novoNome)
    {
        if ($novoNome) {
            $this->nome = strtoupper($novoNome);
        }
    }

    public function getIdGenero()
    {
        return $this->id_genero;
    }

    public function setIdGenero($novoId)
    {
        if ($novoId) {
            $this->id_genero = $novoId;
        }
    }
}
