@extends('layouts.app')
@section('content')
<h5 class="center-align">
  Criar Novo Jogo
</h5>

<section class="container">
  <div class="row center-align">
    <form action="{{route('jogos.salvar')}}" method="POST" class="col s12">
      @csrf <!-- Adicionado para incluir o token CSRF -->
      <div class="row">
        <div class="input-field col m12 l12 s12">
          <input placeholder="Faldon Online" id="jogo_nome" name="jogo_nome" type="text" class="validate" required>
          <label for="jogo_nome">Nome do jogo</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 m12 l12">
          <select name="genero_id" required>
            <option value="" disabled selected>Escolha o Gênero</option>
            @foreach($generos as $genero)
            <option value="{{ $genero->id }}">{{ $genero->nome }}</option>
            @endforeach
          </select>
          <label>Genero</label>
          <br><br><br>
        </div>
      </div>
      <div class="center-align">
        <button class="waves-effect waves-light btn teal darken-1" type="submit">Salvar</button>
        <a href="{{route('jogos.index')}}" class="waves-effect waves-light btn yellow darken-4" type="submit">Voltar</a>
      </div>
    </form>
  </div>
</section>
@endsection