@extends('layouts.app')
@section('content')
<header>
  <nav>
    <div class="nav-wrapper lime darken-1">
      <a class="brand-logo center">Generos De Jogos</a>
      <div class="right">
        <a class="waves-effect waves-light btn teal darken-1" href="{{route('generos.create')}}">Criar</a>
      </div>
    </div>
  </nav>
</header>
</section>
<table class="striped responsive-table centered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Genero</th>
      <th>Acoes</th>
    </tr>
  </thead>

  <tbody>
    @foreach($generos as $genero)
    <tr>
      <td>{{$genero->getId()}}</td>
      <td>{{$genero->getNome()}}</td>
      <td>
        <a class="waves-effect waves-light btn blue" href="{{route('generos.edit',$genero->getId())}}"><i class=" tiny material-icons">edit</i></a>
        <form action="{{ route('generos.deletar', $genero->getId()) }}" method="POST" style="display:inline;">
          @csrf
          @method('DELETE') <!-- Define o método DELETE -->
          <button type="submit" class="waves-effect waves-light btn red">
            <i class="tiny material-icons">delete</i>
          </button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection