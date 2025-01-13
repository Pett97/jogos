@extends('layouts.app')
@section('content')
<header>
  <nav>
    <div class="nav-wrapper lime darken-1">
      <a class="brand-logo center">Jogos</a>
      <div class="right">
        <a class="waves-effect waves-light btn teal darken-1" href="{{route('jogos.create')}}">Criar</a>
      </div>
    </div>
  </nav>
</header>
</section>
<table class="striped responsive-table centered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Jogo</th>
      <th>Genero</th>
      <th>Acoes</th>
    </tr>
  </thead>

  <tbody>
    @foreach($jogos as $jogo)
    <tr>
      <td>{{$jogo->getId()}}</td>
      <td>{{$jogo->getNome()}}</td>
      <td>{{$jogo->getNomeGenero()}}</td>
      <td>
        <a class="waves-effect waves-light btn blue" href="{{route('jogos.edit',$jogo->getId())}}"><i class=" tiny material-icons">edit</i></a>
        <form action="{{ route('jogos.deletar', $jogo->getId()) }}" method="POST" style="display:inline;">
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