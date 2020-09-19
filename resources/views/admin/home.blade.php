@extends('layouts.layouts')
@section('title') Index @endsection
@section('nav')
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-messages">
            <li>
                <a href="#">
                    <div>
                        <strong>Ahmad Orabi </strong>
                        <span class="pull-right text-muted">
                                        <em>today</em>
                                    </span>
                    </div>
                    <div>Hello admin you have new request from Ahmad he is new user in your site check this...</div>
                </a>
            </li>
            <li class="divider"></li>

            <li>
                <a class="text-center" href="#">
                    <strong>See All Users</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
        <!-- /.dropdown-messages -->
    </li>
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            @guest
                <li class="nav-item">
                    <a class="nav-link tm-nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link tm-nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a class="btn" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @endif
                </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
@endsection
@section('content')
    <section class="tm-content">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">Customer</div>
                                <div>Customer Management!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('userShow')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Services</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-desktop fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">Screens</div>
                                <div>Screens management!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('screenService')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Services</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-mobile fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">Devices</div>
                                <div>Device managements!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('deviceService')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Services</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-credit-card fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">ADs</div>
                                <div>ADs managements!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('showImages')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Services</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
{{--            <div class="col-lg-3 col-md-6">--}}
{{--                <div class="panel panel-info">--}}
{{--                    <div class="panel-heading">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-xs-3">--}}
{{--                                <i class="fa fa-group-card fa-5x"></i>--}}
{{--                            </div>--}}
{{--                            <div class="col-xs-9 text-right">--}}
{{--                                <div class="huge">Customer</div>--}}
{{--                                <div>Customer managements!</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <a href="{{route('customerService')}}">--}}
{{--                        <div class="panel-footer">--}}
{{--                            <span class="pull-left">View Services</span>--}}
{{--                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>--}}
{{--                            <div class="clearfix"></div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
                <h4><label>Take Token</label></h4>
                <button type="button" class="btn btn-success btn-circle btn-xl"> <a href="{{route('takeToken')}}"><i class="fa fa-link"></i></a></button>
    </section>
@endsection
