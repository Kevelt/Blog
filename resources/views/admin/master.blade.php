@extends('adminlte::page')

@hasSection('content_title')
    @section('title')@yield('content_title')@stop

    @section('content_header')
        <h1>
            @yield('content_title')
        </h1>
    @stop
@endif

@section('usermenu_header')
    <li class="user-header {{ config('adminlte.usermenu_header_class', 'bg-primary') }}
        @if(!config('adminlte.usermenu_image')) h-auto @endif">
        @if(config('adminlte.usermenu_image'))
            <img src="{{ Auth::user()->adminlte_image() }}"
                    class="img-circle elevation-2"
                    alt="{{ Auth::user()->name }}">
        @endif
        <p class="@if(!config('adminlte.usermenu_image')) mt-0 @endif">
            {{ Auth::user()->name }}
            @if(config('adminlte.usermenu_desc'))
                <small>{{ Auth::user()->adminlte_desc() }}</small>
            @endif
        </p>
    </li>
    <li>
        <a class="btn btn-default btn-flat float-right btn-block"
            href="shop">
            <i class="fa fa-fw fa-power-off"></i>
            Shop
        </a>
    </li>
@stop

@section('content')
    <div class="card card-dark color-palette-box">
        @hasSection('content_title_form')
            <div class="card-header">
                <h3 class="card-title">
                    @yield('content_title_form')
                </h3>
            </div>
        @endif
        <div class="card-body">
            @hasSection('content_form')
                <form class="customform" action="@yield('content_form_action')">
                    @csrf
                    @yield('content_form')

                    <div class="card-footer">
                        <div class="form-message col text-center"></div>
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            @endif

            @hasSection('content_body')
                @yield('content_body')
            @endif
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset('js/custom.js') }}" defer></script>
@stop
