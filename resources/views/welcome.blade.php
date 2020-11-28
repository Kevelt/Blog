@extends('layouts.clean-blog')

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('img/tortamalala.jpg')">
        <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="site-heading">
                        <h1>Malalacake</h1>
                        <span class="subheading">Made With Love</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    
    <div class="glide" style="" data-slider='{"type":"carousel","componentName":"products","arrows":"true","perView":"3","autoplay":"5000","startAt":"0","focusAt":"center","hoverpause":"true","peek":{"before":"0","after":"0"},"breakpoints":{"900":{"perView":"2"},"680":{"perView":"1"}},"bullets":"true","arrows":"true"}'>
        <div class="glide_track" style="overflow: hidden;" data-glide-el="track">
            <ul class="glide__slides">
                <li class="glide__slide">
                    <img id="image_url_img" src="img/tortamalala.jpg" width="300" height="300" />
                </li>
                <li class="glide__slide">
                    <img id="image_url_img" src="img/tortamalala.jpg" width="300" height="300" />
                </li>
                <li class="glide__slide">
                    <img id="image_url_img" src="img/tortamalala.jpg" width="300" height="300" />
                </li>
                <li class="glide__slide">
                    <img id="image_url_img" src="img/tortamalala.jpg" width="300" height="300" />
                </li>
                <li class="glide__slide">
                    <img id="image_url_img" src="img/tortamalala.jpg" width="300" height="300" />
                </li>
                <li class="glide__slide">
                    <img id="image_url_img" src="img/tortamalala.jpg" width="300" height="300" />
                </li>
                <li class="glide__slide">
                    <img id="image_url_img" src="img/tortamalala.jpg" width="300" height="300" />
                </li>
                <li class="glide__slide">
                    <img id="image_url_img" src="img/tortamalala.jpg" width="300" height="300" />
                </li>
            </ul>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <h1 class="my-4">Shop Name</h1>
                <div class="list-group">
                    <a href="#" class="list-group-item">Category 1</a>
                    <a href="#" class="list-group-item">Category 2</a>
                    <a href="#" class="list-group-item">Category 3</a>
                </div>
            </div>
            <!-- /.col-lg-3 -->
            <div class="col-lg-9">
                    <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                        <img class="d-block img-fluid" src="img/tortamalala.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block img-fluid" src="img/tortamalala.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block img-fluid" src="img/tortamalala.jpg" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                            <a href="#"><img class="card-img-top" src="{{$product->image_url}}" alt=""></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                <a href="#">{{$product->title}}</a>
                                </h4>
                                <h5>{{$product->price}}</h5>
                                <p class="card-text">{{$product->getDescription()}}</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">★ ★ ★ ★ ☆</small>
                            </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
                <!-- /.col-lg-9 -->
            </div>
            <!-- Pager -->
            <div class="clearfix">
                <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
            </div>
        </div>
    </div>


    <hr>
@endsection