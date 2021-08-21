@extends('layouts.app')
@section('content')

    <style>
        .inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .inputfile+label {
            max-width: 80%;
            font-size: 1.25rem;
            /* 20px */
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            display: inline-block;
            overflow: hidden;
            padding: 0.625rem 1.25rem;
            /* 10px 20px */
        }

         /* .inputfile+label {
            display: none;
        } */

        .inputfile:focus+label,
        .inputfile.has-focus+label {
            outline: 1px dotted #000;
            outline: -webkit-focus-ring-color auto 5px;
        }

        .inputfile+label * {
            /* pointer-events: none; */
            /* in case of FastClick lib use */
        }

        .inputfile+label svg {
            width: 1em;
            height: 1em;
            vertical-align: middle;
            fill: currentColor;
            margin-top: -0.25em;
            /* 4px */
            margin-right: 0.25em;
            /* 4px */
        }


        /* style 1 */

        .inputfile-1+label {
            color: #f1e5e6;
            background-color: #041f7783;
        }

        .inputfile-1:focus+label,
        .inputfile-1.has-focus+label,
        .inputfile-1+label:hover {
            background-color: #722040;
        }

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
                        <h3 class="card-title ">Add Property</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="col-md-8">
                        <form action="{{ route('properties.store') }}" method="POST" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Inventory Type</label>
                                    <div class="col-sm-6">
                                        <select  class="form-control" name="inventory_type">
                                            <option disabled selected value="">Select Type</option>

                                            <option value="requirement">Requirement</option>
                                            <option value="inventory">Inventory</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">User</label>
                                    <div class="col-sm-6">
                                        <select  class="form-control" name="user_id">
                                            <option disabled selected value="">Select User</option>
                                            @foreach ($users as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->phone }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">User ID</label>
                                    <div class="col-sm-6">
                                        <select  class="form-control" name="user_id">
                                            <option disabled selected value="">Select User ID</option>
                                            <option value="1">1</option>
                                        </select>
                                    </div>
                                </div> --}}


                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Area</label>
                                    <div class="col-sm-6">
                                        <select  class="form-control" name="area_one_id" id="area_one_id">
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
                                        <select  class="form-control" name="area_two_id" id="area_two_id">
                                            <option disabled selected value="">Select Sub-Area</option>
                                            @foreach ($area_two as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Sub-Sub-Area</label>
                                    <div class="col-sm-6">
                                        <select  class="form-control" name="area_three_id" id="area_three_id">
                                            <option disabled selected value="">Select Sub-Area</option>
                                            @foreach ($area_three as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-6">
                                        <input  type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter Name">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-6">
                                        <textarea  class="form-control" id="address" name="address"
                                            placeholder="Enter Address" rows="4"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-6">
                                        <input  type="number" class="form-control" id="name" name="price"
                                            placeholder="Enter Price">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Size</label>
                                    <div class="col-sm-6">
                                        <input  type="number" class="form-control" id="name" name="size"
                                            placeholder="Enter Size">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Longitude</label>
                                    <div class="col-sm-6">
                                        <input  type="number" class="form-control" id="longitude" name="longitude"
                                            placeholder="Enter Longitude" step="any">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Latitude</label>
                                    <div class="col-sm-6">
                                        <input  type="number" class="form-control" id="latitude" name="latitude"
                                            placeholder="Enter Latitude" step="any">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-6">
                                        <select  class="form-control" name="type">
                                            <option disabled selected value="">Select Type</option>

                                            <option value="Residential">Residential</option>
                                            <option value="Commercial">Commercial</option>
                                            <option value="Industrial">Industrial</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">For</label>
                                    <div class="col-sm-6">
                                        <select  class="form-control" name="property_for">
                                            <option disabled selected value="">Select Type</option>
                                            @foreach ($propertyfor as $item)


                                            <option value="{{$item->name}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Size Type</label>
                                    <div class="col-sm-6">
                                        <select  class="form-control" name="size_type">
                                            <option disabled selected value="">Select Size Type</option>

                                            <option value="Sq.ft">Sq.ft</option>
                                            <option value="Yards">Yards</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Property Type</label>
                                    <div class="col-sm-6">
                                        <select  class="form-control" name="property_type">
                                            <option disabled selected value="">Select Type</option>
                                            @foreach ($propertytype as $item)


                                            <option value="{{$item->name}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Property Social Type</label>
                                    <div class="col-sm-6">
                                        <select  class="form-control" name="social_type_id" id="social_type_id">
                                            <option disabled selected value="">Select Type</option>
                                            @foreach ($propertySocialTypes as $propertySocialType)


                                            <option value="{{$propertySocialType->id}}">{{$propertySocialType->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Property Social Group</label>
                                    <div class="col-sm-6">
                                        <select  class="form-control" name="group_id" id="group_id">
                                            <option disabled selected value="">Select Group</option>
                                            @foreach ($propertySocialGroups as $propertySocialGroup)


                                            <option value="{{$propertySocialGroup->id}}">{{$propertySocialGroup->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">No. Bed</label>
                                    <div class="col-sm-6">
                                        <input  type="number" class="form-control" id="name" name="bed"
                                            placeholder="Enter Bed">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">No. Bath</label>
                                    <div class="col-sm-6">
                                        <input  type="number" class="form-control" id="name" name="bath"
                                            placeholder="Enter Bath">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-6">
                                        <textarea  class="form-control" id="description" name="description"
                                            placeholder="Enter Address" rows="4"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Priority</label>
                                    <div class="col-sm-6">
                                        <select  class="form-control" name="priority">
                                            <option disabled selected value="">Select Priority</option>

                                            <option style="color: red" value="1">Super Hot</option>
                                            <option style="color: #ae1111" value="2">Hot</option>
                                            <option style="color: lightseagreen" value="3">Normal</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Advertised</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" class="toggle" name="advertised" value="0">
                                        <label class="switch">
                                            <input type="checkbox" name="advertised" value="1">
                                            <span></span>
                                        </label>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">formatted</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" class="toggle" name="formatted" value="0">
                                        <label class="switch">
                                            <input type="checkbox" name="formatted" value="1">
                                            <span></span>
                                        </label>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Structured</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" class="toggle" name="structured" value="0">
                                        <label class="switch">
                                            <input type="checkbox" name="structured" value="1">
                                            <span></span>
                                        </label>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" class="toggle" name="status" value="0">
                                        <label class="switch">
                                            <input type="checkbox" name="status" value="1">
                                            <span></span>
                                        </label>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Bluk</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" class="toggle" name="bluk" value="0">
                                        <label class="switch">
                                            <input type="checkbox" name="bluk" value="1">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-6">
                                        {{-- <input type="file" name="images[]" class="form-control" multiple><br> --}}
                                        <div class="box">
                                            <input type="file" name="images[]" id="file-1" class="inputfile inputfile-1"
                                                data-multiple-caption="{count} files selected" multiple="">
                                            <label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="17" viewBox="0 0 20 17">
                                                    <path
                                                        d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z">
                                                    </path>
                                                </svg> <span>Choose a file…</span></label>
                                        </div>

                                    </div>
                                </div>




                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        {{-- <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                            <label class="form-check-label" for="exampleCheck2">Remember me</label>
                                        </div> --}}
                                        <button
                                            type="submit"
                                            class="btn btn-info col-sm-7 rounded-bill rounded-pill">Submit</button>
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
