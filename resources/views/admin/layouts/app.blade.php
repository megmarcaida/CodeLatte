<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MultiAuth') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('lib/Hover/hover.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fontawesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/weather-icons/css/weather-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/ionicons/css/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/jquery-toggles/toggles-full.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/morrisjs/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/quirk.css') }}">
    <link rel="stylesheet" href="{{ asset('css/noty.css') }}" >
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" >
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- THIS LINE -->
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('lib/modernizr/modernizr.js') }}"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('lib/html5shiv/html5shiv.js') }}"></script>
    <script src="{{ asset('lib/respond/respond.src.js') }}"></script>
    <![endif]-->
  </head>


  @if (Auth::guard('web_admin')->guest())
      <body class="signwrapper">
        <div id="app">
          @yield('content')
        </div>
      <body>
  @else
      <body>
          <div id="app">

          <header>
              <div class="headerpanel">

                  <div class="logopanel">
                      <h2> <a href="{{ url('/admin/home') }}">
                              {{ config('app.name', 'Laravel') }}
                          </a></h2>
                  </div><!-- logopanel -->

                  <div class="headerbar">

                      <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>

                      <div class="searchpanel">
                          <div class="input-group">
                              <input type="text" class="form-control" placeholder="Search for...">
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                              </span>
                          </div><!-- input-group -->
                      </div>

                      <div class="header-right">
                          <ul class="headermenu">
                              <li>
                                  <div id="noticePanel" class="btn-group">
                                      <button class="btn btn-notice alert-notice" data-toggle="dropdown">
                                          <i class="fa fa-globe"></i>
                                      </button>
                                      <div id="noticeDropdown" class="dropdown-menu dm-notice pull-right">
                                          <div role="tabpanel">
                                              <!-- Nav tabs -->
                                              <ul class="nav nav-tabs nav-justified" role="tablist">
                                                  <li class="active"><a data-target="#notification" data-toggle="tab">Notifications (2)</a></li>
                                                  <li><a data-target="#reminders" data-toggle="tab">Reminders (4)</a></li>
                                              </ul>

                                              <!-- Tab panes -->
                                              <div class="tab-content">
                                                  <div role="tabpanel" class="tab-pane active" id="notification">
                                                      <ul class="list-group notice-list">
                                                          <li class="list-group-item unread">
                                                              <div class="row">
                                                                  <div class="col-xs-2">
                                                                      <i class="fa fa-envelope"></i>
                                                                  </div>
                                                                  <div class="col-xs-10">
                                                                      <h5><a href="">New message from Weno Carasbong</a></h5>
                                                                      <small>June 20, 2015</small>
                                                                      <span>Soluta nobis est eligendi optio cumque...</span>
                                                                  </div>
                                                              </div>
                                                          </li>
                                                          <li class="list-group-item unread">
                                                              <div class="row">
                                                                  <div class="col-xs-2">
                                                                      <i class="fa fa-user"></i>
                                                                  </div>
                                                                  <div class="col-xs-10">
                                                                      <h5><a href="">Renov Leonga is now following you!</a></h5>
                                                                      <small>June 18, 2015</small>
                                                                  </div>
                                                              </div>
                                                          </li>
                                                          <li class="list-group-item">
                                                              <div class="row">
                                                                  <div class="col-xs-2">
                                                                      <i class="fa fa-user"></i>
                                                                  </div>
                                                                  <div class="col-xs-10">
                                                                      <h5><a href="">Zaham Sindil is now following you!</a></h5>
                                                                      <small>June 17, 2015</small>
                                                                  </div>
                                                              </div>
                                                          </li>
                                                          <li class="list-group-item">
                                                              <div class="row">
                                                                  <div class="col-xs-2">
                                                                      <i class="fa fa-thumbs-up"></i>
                                                                  </div>
                                                                  <div class="col-xs-10">
                                                                      <h5><a href="">Rey Reslaba likes your post!</a></h5>
                                                                      <small>June 16, 2015</small>
                                                                      <span>HTML5 For Beginners Chapter 1</span>
                                                                  </div>
                                                              </div>
                                                          </li>
                                                          <li class="list-group-item">
                                                              <div class="row">
                                                                  <div class="col-xs-2">
                                                                      <i class="fa fa-comment"></i>
                                                                  </div>
                                                                  <div class="col-xs-10">
                                                                      <h5><a href="">Socrates commented on your post!</a></h5>
                                                                      <small>June 16, 2015</small>
                                                                      <span>Temporibus autem et aut officiis debitis...</span>
                                                                  </div>
                                                              </div>
                                                          </li>
                                                      </ul>
                                                      <a class="btn-more" href="">View More Notifications <i class="fa fa-long-arrow-right"></i></a>
                                                  </div><!-- tab-pane -->

                                                  <div role="tabpanel" class="tab-pane" id="reminders">
                                                      <h1 id="todayDay" class="today-day">...</h1>
                                                      <h3 id="todayDate" class="today-date">...</h3>

                                                      <h5 class="today-weather"><i class="wi wi-hail"></i> Cloudy 77 Degree</h5>
                                                      <p>Thunderstorm in the area this afternoon through this evening</p>

                                                      <h4 class="panel-title">Upcoming Events</h4>
                                                      <ul class="list-group">
                                                          <li class="list-group-item">
                                                              <div class="row">
                                                                  <div class="col-xs-2">
                                                                      <h4>20</h4>
                                                                      <p>Aug</p>
                                                                  </div>
                                                                  <div class="col-xs-10">
                                                                      <h5><a href="">HTML5/CSS3 Live! United States</a></h5>
                                                                      <small>San Francisco, CA</small>
                                                                  </div>
                                                              </div>
                                                          </li>
                                                          <li class="list-group-item">
                                                              <div class="row">
                                                                  <div class="col-xs-2">
                                                                      <h4>05</h4>
                                                                      <p>Sep</p>
                                                                  </div>
                                                                  <div class="col-xs-10">
                                                                      <h5><a href="">Web Technology Summit</a></h5>
                                                                      <small>Sydney, Australia</small>
                                                                  </div>
                                                              </div>
                                                          </li>
                                                          <li class="list-group-item">
                                                              <div class="row">
                                                                  <div class="col-xs-2">
                                                                      <h4>25</h4>
                                                                      <p>Sep</p>
                                                                  </div>
                                                                  <div class="col-xs-10">
                                                                      <h5><a href="">HTML5 Developer Conference 2015</a></h5>
                                                                      <small>Los Angeles CA United States</small>
                                                                  </div>
                                                              </div>
                                                          </li>
                                                          <li class="list-group-item">
                                                              <div class="row">
                                                                  <div class="col-xs-2">
                                                                      <h4>10</h4>
                                                                      <p>Oct</p>
                                                                  </div>
                                                                  <div class="col-xs-10">
                                                                      <h5><a href="">AngularJS Conference 2015</a></h5>
                                                                      <small>Silicon Valley CA, United States</small>
                                                                  </div>
                                                              </div>
                                                          </li>
                                                      </ul>
                                                      <a class="btn-more" href="">View More Events <i class="fa fa-long-arrow-right"></i></a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                              <li>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-logged" data-toggle="dropdown">
                                          <img src="{{ asset('images/photos/loggeduser.png') }}" alt="" />
                                          {{ Auth::guard('web_admin')->user()->name }}
                                          <span class="caret"></span>
                                      </button>
                                      <ul class="dropdown-menu pull-right">
                                          <li><a href="profile.html"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
                                          <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Account Settings</a></li>
                                          <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li>
                                          <li><a href="{{ url('/admin/logout') }}"
                                                 onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                  <i class="glyphicon glyphicon-log-out"></i> Log Out</a>

                                              <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                                                  {{ csrf_field() }}
                                              </form></li>
                                      </ul>
                                  </div>
                              </li>
                              <li>
                                  <button id="chatview" class="btn btn-chat alert-notice">
                                      <span class="badge-alert"></span>
                                      <i class="fa fa-comments-o"></i>
                                  </button>
                              </li>
                          </ul>
                      </div><!-- header-right -->
                  </div><!-- headerbar -->
              </div><!-- header-->
          </header>

          <section>
             <div class="leftpanel">
                  <div class="leftpanelinner">

                      <!-- ################## LEFT PANEL PROFILE ################## -->

                      <div class="media leftpanel-profile">
                          <div class="media-left">
                              <a href="#">
                                  <img src="../images/photos/loggeduser.png" alt="" class="media-object img-circle">
                              </a>
                          </div>
                          <div class="media-body">
                              <h4 class="media-heading">{{ Auth::guard('web_admin')->user()->name }} <a data-toggle="collapse" data-target="#loguserinfo" class="pull-right"><i class="fa fa-angle-down"></i></a></h4>
                              <span>Software Engineer</span>
                          </div>
                      </div><!-- leftpanel-profile -->

                      <div class="leftpanel-userinfo collapse" id="loguserinfo">
                          <h5 class="sidebar-title">Address</h5>
                          <address>
                              4975 Cambridge Road
                              Miami Gardens, FL 33056
                          </address>
                          <h5 class="sidebar-title">Contact</h5>
                          <ul class="list-group">
                              <li class="list-group-item">
                                  <label class="pull-left">Email</label>
                                  <span class="pull-right">me@themepixels.com</span>
                              </li>
                              <li class="list-group-item">
                                  <label class="pull-left">Home</label>
                                  <span class="pull-right">(032) 1234 567</span>
                              </li>
                              <li class="list-group-item">
                                  <label class="pull-left">Mobile</label>
                                  <span class="pull-right">+63012 3456 789</span>
                              </li>
                              <li class="list-group-item">
                                  <label class="pull-left">Social</label>
                                  <div class="social-icons pull-right">
                                      <a href="#"><i class="fa fa-facebook-official"></i></a>
                                      <a href="#"><i class="fa fa-twitter"></i></a>
                                      <a href="#"><i class="fa fa-pinterest"></i></a>
                                  </div>
                              </li>
                          </ul>
                      </div><!-- leftpanel-userinfo -->

                      <ul class="nav nav-tabs nav-justified nav-sidebar">
                          <li class="tooltips active" data-toggle="tooltip" title="Main Menu"><a data-toggle="tab" data-target="#mainmenu"><i class="tooltips fa fa-ellipsis-h"></i></a></li>
                          <li class="tooltips unread" data-toggle="tooltip" title="Check Mail"><a data-toggle="tab" data-target="#emailmenu"><i class="tooltips fa fa-envelope"></i></a></li>
                          <li class="tooltips" data-toggle="tooltip" title="Contacts"><a data-toggle="tab" data-target="#contactmenu"><i class="fa fa-user"></i></a></li>
                          <li class="tooltips" data-toggle="tooltip" title="Settings"><a data-toggle="tab" data-target="#settings"><i class="fa fa-cog"></i></a></li>
                          <li class="tooltips" data-toggle="tooltip" title="Log Out"><a href="{{ url('/admin/logout') }}"
                                                                                        onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                  <i class="fa fa-sign-out"></i>

                                  <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                                      {{ csrf_field() }}
                                  </form></a></li>
                      </ul>

                      <div class="tab-content">

                          <!-- ################# MAIN MENU ################### -->

                          <div class="tab-pane active" id="mainmenu">
                              <h5 class="sidebar-title">Favorites</h5>
                              <ul class="nav nav-pills nav-stacked nav-quirk">
                                  <li class="active"><a href="{{ url('admin/home') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                              </ul>

                              <h5 class="sidebar-title">Main Menu</h5>
                              <ul class="nav nav-pills nav-stacked nav-quirk">
                                  <li class="nav-parent">
                                      <a href=""><i class="fa fa-file"></i> <span>Master File</span></a>
                                      <ul class="children">
                                          <li><a href="{{ url('admin/faq') }}">FAQs</a></li>
                                          <li><a href="{{ url('admin/glossary') }}">Glossary</a></li>
                                          <li><a href="{{ url('admin/currency') }}">Currency</a></li>
                                          <li><a href="{{ url('admin/plans') }}">Plans</a></li>
                                          <li><a href="{{ url('admin/plans-content') }}">Plan Contents</a></li>
                                          <li><a href="{{ url('admin/programminglanguage') }}">Programming Languages</a></li>
                                      </ul>
                                  </li>
                                  <li class="nav-parent">
                                      <a href=""><i class="fa fa-user"></i> <span>Users</span></a>
                                      <ul class="children">
                                          <li><a href="{{ url('admin/users') }}">List of Users</a></li>
                                          <li><a href="{{ url('admin/billing') }}">Billing</a></li>
                                          <li><a href="{{ url('admin/videos') }}">Progress</a></li>
                                          <li><a href="{{ url('admin/courses') }}">Courses</a></li>
                                          <li><a href="{{ url('admin/support') }}">Support Center</a></li>
                                      </ul>
                                  </li>
                                  <li class="nav-parent">
                                      <a href=""><i class="fa fa-file-image-o"></i> <span>Gallery</span></a>
                                      <ul class="children">
                                          <li><a href="{{ url('admin/media') }}">All Media</a></li>
                                      </ul>
                                  </li>
                                  <li class="nav-parent">
                                      <a href=""><i class="fa fa-code"></i> <span>Courses</span></a>
                                      <ul class="children">
                                          <li><a href="{{ url('admin/course-list') }}">Course List</a></li>
                                          <li><a href="{{ url('admin/tutorials') }}">Tutorials</a></li>
                                          <li><a href="{{ url('admin/templates') }}">Templates</a></li>
                                      </ul>
                                  </li>
                                  <li class="nav-parent">
                                      <a href=""><i class="fa fa-question"></i> <span>Test</span></a>
                                      <ul class="children">
                                          <li><a href="{{ url('admin/quizzes') }}">Quizzes</a></li>
                                          <li><a href="{{ url('admin/questionnaires') }}">Questionnaires</a></li>
                                          <li><a href="{{ url('admin/code-block') }}">Code Block</a></li>

                                      </ul>
                                  </li>
                              </ul>
                          </div><!-- tab-pane -->

                          <!-- ######################## EMAIL MENU ##################### -->

                          <div class="tab-pane" id="emailmenu">
                              <div class="sidebar-btn-wrapper">
                                  <a href="compose.html" class="btn btn-danger btn-block">Compose</a>
                              </div>

                              <h5 class="sidebar-title">Mailboxes</h5>
                              <ul class="nav nav-pills nav-stacked nav-quirk nav-mail">
                                  <li><a href="email.html"><i class="fa fa-inbox"></i> <span>Inbox (3)</span></a></li>
                                  <li><a href="email.html"><i class="fa fa-pencil"></i> <span>Draft (2)</span></a></li>
                                  <li><a href="email.html"><i class="fa fa-paper-plane"></i> <span>Sent</span></a></li>
                              </ul>

                              <h5 class="sidebar-title">Tags</h5>
                              <ul class="nav nav-pills nav-stacked nav-quirk nav-label">
                                  <li><a href="#"><i class="fa fa-tags primary"></i> <span>Communication</span></a></li>
                                  <li><a href="#"><i class="fa fa-tags success"></i> <span>Updates</span></a></li>
                                  <li><a href="#"><i class="fa fa-tags warning"></i> <span>Promotions</span></a></li>
                                  <li><a href="#"><i class="fa fa-tags danger"></i> <span>Social</span></a></li>
                              </ul>
                          </div><!-- tab-pane -->

                          <!-- ################### CONTACT LIST ################### -->

                          <div class="tab-pane" id="contactmenu">
                              <div class="input-group input-search-contact">
                                  <input type="text" class="form-control" placeholder="Search contact">
                                  <span class="input-group-btn">
                  <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                </span>
                              </div>
                              <h5 class="sidebar-title">My Contacts</h5>
                              <ul class="media-list media-list-contacts">
                                  <li class="media">
                                      <a href="#">
                                          <div class="media-left">
                                              <img class="media-object img-circle" src="../images/photos/user1.png" alt="">
                                          </div>
                                          <div class="media-body">
                                              <h4 class="media-heading">Christina R. Hill</h4>
                                              <span><i class="fa fa-phone"></i> 386-752-1860</span>
                                          </div>
                                      </a>
                                  </li>
                                  <li class="media">
                                      <a href="#">
                                          <div class="media-left">
                                              <img class="media-object img-circle" src="../images/photos/user2.png" alt="">
                                          </div>
                                          <div class="media-body">
                                              <h4 class="media-heading">Floyd M. Romero</h4>
                                              <span><i class="fa fa-mobile"></i> +1614-650-8281</span>
                                          </div>
                                      </a>
                                  </li>
                                  <li class="media">
                                      <a href="#">
                                          <div class="media-left">
                                              <img class="media-object img-circle" src="../images/photos/user3.png" alt="">
                                          </div>
                                          <div class="media-body">
                                              <h4 class="media-heading">Jennie S. Gray</h4>
                                              <span><i class="fa fa-phone"></i> 310-757-8444</span>
                                          </div>
                                      </a>
                                  </li>
                                  <li class="media">
                                      <a href="#">
                                          <div class="media-left">
                                              <img class="media-object img-circle" src="../images/photos/user4.png" alt="">
                                          </div>
                                          <div class="media-body">
                                              <h4 class="media-heading">Alia J. Locher</h4>
                                              <span><i class="fa fa-mobile"></i> +1517-386-0059</span>
                                          </div>
                                      </a>
                                  </li>
                                  <li class="media">
                                      <a href="#">
                                          <div class="media-left">
                                              <img class="media-object img-circle" src="../images/photos/user5.png" alt="">
                                          </div>
                                          <div class="media-body">
                                              <h4 class="media-heading">Nicholas T. Hinkle</h4>
                                              <span><i class="fa fa-skype"></i> nicholas.hinkle</span>
                                          </div>
                                      </a>
                                  </li>
                                  <li class="media">
                                      <a href="#">
                                          <div class="media-left">
                                              <img class="media-object img-circle" src="../images/photos/user6.png" alt="">
                                          </div>
                                          <div class="media-body">
                                              <h4 class="media-heading">Jamie W. Bradford</h4>
                                              <span><i class="fa fa-phone"></i> 225-270-2425</span>
                                          </div>
                                      </a>
                                  </li>
                                  <li class="media">
                                      <a href="#">
                                          <div class="media-left">
                                              <img class="media-object img-circle" src="../images/photos/user7.png" alt="">
                                          </div>
                                          <div class="media-body">
                                              <h4 class="media-heading">Pamela J. Stump</h4>
                                              <span><i class="fa fa-mobile"></i> +1773-879-2491</span>
                                          </div>
                                      </a>
                                  </li>
                                  <li class="media">
                                      <a href="#">
                                          <div class="media-left">
                                              <img class="media-object img-circle" src="../images/photos/user8.png" alt="">
                                          </div>
                                          <div class="media-body">
                                              <h4 class="media-heading">Refugio C. Burgess</h4>
                                              <span><i class="fa fa-mobile"></i> +1660-627-7184</span>
                                          </div>
                                      </a>
                                  </li>
                                  <li class="media">
                                      <a href="#">
                                          <div class="media-left">
                                              <img class="media-object img-circle" src="../images/photos/user9.png" alt="">
                                          </div>
                                          <div class="media-body">
                                              <h4 class="media-heading">Ashley T. Brewington</h4>
                                              <span><i class="fa fa-skype"></i> ashley.brewington</span>
                                          </div>
                                      </a>
                                  </li>
                                  <li class="media">
                                      <a href="#">
                                          <div class="media-left">
                                              <img class="media-object img-circle" src="../images/photos/user10.png" alt="">
                                          </div>
                                          <div class="media-body">
                                              <h4 class="media-heading">Roberta F. Horn</h4>
                                              <span><i class="fa fa-phone"></i> 716-630-0132</span>
                                          </div>
                                      </a>
                                  </li>
                              </ul>
                          </div><!-- tab-pane -->

                          <!-- #################### SETTINGS ################### -->

                          <div class="tab-pane" id="settings">
                              <h5 class="sidebar-title">General Settings</h5>
                              <ul class="list-group list-group-settings">
                                  <li class="list-group-item">
                                      <h5>Daily Newsletter</h5>
                                      <small>Get notified when someone else is trying to access your account.</small>
                                      <div class="toggle-wrapper">
                                          <div class="leftpanel-toggle toggle-light success"></div>
                                      </div>
                                  </li>
                                  <li class="list-group-item">
                                      <h5>Call Phones</h5>
                                      <small>Make calls to friends and family right from your account.</small>
                                      <div class="toggle-wrapper">
                                          <div class="leftpanel-toggle-off toggle-light success"></div>
                                      </div>
                                  </li>
                              </ul>
                              <h5 class="sidebar-title">Security Settings</h5>
                              <ul class="list-group list-group-settings">
                                  <li class="list-group-item">
                                      <h5>Login Notifications</h5>
                                      <small>Get notified when someone else is trying to access your account.</small>
                                      <div class="toggle-wrapper">
                                          <div class="leftpanel-toggle toggle-light success"></div>
                                      </div>
                                  </li>
                                  <li class="list-group-item">
                                      <h5>Phone Approvals</h5>
                                      <small>Use your phone when login as an extra layer of security.</small>
                                      <div class="toggle-wrapper">
                                          <div class="leftpanel-toggle toggle-light success"></div>
                                      </div>
                                  </li>
                              </ul>
                          </div><!-- tab-pane -->


                      </div><!-- tab-content -->

                  </div><!-- leftpanelinner -->
              </div><!-- leftpanel -->
          </section>

              @yield('content')


              <div id="wait" style="display:block;width:100%;height:100%;background:rgba(0,0,0,0.5);position:fixed;top:0%;left:0%;"><img style="position:absolute;top:50%;left:50%;" src='{{ asset('img/Ripple.gif')  }}' width="64" height="64" /><br>Loading..</div>
          </div>
      </body>
