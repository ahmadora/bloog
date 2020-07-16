@extends('layouts.layout')
@section('title')
    @endsection
@section('navbar')
    @endsection
@section('content')
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Active Customers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <h5 class= "text-primary card-text-black-title">Special title treatment</h5>
            <table width="100%" class="table table-secondary  table-dark" >
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{!! $customer->title !!}</td>
                        <td> {!! $customer->email !!}</td>
                        <td>{!! $customer->address !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <p  class="text-body ">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-danger">Go somewhere</a>
        </div>
    </div>
    @endsection
