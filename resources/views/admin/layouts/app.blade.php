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

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @yield('third_party_stylesheets')

    @stack('page_css')
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 10px;

        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: rgba(19, 74, 104, 0.357)
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: whitesmoke
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

    </style>
    <style>
        .profile-button {
            background: #1a628c;
            box-shadow: none;
            border: none
        }
        .align-right {
            text-align: right;
        }

        .paginationstyle {
            margin-left: 41%;
        }
        .bck {
            background-image: linear-gradient(121deg, #13547a 1%, #80d0c7 250%);

        }

    </style>
    <style>

        .btn-primary,
        .card-info .card-header,
        .btn-info {
            background-image: linear-gradient(121deg, #13547a 16%, #80d0c7 284%);
            /* background-image: linear-gradient(-45deg, #032b43 0%, #13547a 100%); */
            /* background-image: url('https://qph.fs.quoracdn.net/main-qimg-8b585fb4a5c9fedbb899cfb0cf0331a7') !important; */
            opacity: 1.3
        }

        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Main Header -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto ">
                <li class="nav-item dropdown user-menu">
                    <a href="#" class=" nav-link dropdown-toggle rounded-circle" data-toggle="dropdown"
                        style="background-color: #13547a">
                        <div class=" d-md-inline rounded-circle ">
                            <span
                                style="font-weight:bolder; color: rgb(255, 255, 255) ">{{ strtoupper(Auth::user()->name[0]) }}
                            </span>

                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right " >
                        <!-- User image -->
                        <li class="user-header bg-primary bck rounded-top">

                            @if (Auth::user()->dp == null)
                            <img
                                class="rounded-circle center mt-1 "
                                src="{{ asset('images/userdp/default.png') }}" id="dpuser">
                        @else
                            @php
                            $userdp=Auth::user()->dp;
                            @endphp
                            <img
                            class="rounded-circle center mt-1 "
                            src="{{ asset('images/userdp') }}/{{$userdp}}" id="dpuser" >
                        @endif



                            <p>
                                {{ strtoupper(Auth::user()->name) }}
                                <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer rounded ">
                            {{-- @php
                                $user_id = Auth::user()->id;
                            @endphp --}}
                            <a href="" class="btn btn-primary profile-button ">Profile</a>
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

        <!-- Main Footer -->
        {{-- <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.5
            </div>
            <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer> --}}
    </div>

    <script src="{{ mix('js/app.js') }}" defer></script>

    @yield('third_party_scripts')

    @stack('page_scripts')
    <script>
        // $('.fa-search').on('click', function(e) {
        //     keyword=$('#table_search').val()
        //     event.preventDefault()
        //     data = {
        //         'keyword': $('#table_search').val()
        //     }
        //     e.preventDefault();
        //     $.ajax({
        //         type: "GET",
        //         url: window.location.href+'?keyword='+$('#table_search').val(),
        //         dataType: 'html',

        //         success: function(response) {
        //             $('body').html(response)
        //             $('#table_search').val(keyword)
        //             $('#table_search').focus()
        //             // console.log(response)
        //             // alert('Data Saved!');
        //         },
        //     });
        // });

        // $('#table_search').on('keyup', function(e) {
        //     keyword=$('#table_search').val()
        //     event.preventDefault()
        //     data = {
        //         'keyword': $('#table_search').val()
        //     }
        //     e.preventDefault();
        //     $.ajax({
        //         type: "GET",
        //         url: window.location.href,
        //         dataType: 'html',
        //         data: data,
        //         success: function(response) {
        //             $('.searcharea').html(response)
        //             $('#table_search').val(keyword)
        //             $('#table_search').focus()
        //             // console.log(response)
        //             // alert('Data Saved!');
        //         },
        //     });
        // });

        function search() {
            keyword = $('#table_search').val()
            event.preventDefault()
            data = {
                'keyword': keyword
            }
            history.replaceState('.', '.', window.location.href.split('?')[0] + '?page=1');
            $.ajax({
                type: "GET",
                url: window.location.href,
                dataType: 'html',
                data: data,
                success: function(response) {
                    $('.searcharea').html(response)
                    $('#table_search').val(keyword)
                    $('#table_search').focus()
                    // console.log(response)
                    // alert('Data Saved!');
                },
            });
        }

    </script>
</body>

</html>
