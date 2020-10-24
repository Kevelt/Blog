@extends('admin.master')

@section('content_title', 'Productos')
@section('content_title_form', 'Lista de Productos')

@section('content_body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="{{ route('productCreate') }}"
            class="btn btn-primary btn-lg float-md-right active"
            role="button"
            aria-pressed="true">
            Create Products
        </a>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Lista de Productos</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

<!-- Main content -->
        <section class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="datatable table table-bordered table-hover">
                    <thead>
                    <tr role="row">
                        <th >Id</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>User</th>
                        <th>Tools</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->title}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->description}}</td>
                            <td><img src="{{$product->image_url}}" width="100" height="100" /></td>
                            <td>{{$product->user_id}}</td>
                            <td>......</td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
@stop


