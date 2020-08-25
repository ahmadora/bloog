@extends('layouts.layouts')
@section('title')
    Services
@endsection
@section('navbar')
    <div class="tm-col-right">
        <nav class="navbar navbar-expand-lg " id="tm-main-nav">
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <button class="navbar-toggler toggler-example mr-0 ml-auto" type="button"
                        data-toggle="collapse" data-target="#navbar-nav"
                        aria-controls="navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fas fa-bars"></i></span>
                </button>
                <div class="collapse navbar-collapse tm-nav" id="navbar-nav">
                    <ul class="navbar-nav text-uppercase">

                        <li class="nav-item active">
                            <a class="nav-link tm-nav-link" href={{route('home')}}>Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li  class="nav-item">
                            <div class="nav-item dropdown" >
                                <a  class="nav-link tm-nav-link"  href="#" id="navbardrop" role="button" data-toggle="dropdown">
                                    Services
                                </a>
                                <div class="dropdown-menu">
                                        <a class="dropdown-item" href={{route('tenantServices')}}>Customer management</a>
                                        <a class="dropdown-item" href="">Device management</a>
                                        <a class="dropdown-item" href="{{route('showUsers')}}">Users management</a>
                            </div>
                            </div>
                        </li>

                        <li class="nav-item">
                            <div class="nav-item dropdown" >
                                <a  class="nav-link tm-nav-link"  href="#" id="navbardrop" role="button" data-toggle="dropdown">browser</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('showCustomerUser')}}">Customers</a>
                                    <a class="dropdown-item" href="#">Devices</a>
                                </div>
                            </div>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link tm-nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link tm-nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link tm-nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                                @endif
                            </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
@endsection
@section('content')
    <section class="tm-content">
        <div class="row">
            <h3 class="mb-4 tm-content-title">Create Your Customer</h3>
            <button type="button" class="btn btn-circle btn-xl"> <a href="{{route('createCustomer')}}"><i class="fa fa-check"></i></a></button>
            <h3 class="mb-4 tm-content-title"><label>Show All Customer</label></h3>
            <button type="button" class="btn btn-primary btn-circle btn-xl"> <a href="{{route('showCustomerUser')}}"><i class="fa fa-list"></i></a></button>
            <h3 class="mb-4 tm-content-title"><label>Assign User For Customer</label></h3>
            <button type="button" class="btn btn-success btn-circle btn-xl"href={{ action('HomeController@userLogin') }}><i class="fa fa-link"></i></button>
        </div>

        <div class="row"><div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-group fa-fw"></i> Customers
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="list-group">
                            @foreach($customers as $customer)
                            <a href="#" class="list-group-item">
                                <i class="fa fa-group fa-fw"></i>
                                {{$customer->title}}
                                <span class="pull-right text-muted small"><em>4 minutes ago</em>
                                </span>
                            </a>
                            @endforeach
                        </div>
                        <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                    </div>

                </div>
            </div>
        </div>


    </section>

@endsection
