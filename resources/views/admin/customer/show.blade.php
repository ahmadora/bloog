@extends('layouts.layouts')
@section('title')
    Users
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Customer</th>
                        <th>Devices</th>
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
                        <td class="center">C</td>
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
