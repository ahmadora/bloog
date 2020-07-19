@extends('layouts.layout')
@section('title')
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
    <div class="card text-center" xmlns="http://www.w3.org/1999/html">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a class="nav-link active" href={{route('showUsers')}}>Available Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Devices</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
        </div>
        <div class="card-body text-secondary">


            @csrf
            <h5 class= "text-primary card-text-black-title">Special title treatment</h5>

            @foreach($customers as $customer)
            <div id="accordion">
                <div class="card  ">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            Info {{$customer->title}}
                        </h5>
                        <button class="btn btn-primary" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">

                        </button>
                        {!! Form::open(['method'=>'POST','action'=>'Tenant\TenantCustomerController@delete']) !!}
                        <div class="form-group ">
                            {!! Form::checkbox('customerId[]', $customer->customerId, false ,['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <h5 class="p-3 mb-2 bg-secondary text-white"> {{$customer->title}}  Customer</h5>
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">User Id</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                @foreach($users as $user)

                                <tbody>
                                <tr>
                                 @if($customer->customerId == $user->customerId)
                                        <th scope="row">{{$user->id-1}}</th>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                            <td>{{$user->userId}}</td>
                                    <td>
                                         <div class="form-group ">
                                             <div class="form-check">
                                                 {!! Form::checkbox('userId[]', $user->userId, false ,['class'=>'form-control']) !!}
                                             </div>
                                         </div>
                                     </td>
                                    @endif
                                </tr>
                                </tbody>

                                @endforeach
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach

            <p  class="text-body "></p>
            <button type="submit" class="btn btn-danger">Delete</button>
            <button type="reset" class="btn btn-primary">Reset</button>

            {!! Form::close() !!}
        </div>
    </div>
    @endsection
