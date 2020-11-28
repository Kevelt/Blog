@extends('layouts.clean-blog')

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('img/malalacake.jpg')">
        <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="site-heading">
                        <h1>Shop</h1>
                        <span class="subheading">A Blog Theme by Start Bootstrap</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
    <div class="row">

<div class="col-lg-3">
  <h1 class="my-4">Shop Name</h1>
  <div class="list-group">
    <a href="#" class="list-group-item active">Category 1</a>
    <a href="#" class="list-group-item">Category 2</a>
    <a href="#" class="list-group-item">Category 3</a>
  </div>
</div>
<!-- /.col-lg-3 -->

<div class="col-lg-9">

  <div class="card mt-4">
    <img class="card-img-top img-fluid" src="http://placehold.it/900x400" alt="">
    <div class="card-body">
      <h3 class="card-title">Product Name</h3>
      <h4>$24.99</h4>
      <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente dicta fugit fugiat hic aliquam itaque facere, soluta. Totam id dolores, sint aperiam sequi pariatur praesentium animi perspiciatis molestias iure, ducimus!</p>
      <span class="text-warning">★ ★ ★ ★ ☆</span>
      4.0 stars
    </div>
  </div>
  <!-- /.card -->

  <div class="card card-outline-secondary my-4">
    <div class="card-header">
      Product Reviews
    </div>
    <div class="card-body">
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
      <small class="text-muted">Posted by Anonymous on 3/1/17</small>
      <hr>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
      <small class="text-muted">Posted by Anonymous on 3/1/17</small>
      <hr>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
      <small class="text-muted">Posted by Anonymous on 3/1/17</small>
      <hr>
      <a href="#" class="btn btn-success">Leave a Review</a>
    </div>
  </div>
  <!-- /.card -->

</div>
<!-- /.col-lg-9 -->

</div>
    </div>

    <hr>
@endsection