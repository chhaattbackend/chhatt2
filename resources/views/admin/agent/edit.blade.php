@extends('layouts.app')
@section('content')
     <style>
        input[type=checkbox] {
            -webkit-appearance: checkbox !important;
            /* -moz-appearance: none; */
            /* appearance: none; */
            -webkit-tap-highlight-color: transparent;
            cursor: pointer;
        }

        /* .select2-container--default .select2-selection--multiple .select2-selection__choice {
                                                            background-color: #13547a !important;
                                                            border: 1px solid #aaa;
                                                            border-radius: 4px !important;
                                                            box-sizing: border-box !important;
                                                            display: inline-block !important;
                                                            margin-left: 5px !important;
                                                            margin-top: 5px !important;
                                                            padding: 0;
                                                            padding-left: 20px !important;
                                                            position: relative !important;
                                                            max-width: 100% !important;
                                                            overflow: hidden !important;
                                                            text-overflow: ellipsis !important;
                                                            vertical-align: bottom !important;
                                                            white-space: nowrap !important;
                                                        } */

        /* .select2-container--default .select2-selection--multiple .select2-selection__choice {
                                                            background-color: #15599e !important;
                                                            border-color: #006fe6 !important;
                                                            color: #ffffff;
                                                            padding: 0px 10px;
                                                            margin-top: 0.31rem;
                                                        } */

        .select2-selection {
            height: auto !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #196591 !important;
            border: 1px solid #aaa !important;
            border-radius: 16px !important;
            box-sizing: border-box !important;
            display: inline-block !important;
            margin-left: 5px !important;
            margin-top: 7px !important;
            padding: 0px !important;
            padding-left: 25px !important;
            position: relative !important;
            max-width: 100% !important;
            text-overflow: ellipsis !important;
            vertical-align: bottom !important;
            white-space: nowrap !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            background-color: transparent !important;
            border: none !important;
            border-right: 1px solid var(--white) !important;
            border-top-left-radius: 4px !important;
            border-bottom-left-radius: 4px !important;
            color: var(--white) !important;
            cursor: pointer !important;
            font-size: 1em;
            font-weight: bold;
            padding: 0 4px;
            position: absolute;
            left: 0;
            top: 0;
        }

    </style>
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <!-- /.card -->
                <!-- Form Element sizes -->
                <!-- /.card -->
                <!-- /.card -->
                <!-- Input addon -->
                <!-- /.card -->
                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit Realtor</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="col-md-8">
                        <form action="{{ route('agents.update', $agent->id) }}" method="POST" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">User ID</label>
                                    <div class="col-sm-6">
                                        <select required class="form-control" name="user_id" id="user_id">
                                            @foreach ($user as $item)
                                                <option @if ($item->id == $agent->user_id) selected @endif value="{{ $item->id }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Agency </label>
                                    <div class="col-sm-6">
                                        <select required class="form-control" name="agency_id" id="agency_id">
                                            @foreach ($agency as $item)
                                                <option @if ($item->id == $agent->agency_id) selected @endif value="{{ $item->id }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Speciality</label>
                                    <div class="col-sm-6">

                                        @foreach ($speciality as $item)
                                        @php
                                            $checked = false;
                                        @endphp
                                            @foreach ($agent->specialities as $i)
                                                @if ($item->id == $i->speciality_id)
                                                    @php
                                                        $checked = true;
                                                    @endphp
                                                @endif

                                            @endforeach
                                            <div class="col-sm-6">
                                                <input @if ($checked) checked @endif type="checkbox" value="{{ $item->id }}"
                                                    name="speciality[]">
                                                <label style="padding-right: 10px" for="">{{ $item->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                                {{-- @dd($agent->workingAreas) --}}


                                <div class="form-group row">
                                    {{-- @dd($agent->workingAreas->area_one_id) --}}
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Area</label>
                                    <div class="col-sm-6">
                                        <select multiple required class="form-control" name="areas[]" size=6>
                                            @foreach ($areas as $item)
                                                @php
                                                    $selected = false;
                                                @endphp
                                                @foreach ($agent->workingAreas as $i)
                                                    @if ($item->id == $i->area_one_id)
                                                        @php
                                                            $selected = true;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <option @if ($selected) selected @endif value="{{ $item->id }}">{{ $item->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                </div>




                                {{-- <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="inputPassword3"
                                            placeholder="Password">
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        {{-- <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                            <label class="form-check-label" for="exampleCheck2">Remember me</label>
                                        </div> --}}
                                        <button type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            {{-- <div class="card-footer">
                                <button type="submit" class="btn btn-default float-right">Cancel</button>
                            </div>
                            <!-- /.card-footer --> --}}
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div>
@endsection
