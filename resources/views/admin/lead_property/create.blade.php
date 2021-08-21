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
                        <h3 class="card-title">Edit Properties</h3>
                    </div>

                    <div class="col-md-8">
                        <form action="{{ route('leadproperties.store') }}" method="POST" class="form-horizontal"
                            enctype="multipart/form-data">
                            {{-- @method('PUT') --}}
                            @csrf
                            <div class="card-body">
                                {{-- <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Lead ID</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="lead_id">
                                            <option disabled selected value="">Select ID</option>
                                            @foreach ($leads as $item)
                                                <option @if ($leadProperty->lead_id == $item->id) selected @endif value="{{ $item->id }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                {{-- <input type="hidden" value="{{$lead_id}}" name="lead_id"> --}}

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Properties</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="property_id">
                                            <option disabled selected value="">Select Property </option>
                                            @foreach ($properties as $item)
                                                <option value="{{$item->id}}">{{$item->id}} - {{optional($item->areaOne)->name}} - {{optional($item->areaTwo)->name}} - {{$item->category}} - {{$item->size}} {{$item->size_type}} - {{$item->bed}} bed - {{$item->bath}} bath</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">User ID</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="user_id">
                                            <option disabled selected value="">Select User ID</option>
                                            <option @if ($leadProperty->user_id == 1) selected @endif value="1">1</option>
                                        </select>
                                    </div>
                                </div> --}}

                                {{-- <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Call Status</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="call_status">
                                            <option disabled selected value="">Select Call Status</option>
                                            <option @if ($leadProperty->call_status == 'sdsd') selected @endif  value="sdsd">sdsd</option>
                                        </select>
                                    </div>
                                </div> --}}



                                {{-- <div class="form-group row">


                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Lead Status</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" class="toggle" name="lead_status" value="0">
                                        <label class="switch">
                                            <input type="checkbox" name="lead_status" value="1" @if ($leadProperty->lead_status == 1) checked @endif >
                                            <span></span>
                                        </label>
                                    </div>

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Call Status</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" class="toggle" name="call_status" value="0">
                                        <label class="switch">
                                            <input type="checkbox" name="lead_status" value="1">
                                            <span></span>
                                        </label>
                                    </div>

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Chat Status</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" class="toggle" name="chat_status" value="0">
                                        <label class="switch">
                                            <input type="checkbox" name="chat_status" value="1" @if ($leadProperty->chat_status == 1) checked @endif>
                                            <span></span>
                                        </label>
                                    </div>
                                </div> --}}




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
                                        <button  type="submit" class="btn btn-info col-sm-7 rounded-bill rounded-pill">Submit</button>
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
@endsection
