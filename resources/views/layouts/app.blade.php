<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Latest compiled and minified CSS -->

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">


    @yield('third_party_stylesheets')

    @stack('page_css')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Main Header -->
        <nav class="main-header navbar navbar-expand navbar-custom navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto ">
                <li class="nav-item dropdown user-menu">
                    <a href="#" class=" nav-link dropdown-toggle rounded-circle" data-toggle="dropdown"
                        style="background-color: #fff">
                        <div class=" d-md-inline rounded-circle ">
                            <span style="font-weight:bolder; color: #13547a ">{{ strtoupper(Auth::user()->name[0]) }}
                            </span>

                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right ">
                        <!-- User image -->
                        <li class="user-header bg-primary bck rounded-bottom">

                            @if (Auth::user()->image == null)
                                <img class="rounded-circle center mt-1 "
                                    src="{{ asset('images/userdp/default.png') }}" id="dpuser">
                            @else
                                @php
                                    $userdp = Auth::user()->image;
                                @endphp
                                <img class="rounded-circle center mt-1"
                                    src="https://chhatt.s3.ap-south-1.amazonaws.com/users/{{$userdp}}" id="dpuser">
                            @endif



                            <p>
                                {{ strtoupper(Auth::user()->name) }}
                                <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                                {{-- @if (Auth::user()->role_id == 1) --}}
                                <span class="badge badge-pill"
                                    style="background-color: rgb(255, 255, 255);color: #13547a">{{ auth()->user()->role->name }}</span>

                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer rounded ">

                            <a href="{{ route('user.profile') }}" class="btn  profile-button ">Profile</a>


                            <a href="#" class="btn btn-danger float-right"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Sign out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
                @yield('content')
            </section>
        </div>


    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>


    @yield('third_party_scripts')

    @stack('page_scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script src="{{ asset('js/global.js') }}"></script>

    <script>

        $('select').select2();
        $('#response_status').select2()
    </script>
    @if(auth()->user()->role->name!='Administrator')
    <script>
// {{-- -------------------------------dynamic dropdown---------------------------------------- --}}

$('#area_one_id').change(function() {
    // alert('h')
    var id = $(this).val();
    var name1 = $("#area_one_id option:selected").text();

    $('#area_two_id').find('option').not(':first').remove();
    $.ajax({
        url: '/categories/' + id,
        type: 'get',
        dataType: 'json',
        success: function(response) {
            var len = 0;
            if (response.data != null) {
                len = response.data.length;
            }

            if (len > 0) {
                for (var i = 0; i < len; i++) {
                    var id = response.data[i].id;
                    var name = response.data[i].name;

                    var option = "<option value='" + id + "'>" + name + '-' + name1 + "</option>";

                    $("#area_two_id").append(option);
                }
            }
            $("#area_three_id").html(
                '<option disabled selected value="">Select Sub-Sub-Area</option>');
        }
    })
});

$('#area_two_id').change(function() {

    var id = $(this).val();

    $('#area_three_id').find('option').not(':first').remove();

    $.ajax({
        url: '/subcategories/' + id,
        type: 'get',
        dataType: 'json',
        success: function(response) {
            var len = 0;
            if (response.data != null) {
                len = response.data.length;
            }

            if (len > 0) {
                for (var i = 0; i < len; i++) {
                    var id = response.data[i].id;
                    var name = response.data[i].name;

                    var option = "<option value='" + id + "'>" + name + "</option>";

                    $("#area_three_id").append(option);
                }
            }

        }
    })
});


// {{-- ----------------------------------------------------------------------- --}}

            var idleTime = 0;
        $(document).ready(function () {
            //Increment the idle time counter every minute.
            var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

            //Zero the idle timer on mouse movement.
            $(this).mousemove(function (e) {
                idleTime = 0;
            });
            $(this).keypress(function (e) {
                idleTime = 0;
            });
        });

        function timerIncrement() {
            idleTime = idleTime + 1;
            if (idleTime > 1) {
                alert('Message From Murar G Mandhan: Please Don\'t sit idle');
            }
        }
    </script>
    @endif
</body>

</html>