@endif
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('lib/jquery/jquery.js') }}"></script>
<script src="{{ asset('lib/jquery-ui/jquery-ui.js') }}"></script>
<script src="{{ asset('lib/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('lib/jquery-toggles/toggles.js') }}"></script>

<script src="{{ asset('lib/morrisjs/morris.js') }} "></script>
<script src="{{ asset('lib/raphael/raphael.js') }}"></script>

<script src="{{ asset('lib/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('lib/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('lib/flot-spline/jquery.flot.spline.js') }}"></script>

<script src="{{ asset('lib/jquery-knob/jquery.knob.js') }}"></script>

<script src="{{ asset('js/quirk.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
<script src="{{ asset('js/noty.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/mojs/latest/mo.min.js"></script>

  <script>
      document.onreadystatechange = function () {
          var state = document.readyState
          if (state == 'complete') {
              setTimeout(function(){
                  document.getElementById('wait').style.display="none";
              },1000);
          }
      }
  </script>


  <script>
      $(document).on("click", "#openMedia", function () {
          var mediaID = $(this).data('id');
          var title = $(this).data('title');
          var description = $(this).data('description');
          $(".modal-body #mediaID").val( mediaID );
          $(".modal-body #title").val( title );
          $(".modal-body #description").val( description );
          // As pointed out in comments,
          // it is superfluous to have to manually call the modal.
          // $('#addBookDialog').modal('show');
      });
  </script>
</html>