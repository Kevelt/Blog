@extends('admin.master')

@section('content_title', 'Categorias')
@section('content_title_form', 'Crear Categorias')

@section('content_form')
    <x-forms.group title="Nombre" name="name">
        <x-forms.input name="name" :value="old('name')" :required="true" placeholder="name..." autofocus />
    </x-forms.group>
    <x-forms.group title="Productos" name="products">
        <x-forms.select name="products" :values="$products" text="title" :required="true" :selected="old('products')" :multiple="true" class="duallistbox"/>
    </x-forms.group>
@stop