@extends('layouts.layouts')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Advertisements Info
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Advertisements</th>
                            <th>User Created</th>
                            <th>Created at</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($images as $image)
                            <tr class="odd gradeX">
                                <td>{{$image->id}}</td>

                                <td><img src="{{url($image->path)}}" height="300px" width="300px" /> </td>
                                <td>{{$image->created_at->format('m/d/Y')}}</td>
                                <td  >
                                    {{--                                <form action="{{ route('destroy',$image->id) }}" method="POST">--}}
                                    {{--                                @csrf--}}
                                    {{--                                    <button type="submit" class="btn btn-danger">Delete</button>--}}
                                    {{--                                </form>--}}
                                </td>
                                <td class="center">X</td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection
