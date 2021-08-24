@extends('layouts.app')

@section('content')
    <style>
        /* not to change */
        body {
            overflow-x: hidden
        }

        .navbar-custom {
            border: none !important;
        }

        /* .ani {
                                                                            position: relative;
                                                                            animation: mymove 5s;
                                                                            animation-iteration-count: 9999999;
                                                                        }

                                                                        @keyframes mymove {
                                                                            from {
                                                                                left: 0px;
                                                                            }

                                                                            to {
                                                                                left: 10px;
                                                                            }
                                                                        } */

        .ani:hover {

            /* Start the shake animation and make the animation last for 0.5 seconds */
            animation: shake 0.3s;

            /* When the animation is finished, start again */
            animation-iteration-count: 1;
        }

        @keyframes shake {
            0% {
                transform: translate(1px, 1px) rotate(0deg);
            }

            10% {
                transform: translate(-1px, -2px) rotate(-1deg);
            }

            20% {
                transform: translate(-3px, 0px) rotate(1deg);
            }

            30% {
                transform: translate(3px, 2px) rotate(0deg);
            }

            40% {
                transform: translate(1px, -1px) rotate(1deg);
            }

            50% {
                transform: translate(-1px, 2px) rotate(-1deg);
            }

            60% {
                transform: translate(-3px, 1px) rotate(0deg);
            }

            70% {
                transform: translate(3px, 1px) rotate(-1deg);
            }

            80% {
                transform: translate(-1px, -1px) rotate(1deg);
            }

            90% {
                transform: translate(1px, 2px) rotate(0deg);
            }

            100% {
                transform: translate(1px, -2px) rotate(-1deg);
            }
        }

        .highlight:hover {
            /* background: #c5c3c396; */
            /* color: #26526a;
                                                                                text-shadow: 1px 1px 1px #030e15f7, 0 0 35px #13547ac1, 0 0 5px #13547a; */
            /* color: white; */
            /* background-image: linear-gradient(121deg, #13547a 1%, #07100f 250%); */
            background-image: linear-gradient(121deg, #f5f6f7 1%, #07100f 250%);
            color: black;
            /* color: white */
            text-shadow: 3px 3px 4px #e8e8e8;
            text-transform: capitalize;
            transition: transform .3s;
            transform: scale(1.1);
        }

        .info-box {

            /* background-image: linear-gradient(249deg, #fff 88%, #09103fb9 89%); */
            background-image: linear-gradient(236deg, #fff 47%, #09103fb9 107%);
            /* background-image: linear-gradient(236deg, #fff 36%, #09103fb9 106%); */

        }

        .rowf {
            background-image: linear-gradient(121deg, #09103f 1%, #80d0c7 250%);
            padding-top: 10px;
            padding-bottom: 2px;
            border-radius: 0px 0px 12px 12px;

        }

        .card {
            box-shadow: 1px 1px 5px rgba(68, 83, 106, 0.652);
            /* box-shadow: 6px 6px 3px #09103f48; */
        }

        .card .card-header {
            color: #383636
        }

        .tablecard .card-header {
            color: #ffffff
        }

        .tablecard {
            background-color: #212529;
        }

        .collapsed-card .card-header {
            background: white;
            color: rgb(16, 15, 15);
        }

        .card-header {
            color: rgb(218, 218, 218);
        }

        @media screen and (max-width: 500px) {

            li.page-item {

                display: none;
            }

            .page-item:first-child,
            .page-item:nth-child(2),
            .page-item:nth-last-child(2),
            .page-item:last-child,
            .page-item.active,
            .page-item.disabled {

                display: block;
            }
        }

        .page-link {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #212529;
            background-color: #13547a;
            border: 1px solid #13547a;
        }

        .page-link:hover {
            color: #13547a;
            background-color: #212529;
            border: 1px solid #13547a;

        }

        .page-item.active .page-link {
            z-index: 3;
            color: #13547a;
            background-color: #212529;
            border-color: #13547a;
        }

        .page-item.disabled .page-link {
            z-index: 3;
            color: #212529;
            background-color: #13547a;
            border-color: #13547a;
        }

        .table-dark thead {
            /* background-image: linear-gradient(121deg, #09103f 1%, #80d0c7 250%); */
            /* background-image: linear-gradient(121deg, #f5f6f7 1%, #07100f 250%); */
            background-image: linear-gradient(121deg, #13547a 1%, #062d3f 250%);

            color: white
        }

        /* .highlight:hover {
                                                                    background: #13547ae7;
                                                                    color: #fff;
                                                                    text-shadow: 1px 1px 1.5px rgb(255, 251, 251), 0 0 35px #efeff000, 0 0 5px #ffffff6d;
                                                                    border-radius: 15px 50px 30px 5px;
                                                                    transition: transform .3s;
                                                                    transform: scale(1.1);
                                                                } */
        .parent {
            position: relative;

        }

        .child {

            position: absolute;
            top: 45%;
            left: 50%;
        }

        svg path,
        svg rect {
            fill: #13547a;
        }

    </style>
    <div class="row rowf">
        <div class="col-12 col-sm-6 col-md-3 ani">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><img src="{{ asset('icons/agent.png') }}"
                        style="width: 50px;height: 50px;"></span>

                <div class="info-box-content">
                    <span class="info-box-text">Agents</span>
                    <span class="info-box-number">
                        {{ $agent }}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3 ani">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><img src="{{ asset('icons/agency.png') }}"
                        style="width: 60px;height: 50px;"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Agencies</span>
                    <span class="info-box-number">{{ $agency }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3 ani">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><img src="{{ asset('icons/properties.png') }}"
                        style="width: 60px;height: 50px;"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Properties</span>
                    <span class="info-box-number">{{ $properties->total() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3 ani">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">General Members</span>
                    <span class="info-box-number">{{ $general_members }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="row pt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Latest Properties</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button> --}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive table-striped">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Area</th>
                                    <th>Price</th>
                                    <th>Size</th>
                                    <th>Type</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($properties as $key=>$item)
                                    <tr>
                                        <td>
                                            {{ $item->id }}
                                            {{-- {{ ++$key }} --}}
                                        </td>

                                        <td>{{ optional($item->areaOne)->name }},{{ optional($item->areaTwo)->name }}
                                        </td>
                                        <td>
                                            @if ($item->price != null)
                                                <span class="badge badge-pill badge-success">
                                                    Rs.{{ $item->price }}
                                                </span>
                                            @else
                                                <span class="badge badge-pill badge-danger">
                                                    No Price
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <h6>{{ $item->size }}<span
                                                    class="badge badge-pill">{{ $item->size_type }}</span></h6>
                                        </td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->created_at->diffForHumans() }}</td>
                                    </tr>
                                @empty
                                    <p>No Data Found</p>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>

                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href="{{ route('properties.index') }}" class="btn btn-sm btn-info float-right">View All
                        Properties</a>
                </div>
                <!-- /.card-footer -->
            </div>
        </div>

        <div class="col-md-4">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">Recently Added Leads</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>

                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">

                        @foreach ($leads as $item)
                            <li class="item">
                                <div class="product-img">
                                    <div class="img-size-50">

                                        {{ $item->name }}
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title">{{ $item->phone }}
                                        @if ($item->budget == null)
                                            <span class="badge badge-warning float-right">No Budget</span>
                                    </a>
                                @else
                                    <span class="badge badge-warning float-right">Rs.{{ $item->budget }}</span></a>
                        @endif
                        <span class="product-description">
                            {{ $item->description }}
                        </span>
                </div>
                </li>
                @endforeach
                {{-- <li class="item">
                            <div class="product-img">
                                <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Samsung TV
                                    <span class="badge badge-warning float-right">$1800</span></a>
                                <span class="product-description">
                                    Samsung 32" 1080p 60Hz LED Smart HDTV.
                                </span>
                            </div>
                        </li> --}}
                {{-- <div class="table-responsive table-striped">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Area</th>
                                        <th>Price</th>
                                        <th>Size</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($properties as $key=>$item)
                                        <tr>
                                            <td>{{ ++$key }}</td>

                                            <td>{{ optional($item->areaOne)->name }},{{ optional($item->areaTwo)->name }}</td>
                                            <td>
                                                @if ($item->price != null)
                                                    <span class="badge badge-pill badge-success">
                                                        Rs.{{ $item->price }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-pill badge-danger">
                                                        No Price
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <h6>{{ $item->size }}<span
                                                        class="badge badge-pill">{{ $item->size_type }}</span></h6>
                                            </td>
                                            <td>{{ $item->type }}</td>
                                            <td>{{ $item->description }}</td>
                                        </tr>
                                    @empty
                                        <p>No Data Found</p>
                                    @endforelse
                                </tbody>

                            </table>
                        </div> --}}

                </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
                <a href="{{ route('leads.index') }}" class="uppercase">View All Lead</a>
            </div>
            <!-- /.card-footer -->
        </div>
        <center style="padding-top: 15%">
            <div class='card el-tilt' data-tilt data-tilt-scale='1.2' style="width: 20rem; height: 30rem">
                <div class="card-body">
                    <p class="card-text ">
                    <h2 class="font-italic">Daily Report</h2>
                    </p>
                </div>
                <img src="data:image/jpeg;base64,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"
                    class="card-img-top" alt="">
                <div class="card-body">
                    <p class="card-text ">
                    <h3>Properties : {{$property->count() }} </h3>
                    </p>
                </div>
            </div>
        </center>
    </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>


    <div class="card tablecard">
        <div class="card-header border-transparent">
            <h3 class="card-title">Areas</h3>

            <div class="card-tools">

                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>

            </div>
        </div>
        <!-- /.card-header -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="card-body p-0">
            <div class="table-responsive table-dark">
                <table class="table m-0 ">
                    <thead>
                        <tr>
                            <div>
                                <th>ID</th>
                                <th>Name</th>
                                {{-- <th>agents</th> --}}
                                <th>Agencies</th>
                                <th>Properties</th>
                                <th>Leads</th>
                            </div>

                        </tr>
                    </thead>
                    <tbody id="areatbody">
                        @include('hometable.areatable')
                        <div class="child">
                            <div id="tick" style="display: none" title="4">
                                {{-- <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px"
                                    viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                                    <path fill="#000"
                                        d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
                                        <animateTransform attributeType="xml" attributeName="transform" type="rotate"
                                            from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite" />
                                    </path>
                                </svg> --}}
                                <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px"
                                    viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
                                    <path opacity="0.2" fill="#000"
                                        d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
                                            s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
                                            c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z" />
                                    <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
                                                C22.32,8.481,24.301,9.057,26.013,10.047z">
                                        <animateTransform attributeType="xml" attributeName="transform" type="rotate"
                                            from="0 20 20" to="360 20 20" dur="0.5s" repeatCount="indefinite" />
                                    </path>
                                </svg>

                            </div>
                        </div>
                    </tbody>

                </table>


                {{-- <nav aria-label="Page navigation example">
                    <div id="wow" class="pagination justify-content-center">
                        {{ $areas->links() }}
                    </div>
                </nav> --}}
                <div id="wow" class="justify-content-center pagination">
                    {{ $areas->links() }}
                </div>
            </div>
            <!-- /.table-responsive -->
        </div>


        <!-- /.card-body -->
        {{-- <div class="card-footer clearfix">
            <a href="javascript:void(0)" class="btn btn-sm btn-info float-right">View All Properties</a>
        </div> --}}
        <!-- /.card-footer -->
    </div>
    {{-- <script>
        function timeSince(date) {

            var seconds = Math.floor((new Date() - date) / 1000);

            var interval = seconds / 31536000;

            if (interval > 1) {
                return Math.floor(interval) + " years";
            }
            interval = seconds / 2592000;
            if (interval > 1) {
                return Math.floor(interval) + " months";
            }
            interval = seconds / 86400;
            if (interval > 1) {
                return Math.floor(interval) + " days";
            }
            interval = seconds / 3600;
            if (interval > 1) {
                return Math.floor(interval) + " hours";
            }
            interval = seconds / 60;
            if (interval > 1) {
                return Math.floor(interval) + " minutes";
            }
            return Math.floor(seconds) + " seconds";
        }
        // var aDay = 24 * 60 * 60 * 1000;
        console.log(timeSince(new Date(Date.now())));
        console.log(timeSince(new Date(Date.now())));

    </script> --}}

    <script>
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            // console.log(href);
            paginated(page)
            // getMoreUsers(page);
            $('#tick').show();
            $("#areatbody").css('opacity', '0.1');
        });

        function paginated(page) {


            $.ajax({
                type: "POST",
                url: "home/ajaxSearch" + "?page=" + page,
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {

                },
                success: function(responese) {
                    // console.log(responese.pagination)
                    $('#tick').hide();
                    $("#areatbody").css('opacity', '1');
                    $('#areatbody').html(responese.data);
                    $('#wow').html(responese.pagination);
                },
            });
        }

    </script>

@endsection
