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
                        <h3 class="card-title">Edit Images</h3>
                    </div>

                    <div class="col-md-8">
                        <form action="{{ route('propertyimages.update', $property->id) }}" method="POST"
                            class="form-horizontal" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">User</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="images[]" class="form-control" multiple><br>
                                        <button
                                            type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                </div>
                                <input type="hidden" name="property_id" value="{{ $property->id }}">

                                <div class="card-body table-responsive p-0">
                                    {{-- <form action="{{route()}}"></form> --}}
                                    <table class="table table-hover text-nowrap">
                                        <thead class="thb">
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Sort</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($property->images as $key => $item)
                                                <tr>
                                                    <td>
                                                        {{++$key}}
                                                    </td>
                                                    <td  >
                                                        <img class="form-img"
                                                            src="https://chhatt.s3.ap-south-1.amazonaws.com/properties/{{ $item->name }}">





                                                    </td>
                                                    <td><input type="text" value="{{$item->sort_order}}"></td>
                                                    <td>
                                                        <a href="{{ route('propertyimages.delete', $item->id) }}"
                                                            class="float-left"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="align-right paginationstyle">
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
