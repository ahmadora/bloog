@extends('layouts.userLayout')
@section('title') Services @endsection
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">

                    <a class="btn btn-primary" href={{route('showImages')}}>Show ADs</a>


            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form method="post" action="{{route("image")}}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="author">Image</label>
                        <input type="file" class="form-control" name="path" size="50"/>
                        <label for="author">Duration:</label>
                        <input type="number" class="form-control" size="50" name="duration"/>

                    </div>

                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Check</th>
                            <th>Name</th>
                            <th>Location</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($screens as $screen)
                            <tr class="gradeC">
                                <td>   {!! Form::checkbox('screen[]', $screen->id, false ,['class'=>'form-contol']) !!}</td>
                                <td> {!! $screen->name !!}</td>
                                <td> {!! $screen->location !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-success">submit</button>
                    <button type="reset" class="btn btn-danger">Reset</button>

                </form>
            </div>
            <!-- /.panel-body -->

        </div>
        <!-- /.panel -->
    </div>
@endsection
