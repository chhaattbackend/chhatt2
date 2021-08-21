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
                        <form action="{{ route('leads.update', $lead->id) }}" method="POST" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" value="{{ url()->previous() }}" name="previous_url">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Area one</label>
                                    <div class="col-sm-6">
                                     <select class="form-control" name="area_one_id" id="area_one_id">
                                        <option value="">Select</option>
                                        @foreach ($areaones as $item)
                                        <option @if($lead->area_one_id==$item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Area two</label>
                                    <div class="col-sm-6">
                                     <select  class="form-control" name="area_two_id" id="area_two_id">
                                        <option value="">Select</option>
                                        @foreach ($areatwos as $item)
                                        <option @if($lead->area_two_id==$item->id) selected @endif value="{{$item->id}}">{{$item->name}} - {{$item->area_one->name}}</option>
                                        @endforeach
                                    </select>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-6">
                                        <input required type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter Name" value="{{ $lead->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-6">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter Email" value="{{ $lead->email }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-6">
                                        <input required type="text" class="form-control" id="phone" name="phone"
                                            placeholder="Enter Phone" value="{{ $lead->phone }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" id="description" name="description"
                                            placeholder="Enter Description" name="description"
                                            rows="4">{{ $lead->description }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Budget</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" id="budget" name="budget"
                                            placeholder="Enter budget" value="{{ $lead->budget }}">
                                    </div>
                                </div>

                                {{-- <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="lead_type">
                                            <option disabled selected value="">Select Type</option>
                                            @foreach ($leadtype as $item)
                                                <option @if ($item->lead_type == $lead->type) selected @endif value="{{ $item->name }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">How Soon</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="how_soon">
                                            <option disabled selected value="">Select How Soon</option>
                                            <option @if ($lead->how_soon == '15 Days') selected  @endif value="15 Days" >15 Days</option>
                                            <option @if ($lead->how_soon == '1 Month')selected  @endif value="1 Month">1 Month</option>
                                            <option @if ($lead->how_soon == '2 Month')selected  @endif value="2 Month">2 Months</option>
                                            <option @if ($lead->how_soon == '3 Month')selected  @endif value="3 Month">3 Months</option>
                                            <option @if ($lead->how_soon == '4 Month')selected  @endif value="4 Month">4 Months</option>
                                            <option @if ($lead->how_soon == '5 Month')selected  @endif value="5 Month">5 Months</option>
                                            <option @if ($lead->how_soon == '5 Month+') selected  @endif value="5 Month+">5 Months+</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Family</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="family_members">
                                            <option disabled selected value="">Select Family</option>
                                            <option @if ($lead->family_members == 'Bachelor/Single') selected @endif value="Bachelor/Single">
                                                Bachelor/Single</option>
                                            <option @if ($lead->family_members == 'Family of 2') selected @endif value="Family of 2">Family of 2
                                            </option>
                                            <option @if ($lead->family_members == 'Family of 3') selected @endif value="Family of 3">Family of 3
                                            </option>
                                            <option @if ($lead->family_members == 'Family of 4') selected @endif value="Family of 4">Family of 4
                                            </option>
                                            <option @if ($lead->family_members == 'Family of 5') selected @endif value="Family of 5">Family of 5
                                            </option>
                                            <option @if ($lead->family_members == 'Family of 6') selected @endif value="Family of 6">Family of 6
                                            </option>
                                            <option @if ($lead->family_members == 'Family of 6+') selected @endif value="Family of 6+">Family of 6+
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Lead Source</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="leadsource">
                                            <option disabled selected value="">Select Lead Source</option>
                                            @foreach ($leadsource as $item)
                                                <option @if ($item->name == $lead->leadsource) selected @endif value="{{ $item->name }}">
                                                    {{ $item->name }}</option>
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
                                                <option @if ($item->call_status == $lead->callstatus) selected @endif value="{{ $item->name }}">
                                                    {{ $item->name }}</option>
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
                                                <option @if ($item->name == $lead->response_status) selected @endif value="{{ $item->name }}">
                                                    {{ $item->name }}</option>
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
                                                <option @if ($item->name == $lead->property_type) selected @endif value="{{ $item->name }}">
                                                    {{ $item->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">


                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" class="toggle" name="status" value="0">
                                        <label class="switch">
                                            <input @if ($item->name == 1) checked @endif type="checkbox" name="status" value="1">
                                            <span></span>
                                        </label>
                                    </div>


                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Job Profile</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="name" name="job_profile"
                                            placeholder="Enter Job Profile">
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
