@extends('layouts.app')
@section('content')
<h5 class="center-align">
Login
</h5>

<section class="container">
  <div class="row center-align">
    <form action="{{route('login')}}" method="POST" class="col s12">
      @csrf <!-- Adicionado para incluir o token CSRF -->
      <div class="row">
        <div class="input-field col m12 l12 s12">
          <input placeholder="login" id="login_email" name="login_email" type="email" class="validate" required>
          <label for="login_email">Seu Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col m12 l12 s12">
          <input placeholder="senha" id="login_password" name="login_password" type="password" class="validate" required>
          <label for="login_password">Sua senha </label>
        </div>
      </div>
      <div class="center-align">
        <button class="waves-effect waves-light btn teal darken-1" type="submit">Login</button>
      </div>
    </form>
  </div>
</section>
@endsection