@extends('layouts.layouts')
@section('title')
    Customer Info
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
        <a class="btn btn-primary" href={{route('userShow')}}> Assign User</a>
        <a class="btn btn-primary" href={{route('showCustomerUser')}}> Customers</a>
    </div>
    {!! Form::open(['method'=>'POST','action'=>'Tenant\TenantCustomerController@delete']) !!}
    @csrf
    <!-- .panel-heading -->
    <div class="panel-body">
        @if(!empty($users))
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">User Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>

                            @if($customer[0]->customerId == $user->customerId)
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                @if($user->isActive==1)
                                    <td>Activated</td>
                                @else
                                    <td>Not activated</td>
                                @endif
                                <td>
                                    <div class="form-group ">
                                        <div class="form-check">
                                            {!! Form::checkbox('userId[]', $user->userId, false ,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </td>
                            @endif

                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                <button type="submit" class="btn btn-success">unassigned User</button>


    </div>
    {!! Form::close() !!}
    @else
            </div>
        </div>
    </div>
    @endif
@endsection

