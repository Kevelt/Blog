@extends('admin.master')

@section('content_title', 'Categorias')
@section('content_title_form', 'Crear Categorias')

@section('content_form')
    <x-forms.group title="Nombre" name="name">
        <input type="text" class="form-control" name="name" required placeholder="name..." value="{{ old('name')}}" autofocus>
    </x-forms.group>
    <x-forms.group title="Productos" name="products">
        <x-forms.select name="products" :values="[1=>'Zapato1', 2=>'Zapato Rojo', 6=>'Zapato Azul']" :required="true" :selected="6" :multiple="true" class="duallistbox"/>
    </x-forms.group>
@stop