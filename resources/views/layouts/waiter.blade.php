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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/star-rating.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/waiter/makeorder') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                    @php if(Auth::guard('waiter')->check()) { @endphp

                        <li><a href="{{ route('review') }}">Take Review</a></li>
                        <li><a href="{{ route('placedorder') }}">Placed Order</a></li>
                    @php } @endphp
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @php if(Auth::guard('waiter')->user()) { @endphp
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                Notificatoin <span id="notifCount" class="label label-success"> </span> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" id="notify">
                                <li>
                                   <a href="#" >Profile </a>
                                </li>

                            </ul>
                        </li>

                                <li>
                                    <!-- <a href="#" >
                                        Profile
                                    </a> -->
                                    <a href="{{ route('wlogout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('wlogout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>

                        @php } @endphp
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    {{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
    {{--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>--}}
    {{----}}
    <script src="{{ asset('js/app.js') }}"></script>


    <script src="{{ asset('js/star-rating.js') }}"></script>

    <script src="{{ asset('js/jquery.smartCart.js') }}"></script>



  <script>

    var _token = '{{csrf_token()}}';

    function loadOrderData() {
        $.ajax({
            type: 'get',
            url: '{{ route('getnotify') }}',
            success: function (data) {
                console.log(data);
                $('#notifCount').text(data.length);

                var rows = '';
                data.map(function (index) {

//                    <li>
//                    <a href="#" >Profile </a>
//                    </li>
                    rows += '<li><a>Order Process Completed for ' + index.table.name_or_no + ' Table. </a>' +
                        '<button class="btn btn-success" id="processOK">OK</button> </li><br>';

                })
                $('#notify').html(rows);
            }
        })
    }


    function timeOut() {
        setTimeout(function () {
            loadOrderData();
            timeOut();
        }, 5000);
    }

    $(document).ready(function () {
        timeOut();
        loadOrderData();
        // Initialize Smart Cart
        $('#smartcart').smartCart();

//        $("#datepicker").datepicker({
//            maxDate: new Date,
//        });

    });

</script>
</body>
</html>
