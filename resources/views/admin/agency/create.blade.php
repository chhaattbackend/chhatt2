@extends('layouts.app')
@section('content')

    <style>
        .cmn-toggle {
            position: absolute;
            margin-left: -9999px;
            visibility: hidden;
        }

        .cmn-toggle+label {
            display: block;
            position: relative;
            cursor: pointer;
            outline: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        input.cmn-toggle-round-flat+label {
            padding: 2px;
            width: 75px;
            height: 30px;
            background-color: #fc4e4e;
            -webkit-border-radius: 60px;
            -moz-border-radius: 60px;
            -ms-border-radius: 60px;
            -o-border-radius: 60px;
            border-radius: 60px;
            -webkit-transition: background 0.4s;
            -moz-transition: background 0.4s;
            -o-transition: background 0.4s;
            transition: background 0.4s;
        }

        input.cmn-toggle-round-flat+label:before,
        input.cmn-toggle-round-flat+label:after {
            display: block;
            position: absolute;
            content: "";
        }

        input.cmn-toggle-round-flat+label:before {
            top: 2px;
            left: 2px;
            bottom: 2px;
            right: 2px;
            background-color: #fff;
            -webkit-border-radius: 60px;
            -moz-border-radius: 60px;
            -ms-border-radius: 60px;
            -o-border-radius: 60px;
            border-radius: 60px;
            -webkit-transition: background 0.4s;
            -moz-transition: background 0.4s;
            -o-transition: background 0.4s;
            transition: background 0.4s;
        }

        input.cmn-toggle-round-flat+label:after {
            top: 4px;
            left: 4px;
            bottom: 4px;
            width: 22px;
            background-color: #fc4e4e;
            -webkit-border-radius: 52px;
            -moz-border-radius: 52px;
            -ms-border-radius: 52px;
            -o-border-radius: 52px;
            border-radius: 52px;
            -webkit-transition: margin 0.4s, background 0.4s;
            -moz-transition: margin 0.4s, background 0.4s;
            -o-transition: margin 0.4s, background 0.4s;
            transition: margin 0.4s, background 0.4s;
        }

        input.cmn-toggle-round-flat:checked+label {
            background-color: #55fa87;
        }

        input.cmn-toggle-round-flat:checked+label:after {
            margin-left: 45px;
            background-color: #55fa87;
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
                        <h3 class="card-title">Add Agency</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="col-md-8">
                        <form action="{{ route('agencies.store') }}" method="POST" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">User</label>
                                    <div class="col-sm-6">
                                        <select required class="form-control" name="user_id" id="user_id">
                                            <option disabled selected value="">Select User</option>
                                            @foreach ($users as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }} {{ $item->phone }} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Area</label>
                                    <div class="col-sm-6">
                                        <select required class="form-control" name="area_one_id" id="area_one_id">
                                            <option disabled selected value="">Select Area</option>
                                            @foreach ($area_one as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Sub-Area</label>
                                    <div class="col-sm-6">
                                        <select required class="form-control" name="area_two_id" id="area_two_id">
                                            <option disabled selected value="">Select Sub-Area</option>
                                            {{-- @foreach ($area_two as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Sub-Sub-Area</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="area_three_id" id="area_three_id">
                                            <option disabled selected value="">Select Sub-Sub-Area</option>
                                            {{-- @foreach ($area_three as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Agency Name</label>
                                    <div class="col-sm-6">
                                        <input required type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter Name">
                                    </div>

                                </div>




                                <div class="form-group row">


                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" class="toggle" name="status" value="0">
                                        <label class="switch">
                                            <input type="checkbox" name="status" value="1">
                                            <span></span>
                                        </label>
                                    </div>

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Verified</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" class="toggle" name="verified" value="0">
                                        <label class="switch">
                                            <input type="checkbox" name="verified" value="1">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-6">
                                        <input type='file' name="image" onchange="readURL(this);" />
                                        <img id="blah" src="#" />
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
                                        <button type="submit" class="btn btn-info rounded-bill rounded-pill">Submit</button>
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
    <script>
        $('#area_one_id').change(function() {

            var id = $(this).val();

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

                            var option = "<option value='" + id + "'>" + name + "</option>";

                            $("#area_two_id").append(option);
                        }
                    }
                    $("#area_three_id").html('<option disabled selected value="">Select Sub-Sub-Area</option>');
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

    </script>
@endsection
