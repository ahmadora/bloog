@extends('layouts.layouts')
@section('title') Services @endsection
@section('content')
    <form method="post" action="{{route("image")}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="author">Image</label>
            <input type="file" class="form-control" name="path"/>
            <label for="author">Duration:</label>
            <input type="number" class="form-control" name="duration"/>

        </div>
        @foreach($screens as $screen)
            <div>
                <label>{{$screen->name}}</label>
                {!! Form::checkbox('screen[]', $screen->id, false ,['class'=>'form-group']) !!}
            </div>
        @endforeach
        <button type="submit">submit</button>

    </form>
        <a  href="{{route('showImages')}}">show</a>
@endsection
