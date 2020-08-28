@extends('layouts.layouts')
@section('title')
    Edit
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
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
@endif
        <h4 > You are edit on this screen  : {{$screen->name}}</h4>

        <div class="card text-center" xmlns="http://www.w3.org/1999/html">
            <div class="card-header text-secondary">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="navbar-text" >Active Customers</a>
                    </li>
                </ul>
                <div class="card-body text-secondary">
                    {!! Form::open(['method'=>'POST','action'=>'ScreenController@assign']) !!}
                    @csrf

                    <table width="70%" class="table table-secondary  table-dark" class="center">
                        <thead>
                        <tr class="center">
                            <th scope="col">#</th>
                            <th scope="col"> Device Name</th>
                            <th>Device Status</th>
                            <th>Created at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($devices as $device)

                            <tr>
                                @if($device->availableScreen)
                                <td scope="row">
                                    <div class="form-group ">
                                        <div class="form-check">

                                            {!! Form::checkbox('device[]', $device->deviceId, false ,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </td>
                                @else
                                    <td>Not Available</td>
                                @endif
                                <td> {!! $device->name !!}</td>
                                    @if($device->available)
                                <td> available device</td>
                                        @endif
                                    <td>{{$device->created_at->format('m/d/Y')}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success" name="submit" value="{{$screen->id}}">Submit</button>
                    </div>
                </div>
            </div>
        </div>

{{--    @endforeach--}}

@endsection
