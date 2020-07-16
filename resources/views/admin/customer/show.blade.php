@extends('layouts.layout')
@section('title')
    Users
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
                            <a class="nav-link tm-nav-link" href={{__('home')}}>Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li  class="nav-item">
                            <div class="nav-item dropdown" >
                                <a  class="nav-link tm-nav-link"  href="#" id="navbardrop" role="button" data-toggle="dropdown">
                                    Services
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href={{action('Tenant\TenantController@service')}}>Customer management</a>
                                    <a class="dropdown-item" href="#">Device management</a>
                                    <a class="dropdown-item" href="#">Asset management</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="nav-item dropdown" >
                                <a  class="nav-link tm-nav-link"  href="#" id="navbardrop" role="button" data-toggle="dropdown">browser</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Customers</a>
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
@section('navBarAdmin')@endsection
@section('content')
    <div class="container">
    <div class="tm-row">
        <div class="tm-col-right"></div>
        <main  class="tm-col-right tm-contact-main">
            {!! Form::open(['method'=>'POST','action'=>'Tenant\TenantCustomerController@saveNewUser']) !!}
            @csrf
            <table width="70%" class="table table-secondary  table-dark" class="center">
                <thead>
                <tr>
                    <th scope="col">WorkSpace</th>
                    <th scope="col">Email</th>
                    <th scope="col">User Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">
                            <div class="form-group ">
                                <div class="form-check">
                                    {!! Form::checkbox('email[]', $user['email'], false ,['class'=>'form-check']) !!}
                                </div>
                            </div>
                        </th>
                        <td> {!! $user->email !!}</td>
                        <td> {!! $user->name !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="form-group">
                <label>Valid Customers</label>
                <div class="checkbox" class="form-control" name="customerId">
                    @foreach($customers as $customer)
                    <label>
                        {{$customer->title}}
                        {!! Form::checkbox('customer[]', $customer->customerId, false ,['class'=>'form-check']) !!}
                    </label>
                        @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-secondary">Submit Button</button>
            <button type="reset" class="btn btn-secondary">Reset Button.</button>
            {!! Form::close() !!}

        </main>
    </div>
    </div>

    @endsection
