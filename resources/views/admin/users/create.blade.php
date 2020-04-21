@extends('adminlte::page')

@section('title', 'Novo usuário')

@section('content_header')
  <h1>Novo usuário</h1>
@endsection

@section('content')
  
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        <h5><i class="icon fas fa-ban"></i> Ocorreu um erro</h5>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="card">
    <div class="card-body">
      <form class="form-horizontal" method="POST" action="{{route('users.store')}}">
        @csrf
        <div class="form-group row">
          <label for="name" class="col-sm-2 col-form-label">Nome completo</label>
          <div class="col-sm-10">
            <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control @error('name') is-invalid @enderror">
          </div>
        </div>
  
        <div class="form-group row">
          <label for="email" class="col-sm-2 col-form-label">E-mail</label>
          <div class="col-sm-10">
            <input type="email" name="email" value="{{old('email')}}" id="email" class="form-control @error('email') is-invalid @enderror">
          </div>
        </div>
  
        <div class="form-group row">
          <label for="password" class="col-sm-2 col-form-label">Senha</label>
          <div class="col-sm-10">
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
          </div>
        </div>
  
        <div class="form-group row">
          <label for="password_confirmation" class="col-sm-2 col-form-label">Confirmar senha</label>
          <div class="col-sm-10">
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password') is-invalid @enderror">
          </div>
        </div>
  
        <div class="form-group row">
          <label class="col-sm-2 col-form-label"></label>
          <div class="col-sm-10">
            <input type="submit" class="btn btn-success" value="Cadastrar">
          </div>
        </div>
      </form>
    </div>
  </div>

@endsection