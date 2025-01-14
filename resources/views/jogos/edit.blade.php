@extends('layouts.app')
@section('content')

<h5 class="center-align">
  Dados Jogo : {{$jogo->getNome()}}
</h5>

<section class="container">
  <div class="row center-align">
    <form action="{{ route('jogos.update',$jogo) }}" method="POST" class="col l12 m12 s12">
      @csrf <!-- Adicionado o token CSRF para proteção -->
      @method('PUT') <!-- Definindo o método PUT para a atualização -->
      <div class="row">
        <div class="input-field col l12 m12 s12">
          <input value="{{$jogo->getNome()}}" id="nome_jogo" type="text" class="validate" name="jogo[novoNome]" required minlength="3">
          <label for="nome_jogo">Nome Jogo</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col l12 m12 s12">
          <select name="id_genero" required>
            <option value="{{$generoAtual->id}}">{{$generoAtual->nome}}</option>
            @foreach($generos as $genero)
            @if($genero->id == $jogo->genero_id) selected @endif>
            <option value="{{$genero->id}}">{{$genero->nome}}</option>
            @endforeach
          </select>
          <label> Genero </label>
        </div>
      </div>
      <div class="row">
        <div class="center-align">
          <button class="waves-effect waves-light btn teal darken-1" type="submit">Salvar</button>
          <a href="<?= route('jogos.index') ?>" class="waves-effect waves-light btn yellow darken-4">Voltar</a>
        </div>
      </div>
    </form>

  </div>
</section>


@endsection