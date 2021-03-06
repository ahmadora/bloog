@extends('layouts.layouts')
@section('title')
    Services
@endsection
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

    <div class="col-lg-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                Advertisements
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-pills">
                    @if(\Illuminate\Support\Facades\Auth::user()->isActive && \Illuminate\Support\Facades\Auth::user()->id != 1)
                    <li class="active"><a href="#home-pills" data-toggle="tab">Create</a>
                    </li>
                    @endif
                    <li><a href="{{route('showImages')}}" data-toggle="tab">Show</a>
                    </li>
                    <li><a href="#messages-pills" data-toggle="tab">Edit</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    @if(\Illuminate\Support\Facades\Auth::user()->isActive && \Illuminate\Support\Facades\Auth::user()->id != 1)

                        <button type="button" class="btn btn-outline btn-success"> <a href="{{route('createDevice')}}"><i class="fa fa-check"></i></a></button>
                    </div>
                    @endif
                           <div class="tab-pane fade" id="profile-pills">
                            <button type="button" class="btn  btn-outline btn-info"> <a href="{{route('showImages')}}"><i class="fa fa-list"></i></a></button>
                        </div>


                </div>
            </div>
        </div>
        <!-- /.panel -->
    </div>
@endsection
