@extends('layouts.app')
@section('content')

    <style>
        [type=search] {
            height: 20px !important;
            border-radius: 100px !important;
        }

        .select2-container--default.select2-container--open .select2-selection--single {
            border-color: #19599e !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected],
        .select2-container--default .select2-results__option--highlighted[aria-selected]:hover {
            background-color: #015982 !important;
            color: var(--white) !important;
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #015982 !important;
        }

        .select2-search--dropdown {
            display: block !important;
            padding: 0px !important;
            border-style: solid !important;
            border-width: 0px !important;
            border-top-color: #365872 !important;
            border-left-color: #264c69 !important;
            border-right-color: white !important;
            border-bottom-color: white !important;
        }

        .select2-container--default .select2-results__option {
            padding: 1px 4px !important;

        }

        .select2-container--default .select2-selection--single {
            background-color: #fff !important;
            border: 1px solid #2d718c !important;
            border-radius: 10px 10px 0px 0px !important;
        }

        .select2-container--default .select2-dropdown .select2-search__field:focus,
        .select2-container--default .select2-search--inline .select2-search__field:focus {
            outline: none;
            border: 0px solid #80bdff !important;
        }

        .select2-container--default .select2-dropdown {
            border: 1px solid #005982 !important;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 0px solid #aaa !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #145479  !important;
            line-height: 21px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow b{
            border-color: #216484 transparent transparent transparent !important;
        }

        .select2-selection {
            height: 30px !important;
        }

        .select2-container .select2-selection--single {
            height: 80% !important;
        }

        .select2-container {
            height: 80% !important;
        }

        select:focus {

            outline: none;
        }

        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #80bdff;
            outline: none !important;
        }

        select {
            word-wrap: normal;
            /* color: green; */
            border-radius: 11px;
            padding: 3px;
        }

        .child {

            position: absolute;
            top: 1%;
            left: 50%;
        }

        svg path,
        svg rect {
            fill: #13547a;
        }

    </style>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="heading col-sm-6">
                    <h1>By Parent</h1>
                </div>
                {{-- <div class="offset-sm-4  col-sm-2">
                <h1 class="float-sm-right"><span
                    style="background-image: linear-gradient(121deg,black  1%, white 300%);
                    color: white;"
                        class="badge badge-pill">{{ $projects->total() }}</span></h1>
            </div> --}}

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card searcharea">
                    <div class="align-right">
                    </div>
                    <div class="card-header">
                        <br>
                        <div class="card-tools">
                            {{-- <div class="input-group input-group-sm">
                                <form action="{{ route('projects.index') }}" style="display: flex;">
                                    <div class="input-group border rounded-pill ">
                                        <input name="keyword" type="search" placeholder="Search"
                                            aria-describedby="button-addon3" class="form-control bg-none border-0">
                                        <div class="input-group-append border-0">
                                            <button id="button-addon3" type="button" class="btn btn-link text-blue"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div> --}}
                            <select id="changeparent" class="mdb-select md-form" searchable="Search here.."
                                onchange="changeParent()">
                                <option value="" disabled selected>Select Parent</option>
                                @foreach ($selecttag as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div id="tbl" class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap thb">
                            <thead>
                                <tr>
                                    <th>Parent</th>
                                    {{-- <th>ID's</th> --}}
                                    <th>Sub-Parent</th>
                                    {{-- <th>Sub-Sub-Parent</th> --}}
                                    <th>Total</th>

                                </tr>
                            </thead>
                            <tbody>



                                @include('admin.property.byParentTable')


                            </tbody>
                        </table>
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

                        {{-- <div class="align-right paginationstyle">
                        {{ $projects->links() }}
                    </div> --}}
                    </div>

                </div>
                <!-- /.card-header -->


                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    </div>
    <script>
        $("#changeparent").change(function() {
            var selectedParent = $(this).children("option:selected").val();
            $('#tick').show();
            $("tbody").css('opacity', '0.5');
            changeParent(selectedParent)
        });

        function changeParent(id) {
            var val = $('#callstatus' + id).val()
            // <meta name="csrf-token" content="{{ csrf_token() }}" />


            $.ajax({
                type: "GET",
                url: "byparent",
                dataType: 'JSON',
                // headers: {
                //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                data: {
                    parent: id
                },
                success: function(responese) {
                    $('tbody').html(responese.data);
                    $('#tick').hide();
                    $("tbody").css('opacity', '1');
                },
            });
        }

    </script>

@endsection
