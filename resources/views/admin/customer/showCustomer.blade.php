@extends('layouts.layouts')
@section('title')
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
                   <h5> <label>Customers</label></h5>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="card-body text-secondary">

                        <table width="100%" class="table table-striped table-bordered table-hover"
                               id="dataTables-example">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Address</th>
                                <th> Created at</th>
                                <th>Show Devices</th>
                                <th> Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->title}}</td>
                                    <td>{{$customer->address}}</td>
                                    <td>{{$customer->created_at}}</td>
                                    <td><a href="{{route('Devices',$customer->customerId)}}"class="btn btn-primary"><i class="fa fa-tablet"></i></a></td>

                                    <td>
                                        {!! Form::open(['method'=>'POST','action'=>'Tenant\TenantCustomerController@showUsers']) !!}
                                        <button type="input" value="{{$customer->id}}" name="assign"
                                                class="btn btn-warning "><i class="fa fa-edit"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                    {!! Form::open(['method'=>'POST','action'=>'Tenant\TenantCustomerController@delete']) !!}
                                        @csrf
                                        <button type="input" value="{{$customer->id}}" name="customerId"
                                                class="btn btn-danger "><i class="fa fa-times"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                {!! Form::close() !!}

                <!-- .panel-body -->
                </div>

                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        </div>
@endsection
