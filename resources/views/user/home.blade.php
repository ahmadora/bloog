@extends('layouts.layout')
@section('title') Index @endsection
{{--@section('navbar')--}}
{{--    <div class="tm-col-right">--}}
{{--        <nav class="navbar navbar-expand-lg " id="tm-main-nav">--}}
{{--            <div class="collapse navbar-collapse" id="collapsibleNavbar">--}}
{{--                <button class="navbar-toggler toggler-example mr-0 ml-auto" type="button"--}}
{{--                        data-toggle="collapse" data-target="#navbar-nav"--}}
{{--                        aria-controls="navbar-nav" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                    <span><i class="fas fa-bars"></i></span>--}}
{{--                </button>--}}
{{--                <div class="collapse navbar-collapse tm-nav" id="navbar-nav">--}}
{{--                    <ul class="navbar-nav text-uppercase">--}}

{{--                        <li class="nav-item active">--}}
{{--                            <a class="nav-link tm-nav-link" href={{route('userHome')}}>Home <span class="sr-only">(current)</span></a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <div class="nav-item dropdown">--}}
{{--                                <a class="nav-link tm-nav-link" href="#" id="navbardrop" role="button"--}}
{{--                                   data-toggle="dropdown">--}}
{{--                                    Services--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-menu">--}}
{{--                                    @if(\Illuminate\Support\Facades\Auth::user()->isCustomer && \Illuminate\Support\Facades\Auth::user()->isActive)--}}
{{--                                        <a class="dropdown-item" href="{{route('deviceServices')}}">Device--}}
{{--                                            management</a>--}}
{{--                                        <a class="dropdown-item" href="#">ADs management</a>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <div class="nav-item dropdown">--}}
{{--                                <a class="nav-link tm-nav-link" href="#" id="navbardrop" role="button"--}}
{{--                                   data-toggle="dropdown">browser</a>--}}
{{--                                <div class="dropdown-menu">--}}
{{--                                    @if(\Illuminate\Support\Facades\Auth::user()->isCustomer && \Illuminate\Support\Facades\Auth::user()->isActive)--}}
{{--                                        <a class="dropdown-item" href="#">ADs</a>--}}
{{--                                        <a class="dropdown-item" href="#">Devices</a>--}}
{{--                                    @else--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <!-- Authentication Links -->--}}
{{--                        @guest--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link tm-nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                            </li>--}}
{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link tm-nav-link"--}}
{{--                                       href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        @else--}}
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a id="navbarDropdown" class="nav-link tm-nav-link" href="#" role="button"--}}
{{--                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                    {{ Auth::user()->name }} <span class="caret"></span>--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
{{--                                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                       onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                        {{ __('Logout') }}--}}
{{--                                    </a>--}}
{{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"--}}
{{--                                          style="display: none;">--}}
{{--                                        @csrf--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                                @endif--}}
{{--                            </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}
{{--    </div>--}}
{{--@endsection--}}
@section('content')
    <div class="container">
        <div class="tm-row">
            <div class="tm-col-left"></div>
            <main class="tm-col-right">
                <form method="post" action="{{route("active")}}" enctype="multipart/form-data">
                    @csrf
                    @if(!\Illuminate\Support\Facades\Auth::user()->id !=1 &&\Illuminate\Support\Facades\Auth::user()->isActive)
                        <section class="tm-content">
                            <a class="btn btn-primary" href={{ route('takeToken') }}>take token </a>
                        </section>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->id != 1 && !\Illuminate\Support\Facades\Auth::user()->isCustomer && !\Illuminate\Support\Facades\Auth::user()->isActive   )
                        <h2 class="mb-5 tm-content-title">Hello User You Are Did not have permission yet</h2>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->isCustomer && !\Illuminate\Support\Facades\Auth::user()->isActive)
                        <section class="tm-content">
                            <input id="password" type="password" name="password" required
                                   autocomplete="current-password">
                            <button type="submit"><a class="btn btn-primary">Active Account</a></button>
                        </section>
                    @endif
                </form>
            </main>
        </div>
    </div>
@endsection
