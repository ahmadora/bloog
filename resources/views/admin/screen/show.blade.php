@extends('layouts.layouts')
@section('title')
    Users
@endsection
@section('content')

    <div class="card text-center" xmlns="http://www.w3.org/1999/html">
        <div class="card-body text-secondary">
            {!! Form::open(['method'=>'POST','action'=>'ScreenController@edit']) !!}
            @csrf

            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Status To Edit</th>

                    <th> Location Screen</th>
                    <th> Created at</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($screens as $screen)
                    <tr class="gradeC">
                        <td> {!! $screen->name !!}</td>
                        <td> @if($screen->available)
                                 Available
                                 @else
                            Not Available
                                 @endif
                        </td>



                        <td>{{$screen->location}}</td>
                    <td>{{$screen->created_at->format('m/d/Y')}}</td>
                        <td> @if(\Illuminate\Support\Facades\Auth::user()->id == 1)
                            @if($screen->available)
                                <div class="form-group">
                                    <button type="submit" value="{{$screen->id}}" name="delete" class="btn btn-danger "><i class="fa fa-times"></i>
                                    </button>
                                    @else
                                        <button type="submit" value="{{$screen->id}}" name="uassign" class="btn btn-danger "><i class="fa fa-times"></i>
                                        </button>
                                </div>
                            @endif
                            @endif</td>
                    </tr>

                @endforeach
                </tbody>
            </table>

        </div>
    </div>
    {!! Form::close() !!}
@endsection
