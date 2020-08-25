@extends('layouts.layouts')
@section('title')
    Services
@endsection

@section('content')

    <div class="col-lg-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                Advertisments Operation
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-pills">
                    <li class="active"><a href="#home-pills" data-toggle="tab">Create</a>
                    </li>
                    <li><a href="#profile-pills" data-toggle="tab">Show</a>
                    </li>
                    <li><a href="#messages-pills" data-toggle="tab">Edit</a>
                    </li>
                    <li><a href="#settings-pills" data-toggle="tab">Delete</a>
                    </li>
                    <li><a href="#settings-pills" data-toggle="tab">Linked</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="home-pills">
                        <h4>Hello </h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <button type="button" class="btn btn-outline btn-success"> <a href="{{route('createDevice')}}"><i class="fa fa-check"></i></a></button>
                    </div>

                    <div class="tab-pane fade" id="profile-pills">
                        <h4>Profile Tab</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <button type="button" class="btn  btn-outline btn-info"> <a href="{{route('showDevices')}}"><i class="fa fa-list"></i></a></button>
                    </div>
                    <div class="tab-pane fade" id="messages-pills">
                        <h4>Messages Tab</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <button type="button" class="btn btn-outline btn-warning">Edit</button>
                    </div>
                    <div class="tab-pane fade" id="settings-pills">
                        <h4>Settings Tab</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <button type="button" class="btn btn-outline btn-danger">Delete</button>
                    </div>
                    <div class="tab-pane fade" id="settings-pills">
                        <h4>Settings Tab</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <button type="button" class="btn btn-outline btn-primary">Assign</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.panel -->
    </div>
@endsection
