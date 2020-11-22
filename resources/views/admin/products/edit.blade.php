@extends('admin.master')

@section('content_title', 'Productos')
@section('content_title_form', 'Editar Productos')
@section('content_form_attr', "noreset=true")

@section('content_form')

    <input type="hidden" class="form-control" name="id" required value="{{ $product->id }}">

    <div class="form-group">
        <label for="title">Titulo</label>
        <input type="text" class="form-control" name="title" required placeholder="title..." value="{{ $product->title }}" autofocus>
        <span class="invalid-feedback" role="alert"></span>
    </div>

    <div class="form-group">
        <label for="price">Precio</label>
        <input type="text" class="form-control" name="price" required placeholder="price..." value="{{ $product->price }}">
        <span class="invalid-feedback" role="alert"></span>
    </div>
    <div class="form-group">
        <label for="description">inserte descripcion</label>
        <textarea class="form-control" name="description" required placeholder="Enter ...">{{ $product->description }}</textarea>
        <span class="invalid-feedback" role="alert"></span>
    </div>
    <div class="form-group">
        <label for="image_url">Imagen</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input custom-file-input--img custom-file-input--img-preview" name="image_url" >
                <label class="custom-file-label" for="image_url">Choose file</label>
            </div>
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <label class="input-group-text" for="image_url">
                    <img id="image_url_img" src="{{$product->image_url}}" width="100" height="100" />
                </label>
            </div>
        </div>
    </div>

    <script>
        CKEDITOR.replace( 'description' );
    </script>
@stop