@extends('layouts.app')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="heading col-sm-6">
                    <h1>Properties</h1>
                </div>
                <div class=" offset-sm-4  col-sm-2">
                    <h1 class="float-sm-right"><span
                            style="background-image: linear-gradient(121deg, #13547a 1%, #80d0c7 250%);color: white"
                            class="badge badge-pill">{{ $properties->total() }}</span></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
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

    </style>
    <div class="container-fluid">
        <button class="btn1 info filterbtn">Filter</button>
        <div class="row">
            <div class="filtersdiv">

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
                    <form action="{{ route('properties.filter') }}" >
                        @csrf
                        <div class="col-md-12">


                            <div class="float-left mx-3 my-3">
                                <label>Property Type:</label><br>
                                <select style ="width : 140%" class="form-control filter-control filter-select" name="type">
                                    <option @if (request()->get('type') == null) selected @endif value="">Select
                                    </option>
                                    <option @if (request()->get('type') == 'Residential') selected @endif value="Residential">Residential</option>
                                    <option @if (request()->get('type') == 'Commercial') selected @endif value="Commercial">Commercial</option>
                                    <option @if (request()->get('type') == 'Industrial') selected @endif value="Industrial">Industrial</option>


                                </select>
                            </div>
                            <div class="float-left mx-5 my-3">
                                <label>Property Description:</label><br>
                                <select style ="width : 130%" class="form-control filter-control filter-select" name="description">
                                    <option @if (request()->get('description') == null) selected @endif value="">Select
                                    </option>
                                    <option @if (request()->get('description') == 'For Sale') selected @endif value="For Sale">For Sale</option>
                                    <option @if (request()->get('description') == 'For Rent') selected @endif value="For Rent">For Rent</option>
                                    <option @if (request()->get('description') == 'For Buy') selected @endif value="For Buy">For Buy</option>
                                    <option @if (request()->get('description') == 'For Booking') selected @endif value="For Booking">For Booking</option>

                                </select>
                            </div>

                            <div class="float-left mx-3 my-3">
                                <label>Major Area:</label><br>
                                <select style ="width : 140%" class="form-control filter-control filter-select" name="area_one_id">
                                    <option @if (request()->get('area_one_id') == null) selected @endif value="">Select
                                    </option>
                                    @foreach ($area_one as $item)


                                        <option @if (request()->get('area_one_id') == $item->id) selected @endif value="{{ $item->id }}">
                                            {{ $item->name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="float-left mx-4 my-3">
                                <label>Minor Area:</label><br>
                                <select style ="width : 140%" class="form-control filter-control filter-select" name="area_two_id">
                                    <option @if (request()->get('area_two_id') == null) selected @endif value="">Select
                                    </option>
                                    @foreach ($area_two as $item)


                                        <option @if (request()->get('area_two_id') == $item->id) selected @endif value="{{ $item->id }}">
                                            {{ $item->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="float-left mx-3 my-3">
                                <label> Structured:</label><br>
                                <select style="width: 129%"  class="form-control filter-control filter-select" name="structured">
                                    <option @if (request()->get('structured') == null) selected @endif value="">Select
                                    </option>
                                    <option @if (request()->get('structured') == '1') selected @endif value="1">Active</option>
                                    <option @if (request()->get('structured') == '0') selected @endif value="0">Non Active</option>

                                </select>
                            </div>

                            <div class="float-left mx-3 my-3">
                                <label> Inventory:</label><br>
                                <select style="width: 129%"  class="form-control filter-control filter-select" name="inventory_type">
                                    <option @if (request()->get('structured') == null) selected @endif value="">Select
                                    </option>
                                    <option @if (request()->get('structured') == '1') selected @endif value="requirement">Requirement</option>
                                    <option @if (request()->get('structured') == '0') selected @endif value="inventory">Inventory</option>

                                </select>
                            </div>

                        </div>


                        <div class="col-md-0 mx-3 my-3">
                            <button class="btn btn-primary">Submit</button>
                            <a href="{{ route('properties.index') }}"><button type="button"
                                    class="btn btn-danger">Cancel</button></a>

                        </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-12">
            <div class="card searcharea">
                <div class="align-right">
                </div>
                <div class="card-header" style="padding-left:1% ">
                    {{-- <h3 class="card-title"><button style="padding: 3px" type="button" class="btn btn-primary">
                              <a style="color: white" href="{{ route('properties.by_parent') }}">
                                By Parent
                            </a>
                            </button>
                        </h3> --}}

                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <form action="{{ route('properties.index') }}" style="display: flex;">
                                <input type="text" name="keyword" id="keyword" class="form-control check"
                                    placeholder="Search" style="height:93%; width:40%; margin-left:auto;">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default mr-2  "><i
                                            class="fas fa-search"></i></button>
                            </form>

                            <a href="{{ route('properties.create') }}"><button type="button" class="btn btn-primary">Add
                                    Property</button></a>
                        </div>
                    </div>
                </div>


            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap  thb">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Inventory</th>
                            <th>User</th>
                            <th>Agency</th>
                            <th>Area</th>
                            <th>Sub-Area</th>
                            {{-- <th>Name</th> --}}
                            <th>Address</th>
                            <th>Price</th>
                            <th>Size</th>
                            {{-- <th>Size Type</th> --}}
                            <th>Area Type</th>
                            <th>Property Type</th>
                            <th>Bed</th>
                            <th>Bath</th>
                            <th>images</th>
                            {{-- <th>Description</th> --}}
                            <th>progress</th>
                            <th>Platform</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Priority</th>
                            {{-- <th>Advertised</th> --}}
                            <th>Edit Image</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($properties as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ @$item->inventory_type }}</td>
                                <td>{{ optional($item->user)->name }}</td>
                                <td>
                                    @if ($item->agency_id == null)
                                    {{ @$item->user->agent->agency->name }}
                                    @else
                                    {{ @$item->agency->name }}
                                @endif
                                {{-- {{ @$item->user->agent->agency->name }} --}}
                                </td>
                                <td>{{ optional($item->areaOne)->name }}</td>
                                <td>{{ optional($item->areaTwo)->name }}</td>
                                {{-- <td>{{ optional($item->areaThree)->name }}</td> --}}
                                {{-- <td>{{ $item->name }}</td> --}}
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->size }} {{ $item->size_type }}</td>
                                {{-- <td></td> --}}
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->property_type }}</td>
                                <td>{{ $item->bed }}</td>
                                <td>{{ $item->bath }}</td>
                                <td>{{ count($item->images) }}</td>
                                <td>{{ @$item->progress }}</td>
                                <td>{{ $item->platform }}</td>
                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                <td>{{ $item->updated_at->diffForHumans() }}</td>
                                <td>
                                    @if ($item->priority == 1)
                                        <span class="badge badge-pill badge-success superhot">Super
                                            Hot</span>
                                    @elseif ($item->priority==2)
                                        <span class="badge badge-pill badge-success hot">Hot</span>
                                    @elseif ($item->priority==3)
                                        <span class="badge badge-pill badge-success normal">Normal</span>
                                    @endif
                                </td>
                                {{-- <td>
                                    @if ($item->advertised == 1)
                                        <span class="badge badge-pill badge-success">Advertised</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Not Advertised</span>
                                    @endif
                                </td> --}}
                                <td>
                                    <a href="{{ route('properties.show', $item->id) }}" class="float-left"
                                        style="color: green"><i class="fas fa-edit"></i>EDIT</a>
                                </td>
                                <td>
                                    <a href="{{ route('properties.edit', $item->id) }}" class="float-left"><i
                                            class="fas fa-edit"></i></a>
                                    <form action="{{ route('properties.destroy', $item->id) }}" method="POST">
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
                    {{ $properties->links() }}
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

    </script>
@endsection
