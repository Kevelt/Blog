@extends('admin.master')

@section('content_title', 'Categorias')
@section('content_title_form', 'Crear Categorias')

@section('content_form')

    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control" name="name" required placeholder="name..." value="{{ old('name')}}" autofocus>
        <span class="invalid-feedback" role="alert"></span>
    </div>

@stop