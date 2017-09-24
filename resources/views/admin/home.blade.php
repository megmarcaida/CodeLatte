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

                        <div class="col-xs-4 col-sm-4 col-md-4 page-products">
                            <div class="panel">
                                <a href="#">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Manage Products</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="page-icon"><i class="fa fa-shopping-cart"></i></div>
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
                        <div class="col-xs-4 col-sm-4 col-md-4 page-support">
                            <div class="panel">
                                <a href="#">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Manage Support</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="page-icon"><i class="icon ion-help-buoy"></i></div>
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
                        <div class="col-sm-5 col-md-12 col-lg-6">
                            <div class="panel panel-primary list-announcement">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Previous Announcements</h4>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-unstyled mb20">
                                        <li>
                                            <a href="">Testing Credit Card Payments on...</a>
                                            <small>June 30, 2015 <a href="">7 shares</a></small>
                                        </li>
                                        <li>
                                            <a href="">A Shopping Cart for New and...</a>
                                            <small>June 15, 2015 &nbsp; <a href="">11 shares</a></small>
                                        </li>
                                        <li>
                                            <a href="">A Shopping Cart for New and...</a>
                                            <small>June 15, 2015 &nbsp; <a href="">2 shares</a></small>
                                        </li>
                                    </ul>
                                </div>
                                <div class="panel-footer">
                                    <button class="btn btn-primary btn-block">View More Announcements <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </div><!-- col-md-12 -->
                    </div><!-- row -->

                    <div class="row">
                        <div class="col-sm-5 col-md-12 col-lg-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Recent User Activity</h4>
                                </div>
                                <div class="panel-body">
                                    <ul class="media-list user-list">
                                        <li class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object img-circle" src="../images/photos/user2.png" alt="">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading nomargin"><a href="">Floyd M. Romero</a></h4>
                                                is now following <a href="">Christina R. Hill</a>
                                                <small class="date"><i class="glyphicon glyphicon-time"></i> Just now</small>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object img-circle" src="../images/photos/user10.png" alt="">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading nomargin"><a href="">Roberta F. Horn</a></h4>
                                                commented on <a href="">HTML5 Tutorial</a>
                                                <small class="date"><i class="glyphicon glyphicon-time"></i> Yesterday</small>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object img-circle" src="../images/photos/user3.png" alt="">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading nomargin"><a href="">Jennie S. Gray</a></h4>
                                                posted a video on <a href="">The Discovery</a>
                                                <small class="date"><i class="glyphicon glyphicon-time"></i> June 25, 2015</small>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object img-circle" src="../images/photos/user5.png" alt="">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading nomargin"><a href="">Nicholas T. Hinkle</a></h4>
                                                liked your video on <a href="">The Discovery</a>
                                                <small class="date"><i class="glyphicon glyphicon-time"></i> June 24, 2015</small>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object img-circle" src="../images/photos/user2.png" alt="">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading nomargin"><a href="">Floyd M. Romero</a></h4>
                                                liked your photo on <a href="">My Life Adventure</a>
                                                <small class="date"><i class="glyphicon glyphicon-time"></i> June 24, 2015</small>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- panel -->
                        </div>

                        <div class="col-sm-5 col-md-12 col-lg-6">
                            <div class="panel panel-inverse">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Most Followed Users</h4>
                                </div>
                                <div class="panel-body">
                                    <ul class="media-list user-list">
                                        <li class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object img-circle" src="../images/photos/user9.png" alt="">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href="">Ashley T. Brewington</a></h4>
                                                <span>5,323</span> Followers
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object img-circle" src="../images/photos/user10.png" alt="">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href="">Roberta F. Horn</a></h4>
                                                <span>4,100</span> Followers
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object img-circle" src="../images/photos/user3.png" alt="">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href="">Jennie S. Gray</a></h4>
                                                <span>3,508</span> Followers
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object img-circle" src="../images/photos/user4.png" alt="">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href="">Alia J. Locher</a></h4>
                                                <span>3,508</span> Followers
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object img-circle" src="../images/photos/user6.png" alt="">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href="">Jamie W. Bradford</a></h4>
                                                <span>2,001</span> Followers
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- row -->

                </div><!-- col-md-3 -->
            </div><!-- row -->

        </div><!-- contentpanel -->

    </div><!-- mainpanel -->
@endsection