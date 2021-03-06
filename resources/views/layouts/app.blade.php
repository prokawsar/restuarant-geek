<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Restaurant Geek</title>

    <!-- Styles -->
    <link href="{{ asset('css/adminLTE.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
</head>
<body>
<div id="app">
    <nav class="navbar @php if(Auth::check()){ echo 'navbar-inverse'; } else {echo 'navbar-default';} @endphp navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @guest
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" aria-haspopup="true">
                                <span class="glyphicon glyphicon-home"></span> My Restaurant <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">

                                <li><a href="{{ route('allitem') }}">My Items</a></li>
                                <li><a href="{{ route('allTable') }}">My Tables</a></li>
                                <li><a href="{{ route('mycustomer') }}">My Customers</a></li>
                                <li><a href="{{ route('allreview') }}">My Reviews</a></li>
                            </ul>
                        </li>

                        <li><a href="{{ route('kitchen') }}"><span class="glyphicon glyphicon-barcode"></span> Kitchen
                                View</a></li>
                        <li><a href="{{ route('allorder')  }}"><span class="glyphicon glyphicon-dashboard"></span> All
                                Orders</a></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" aria-haspopup="true">
                                <span class="glyphicon glyphicon-bell"></span> Campaign <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">

                                <li><a href="{{ route('emailcamp') }}">Email Campaign <span class="badge label-warning">Premium</span></a>
                                </li>
                                <li><a href="{{ route('smscamp') }}">SMS Campaign <span class="badge label-primary">Premium</span></a>
                                </li>
                            </ul>
                        </li>

                        @endguest
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false" aria-haspopup="true">
                            <span class="badge label-info">ARE YOU A RESTAURANT OWNER <span class="glyphicon glyphicon-question-sign"></span></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"> </span>
                                    Login</a></li>
                            <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-plus-sign"> </span>
                                    Register</a></li>
                        </ul>
                    </li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" aria-haspopup="true">
                                <span class="glyphicon glyphicon-user"> </span> {{ Auth::user()->rest_name }} <span
                                        class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('profile') }}">
                                        <span class="glyphicon glyphicon-user"></span> Profile
                                    </a>
                                    <a href="{{ route('setting') }}">
                                        <span class="glyphicon glyphicon-asterisk"></span>Setting
                                    </a>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <span class="glyphicon glyphicon-off"></span> Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js')}}"></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(function () {
        $("#datepicker").datepicker({
            maxDate: new Date,
            dateFormat: "yy-mm-dd",
        });
        $("#datepicker2").datepicker({
            maxDate: new Date,
            dateFormat: "yy-mm-dd",
        });

    });

</script>
</body>
</html>
