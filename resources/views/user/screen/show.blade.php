@extends('layouts.layouts')
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
                                    <a class="dropdown-item" href={{route('tenantServices')}}>Customer management</a>
                                    <a class="dropdown-item" href="{{__('showDevices')}}">Device management</a>
                                    <a class="dropdown-item" href="#">Asset management</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="nav-item dropdown" >
                                <a  class="nav-link tm-nav-link"  href="#" id="navbardrop" role="button" data-toggle="dropdown">browser</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href={{route('showCustomerUser')}}>Customers</a>
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

    <div class="card text-center" xmlns="http://www.w3.org/1999/html">
        <div class="card-body text-secondary">
            {!! Form::open(['method'=>'POST','action'=>'ScreenController@edit   ']) !!}
            @csrf

            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Status To Edit</th>
                    <th>Linked To Screen</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                @foreach($screens as $screen)
                    <tr class="gradeC">
                        <td> {!! $screen->name !!}</td>
                        <td> @if($screen->available)
                                 Available
                                 @else
                            Not Available
                                 @endif
                        </td>

                        <td>
                            @if(\Illuminate\Support\Facades\Auth::user()->id == 1)
                            @if($screen->available)
                                <div class="form-group">
                                    <button type="input" value="{{$screen->id}}" name="edit" class="btn btn-info "><i class="fa fa-check"></i>
                                    </button>
                                    <button type="submit" value="{{$screen->id}}" name="delete" class="btn btn-danger "><i class="fa fa-times"></i>
                                    </button>
                                    @else
                                        <button type="submit" value="{{$screen->id}}" name="uassign" class="btn btn-danger "><i class="fa fa-times"></i>
                                    </button>
                                </div>
{{--                                @if($device->availableScreen)--}}
{{--                                <button type="input" value="{{$device->deviceId}}" name="assign" class="btn btn-warning "><i class="fa fa-desktop"></i>--}}
{{--                                </button>--}}
{{--                        @endif--}}
                        @endif
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
    {!! Form::close() !!}
@endsection
