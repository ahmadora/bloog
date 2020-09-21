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
    <div class="row">
        <div class="col-lg-12">
            <h2 class="mb-4 tm-content-title">Create New Customer</h2>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href={{route('showCustomerUser')}}>Available Customers</a>
                </div>

                <p class="mb-85"></p>
                <form id="contact-form" action={{route('soso')}} method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <input type="text" name="name" class="form-control" placeholder="Name" required=""/>
                    </div>
                    <div class="form-group mb-4">
                        <input type="email" name="email" class="form-control" placeholder="Email" required=""/>
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" name="address" class="form-control" placeholder="Address" required=""/>
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" name="city" class="form-control" placeholder="City" required=""/>
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" name="phone" class="form-control" placeholder="Phone" required=""/>
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" name="title" class="form-control" placeholder="Title" required=""/>
                    </div>
                    <div class="text-left">
                        <button type="submit" class="btn btn-big btn-success"> Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

