@extends('layouts.layouts')
@section('nav')
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-messages">
            <li>
                <a href="#">
                    <div>
                        <strong>Ahmad Orabi </strong>
                        <span class="pull-right text-muted">
                                        <em>today</em>
                                    </span>
                    </div>
                    <div>Hello admin you have new request from Ahmad he is new user in your site check this...</div>
                </a>
            </li>
            <li class="divider"></li>

            <li>
                <a class="text-center" href="#">
                    <strong>See All Users</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
        <!-- /.dropdown-messages -->
    </li>
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
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
                    <a class="btn" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @endif
                </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
@endsection
@section('content')
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="tm-row">
        <div class="tm-col-left"></div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <main class="tm-col-right tm-contact-main"> <!-- Content -->

            <section class="tm-content tm-contact">

                <h2 class="mb-4 tm-content-title">Create New Device</h2>
                <p class="mb-85"></p>
                <div class="panel panel-default">
                    <div class="panel-heading">

                            <a class="btn btn-primary" href={{route('showDevices')}}>Show Devices</a>

                    </div>
                <form id="contact-form" action={{route('createDevice')}} method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <input type="text" name="name" class="form-control" placeholder="Name" required="" />
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" name="type" class="form-control" placeholder="Type" required="" />
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" name="label" class="form-control" placeholder="label" required="" />
                    </div>

                    <div class="text-left">
                        <button type="submit" class="btn btn-big btn-success"> Create</button>

                    </div>

                </form>
                </div>
            </section>
        </main>
    </div>
@endsection

