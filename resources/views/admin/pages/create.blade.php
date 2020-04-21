@extends('adminlte::page')

@section('title', 'Nova página')

@section('content_header')
  <h1>Nova página</h1>
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
      <form class="form-horizontal" method="POST" action="{{route('pages.store')}}">
        @csrf
        <div class="form-group row">
          <label for="title" class="col-sm-2 col-form-label">Título</label>
          <div class="col-sm-10">
            <input type="text" name="title" value="{{old('title')}}" id="title" class="form-control @error('title') is-invalid @enderror">
          </div>
        </div>
  
        <div class="form-group row">
          <label for="body" class="col-sm-2 col-form-label">Corpo</label>
          <div class="col-sm-10">
            <textarea name="body" id="body" class="form-control">{{old('body')}}</textarea>
          </div>
        </div>
  
        <div class="form-group row">
          <label class="col-sm-2 col-form-label"></label>
          <div class="col-sm-10">
            <input type="submit" class="btn btn-success" value="Criar">
          </div>
        </div>
      </form>
    </div>
  </div>

@endsection