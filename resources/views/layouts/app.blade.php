<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{ env('APP_NAME', 'CharityQ')  }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Barlow:100,600" rel="stylesheet" type="text/css">

    @yield('css')

    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    
    @yield('header')
</head>


<body>

@yield('scripts')
<div id="app">


    <nav class="navbar-toggleable-md navbar-toggleable-xs navbar-light navbar-fixed-top"
         style="background-color: #8e24aa;padding-bottom: .5px;margin-bottom: 10px">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-3"
                     style='padding-left: 0px;padding-top: .5px;padding-bottom: -5px;padding-right:10px;margin-top: -2px;margin-bottom: -0.5px'>
                    @if (Auth::guest())
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('img/CharityQ_Logo.png') }}" alt="{{ env('APP_NAME', 'CharityQ')  }}"
                                 id="logo" class="img-responsive"
                                 width="60%" style='background-size: inherit'/>
                        </a>
                    @elseif ((Auth::user()->organization->trial_ends_at >= \Carbon\Carbon::now())
                    OR ( Auth::user()->organization->parentOrganization->isNotEmpty() AND  Auth::user()->organization->parentOrganization[0]->parentOrganization->trial_ends_at >= \Carbon\Carbon::now()))
                        <a href="{{ url('/dashboard') }}">
                            <img src="{{ asset('img/CharityQ_Logo.png') }}" alt="{{ env('APP_NAME', 'CharityQ')  }}"
                                 id="logo" class="img-responsive"
                                 width="60%" style='background-size: inherit'/>
                        </a>

                    @else
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('img/CharityQ_Logo.png') }}" alt="{{ env('APP_NAME', 'CharityQ')  }}"
                                 id="logo" class="img-responsive"
                                 width="60%" style='background-size: inherit'/>
                        </a>
                    @endif


                </div>
                <div class="col-sm-9 col-md-offset-3" style='position:absolute;right: 0px;top:0px;'>
                    <div class="collapse navbar-collapse" id="myNavbar" style="padding-right:35px;" >
                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right visible-md-block visible-lg-block">

                            @if (Auth::guest())
                                <li><a href="{{ url('/') }}#about" class="w3-bar-item w3-button">About Us&nbsp;<span
                                                class="glyphicon glyphicon-info-sign"></span></a></li>
                                <li><a href="{{ url('/') }}#how" class="w3-bar-item w3-button">How This Works&nbsp;<span
                                                class="glyphicon glyphicon-question-sign"></span></a></li>
                                <li><a href="{{ url('/') }}#generic_price_table" class="w3-bar-item w3-button">Pricing&nbsp;<span
                                                class="glyphicon glyphicon-question-sign"></span></a></li>
    
                                <li><a href="{{ route('register') }}" class="w3-bar-item w3-button">Sign Up <span
                                                class="glyphicon glyphicon-user"></span></a></li>
                                <li><a href="{{ route('login') }}" class="w3-bar-item w3-button ">Login&nbsp;<span
                                                class="glyphicon glyphicon-log-in"></span></a></li>


                        </ul>
                    </div>
                    @elseif ((Auth::user()->organization->trial_ends_at >= \Carbon\Carbon::now())
                    OR ( Auth::user()->organization->parentOrganization->isNotEmpty() AND  Auth::user()->organization->parentOrganization[0]->parentOrganization->trial_ends_at >= \Carbon\Carbon::now()))
                        <ul class="nav navbar-nav navbar-right visible-md-block visible-lg-block">
                            <li><a href="{{ url('/dashboard')}}" id = 'Dashboard' class="w3-bar-item w3-button current"
                                   style="font-weight:bold; right:10px">Dashboard</a>
                            </li>
                            <li><a href="{{url('/organizations/donationurl',encrypt(Auth::user()->organization_id) )}}" id = 'MyDonationForm' class="w3-bar-item w3-button current"
                                   style="font-weight:bold; right:10px">My Donation Form</a>
                            @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_USER)
                                <li><a href="{{ route('donationrequests.index')}}" id = 'searchDonations' class="w3-bar-item w3-button "
                                       style="font-weight:bold; right:10px">Search
                                        Donations</a></li>
                            @elseif(Auth::user()->roles[0]->id == \App\Custom\Constant::TAGG_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::TAGG_USER OR Auth::user()->roles[0]->id == \App\Custom\Constant::ROOT_USER)
                                <li><a href="{{ URL('donationrequests/admin')}}" id = 'searchDonations'   class="w3-bar-item w3-button "
                                       style="font-weight:bold; right:10px">Search
                                        Donations</a></li>
                            @endif
                            <li>
                                <a href="#" class="dropdown-toggle" style="font-weight:bold; right: 10px;"
                                   data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    My Business
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <div class="w3-dropdown-content w3-card-4 w3-bar-block">
                                        @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_USER)
                                            <li>
                                                <a href="{{ url('/rules?rule=1')}}">Donation Preferences</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('/donationrequests/create') }}?orgId={{encrypt(Auth::user()->organization_id)}}" target="_blank">Manual Donation Request</a>
                                            </li>
                                        @endif
                                        <li>
                                            <a href="{{route('organizations.edit',encrypt(Auth::user()->organization_id) )}}">Business
                                                Profile</a>
                                        </li>
                                        @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::ROOT_USER OR Auth::user()->roles[0]->id == \App\Custom\Constant::TAGG_ADMIN)
                                            <li>
                                                <a href="{{ url('user/manageusers')}}">Users</a>
                                            </li>
                                            @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_USER)
                                                <li>
                                                    <a href="{{ route('organizations.index')}}">Business Locations</a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{ route('emailtemplates.index') }}">
                                                    Email Templates
                                                </a>
                                            </li>
                                        @endif
                                    </div>
                                </ul>
                            </li>

                            {{--this is the one showing for nav bar--}}

                            <li>

                                <a href="#" id ='username' class="dropdown-toggle" style="font-weight:bold;right:10px;"
                                   data-toggle="dropdown"
                                   role="button"
                                   aria-expanded="false">
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<span
                                            class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <div class="w3-dropdown-content w3-card-4 w3-bar-block">
                                    <li>
                                        <a href="{{ action('UserController@editProfile')}}">User Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('reset-password') }}">
                                            Change Password
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    </div>
                                </ul>

                            </li>
                        </ul>
                    @else
                        <ul class="nav navbar-nav navbar-right visible-md-block visible-lg-block">
                            <li><a href="{{ url('/subscription')}}"
                                   class="w3-bar-item w3-button current">Subscription</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</div>


