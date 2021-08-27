@extends('layouts.app')
@section('content')

    <style>
        .switch {
            cursor: pointer;
        }

        .switch input {
            display: none;
        }

        .switch input+span {
            width: 48px;
            height: 28px;
            border-radius: 14px;
            transition: all 0.3s ease;
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
            top: 5px;
            left: 5px;
            width: 18px;
            height: 18px;
            border-radius: 9px;
            border: 5px solid #fff;
        }

        .switch input+span:after {
            top: 5px;
            left: 32px;
            width: 6px;
            height: 18px;
            border-radius: 40%;
            transform-origin: 50% 50%;
            background: #fff;
            opacity: 0;
        }

        .switch input+span:active {
            transform: scale(0.92);
        }

        .switch input:checked+span {
            background: #48EA8B;
            box-shadow: 0 8px 16px -1px rgba(72, 234, 139, 0.2);
        }

        .switch input:checked+span:before {
            width: 0px;
            border-radius: 3px;
            margin-left: 27px;
            border-width: 3px;
            background: #fff;
        }

        .switch input:checked+span:after {
            -webkit-animation: blobChecked 0.35s linear forwards 0.2s;
            animation: blobChecked 0.35s linear forwards 0.2s;
        }

        .switch input:not(:checked)+span:before {
            -webkit-animation: blob 0.85s linear forwards 0.2s;
            animation: blob 0.85s linear forwards 0.2s;
        }

    </style>


    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit Property</h3>
                    </div>

                    <div class="col-md-8">
                        <form action="{{ route('properties.update', $property->id) }}" method="POST"
                            class="form-horizontal" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <input type="hidden" name ="link" value="{{$link}}">

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Inventory Type</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="inventory_type">
                                            <option disabled selected value="">Select Type</option>

                                            <option @if ($property->inventory_type == 'requirement') selected @endif value="requirement">Requirement
                                            </option>
                                            <option @if ($property->inventory_type == 'inventory') selected @endif value="inventory">Inventory
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">User</label>
                                    <div class="col-sm-6">
                                        <select required class="form-control" name="user_id">
                                            <option disabled selected value="">Select User</option>
                                            @foreach ($users as $item)
                                                <option @if ($property->user_id == $item->id) selected @endif value="{{ $item->id }}">
                                                    {{ $item->name }} - {{ $item->phone }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">User ID</label>
                                    <div class="col-sm-6">
                                        <select required class="form-control" name="user_id">
                                            <option disabled selected value="">Select User ID</option>
                                            <option @if ($property->user_id == 1) selected @endif value="1">1</option>
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-6">
                                        <select id="city" required class="form-control">
                                            <option disabled selected value="">Select Parent</option>
                                            @foreach ($city as $item)
                                                <option @if (optional(optional($property->areaOne)->city)->id == $item->id) selected @endif value="{{ $item->id }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Area</label>
                                    <div class="col-sm-6">
                                        <select id="area_one_id" required class="form-control" name="area_one_id">
                                            <option disabled selected value="">Select Area</option>
                                            @foreach ($area_one as $item)
                                                <option @if ($property->area_one_id == $item->id) selected @endif value="{{ $item->id }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Sub-Area</label>
                                    <div class="col-sm-6">
                                        <select id="area_two_id" class="form-control" name="area_two_id">
                                            <option disabled selected value="">Select Sub-Area</option>
                                            @foreach ($area_two as $item)
                                                <option @if ($property->area_two_id == $item->id) selected @endif value="{{ $item->id }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Sub-Sub-Area</label>
                                    <div class="col-sm-6">
                                        <select id="area_three_id" class="form-control" name="area_three_id">
                                            <option disabled selected value="">Select Sub-Area</option>
                                            @foreach ($area_three as $item)
                                                <option @if ($property->area_three_id == $item->id) selected @endif value="{{ $item->id }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                {{-- <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter Name" value="{{ $property->name }}">
                                    </div>
                                </div> --}}


                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" id="address" name="address"
                                            placeholder="Enter Address" rows="4">{{ $property->address }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" id="name" name="price"
                                            placeholder="Enter Price" value="{{ $property->price }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Size</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" id="name" name="size"
                                            placeholder="Enter Size" value="{{ $property->size }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="type">
                                            <option disabled selected value="">Select Type</option>

                                            <option @if ($property->type == 'Residential') selected @endif value="Residential">Residential
                                            </option>
                                            <option @if ($property->type == 'Commercial') selected @endif value="Commercial">Commercial
                                            </option>
                                            <option @if ($property->type == 'Industrial') selected @endif value="Industrial">Industrial
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Property Type</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="property_type">
                                            <option disabled selected value="">Select Type</option>
                                            @foreach ($propertytype as $item)
                                                <option @if ($property->property_type == $item->name) selected @endif value="{{ $item->name }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Property Social Type</label>
                                    <div class="col-sm-6">
                                        <select  class="form-control" name="social_type_id" id="social_type_id">
                                            <option disabled selected value="">Select Type</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Property Social Group</label>
                                    <div class="col-sm-6">
                                        <select  class="form-control" name="group_id" id="group_id">
                                            <option disabled selected value="">Select Group</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">For</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="property_for">
                                            @foreach ($propertyfor as $item)
                                                <option @if ($item->name == $property->property_for) selected @endif value="{{ $item->name }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Size Type</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="size_type">
                                            <option disabled selected value="">Select Size Type</option>

                                            <option @if ($property->size_type == 'Sq.ft') selected @endif value="Sq.ft">Sq.ft</option>
                                            <option @if ($property->size_type == 'Yards') selected @endif value="Yards">Yards</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">No. Bed</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" id="name" name="bed"
                                            placeholder="Enter Bed" value="{{ $property->bed }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">No. Bath</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" id="name" name="bath"
                                            placeholder="Enter Bath" value="{{ $property->bath }}">
                                    </div>
                                </div>




                               <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Longitude</label>
                                    <div class="col-sm-6">
                                        <input  type="text" class="form-control" id="longitude" name="longitude" value="{{ $property->longitude }}"
                                            placeholder="Enter Longitude">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Latitude</label>
                                    <div class="col-sm-6">
                                        <input  type="text" class="form-control" id="latitude" name="latitude" value="{{ $property->latitude }}"
                                            placeholder="Enter Latitude">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" id="address" name="description"
                                            placeholder="Enter Address" rows="4">{{ $property->description }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Priority</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="priority">
                                            <option disabled selected value="">Select Priority</option>

                                            <option @if ($property->priority == 1) selected @endif style="color: red" value="1">Super
                                                Hot</option>
                                            <option @if ($property->priority == 2) selected @endif style="color: #ae1111" value="2">Hot
                                            </option>
                                            <option @if ($property->priority == 3) selected @endif style="color: lightseagreen"
                                                value="3">Normal</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Advertised Status</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" class="toggle" name="advertised" value="0">
                                        <label class="switch">
                                            <input @if ($property->advertised == '1') checked @endif type="checkbox" name="advertised"
                                                value="1">
                                            <span></span>
                                        </label>
                                    </div>

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Formatted Property</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" class="toggle" name="formatted" value="0">
                                        <label class="switch">
                                            <input @if ($property->formatted == '1') checked @endif type="checkbox" name="formatted"
                                                value="1">
                                            <span></span>
                                        </label>
                                    </div>

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Bluk Property</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" class="toggle" name="bluk" value="0">
                                        <label class="switch">
                                            <input @if ($property->bluk == '1') checked @endif type="checkbox" name="bluk"
                                                value="1">
                                            <span></span>
                                        </label>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" class="toggle" name="status" value="0">
                                        <label class="switch">
                                            <input @if ($property->status == '1') checked @endif type="checkbox" name="status"
                                                value="1">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>




                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        {{-- <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                            <label class="form-check-label" for="exampleCheck2">Remember me</label>
                                        </div> --}}
                                        <button type="submit" class="btn btn-info col-sm-7">Submit</button>
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

            </div>


        </div>

    </div>

    <script>
        $('#city').change(function() {
            // alert('h')
            var id = $(this).val();
            var name1 = $("#city option:selected").text();

            $('#area_one_id').find('option').not(':first').remove();
            $.ajax({
                url: '/parent/' + id,
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

                            var option = "<option value='" + id + "'>" + name + '-' + name1 +
                                "</option>";

                            $("#area_one_id").append(option);
                        }
                    }
                    $("#area_two_id").html(
                        '<option disabled selected value="">Select Sub-Area</option>');
                    $("#area_three_id").html(
                        '<option disabled selected value="">Select Sub-Sub-Area</option>');
                }
            })
        });

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

                            var option = "<option value='" + id + "'>" + name + '-' + name1 +
                                "</option>";

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

    </script>
@endsection
