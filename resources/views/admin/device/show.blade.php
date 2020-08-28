@extends('layouts.layouts')
@section('title')
    Users
@endsection
@section('content')

    <div class="card text-center" xmlns="http://www.w3.org/1999/html">
        <div class="card-body text-secondary">
            {!! Form::open(['method'=>'POST','action'=>'Tenant\TenantDeviceController@store']) !!}
            @csrf

            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Status To Edit</th>
                    <th>Linked To Screen</th>
                    <th>Edit</th>
                    <th> Created at</th>
                </tr>
                </thead>
                <tbody>

                @foreach($devices as $device)

                    <tr class="gradeC">
                        <td> {!! $device->name !!}</td>
                        <td> @if($device->available)
                                Available
                            @else
                                Not Available
                            @endif
                        </td>
                        <td>
                            @if($device->availableScreen)
                                Available
                            @else
                            @endif
                        </td>
                        <td>
                            @if($device->available)
                                <div class="form-group">
                                    <button type="input" value="{{$device->deviceId}}" name="edit"
                                            class="btn btn-info "><i class="fa fa-check"></i>
                                    </button>
                                    <button type="submit" value="{{$device->name}}" name="delete"
                                            class="btn btn-danger "><i class="fa fa-times"></i>
                                    </button>
                                    @else
                                        <button type="submit" value="{{$device->name}}" name="delete"
                                                class="btn btn-danger "><i class="fa fa-times"></i>
                                        </button>
                                </div>
                                @if($device->availableScreen)
                                    <button type="input" value="{{$device->deviceId}}" name="assign"
                                            class="btn btn-warning "><i class="fa fa-desktop"></i>
                                    </button>
                        @endif
                        @endif
                        <td>{{$device->created_at->format('m/d/Y')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
    {!! Form::close() !!}
@endsection
