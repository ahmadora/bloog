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
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Advertisements Info</h3>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
{{--                            @if(\Illuminate\Support\Facades\Auth::user()->id == 1)--}}
                                <th>Advertisements</th>
                                <th>User Created</th>
                                <th>Screen</th>
{{--                                <th>Customer</th>--}}
                                <th>Created at</th>
                            <td>Delete</td>
                        </tr>
                        </thead>
                        <tbody>
                        @if(\Illuminate\Support\Facades\Auth::user()->id == 1)
                            @foreach($screens as $screen)
                                <tr class="odd gradeX">
                                    <td><img src="{{url($screen->image->path)}}" height="30px" width="30px"/></td>

                                    <td>{{$screen->image->user->name}}</td>
                                    <td>{{$screen->screen->name}}</td>
                                    <td>{{$screen->image->created_at->format('H:i - m/d/Y ')}}</td>
                                    {!! Form::open(['route'=>['destroyImage',$screen->image->id],'method'=>'POST']) !!}
                                    <td><button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button></td>
                                    {!! Form:: close() !!}
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection



