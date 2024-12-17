@extends('layouts.app')
@section('content')
  <header>
  <nav>
    <div class="nav-wrapper lime darken-1">
      <a class="brand-logo center">Generos</a>
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
             <a href="{{route('generos.edit',$genero->getId())}}"><i class=" tiny material-icons">edit</i></a>
             <a href=""><i class=" tiny material-icons">delete</i></a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection