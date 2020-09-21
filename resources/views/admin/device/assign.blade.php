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









        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        @foreach($devices as $device)
                            <h4 > You Are Edit Device :  {{$device->name}}</h4>
                        @endforeach

                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">

                                <div class="card-body text-secondary">
                                    {!! Form::open(['method'=>'POST','action'=>'ScreenController@update']) !!}
                                    @csrf

                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th scope="col">Check</th>
                                            <th scope="col">Screen Name</th>
                                            <th scope="col"> Location</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($screens as $screen)
                                            <tr>
                                                <td> {!! Form::checkbox('screen[]', $screen->id, false ,['class'=>'form-groups']) !!}
                                                </td>
                                                <td> {!! $screen->name !!}</td>
                                                <td> {!! $screen->location !!}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" name="deviceName" value="{{$device->name}}">Submit</button>
                                    </div>
                                </div>
                        </div>

                    </div>

                    </div>
                    <!-- /.panel-body -->

                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->



@endsection
