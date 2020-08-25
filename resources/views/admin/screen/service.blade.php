@extends('layouts.userLayout')
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
                                    @if(\Illuminate\Support\Facades\Auth::user()->id == 1)
                                        <a class="dropdown-item" href={{route('tenantServices')}}>Customer management</a>
                                        <a class="dropdown-item" href="">Device management</a>
                                        <a class="dropdown-item" href="{{route('showUsers')}}">Users management</a>
                                    @else
                                        @if(\Illuminate\Support\Facades\Auth::user()->isCustomer && \Illuminate\Support\Facades\Auth::user()->isActive)
                                            {{--                                    <a class="dropdown-item" href="{{route('upload')}}">Upload AD</a>--}}
                                            <a class="dropdown-item" href="{{route('screenService')}}">Screen management</a>
                                        @endif
                                </div>@endif
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="nav-item dropdown" >
                                <a  class="nav-link tm-nav-link"  href="#" id="navbardrop" role="button" data-toggle="dropdown">browser</a>
                                <div class="dropdown-menu">
                                    @if(\Illuminate\Support\Facades\Auth::user()->isCustomer && \Illuminate\Support\Facades\Auth::user()->isActive)
                                        <a class="dropdown-item" href="#">ADs</a>
                                        <a class="dropdown-item" href="#">Devices</a>
                                    @else
                                        @if(\Illuminate\Support\Facades\Auth::user()->id == 1 )
                                            <a class="dropdown-item" href="{{route('showCustomerUser')}}">Customer</a>
                                            <a class="dropdown-item" href="{{route('showDevices')}}">Devices</a>
                                        @endif
                                    @endif

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

    <div class="col-lg-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                Advertisments Operation
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-pills">
                    <li class="active"><a href="#home-pills" data-toggle="tab">Create</a>
                    </li>
                    <button>  <li><a href="#profile-pills" data-toggle="tab">Show</a>
                        </li></button>
                    <li><a href="#messages-pills" data-toggle="tab">Edit</a>
                    </li>
                    <li><a href="#settings-pills" data-toggle="tab">Delete</a>
                    </li>
                    <li><a href="#settings-pills" data-toggle="tab">Linked</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="home-pills">
                        <h4>Hello </h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <button type="button" class="btn btn-outline btn-success"> <a href="{{route('createDevice')}}"><i class="fa fa-check"></i></a></button>
                    </div>

                    <div class="tab-pane fade" id="profile-pills">
                        <h4>Profile Tab</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
{{--                        <button type="button" class="btn  btn-outline btn-info"> <a href="{{route('showDevices')}}"><i class="fa fa-list"></i></a></button>--}}
                    </div>
                    <div class="tab-pane fade" id="messages-pills">
                        <h4>Messages Tab</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <button type="button" class="btn btn-outline btn-warning">Edit</button>
                    </div>
                    <div class="tab-pane fade" id="settings-pills">
                        <h4>Settings Tab</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <button type="button" class="btn btn-outline btn-danger">Delete</button>
                    </div>
                    <div class="tab-pane fade" id="settings-pills">
                        <h4>Settings Tab</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <button type="button" class="btn btn-outline btn-primary">Assign</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
