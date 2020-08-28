@extends('layouts.layouts')

@section('content')
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="tm-row">
        <div class="tm-col-left"></div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <main class="tm-col-right tm-contact-main"> <!-- Content -->

            <section class="tm-content tm-contact">

                <h2 class="mb-4 tm-content-title">Create New Device</h2>
                <p class="mb-85"></p>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <li class="nav-item">
                            <a class="btn btn-primary" href={{route('showCustomerUser')}}>Available Customers</a>
                        </li>
                    </div>
                <form id="contact-form" action={{route('createDevice')}} method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <input type="text" name="name" class="form-control" placeholder="Name" required="" />
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" name="type" class="form-control" placeholder="Type" required="" />
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" name="label" class="form-control" placeholder="label" required="" />
                    </div>
                    <div class="form-chec mb-4">
                        <label >Is Gateway
                            <input type="checkbox" name ="gateway" class="form-control" placeholder="Is Gateway">
                        </label>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-big btn-primary">Send It</button>
                    </div>
                </form>
                </div>
            </section>
        </main>
    </div>
@endsection