<div id="navDemo" class="divsmall visible-xs-block visible-sm-block">
    @if (Auth::guest())

        <ul>
            <li><a href="{{ url('/') }}#about" class="w3-bar-item w3-button">About Us&nbsp;<span
                            class="glyphicon glyphicon-info-sign"></span></a></li>
            <li><a href="{{ url('/') }}#how" class="w3-bar-item w3-button">How This Works&nbsp;<span
                            class="glyphicon glyphicon-question-sign"></span></a></li>
            <li><a href="{{ route('register') }}" class="w3-bar-item w3-button">Sign Up <span
                            class="glyphicon glyphicon-user"></span></a></li>
            <li><a href="{{ route('login') }}" class="w3-bar-item w3-button ">Login&nbsp;<span
                            class="glyphicon glyphicon-log-in"></span></a></li>
        </ul>
    @elseif ((Auth::user()->organization->trial_ends_at >= \Carbon\Carbon::now())
                   OR ( Auth::user()->organization->parentOrganization->isNotEmpty() AND  Auth::user()->organization->parentOrganization[0]->parentOrganization->trial_ends_at >= \Carbon\Carbon::now()))

              <ul class="divsmall visible-xs-block visible-sm-block">
            <li><a href="{{ url('/dashboard')}}" class="w3-bar-item w3-button current">Dashboard</a></li>
            @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_USER)
                <li><a href="{{ route('donationrequests.index')}}" class="w3-bar-item w3-button">Search
                        Donations</a></li>
            @elseif(Auth::user()->roles[0]->id == \App\Custom\Constant::TAGG_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::TAGG_USER)
                <li><a href="{{ URL('donationrequests/admin')}}" class="w3-bar-item w3-button">Search
                        Donations</a></li>
            @endif
            <li class="dropdown">
                <div class="w3-dropdown-content w3-card-4 w3-bar-block">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false">
                        My Business
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_USER)
                            <li>
                                <a href="{{ url('/rules?rule=1')}}">Donation Preferences</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{route('organizations.edit',encrypt(Auth::user()->organization_id))}}">Business
                                Profile</a>
                        </li>
                        @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::ROOT_USER OR Auth::user()->roles[0]->id == \App\Custom\Constant::TAGG_ADMIN)
                            <li>
                                <a href="{{ url('user/manageusers')}}">Users</a>
                            </li>
                            @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_USER)
                                <li>
                                    <a href="{{ route('organizations.index')}}">Business Locations</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('emailtemplates.index') }}">
                                    Email Templates
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>

            <li class="dropdown">
                <div class="w3-dropdown-content w3-card-4 w3-bar-block">
                    <a href="#" id ='username' class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<span
                                class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ action('UserController@editProfile')}}">User Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('reset-password') }}">
                                Change Password
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    @else
        <ul class="nav navbar-nav navbar-right visible-md-block visible-lg-block">
            <li><a href="{{ url('/subscription')}}"
                   class="w3-bar-item w3-button current">Subscription</a>
            </li>
            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    @endif
</div>
<div id="content">
    {{--@include('layouts.partials._status')--}}
    @yield('content')

</div>


{{--<script src="{{ asset('js/app.js') }}">--}}

</body>
<!-- <footer class="footer bg-4">

    <img src="{{ asset('img/icon-partner.png') }}" class="imgalign"  style="width:100px;height:50px;"  >

    <h5>A {{ env('APP_NAME', 'CharityQ')  }} Intiative</h5>
 </footer> -->
