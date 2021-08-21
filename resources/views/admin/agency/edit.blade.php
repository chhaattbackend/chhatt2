@extends('layouts.app')
@section('content')
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
                        <form action="{{ route('agencies.update', $agency->id) }}" method="POST" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">User</label>
                                    <div class="col-sm-6">
                                        <select required class="form-control" name="user_id" id="user_id">
                                            @foreach ($users as $item)
                                            <option @if ($item->id == $agency->user_id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Area One </label>
                                    <div class="col-sm-6">
                                        <select required class="form-control" name="area_one_id" id="area_one_id">
                                            @foreach ($area_one as $item)
                                            <option @if ($item->id == $agency->area_one_id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="">{{$agency->major_area}}</label>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Area Two </label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="area_two_id" id="area_two_id">
                                            <option value="">Select</option>
                                            @foreach ($area_two as $item)
                                            <option @if ($item->id == $agency->area_two_id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="">{{$agency->minor_area}}</label>

                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Area Three </label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="area_three_id" id="area_three_id">
                                            <option value="">Select</option>
                                            @foreach ($area_three as $item)
                                                <option @if ($item->id == $agency->area_three_id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-6">
                                        <input required type="text" class="form-control" value="{{ $agency->name }}"
                                            id="name" name="name" placeholder="Enter Name">
                                    </div>

                                </div>

                                <div class="form-group row">


                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" class="toggle" name="status" value="0">
                                        <label class="switch">
                                            <input @if ($agency->status == 1)
                                            checked
                                            @endif type="checkbox" name="status" value="1">
                                            <span></span>
                                        </label>
                                    </div>

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Verified</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" class="toggle" name="verified" value="0">
                                        <label class="switch">
                                            <input @if ($agency->verified == 1)
                                            checked
                                            @endif type="checkbox" name="verified" value="1">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-6">
                                        <input type='file' name="image" onchange="readURL(this);" />
                                        <img id="blah" class="form-img"  src="{{$agency->image}}" />
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
