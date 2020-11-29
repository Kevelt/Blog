@extends('admin.master')

@section('content_title', 'Productos')
@section('content_title_form', 'Crear Productos')

@section('content_form')

    <x-forms.group title="Title" name="title">
        <x-forms.input name="title" :value="old('title')" :required="true" placeholder="title..." autofocus />
    </x-forms.group>
    <x-forms.group title="Price" name="price">
        <x-forms.input name="price" :value="old('price')" :required="true" placeholder="price..." />
    </x-forms.group>
    <x-forms.group title="Insert description" name="description">
        <x-forms.textarea name="description" :value="old('description')" :required="true" placeholder="Enter ..." />
    </x-forms.group>
    <x-forms.group title="Image" name="image_url">
        <x-forms.input name="image_url" :value="old('image_url')" :required="true" type="img" />
    </x-forms.group>

@stop
