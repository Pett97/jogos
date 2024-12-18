@extends('layouts.app')
@section('content')

<h5 class="center-align">
  Dados Genero : {{$genero->getNome()}}
</h5>

<section class="container">
  <div class="row center-align">
    <form action="{{ route('generos.update',$genero) }}" method="POST" class="col l12 m12 s12">
      @csrf <!-- Adicionado o token CSRF para proteção -->
      @method('PUT') <!-- Definindo o método PUT para a atualização -->
      <div class="row">
        <div class="input-field col l12 m12 s12">
          <input value="{{$genero->getNome()}}" id="nome_genero" type="text" class="validate" name="genero[novoNome]" required minlength="3">
          <label for="nome_genero">Nome Genero</label>
        </div>
      </div>
      <div class="center-align">
        <button class="waves-effect waves-light btn teal darken-1" type="submit">Salvar</button>
        <a href="<?= route('generos.index') ?>" class="waves-effect waves-light btn yellow darken-4">Voltar</a>
      </div>
    </form>

  </div>
</section>


@endsection