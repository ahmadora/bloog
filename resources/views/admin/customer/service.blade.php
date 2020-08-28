@extends('layouts.layouts')
@section('title')
    Services
@endsection
@section('content')
    <section class="tm-content">

        <h3 class="mb-4 tm-content-title"><label>Create New Customer</label></h3>
        <button type="button" class="btn btn-circle btn-xl"><a href="{{route('createCustomer')}}"><i
                    class="fa fa-check"></i></a></button>
        <h3 class="mb-4 tm-content-title"><label>Show All Customer</label></h3>
        <button type="button" class="btn btn-primary btn-circle btn-xl"><a href="{{route('showCustomerUser')}}"><i
                    class="fa fa-list"></i></a></button>
        <h3 class="mb-4 tm-content-title"><label>Assign User For Customer</label></h3>
        <button type="button" class="btn btn-success btn-circle btn-xl" href={{ action('HomeController@userLogin') }}><i
                class="fa fa-link"></i></button>

    </section>
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-group fa-fw"></i> Customers
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        @foreach($customers as $customer)
                            <a href="#" class="list-group-item">
                                <i class="fa fa-group fa-fw"></i>
                                {{$customer->title}}
                            </a>
                        @endforeach
                    </div>
                    <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                </div>

            </div>
        </div>
    </div>



@endsection
