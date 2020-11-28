@extends('admin.master')

@section('content_title', 'Categorias')
@section('content_title_form', 'Crear Categorias')

@section('content_form')

    <div class="form-group">
        <x-label title="Nombre" name="name" />
        <input type="text" class="form-control" name="name" required placeholder="name..." value="{{ old('name')}}" autofocus>
        <span class="invalid-feedback" role="alert"></span>
    </div>
    <x-forms.group name="products" title="Productos">
        <x-forms.select name="products" :required="true" :values="[1=>'Zapato1', 2=>'Zapato Rojo', 6=>'Zapato Azul']" :selected="6" :multiple="true" class="duallistbox"/>
    </x-forms.group>
@stop