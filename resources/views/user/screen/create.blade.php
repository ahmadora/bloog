@extends('layouts.layouts')
@section('title') Services @endsection
@section('navbar')
@endsection

@section('content')
    <form method="post" action="{{route("screen")}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="author">name</label>
            <input type="text" class="form-control" name="screen"/>
            <label for="author">location</label>
            <input type="text" class="form-control" name="location"/>
            <div class="form-group">
                <label for="author">Customers</label>
                {!! Form::Select('customers',$customers ,null,['class'=>'form-control','placeholder'=>'Please select ...']) !!}
            </div>
        </div>
        <button type="submit" >submit</button>
    </form>
@endsection
