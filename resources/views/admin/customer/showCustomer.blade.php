@extends('layouts.layouts')
@section('title')
    @endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href={{route('showUsers')}}>Available Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('showDevices')}}">Devices</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Disabled</a>
                        </li>
                    </ul>
                </div>
                @if($customers)
                <!-- .panel-heading -->
                    <div class="panel-body">
                        <div class="panel-group" id="accordion">
                            @foreach($customers as $customer)
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">{{$customer->title}}</a>
                                            {!! Form::open(['method'=>'POST','action'=>'Tenant\TenantCustomerController@delete']) !!}
                                            {!! Form::checkbox('customerId[]', $customer->customerId, false ,['class'=>'form-group']) !!}

                                        </h4>

                                    </div>
                                    @if($users != null)
                                        <div id="collapseOne" class="panel-collapse collapse in">
                                            <div class="panel-body">
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
                                                        @foreach($users as $user)
                                                            <tbody>
                                                            <tr>
                                                                @if($customer->customerId == $user->customerId)
                                                                    <th scope="row">{{$user->id-1}}</th>
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
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach

                        </div>

                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="reset" class="btn btn-primary">Reset</button>
                        {!! Form::close() !!}
                @else

                    @endif
                </div>

                <!-- .panel-body -->
            </div>

            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->

    </div>
@endsection
