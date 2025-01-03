@extends('layouts.app')
@section('content')

<h5 class="center-align">
  Criar Novo Genero
</h5>

<section class="container">
  <div class="row center-align">
    <form action="{{route('generos.salvar')}}" method="POST" class="col s12">
      @csrf <!-- Adicionado para incluir o token CSRF -->
      <div class="row">
        <div class="input-field col m12 l12 s12">
          <input placeholder="Exemplo: RPG" id="genero_nome" name="genero_nome" type="text" class="validate">
          <label for="genero_nome">Nome do genero</label>
        </div>
      </div>
      <div class="center-align">
        <button class="waves-effect waves-light btn teal darken-1" type="submit">Salvar</button>
        <a href="{{route('generos.index')}}" class="waves-effect waves-light btn yellow darken-4" type="submit">Voltar</a>
      </div>
    </form>
  </div>
</section>

@endsection