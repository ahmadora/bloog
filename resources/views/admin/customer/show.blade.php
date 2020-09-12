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
        <div class="card-body text-secondary">
            <label></label>
            {!! Form::open(['method'=>'POST','action'=>'Tenant\TenantCustomerController@saveNewUser']) !!}
            @csrf
        </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            <li class="nav-item">
                <a class="btn btn-primary" href={{route('showCustomerUser')}}>Available Customers</a>
            </li>

            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>

                        <th>Check</th>
                        <th>Email</th>
                        <th>Name</th>

                        <th>Customer</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr class="gradeC">

                        <td>{!! Form::checkbox('email[]', $user['email'], false ,['class'=>'form-control']) !!}</td>
                            <td> {!! $user->email !!}</td>
                            <td> {!! $user->name !!}</td>
                        <td class="center"> {!! Form::Select('customer[]',$customers ,null,['class'=>'form-control','placeholder'=>'Please select ...']) !!}
                            </td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>

    <button type="submit" class="btn btn-success">Add User To Customers</button>
    <button type="reset" class="btn btn-danger">Reset Button.</button>
    {!! Form::close() !!}
    @endsection
