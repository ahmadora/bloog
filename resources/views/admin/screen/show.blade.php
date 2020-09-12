@extends('layouts.layouts')
@section('title')
    Users
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

    <div class="card text-center" xmlns="http://www.w3.org/1999/html">
        <div class="card-body text-secondary">
            {!! Form::open(['method'=>'POST','action'=>'ScreenController@edit']) !!}
            @csrf

            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr>
                    <th>Name</th>
                    <th> Location Screen</th>

                    @if(\Illuminate\Support\Facades\Auth::user()->id == 1)
                        <th>Status To Edit</th>
                        <th> Created at</th>
                        <th>Delete</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($screens as $screen)
                    <tr class="gradeC">
                        @if(\Illuminate\Support\Facades\Auth::user()->id == 1)
                            <td> {!! $screen->name !!}</td>
                            <td>{{$screen->location}}</td>
                            <td> @if($screen->available)
                                    Available
                                @else
                                    Not Available
                                @endif
                            </td>
                            <td>{{$screen->created_at->format('m/d/Y')}}</td>
                            <td>
                                @if($screen->available)
                                    <div class="form-group">
                                        <button type="submit" value="{{$screen->id}}" name="delete"
                                                class="btn btn-danger "><i class="fa fa-times"></i>
                                        </button>
                                        @else
                                            <button type="submit" value="{{$screen->id}}" name="uassign"
                                                    class="btn btn-danger "><i class="fa fa-times"></i>
                                            </button>
                                    </div></td>
                             @endif
                        @else
                            <td> {!! $screen->name !!}</td>
                            <td>{{$screen->location}}</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
    {!! Form::close() !!}
@endsection
