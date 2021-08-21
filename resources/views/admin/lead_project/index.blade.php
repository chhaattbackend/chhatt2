@extends('layouts.app')
@section('content')
    <style>
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
            width: 27px;
            height: px;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #15af34;
            stroke-miterlimit: 10;
            margin: 2% 53%;
            /* margin: 12% 3%; */
            box-shadow: inset 0px 0px 0px #15af34;
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
                box-shadow: inset 0px 0px 0px 30px #fdfdfd;
            }
        }

        .btn-sm,
        .btn-group-sm>.btn {
            padding: 0.35rem 0.5rem !important;
            font-size: 0.875rem !important;
            line-height: 0.9 !important;
            border-radius: 1.2rem !important;
        }

    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="heading col-sm-6">
                    <h1>Lead Project</h1>
                </div>
                <div class=" offset-sm-4  col-sm-2">
                    <h1 class="float-sm-right"><span
                            style="background-image: linear-gradient(121deg, #13547a 1%, #80d0c7 250%);color: white"
                            class="badge badge-pill">{{ $leadProjects->total() }}</span>
                    </h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <button class="btn1 info filterbtn">Filter</button>
        <div class="row">

            <div class="col-12">
                <div class="filtersdiv">
                    <style>
                        .btn1 {
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

                        .abc {
                            width: 200%;
                        }

                    </style>

                    <style>
                        /* .filtersdiv {
                                                                                        border: 1px solid;
                                                                                        border-color: lightgray;
                                                                                        border-radius: 100px;
                                                                                        margin: 3px;
                                                                                        width: 80%;
                                                                                    } */
                        .filter-control {
                            display: inline;
                        }

                        .filters .select2-container--default .select2-selection--single {
                            /* width: 220px; */
                        }

                    </style>

                    <div class="filters row" style="display:none">
                        <form action="{{ route('leadprojects.filter') }}">
                            @csrf


                            <div class="float-left mx-2 my-3">
                                <label>From This:</label>
                                <input type="date" class="form-control filter-control" name="start_date" id="">
                            </div>
                            <div class="float-left mx-2 my-3">
                                <label>To This:</label><input type="date" class="form-control filter-control"
                                    name="end_date" id="" @if (request()->get('end_date') !== null) value={{ request()->get('end_date') }} @endif>
                            </div>
                            <div class="float-left my-3">
                                <label>Project:</label><br>
                                <select style="width : 180px;" class="form-control filter-control filter-select"
                                    name="project_id">
                                    <option @if (request()->get('project_id') == null) selected @endif value="">Select
                                    </option>
                                    <option @if (request()->get('project_id') == '1') selected @endif value="1">Welcome Center</option>
                                    <option @if (request()->get('project_id') == '2') selected @endif value="2">JF Tower</option>
                                    <option @if (request()->get('project_id') == '3') selected @endif value="3">Codesk</option>
                                    <option @if (request()->get('project_id') == '4') selected @endif value="4">Royal Heights</option>
                                    <option @if (request()->get('project_id') == '5') selected @endif value="5">Shop for sale with rental income
                                        45k</option>

                                </select>
                            </div>
                            <div class="float-left mx-3 my-3">
                                <label>Call Status:</label><br>
                                <select style="width: 180px;" class="form-control filter-control filter-select"
                                    name="call_status">
                                    <option @if (request()->get('call_status') == null) selected @endif value="">Select
                                    </option>
                                    <option @if (request()->get('call_status') == '1') selected @endif value="1">Active</option>
                                    <option @if (request()->get('call_status') == '0') selected @endif value="0">Non Active</option>

                                </select>
                            </div>
                            <div class="float-left mx-3 my-3">
                                <label>Response Status:</label><br>
                                <select style="width: 180px;" class="form-control filter-control filter-select"
                                    name="response_status">
                                    <option @if (request()->get('response_status') == null) selected @endif value="">Select
                                    </option>
                                    <option @if (request()->get('response_status') == 'Responded') selected @endif value="Responded">Responded</option>
                                    <option @if (request()->get('response_status') == 'Not Responded') selected @endif value="Not Responded">Not Responded</option>
                                    <option @if (request()->get('response_status') == 'Interested') selected @endif value="Interested">Interested</option>
                                    <option @if (request()->get('response_status') == 'Not Interested') selected @endif value="Not Interested">Not Interested
                                    </option>
                                    <option @if (request()->get('response_status') == 'Called Back') selected @endif value="Called Back">Called Back</option>
                                    <option @if (request()->get('response_status') == 'Not Interested Now') selected @endif value="Not Interested Now">Not Interested Now
                                    </option>

                                </select>
                            </div>




                            <div class="col-md-0 mx-3 my-3">
                                <button class="btn btn-primary">Submit</button>
                                <a href="{{ route('leadprojects.index') }}"><button type="button"
                                        class="btn btn-danger">Cancel</button></a>

                            </div>
                    </div>


                </div>
                </form>
            </div>
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

            <div class="card searcharea">
                <div class="align-right">
                </div>
                <div class="card-header" style="padding-left:1% ">
                    {{-- <h3 class="card-title"><button style="padding: 3px" type="button" class="btn btn-primary">
                                TOTAL <span class="badge badge-pill badge-light">{{$count}}</span>
                            </button></h3>
                        <br> --}}
                    <br>

                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <form action="{{ route('leadprojects.index') }}" style="display: flex;">
                                <div class="input-group border rounded-pill m-1 ">
                                    <input name="keyword" id="keyword" type="search" placeholder="Search"
                                        aria-describedby="button-addon3" class="form-control bg-none border-0">
                                    <div class="input-group-append border-0">
                                        <button type="submit" id="button-addon3" class="btn btn-link text-blue"><i
                                                class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>

                            <a href="{{ route('leads.createproject') }}"><button type="button"
                                    class="btn btn-primary rounded-pill rounded-bill">Add
                                    Lead Project </button></a>
                        </div>
                    </div>

                </div>


                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>Visit Date</th>
                                <th>Project Name</th>
                                {{-- <th>Owner</th> --}}
                                {{-- <th>Contact</th> --}}
                                <th>Lead Name</th>
                                <th>Lead Contact</th>
                                <th>Description</th>
                                {{-- <th>Family Members</th> --}}
                                {{-- <th>Budget</th> --}}
                                <th>Call Status</th>
                                <th>Response Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leadProjects as $item)
                                <tr>
                                    <meta name="csrf-token" content="{{ csrf_token() }}" />

                                    <td>{{ $item->id }}</td>
                                    <td><a href="{{ route('leads.edit', $item->lead_id) }}" class="float-left"><i
                                                class="fas fa-edit"></i></a></td>
                                    <td>
                                        @if ($item->response_status == 'Not Interested')

                                            <span class="badge badge-pill badge-danger ">Not Interested</span>
                                        @elseif (optional($item->lead)->visit_date==null)
                                    {{-- <td> --}}
                                        <span style="cursor: pointer" id="visit_date{{ optional($item->lead)->id }}"
                                            onclick="openVisitModal('{{ optional($item->lead)->id }}')"
                                            data-toggle="modal" data-target="#myModal"
                                            class="badge badge-pill badge-info">Date Not
                                            Set</span><br>
                                        <span style="display: none" id="visit_date2{{ optional($item->lead)->id }}"
                                            class="badge badge-pill badge-success">{{ date('h:i A', strtotime(optional($item->lead)->visit_date)) }}</span>
                                    {{-- </td> --}}

                                @elseif (optional($item->lead)->visit_date!=null && $item->response_status != 'Not
                                    Interested')
                                    {{-- <td> --}}

                                        <span style="cursor: pointer" id="visit_date{{ optional($item->lead)->id }}"
                                            onclick="openVisitModal('{{ optional($item->lead)->id }}','{{ strftime('%Y-%m-%dT%H:%M:%S', strtotime(optional($item->lead)->visit_date)) }}')"
                                            data-toggle="modal" data-target="#myModal"
                                            class="badge badge-pill badge-success">{{ date('D, d-m-Y', strtotime(optional($item->lead)->visit_date)) }}</span><br>
                                        <span id="visit_date2{{ optional($item->lead)->id }}"
                                            class="badge badge-pill badge-success">{{ date('h:i A', strtotime(optional($item->lead)->visit_date)) }}</span>
                                    {{-- </td> --}}
                            @endif
                            <span class="badge badge-pill badge-success status{{optional($item->lead)->id}}">@if(optional($item->lead)->response_status==null) New Lead @endif {{ optional($item->lead)->response_status }}</span>


                            </td>
                            <meta name="csrf-token" content="{{ csrf_token() }}" />


                            <td>{{ optional($item->project)->name }}</td>
                            {{-- <td>{{ optional($item->project->user)->name }}</td> --}}
                            {{-- <td>{{ optional($item->project->user)->phone }}</td> --}}
                            <td>{{ optional($item->lead)->name }}</td>
                            <td>
                                @php
                                    $phones = explode('-', optional($item->lead)->phone);
                                @endphp
                                @foreach ($phones as $phone)

                                    <a
                                        href="https://api.whatsapp.com/send?phone={{ $phone }}&&text={{ optional($item->project)->message }} ">{{ $phone }}</a>
                                @endforeach
                            </td>


                            <td>
                                {{-- {{optional($item->lead)->description}} --}}
                                <div class="col-10">
                                    <textarea readonly class="parent" id="desc{{ optional($item->lead)->id }}" cols="40"
                                        rows="5">{{ optional($item->lead)->description }}</textarea>
                                    <svg id="tick{{ optional($item->lead)->id }}" class="checkmark child"
                                        style="display: none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                        <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                                        <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                                    </svg>

                                </div>

                                <div class="flex">
                                    <input id="countClick{{ optional($item->lead)->id }}" type="hidden">
                                    <button id="editdesc{{ optional($item->lead)->id }}" class="btn btn-sm btn-success"
                                        onclick="editDesc('{{ optional($item->lead)->id }}')">Edit</button>
                                    <button disabled id="savedesc{{ optional($item->lead)->id }}"
                                        class="btn btn-sm btn-primary"
                                        onclick="saveDesc('{{ optional($item->lead)->id }}')">Save</button>
                                </div>
                            </td>
                            {{-- <td>{{ optional($item->lead)->family_members }}</td> --}}
                            {{-- <td>{{ optional($item->lead)->budget }}</td> --}}



                            <td>
                                {{-- {{optional($item->lead)->call_status}} --}}
                                <select name="call_status" lead_id={{ optional($item->lead)->id }}
                                    class="form-control call_status" style="width:100%;">
                                    <option value="" disabled>Select</option>
                                    @foreach ($call_status as $item1)

                                        <option @if ($item1->name == optional($item->lead)->call_status) selected @endif value="{{ $item1->name }}">
                                            {{ $item1->name }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                {{-- {{optional($item->lead)->response_status}} --}}
                                <select name="response_status" lead_id={{ optional($item->lead)->id }}
                                    class="form-control response_status" style="width:100%;">
                                    <option value="">Select</option>
                                    @foreach ($response_status as $item1)

                                        <option @if ($item1->name == optional($item->lead)->response_status) selected @endif value="{{ $item1->name }}">
                                            {{ $item1->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td> {{ optional($item->lead)->created_at }}</td>
                            <td> {{ optional($item->lead)->updated_at }}</td>
                            <td>
                                <a href="{{ route('leads.edit', $item->lead_id) }}" class="float-left"><i
                                        class="fas fa-edit"></i></a>
                                <form action="{{ route('leadprojects.destroy', $item->id) }}" method="POST">
                                    @method('delete') @csrf <button class="btn btn-link pt-0"><i
                                            class="fas fa-trash-alt"></i></button> </form>
                            </td>
                            </tr>
                        @empty
                            <p>No Data Found</p>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="align-right paginationstyle">
                        {{ $leadProjects->links() }}
                    </div>
                </div>
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
        $('.filterbtn').on('click', function() {
            $('.filters').toggle(500)
        })

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
                // var res = descval.split("Updated");
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


            // console.log(val)
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

    </script>

@endsection
