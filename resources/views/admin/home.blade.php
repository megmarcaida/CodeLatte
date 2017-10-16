@extends('admin.layouts.app')

@section('content')
    <div class="mainpanel">

        <!--<div class="pageheader">
          <h2><i class="fa fa-home"></i> Dashboard</h2>
        </div>-->

        <div class="contentpanel">

            <div class="row">
                <div class="col-md-9 col-lg-8 dash-left">

                    <div class="row panel-quick-page">

                        <div class="col-xs-4 col-sm-5 col-md-4 page-user">
                            <div class="panel">
                                <a href="#">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Manage Users</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="page-icon"><i class="icon ion-person-stalker"></i></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-3 col-md-2 page-events">
                            <div class="panel">
                                <a href="#">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Events</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="page-icon"><i class="icon ion-ios-calendar-outline"></i></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-3 col-md-2 page-messages">
                            <div class="panel">
                                <a href="#">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Messages</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="page-icon"><i class="icon ion-email"></i></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-5 col-md-2 page-reports">
                            <div class="panel">
                                <a href="#">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Reports</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="page-icon"><i class="icon ion-arrow-graph-up-right"></i></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-2 page-statistics">
                            <div class="panel">
                                <a href="#">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Statistics</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="page-icon"><i class="icon ion-ios-pulse-strong"></i></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-2 page-privacy">
                            <div class="panel">
                                <a href="#">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Privacy</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="page-icon"><i class="icon ion-android-lock"></i></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-2 page-settings">
                            <div class="panel">
                                <a href="#">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Settings</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="page-icon"><i class="icon ion-gear-a"></i></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div><!-- row -->

                </div><!-- col-md-9 -->
                <div class="col-md-3 col-lg-4 dash-right">
                    <div class="row">
                        <div class="col-sm-5 col-md-12 col-lg-6">
                            <div class="panel panel-danger panel-weather">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Weather Forecast</h4>
                                </div>
                                <div class="panel-body inverse">
                                    <div class="row mb10">
                                        <div class="col-xs-6">
                                            <h2 class="today-day">Monday</h2>
                                            <h3 class="today-date">July 13, 2015</h3>
                                        </div>
                                        <div class="col-xs-6">
                                            <i class="wi wi-hail today-cloud"></i>
                                        </div>
                                    </div>
                                    <p class="nomargin">Thunderstorm in the area of responsibility this afternoon through this evening.</p>
                                    <div class="row mt10">
                                        <div class="col-xs-7">
                                            <strong>Temperature:</strong> (Celcius) 19
                                        </div>
                                        <div class="col-xs-5">
                                            <strong>Wind:</strong> 30+ mph
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- col-md-12 -->
                                <div class="panel-footer">
                                    <button class="btn btn-primary btn-block">View More Announcements <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </div><!-- col-md-12 -->
                    </div><!-- row -->

                    

                </div><!-- col-md-3 -->
            </div><!-- row -->

        </div><!-- contentpanel -->

    </div><!-- mainpanel -->
@endsection