@extends('admin.master')

@section('content_title', 'Productos')
@section('content_title_form', 'Crear Productos')

@section('content_form')

    <div class="form-group">
        <label for="title">Titulo</label>
        <input type="text" class="form-control" name="title" required placeholder="title..." value="{{ old('title')}}" autofocus>
        <span class="invalid-feedback" role="alert"></span>
    </div>

    <div class="form-group">
        <label for="price">price</label>
        <input type="text" class="form-control" name="price" required placeholder="price..." value="{{ old('price')}}">
        <span class="invalid-feedback" role="alert"></span>
    </div>
    <div class="form-group">
        <label for="description">inserte descipcion</label>
        <textarea class="form-control" name="description" required placeholder="Enter ...">{{ old('description')}}</textarea>
        <span class="invalid-feedback" role="alert"></span>
    </div>
    <div class="form-group">
        <label for="image_url">Imagen</label>
        <div class="input-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="image_url" required>
            <label class="custom-file-label" for="image_url">Choose file</label>
        </div>
        <div class="input-group-append">
            <span class="input-group-text">Upload</span>
        </div>
        </div>
    </div>
@stop
