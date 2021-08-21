@extends('layouts.app')
@section('content')
<img src="{{$image}}" alt="">
    <style>
        [type=search] {
            height: 37px !important;
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
            border-width: 3px !important;
            border-top-color: #365872 !important;
            border-left-color: #264c69 !important;
            border-right-color: white !important;
            border-bottom-color: white !important;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff !important;
            border: 1px solid #aaa !important;
            border-radius: 12px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444 !important;
            line-height: 21px !important;
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

    </style>

    <style>
        .switch {
            cursor: pointer;
        }

        .switch input {
            display: none;
        }



        .switch input+span {
            width: 48px !important;
            height: 20px !important;
            border-radius: 14px;
            transition: all 1.0s cubic-bezier(0.6, -0.28, 0.26, 0.98);
            display: block;
            position: relative;
            background: #FF4651;
            box-shadow: 0 8px 16px -1px rgba(255, 70, 81, 0.2);
        }

        .switch input+span:before,
        .switch input+span:after {
            content: "";
            display: block;
            position: absolute;
            transition: all 0.3s ease;
        }

        .switch input+span:before {
            top: 4px;
            left: 5px;
            width: 12px;
            height: 12px;
            border-radius: 9px !important;
            border: 3px solid #000306;
        }

        .switch input+span:after {
            top: 5px !important;
            left: 32px !important;
            width: 6px !important;
            height: 17px !important;
            border-radius: 40% !important;
            transform-origin: 50% 50% !important;
            background: #fff !important;
            opacity: 0 !important;


        }

        .switch input+span:active {
            transform: scale(0.92);
        }

        .switch input:checked+span {
            background: #48EA8B;
            box-shadow: 0 8px 16px -1px rgba(72, 234, 139, 0.2);
        }

        .switch input:checked+span:before {
            width: 5px !important;
            height: 12px !important;
            border-radius: 121px !important;
            margin-left: 31px !important;
            border-width: 3px !important;
            background: #0d2034 !important;
        }


        .switch input:checked+span:after {

            -webkit-animation: blobChecked 0.35s linear forwards 0.2s;
            animation: blobChecked 0.35s linear forwards 0.2s;
        }

        .switch input:not(:checked)+span:before {
            -webkit-animation: blob 0.85s linear forwards 0.2s;
            animation: blob 0.85s linear forwards 0.2s;
        }

        .highlight {
            /* background: #c5c3c396; */
            /* color: #26526a;
                                                                                                                                                    text-shadow: 1px 1px 1px #030e15f7, 0 0 35px #13547ac1, 0 0 5px #13547a; */
            /* color: white; */
            /* background-image: linear-gradient(121deg, #13547a 1%, #07100f 250%); */
            background-image: linear-gradient(121deg, #fd090964 1%, #fd09097b 250%);
            color: black;
            /* color: white */
            /* text-shadow: 3px 3px 4px #e8e8e8; */
            text-transform: capitalize;
            transition: transform .3s;
            transform: scale(1.0);
        }

        .transfromhighlight {

            transition: transform .3s;
            transform: scale(1.0);
        }

    </style>

    {{-- <style>
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
            border-width: 3px !important;
            border-top-color: #365872 !important;
            border-left-color: #264c69 !important;
            border-right-color: white !important;
            border-bottom-color: white !important;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff !important;
            border: 1px solid #aaa !important;
            border-radius: 12px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444!important;
            line-height: 21px!important;
        }

        .select2-selection {
            height: 30px !important;
        }




        .btn1 {
            height: 100px;
            width: 10px;
            border: 2px solid black;
            background-color: white;
            color: black;
            padding: 8px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 25px;
        }

        .info {
            border-color: #1F6182;
            color: #1F6182;
        }

        .info:hover {
            background: #1F6182;
            color: white;
        }

        .tooltip .tooltiptext {
            background-color: red;
            color: #fff;

        }

    </style> --}}
    {{-- <style>
        .select2-container .select2-selection--single {
            height: 30px !important;
        }

        .select2-container--default .select2-selection--single {
            background-color: var(--white);
            border: 1px solid #062b5052;
            border-radius: 30px;
        }

    </style> --}}

    <style>
        @keyframes shake {
            0% {
                transform: rotate(36deg);
            }

            10% {
                transform: rotate(72deg);
            }

            20% {
                transform: rotate(108deg);
            }

            30% {
                transform: rotate(144deg);
            }

            40% {
                transform: rotate(180deg);
            }

            50% {
                transform: rotate(216deg);
            }

            60% {
                transform: rotate(252deg);
            }

            70% {
                transform: rotate(288deg);
            }

            80% {
                transform: rotate(324deg);
            }

            90% {
                transform: rotate(360deg);
            }

            100% {
                transform: rotate(396deg);
            }
        }

        .btn-default1 {
            background-color: transparent;
            border-color: rgb(0, 0, 0);
            color: #000000;
            opacity: 0.9;
        }

        .btn-default1:hover {
            background-color: #eaeef2cd;
            border-color: #ddd;
            color: #070707;
            opacity: 0.7;
        }

        input[type="datetime-local"]:hover {
            background: #eaeef2cd;
            color: #000000 opacity: 0.7;
        }

        .modal-open .modal {
            overflow-x: hidden;
            overflow-y: auto;
            backdrop-filter: blur(9px);
        }

        .modal-footer {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-end;
            padding: 0.75rem;
            border-top: 0px solid #fbfdff26;
            border-bottom-right-radius: calc(0.3rem - -21px);
            border-bottom-left-radius: calc(0.3rem - -21px);
            background: #fbfdff26;
            opacity: 0.9;
        }

        .modal-body {
            position: relative;
            flex: 1 1 auto;
            padding: 1rem;
            background: #fbfdff26;
            opacity: 0.9;
        }

        .modal-content {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: #ffffff00;
            background-clip: padding-box;
            border: 0px solid rgba(0, 0, 0, 0.2);
            border-radius: 1.7rem;
            box-shadow: 0 0.25rem 0.5rem rgb(0 0 0 / 50%);
            outline: 0;
        }

        .modal-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            padding: 1rem;
            border-bottom: 0px solid #fbfdff26;
            border-top-left-radius: calc(0.3rem - -21px);
            border-top-right-radius: calc(0.3rem - -21px);
            background: #fbfdff26;
            opacity: 0.9;
        }

        .close,
        .mailbox-attachment-close {
            float: right;
            font-size: 1.5rem;
            font-weight: 900;
            line-height: 1;
            color: rgb(0, 0, 0);
            background: #fbfdff26;
            text-shadow: 0 1px 0 #000;
            opacity: 0.6;
        }

        .modal-title {
            margin-bottom: 0;
            line-height: 1.5;
            color: #0a0a0ac2;
        }


        .ani:hover span {

            /* Start the shake animation and make the animation last for 0.5 seconds */
            animation: shake 1s;

            /* When the animation is finished, start again */
            animation-iteration-count: 100;
        }

    </style>

    <section class="content-header">
        <style>
            #icon {
                transition: 0.6s;

            }

            #icon:hover {

                -ms-transform: scale(1.5);
                /* IE 9 */
                -webkit-transform: scale(1.5);
                /* Safari 3-8 */
                transform: scale(1.5);
                transition: 0.6s;

            }

            .zoom {
                transition: 0.5s;
            }

            input[type="datetime-local"] {
                appearance: none;
                -webkit-appearance: none;
                color: #000000;
                font-family: "Helvetica", arial, sans-serif;
                font-size: 16px;
                border: 1px solid #000000;
                background: transparent;
                padding: 5px;
                border-radius: 11px;
                display: inline-block !important;
                visibility: visible !important;
                opacity: 0.9;
            }

            input[type="datetime-local"]:focus {
                outline: 0;
            }

            .zoom:hover {
                -ms-transform: scale(1.5);
                /* IE 9 */
                -webkit-transform: scale(1.5);
                /* Safari 3-8 */
                transform: scale(1.5);
                transition: 0.6s;


            }

            .s {
                border: 1px solid #007BFF !important;
                border-radius: 5px;
                padding-left: 15px;
                padding-top: 5px;
                padding-right: 15px;
                padding-bottom: 5px;
                "

            }

            .container-fluid {
                overflow-x: hidden !important;
            }

            textarea {
                border: #ffffff00 solid 1px;
            }

            textarea:focus {

                outline: none;
            }

            .parent {
                position: relative;

            }

            .child {

                position: absolute;
                top: 0;
                left: 50%;
            }

            .checkmark__circle {
                stroke-dasharray: 166;
                stroke-dashoffset: 166;
                stroke-width: 2;
                stroke-miterlimit: 10;
                stroke: #15af34;
                fill: none;
                animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
            }

            .checkmark {
                width: 40px;
                height: px;
                border-radius: 50%;
                display: block;
                stroke-width: 2;
                stroke: #fff;
                stroke-miterlimit: 10;
                /* margin: 11% auto; */
                margin: 12% 3%;

                box-shadow: inset 0px 0px 0px white;
                animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
            }

            .checkmark__check {
                transform-origin: 50% 50%;
                stroke-dasharray: 48;
                stroke-dashoffset: 48;
                animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
            }

            @keyframes stroke {
                100% {
                    stroke-dashoffset: 0;
                }
            }

            @keyframes scale {

                0%,
                100% {
                    transform: none;
                }

                50% {
                    transform: scale3d(1.1, 1.1, 1);
                }
            }

            @keyframes fill {
                100% {
                    box-shadow: inset 0px 0px 0px 30px #15af34;
                }
            }

        </style>
        <div class="container-fluid" style="">
            <div class="row mb-2">
                <div class="filtersdiv">

                    <style>
                        .filter-control {
                            display: inline;
                        }

                        .filters .select2-container--default .select2-selection--single {
                            width: 220px;
                            background: black
                        }

                        /* .fltersdiv {
                                                                                                                                                                background: #32576d;
                                                                                                                                                                padding-bottom: 2%;
                                                                                                                                                                margin-bottom: 1%;
                                                                                                                                                                border-radius: 24px 24px 32% 30%;
                                                                                                                                                            } */

                    </style>

                    <div class="filters row" style="display:none;">
                        <div class="col-md-12">
                            <form action="{{ route('leads.filter') }}">
                                @csrf
                                <div class="float-left mx-3 my-3">
                                    <label>From This:</label>
                                    <input type="date" class="form-control filter-control" name="start_date" id="" @if (request()->get('start_date') !== null) value={{ request()->get('start_date') }} @endif>
                                    {{-- <input type="date" class="form-control filter-control"
                                    name="start_date" id="" @if (request()->get('start_date') !== null) value={{ request()->get('start_date') }} @endif> --}}

                                </div>
                                <div class="float-left mx-3 my-3">
                                    <label>To This:</label>
                                    <input type="date" class="form-control filter-control" name="end_date" id="" @if (request()->get('end_date') !== null) value={{ request()->get('end_date') }} @endif>
                                </div>
                                <div class="float-left mx-3 my-3">
                                    <label>Lead Source:</label><br>
                                    <select class="form-control filter-control filter-select" name="leadsource">
                                        <option @if (request()->get('leadsource') == null) selected @endif value="">Select Category
                                        </option>
                                        <option @if (request()->get('leadsource') == '-') selected @endif value="-">-</option>
                                        <option @if (request()->get('leadsource') == 'Facebook') selected @endif value="Facebook">Facebook</option>
                                        <option @if (request()->get('leadsource') == 'On Call') selected @endif value="On Call">On Call</option>
                                        <option @if (request()->get('leadsource') == 'from website') selected @endif value="from website">From Website
                                        </option>
                                        <option @if (request()->get('leadsource') == 'Wanted_web') selected @endif value="Wanted_web">From Wanted</option>
                                        <option @if (request()->get('leadsource') == 'From Project') selected @endif value="From Project">From Project
                                        </option>
                                    </select>
                                </div>
                                <div class="float-left mx-3 my-3">
                                    <label>Response Status:</label><br>
                                    <select class="form-control filter-control filter-select" name="response_status">
                                        <option @if (request()->get('response_status') == null) selected @endif value="">Select Category</option>
                                        <option @if (request()->get('response_status') == 'Responded') selected @endif value="Responded">Responded</option>
                                        <option @if (request()->get('response_status') == 'Not Responded') selected @endif value="Not Responded">Not Responded
                                        </option>
                                        <option @if (request()->get('response_status') == 'Interested') selected @endif value="Interested">Interested</option>
                                        <option @if (request()->get('response_status') == 'Not Interested') selected @endif value="Not Interested">Not Interested
                                        </option>
                                        <option @if (request()->get('response_status') == 'Not Interested Now') selected @endif value="Not Interested Now">Not Interested
                                            Now
                                        </option>
                                    </select>
                                </div>

                                <br />
                                <br />

                                <div class="col-md-3 mx-3 my-3">
                                    <button class="btn btn-primary">Apply Filter</button>
                                    <a href="{{ route('leads.index') }}"><button type="button"
                                            class="btn btn-danger">Cancel</button></a>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <div class=" heading col-sm-6">
                    <h1>Lead</h1>
                </div>
                <div class="col-sm-2">
                    <span data-toggle="tooltip" title="Filter" class="filterbtn"><i id="icon" class='fas fa-angle-down'
                            style='font-size:25px;color:#13547a;padding-bottom: 1%'></i></span>
                </div>
                <div class="offset-sm-2  col-sm-2">
                    <h1 class="float-sm-right"><span id="total"
                            style="background-image: linear-gradient(121deg, #13547a 1%, #80d0c7 250%);color: white"
                            class="badge badge-pill">{{ $leads->total() }}</span></h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">

        {{-- <button class="btn1 info filterbtn"><i class='fas fa-angle-right' style='color:red'></i></button> --}}
        <div class="row">

            <div class="col-12">
                <div class="card searcharea">
                    <div class="align-right" style="position: fixed; z-index: 2; margin-left: 79%">
                        {{-- href="{{ route('leads.edit', $item->id) }}" --}}
                        <a id="editselected" style="display: none">
                            <button class="btn btn-sm btn-success">
                                <i class="fas fa-edit" style="color: white"></i> Edit
                            </button>
                        </a>

                        <button onclick="deleteItems()" id="dltselected" style="display: none;box-shadow: 5px 10px #888888;"
                            class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Delete <span id="dltbadge"
                                class="badge badge-light"></span></button>
                    </div>
                    <div class="card-header" style="padding-left:1%">

                        <br>
                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <div style="display: flex;">
                                <div class="input-group border rounded-pill m-1 ">
                                    <input style="background: transparent" name="keyword" id="keyword" type="text"
                                        placeholder="Search" class="form-control bg-none border-0">
                                    <div class="input-group-append border-0">
                                        <button id="loader" type="button" id="button-addon3" type="button"
                                            class="btn btn-link text-blue"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>

                                <a href="{{ route('leads.import') }}"><button type="button"
                                        class="btn btn-danger rounded-pill specialbutton m-1">Import Leads</button></a>
                                <a href="{{ route('leads.create') }}"><button type="button"
                                        class="btn btn-primary rounded-pill rounded-bill m-1">Add
                                        Lead</button></a>
                            </div>
                        </div>

                        {{-- DateModal --}}
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog  ">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Visit Date</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input id="leadid" type="hidden">
                                        <input id="visitdate" type="datetime-local">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" onclick="saveVisitDate()" class="btn btn-default1"
                                            data-dismiss="modal">Save</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- DateModal --}}

                        {{-- addleadModal --}}

                        {{-- <div class="modal fade" id="addleadModal" role="dialog">
                            <div class="modal-dialog modal-dialog-centered ">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <style>

                                    </style>
                                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Lead</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Area one</label>
                                            <div class="col-sm-10">
                                             <select class="form-control" name="area_one_id" id="area_one_id">
                                                <option value="">Select</option>
                                                @foreach ($area_one as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" onclick="" class="btn btn-default1"
                                            data-dismiss="modal">Save</button>
                                    </div>
                                </div>

                            </div>
                        </div> --}}
                        {{-- addleadModal --}}
                        <style>
                            .Container {
                                width: 200px;
                                overflow-y: auto;
                            }

                            .Content {}

                            .Flipped,
                            .Content {
                                transform: rotateX(180deg);
                                -ms-transform: rotateX(180deg);
                                /* IE 9 */
                                -webkit-transform: rotateX(180deg);
                                /* Safari and Chrome */
                            }

                        </style>



                    </div>
                    <div class="card-body table-responsive p-0 Flipped">
                        <div id="wow" class="align-right paginationstyle Content">
                            {{ $leads->links() }}
                        </div>
                        <table class="table table-hover text-nowrap Content" style="margin-bottom: 7px ">
                            <thead>
                                <tr> <input type="hidden" id="sort_from">
                                    <th onclick="sortBy('id')"># <i style="display: none" id="sort_by_icon"
                                            class="fas fa-sort-up"></i> <input type="hidden" id="sort_by"></th>
                                    <th>Visit Date</th>
                                    <th id="thname">Detail</th>
                                    {{-- <th>Email</th> --}}
                                    {{-- <th>Phone</th> --}}
                                    <th>Description</th>
                                    <th>More Detail</th>
                                    {{-- <th>Type</th> --}}
                                    {{-- <th>How Soon</th> --}}
                                    {{-- <th>Family</th> --}}
                                    {{-- <th>Leadsource</th> --}}
                                    <th>Status</th>
                                    {{-- <th>Call Status</th> --}}
                                    {{-- <th>Response Status</th> --}}
                                    {{-- <th>Property Type</th> --}}
                                    {{-- <th>Status</th> --}}
                                    <th onclick="sortBy('created_at')">Created At <i style="display: none"
                                            id="sort_by_iconcreated" class="fas fa-sort-up"><input type="hidden"
                                                id="sort_by_created"></th>
                                    <th onclick="sortBy('updated_at')">Updated At <i style="display: none"
                                            id="sort_by_iconupdated" class="fas fa-sort-up"><input type="hidden"
                                                id="sort_by_updated"></th>
                                    <th>Created By</th>
                                    <th>Action</th>
                                    <th>Assign To</th>
                                    {{-- <th>Updated By</th> --}}

                                </tr>
                            </thead>
                            <tbody style="width: 10px">
                                <div id="leadss">
                                    @include('admin.lead.ajaxtable')
                                </div>
                            </tbody>
                        </table>

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
        var icon = document.getElementById("icon");
        var toggleiconnumb = 0;
        $('.filterbtn').on('click', function() {
            toggleicon();
            tooglefilter();
        })

        function toggleicon() {
            if (toggleiconnumb == 1) {
                icon.className = "fas fa-angle-down";
                toggleiconnumb = 0;
            } else {
                icon.className = "fas fa-angle-up";
                toggleiconnumb = 1;
            }
        }

        function tooglefilter() {
            $('.filters').toggle(70);
        }

    </script>

    <script>
        var sortbyicon = document.getElementById("sort_by_icon");
        var sortbyiconcreate = document.getElementById("sort_by_iconcreated");
        var sortbyiconupdate = document.getElementById("sort_by_iconupdated");
        var toggleiconnumbid = 0;
        var toggleiconnumbcreate = 0;
        var toggleiconnumbupdate = 0;

        function sortBy(from) {
            // console.log(from)
            if (from == 'id') {
                $('#sort_from').val('id');
                // console.log('idkyander')
                $('#sort_by_iconcreated').hide();
                $('#sort_by_iconupdated').hide();
                $('#sort_by_icon').show();
                if (toggleiconnumbid == 1) {
                    sortbyicon.className = "fas fa-sort-up";
                    toggleiconnumbid = 0;
                    var value = $('#keyword').val();
                    $('#sort_by').val('DESC');
                    ajaxSortBy(value, from, 'DESC');

                } else {
                    sortbyicon.className = "fas fa-sort-down";

                    toggleiconnumbid = 1;
                    var value = $('#keyword').val();
                    $('#sort_by').val('ASC');
                    ajaxSortBy(value, from, 'ASC');

                }
            }

            if (from == 'updated_at') {
                // console.log('updated_atkyander')
                $('#sort_from').val('updated_at');

                $('#sort_by_icon').hide();
                $('#sort_by_iconcreated').hide();
                $('#sort_by_iconupdated').show();


                if (toggleiconnumbupdate == 1) {
                    sortbyiconupdate.className = "fas fa-sort-up";
                    toggleiconnumbupdate = 0;
                    var value = $('#keyword').val();
                    $('#sort_by_updated').val('DESC');

                    ajaxSortBy(value, from, 'DESC');



                } else {
                    sortbyiconupdate.className = "fas fa-sort-down";

                    toggleiconnumbupdate = 1;
                    var value = $('#keyword').val();
                    $('#sort_by_updated').val('ASC');
                    ajaxSortBy(value, from, 'ASC');

                }
            }

            if (from == 'created_at') {
                // console.log('created_atkyander')
                $('#sort_from').val('created_at');

                $('#sort_by_icon').hide();
                $('#sort_by_iconupdated').hide();
                $('#sort_by_iconcreated').show();


                if (toggleiconnumbcreate == 1) {
                    sortbyiconcreate.className = "fas fa-sort-up";
                    toggleiconnumbcreate = 0;
                    var value = $('#keyword').val();
                    $('#sort_by_created').val('DESC');
                    ajaxSortBy(value, from, 'DESC');



                } else {
                    sortbyiconcreate.className = "fas fa-sort-down";

                    toggleiconnumbcreate = 1;
                    var value = $('#keyword').val();
                    $('#sort_by_created').val('ASC');
                    ajaxSortBy(value, from, 'ASC');


                }
            }


            // console.log($value);
            // ajaxSearch($value)
        }

        function ajaxSortBy(value, sort_from, sort_by) {
            $.ajax({
                type: "POST",
                url: "leads/ajaxSearch",
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'keyword': value,
                    'sort_by': sort_by,
                    'sort_from': sort_from
                },
                success: function(responese) {


                    // console.log(responese.pagination)
                    $('tbody').html(responese.data);
                    $('#wow').html(responese.pagination);
                    $('#total').html(responese.total);
                },
            });
        }

    </script>

    <script>
        $('#keyword').on('keypress', function(event) {
            // alert('h')
            if (event.which == 13) {
                console.log(1)
                event.preventDefault()
            }
        })

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var href = $(this).attr('href');
            console.log(href);
            var page = $(this).attr('href').split('page=')[1];
            var url = $(this).attr('href').split('?')[1];
            var fullurl = "leads?" + url;

            $(this).html('<i class="fa fa-circle-notch fa-spin"></i>')
            window.history.pushState('new', 'Title', fullurl);
            paginated(page)
            // getMoreUsers(page);
        });

        function paginated(page) {
            var value = $('#keyword').val();
            var sort_by = $('#sort_by').val();
            var sort_from = $('#sort_from').val();

            // console.log(sort_by);
            if (sort_by == null) {
                sort_by = 'DESC'
            }
            if (sort_from == null) {
                sort_from = 'created_at'
            }

            $.ajax({
                type: "POST",
                url: "leads/ajaxSearch" + "?page=" + page,
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'keyword': value,
                    'sort_by': sort_by,
                    'sort_from': sort_from
                },
                success: function(responese) {
                    // console.log(responese.pagination)
                    $('tbody').html(responese.data);
                    $('#wow').html(responese.pagination);
                },
            });
        }

        $('#keyword').on('keyup', function(event) {
            if (event.which != 13) {
                $value = $(this).val();
                var fullurl = "leads?keyword=" + $value;
                window.history.pushState('new', 'Title', fullurl);
                // console.log($value);
                $('#loader').html('<i class="fa fa-circle-notch fa-spin"></i>');

                ajaxSearch($value)
            }

        });

        function ajaxSearch(value) {
            $.ajax({
                type: "POST",
                url: "leads/ajaxSearch",
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'keyword': value,
                },
                success: function(responese) {


                    // console.log(responese.pagination)
                    $('#loader').html('<i class="fa fa-search"></i>');
                    $('tbody').html(responese.data);
                    $('#wow').html(responese.pagination);
                    $('#total').html(responese.total);
                },
            });
        }

    </script>

    <script>
        $(document).ready(function() {
            window.name = 1;
        })
        document.getElementById("thname").addEventListener("dblclick", hidenamerow);
        document.getElementById("thdesc").addEventListener("dblclick", hidedescrow);
        document.getElementById("thbudget").addEventListener("dblclick", hidebudgetrow);
        document.getElementById("thtype").addEventListener("dblclick", hidetyperow);
        document.getElementById("thhowsoon").addEventListener("dblclick", hidehowsoonrow);
        document.getElementById("thfamily").addEventListener("dblclick", hidefamilyrow);

        function checkHiddenColumns() {
            // alert('1'+window.name)
            if (window.name == 0) {
                hidenamerow()
                // alert(window.name+'done')
            }
            if (window.desc == 0) {
                hidedescrow()
            }
            if (window.budget == 0) {
                hidebudgetrow()
            }
            if (window.type == 0) {
                hidetyperow()
            }
            if (window.howsoon == 0) {
                hidehowsoonrow()
            }
            if (window.family == 0) {
                hidefamilyrow()
            }

        }

        function hidenamerow() {
            $('#thname').hide();
            $("table").find(".tdname").hide();
            window.name = 0;
        }

        function hidedescrow() {
            $('#thdesc').hide();
            $("table").find(".tddesc").hide();
            window.desc = 0
        }

        function hidebudgetrow() {
            $('#thbudget').hide();
            $("table").find(".tdbudget").hide();
            window.budget = 0
        }

        function hidetyperow() {
            $('#thtype').hide();
            $("table").find(".tdtype").hide();
            window.type = 0
        }

        function hidehowsoonrow() {
            $('#thhowsoon').hide();
            $("table").find(".tdhowsoon").hide();
            window.howsoon = 0
        }

        function hiderow() {
            // document.getElementById("demo").innerHTML = "I was double-clicked!";
            console.log('namethclicked')
        }

    </script>

    <script>
        var dltid = [];

        function selectMultiple(id) {
            var val;
            var table = document.getElementById("tablerow" + id);

            function checkAdult(idd) {
                return idd == id;
            }



            if ($('#deleterow' + id).prop("checked") == true) {
                // console.log("Checkbox is checked.");
                // table.className = "transfromhighlight";
                table.className = "";
                $('#deleterow' + id).prop("checked", false);
                idindex = dltid.findIndex(checkAdult);
                dltid.splice(idindex, 1);

                val = 1;
            } else if ($('#deleterow' + id).prop("checked") == false) {
                // console.log("Checkbox is unchecked.");
                table.className = "highlight";
                $('#deleterow' + id).prop("checked", true);
                dltid.push(id);
                val = 0;
            }
            $('#dltbadge').text(dltid.length);

            if (dltid.length == 0) {
                $('#editselected').hide();
                $('#dltselected').hide();
            }
            if (dltid.length == 1) {
                $('#editselected').show();
                var routeid = dltid[0];
                var url = '{{ route('leads.edit', ':id') }}';
                url = url.replace(':id', routeid);
                // alert(url)
                $('#editselected').attr("href", url);
                $('#dltselected').show();
            }
            if (dltid.length > 1) {
                $('#editselected').hide();
                $('#dltselected').show();
            }
        }

        function deleteItems() {
            // console.log(dltid);
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete ` + dltid.length + ' items?',
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        multidelete();
                        swal("Your file has been deleted!", {
                            icon: "success",
                        });
                    }
                });

        }

        function multidelete() {

            $.ajax({
                type: "POST",
                url: "leads/ajaxSearch",
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    dltid: dltid,
                },
                success: function(responese) {


                    // console.log(responese.pagination)
                    $('tbody').html(responese.data);
                    $('#wow').html(responese.pagination);
                    $('#total').html(responese.total);
                    $('#editselected').hide();
                    $('#dltselected').hide();
                    dltid = [];


                },
            });
        }

    </script>

    <script>
        var desoldcval = [];

        function editDesc(id) {
            var countclick = document.getElementById("countClick" + id).value;
            var descval = $("#desc" + id).val();
            // console.log(descval);
            // function checkAdult(idd) {
            //     return idd == descval;
            // }


            // idindex = dltid.findIndex(checkAdult);
            //     dltid.splice(idindex, 1);
            //     dltid.push(id);

            if (countclick == 0) {
                $("#desc" + id).attr("readonly", false);
                // var res = descval.split("Updated By:");
                // $('#desc' + id).text(res[0]);
                // desoldcval[id] = descval;
                // console.log(desoldcval);
                $("#savedesc" + id).attr("disabled", false);
                $("#editdesc" + id).html("Un-Edit");
                document.getElementById("countClick" + id).value++;
                $("#desc" + id).css('border', '1px solid green');
            }
            if (countclick == 1) {
                $("#desc" + id).attr("readonly", true);
                $("#savedesc" + id).attr("disabled", true);
                $("#editdesc" + id).html("Edit");
                // idindex = desoldcval.findIndex(checkAdult);
                // console.log(idindex)

                $('#desc' + id).text(desoldcval[id]);
                // console.log(desoldcval[id]);
                // desoldcval.splice(id, 1);
                document.getElementById("countClick" + id).value = 0;
                $("#desc" + id).css('border', '1px solid #ffffff00 ');
            }

        }

        function saveDesc(id) {

            // var val = desoldcval[id];
            var val = $("#desc" + id).val();

            $.ajax({
                type: "POST",
                url: "leads/ajax",
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    desc_id: id,
                    desc_val: val
                },
                success: function(responese) {
                    $('#tick' + id).show();
                    setTimeout(function() {
                        $('#tick' + id).hide();
                    }, 2200);
                    $("#desc" + id).attr("readonly", true);
                    $("#savedesc" + id).attr("disabled", true);
                    $("#editdesc" + id).html("Edit");
                    document.getElementById("countClick" + id).value = 0;
                    $("#desc" + id).css('border', '1px solid #ffffff00');
                    $('#desc' + id).text(responese.desc);
                    // alert("#visit_date".id)
                    // alert(date)

                    // $("#visit_date"+id).text(date);


                    // setTimeout(function(){ $("#tick").css("display", "block"); },2000);
                },
            });
        }

        function openVisitModal(id, date) {
            $('#visitdate').val(date);
            $('#leadid').val(id);
        }

        function saveVisitDate() {
            var date = $('#visitdate').val();
            var id = $('#leadid').val();

            $.ajax({
                type: "POST",
                url: "leads/ajax",
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    visit_id: id,
                    visit_date: date
                },
                success: function(responese) {
                    // $('#tick').show();
                    // setTimeout(function() {
                    //     $('#tick').hide();
                    // }, 3000);
                    // alert("#visit_date".id)
                    // alert(date)
                    console.log(responese.date);

                    // $("#visit_date"+id).text(date);
                    $("#visit_date" + id).text('{{ date('D, d-m-Y', strtotime('responese.date')) }}');
                    // $("#visit_date" + id).color('green');
                    $("#visit_date2" + id).show();
                    $("#visit_date2" + id).text('{{ date('h:i A', strtotime('responese.date')) }}');




                    // setTimeout(function(){ $("#tick").css("display", "block"); },2000);
                },
            });

        }

        function statusToggle(id) {
            var val;

            if ($('#status' + id).prop("checked") == true) {
                // console.log("Checkbox is checked.");
                val = 1;
            } else if ($('#status' + id).prop("checked") == false) {
                // console.log("Checkbox is unchecked.");
                val = 0;
            }


            $.ajax({
                type: "POST",
                url: "leads/ajax",
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    status_id: id,
                    status_val: val
                },
            });

        }


        function changeCallStatus(id) {


            var val = $('#callstatus' + id).val()


            $.ajax({
                type: "POST",
                url: "leads/ajax",
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    callstatus_id: id,
                    callstatus_val: val
                },
            });

        }

        function changeResponseStatus(id) {


            var val = $('#responsestatus' + id).val()


            $.ajax({
                type: "POST",
                url: "leads/ajax",
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    responsestatus_id: id,
                    responsestatus_val: val
                },
            });

        }

    </script>
    {{-- <script>
        (function(document) {
            'use strict';

            var LightTableFilter = (function(Arr) {

                var _input;

                function _onInputEvent(e) {
                    _input = e.target;
                    var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
                    Arr.forEach.call(tables, function(table) {
                        Arr.forEach.call(table.tBodies, function(tbody) {
                            Arr.forEach.call(tbody.rows, _filter);
                        });
                    });
                }

                function _filter(row) {
                    var text = row.textContent.toLowerCase(),
                        val = _input.value.toLowerCase();
                    row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
                }

                return {
                    init: function() {
                        var inputs = document.getElementsByClassName('light-table-filter');
                        Arr.forEach.call(inputs, function(input) {
                            input.oninput = _onInputEvent;
                        });
                    }
                };
            })(Array.prototype);

            document.addEventListener('readystatechange', function() {
                if (document.readyState === 'complete') {
                    LightTableFilter.init();
                }
            });

        })(document);

    </script> --}}


@endsection
