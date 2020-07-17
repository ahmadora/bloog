@extends('layouts.layout')
@section('title')
    @endsection
@section('navbar')
    @endsection
@section('content')
    <div class="card text-center" xmlns="http://www.w3.org/1999/html">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a class="nav-link active" href={{route('showUsers')}}>Active Customers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
        </div>
        <div class="card-body text-secondary">
            <h5 class= "text-primary card-text-black-title">Special title treatment</h5>
            @foreach($customers as $customer)
            <div id="accordion">
                <div class="card  ">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-danger">Delete</button>
                            <button class="btn btn-primary" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              INFO {{$customer->title}}
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <h5 class="p-3 mb-2 bg-secondary text-white"> #{{$customer->title}}</h5>
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">User Id</th>
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
                                        <td>{{$user->userId}}</td>
                                     <td><button class="btn btn-danger">Delete</button></td>
                                    @endif
                                </tr>
                                </tbody>
                                @endforeach
                            </table>


                        </div>
                    </div>
                </div>
            </div>
            @endforeach
{{--            <table width="100%" class="table table-secondary  table-dark" >--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th scope="col">Title</th>--}}
{{--                    <th scope="col">Email</th>--}}
{{--                    <th scope="col">Address</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach($customers as $customer)--}}
{{--                    <tr>--}}
{{--                        <td>{!! $customer->title !!}</td>--}}
{{--                        <td> {!! $customer->email !!}</td>--}}
{{--                        <td>{!! $customer->address !!}</td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
            <p  class="text-body ">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-danger">Go somewhere</a>
        </div>
    </div>
    @endsection
