@extends('layouts.app')
@section('content')

    <style>
        input[type=checkbox] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            -webkit-tap-highlight-color: transparent;
            cursor: pointer;
        }

        input[type=checkbox]:focus {
            outline: 0;
        }

        .toggle {
            height: 32px;
            width: 52px;
            border-radius: 16px;
            display: inline-block;
            position: relative;
            margin: 0;
            border: 2px solid #474755;
            background: linear-gradient(180deg, #2D2F39 0%, #1F2027 100%);
            transition: all 0.2s ease;
        }

        .toggle:after {
            content: "";
            position: absolute;
            top: 2px;
            left: 2px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: white;
            box-shadow: 0 1px 2px rgba(44, 44, 44, 0.2);
            transition: all 0.2s cubic-bezier(0.5, 0.1, 0.75, 1.35);
        }

        .toggle:checked {
            background: linear-gradient(180deg, #0ba503 0%, #1F2027 100%);
        }

        .toggle:checked:after {
            transform: translatex(20px);
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
                        <h3 class="card-title">Add Lead</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="col-md-8">
                        <form action="{{ route('leads.storeproject') }}" method="POST" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Project ID</label>
                                    <div class="col-sm-6">
                                        <select required class="form-control" name="project_id">
                                            <option disabled selected value="">Select ID</option>

                                            @foreach ($projects as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-6">
                                        <input required type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-6">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-6">
                                        <input required type="number" class="form-control" id="phone" name="phone"
                                            placeholder="Enter Phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" id="description" name="description"
                                            placeholder="Enter Description" name="description" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Budget</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" id="budget" name="budget"
                                            placeholder="Enter budget">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="lead_type">
                                            <option disabled selected value="">Select Type</option>
                                            @foreach ($leadtype as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">How Soon</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="how_soon">
                                            <option disabled selected value="">Select How Soon</option>
                                            <option>15 Days</option>
                                            <option>1 Month</option>
                                            <option>2 Months</option>
                                            <option>3 Months</option>
                                            <option>4 Months</option>
                                            <option>5 Months</option>
                                            <option>5 Months+</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Family</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="family_members">
                                            <option disabled selected value="">Select Family</option>
                                            <option value="Bachelor/Single">Bachelor/Single</option>
                                            <option value="Family of 2">Family of 2</option>
                                            <option value="Family of 3">Family of 3</option>
                                            <option value="Family of 4">Family of 4</option>
                                            <option value="Family of 5">Family of 5</option>
                                            <option value="Family of 6">Family of 6</option>
                                            <option value="Family of 6+">Family of 6+</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Lead Source</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="leadsource">
                                            <option disabled selected value="">Select Lead Source</option>
                                            @foreach ($leadsource as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Call Status</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="call_status">
                                            <option disabled selected value="">Select Call Status</option>
                                            @foreach ($callstatus as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Response Status</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="response_status">
                                            <option disabled selected value="">Select Response Status</option>
                                            @foreach ($responsestatus as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Property Type</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="property_type">
                                            <option disabled selected value="">Select Property Type</option>
                                            @foreach ($propertytype as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Job Profile</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="name" name="job_profile"
                                            placeholder="Enter Job Profile">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-2">
                                        {{-- <input name='status' type="checkbox" data-toggle="toggle" data-on="1" data-off="0"> --}}
                                        <input type="hidden" class="toggle" name="status" value="0">
                                        <input type="checkbox" class="toggle" name="status" value="1">
                                    </div>

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Lead Status</label>
                                    <div class="col-sm-2">
                                        {{-- <input name='status' type="checkbox" data-toggle="toggle" data-on="1" data-off="0"> --}}
                                        <input type="hidden" class="toggle" name="lead_status" value="0">
                                        <input type="checkbox" class="toggle" name="lead_status" value="1">
                                    </div>

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Chat Status</label>
                                    <div class="col-sm-2">
                                        {{-- <input name='status' type="checkbox" data-toggle="toggle" data-on="1" data-off="0"> --}}
                                        <input type="hidden" class="toggle" name="chat_status" value="0">
                                        <input type="checkbox" class="toggle" name="chat_status" value="1">
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
                                        <button type="submit"
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
