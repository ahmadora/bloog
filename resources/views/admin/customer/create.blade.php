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
        <main class="tm-col-right tm-contact-main"> <!-- Content -->
            <section class="tm-content tm-contact">
                <h2 class="mb-4 tm-content-title">Create New Customer</h2>
                <p class="mb-85"></p>
                <form id="contact-form" action={{route('soso')}} method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <input type="text" name="name" class="form-control" placeholder="Name" required="" />
                    </div>
                    <div class="form-group mb-4">
                        <input type="email" name="email" class="form-control" placeholder="Email" required="" />
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" name="address" class="form-control" placeholder="Address" required="" />
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" name="city" class="form-control" placeholder="City" required="" />
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" name="phone" class="form-control" placeholder="Phone" required="" />
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" name="title" class="form-control" placeholder="Title" required="" />
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-big btn-primary">Create</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
        @endsection

