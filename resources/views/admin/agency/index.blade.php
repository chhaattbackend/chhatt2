@extends('layouts.app')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="heading col-sm-6">
                    <h1>Agencies</h1>
                </div>
                <div class="offset-sm-4  col-sm-2">
                    @if (auth()->user()->role->name == 'Administrator')

                    <h1 class="float-sm-right"><span  style="background-image: linear-gradient(121deg, #13547a 1%, #80d0c7 250%);color: white" class="badge badge-pill">{{ $agencies->total() }}</span></h1>
                </div>
                @endif

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
        .abc{
            width: 200%;
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
                    <form action="{{ route('agencies.filter') }}">
                        @csrf
                        <div class="col-md-12">


                            <div class="float-left mx-3 my-3">
                                <label> Status:</label><br>
                                <select style="width: 129%"  class="form-control filter-control filter-select" name="status">
                                    <option @if (request()->get('status') == null) selected @endif value="">Select
                                    </option>
                                    <option @if (request()->get('status') == '1') selected @endif value="1">Active</option>
                                    <option @if (request()->get('status') == '0') selected @endif value="0">Non Active</option>

                                </select>
                            </div>
                            <div class="float-left mx-4 my-3">
                                <label>Verified:</label><br>
                                <select style="width: 140%" class="form-control abc filter-control filter-select" name="verified">
                                    <option @if (request()->get('verified') == null) selected @endif value="">Select
                                    </option>
                                    <option @if (request()->get('verified') == '1') selected @endif value="1">Verified</option>
                                    <option @if (request()->get('verified') == '0') selected @endif value="0">Non Verified</option>

                                </select>
                            </div>

                            <div class="float-left mx-4 my-3">
                                <label>Major Area:</label><br>
                                <select style="width: 140%" class="form-control abc filter-control filter-select" name="area_one_id">
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
                                <select style="width: 140%" class="form-control abc filter-control filter-select" name="area_two_id">
                                    <option @if (request()->get('area_two_id') == null) selected @endif value="">Select
                                    </option>
                                    @foreach ($area_two as $item)
                                        <option @if (request()->get('area_two_id') == $item->id) selected @endif value="{{ $item->id }}">
                                            {{ $item->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="float-left mx-4 my-3">
                                <label>Created At:</label><br>
                                <select style="width: 140%" class="form-control abc filter-control filter-select" name="created_at">
                                    <option @if (request()->get('created_at') == null) selected @endif value="">Select
                                    </option>
                                    <option @if (request()->get('created_at') == '1') selected @endif value="ascending">Ascending</option>
                                    <option @if (request()->get('created_at') == '0') selected @endif value="descending">Descending</option>

                                </select>
                            </div>

                            <div class="float-left mx-4 my-3">
                                <label>Updated At:</label><br>
                                <select style="width: 140%" class="form-control abc filter-control filter-select" name="updated_at">
                                    <option @if (request()->get('updated_at') == null) selected @endif value="">Select
                                    </option>
                                    <option @if (request()->get('updated_at') == '1') selected @endif value="ascending">Ascending</option>
                                    <option @if (request()->get('updated_at') == '0') selected @endif value="descending">Descending</option>

                                </select>
                            </div>
                            <div class="col-md-0 mx-3 my-3">
                                <button class="btn btn-primary">Submit</button>
                                <a href="{{ route('agencies.index') }}"><button type="button"
                                        class="btn btn-danger">Cancel</button></a>

                            </div>

                        </div>


                </div>
                </form>
            </div>
        </div>

        <div class="col-12">

            <div class="card searcharea">
                <div class="align-right">
                </div>
                <div class="card-header">
                    <br>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <form action="{{ route('agencies.index') }}" style="display: flex;">
                                <div class="input-group border rounded-pill ">
                                    <input name="keyword" type="search" placeholder="Search"
                                        aria-describedby="button-addon3" class="form-control bg-none border-0">
                                    <div class="input-group-append border-0">
                                        <button id="button-addon3" type="submit" class="btn btn-link text-blue"><i
                                                class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>

                            <a href="{{ route('agencies.create') }}"><button type="button"
                                    class="btn btn-primary rounded-pill rounded-bill">Add
                                    Agency</button></a>
                        </div>
                    </div>

                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>User</th>
                                <th>Area</th>
                                <th>Major Area</th>
                                <th>Minor Area</th>

                                <th>Contact</th>
                                <th>Status</th>
                                <th>Verified</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($agencies as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->image }}</td>
                                    <td>{{ optional($item->user)->name }}</td>
                                    <td>{{ optional($item->areaOne)->name }}, {{ optional($item->areaTwo)->name }},
                                        {{ optional($item->areaThree)->name }}</td>
                                    <td>{{ $item->major_area }}</td>
                                    <td>{{ $item->minor_area }}</td>

                                    <td>{{ optional($item->user)->phone }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->verified == 1)
                                            <span class="badge badge-pill badge-success">Verified</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">Not Verified</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a style="padding-right:10%" href="{{ route('agencies.show', $item->id ) }}" class="float-left"><i
                                            class="fas fa-eye"></i></a>
                                        <a style="padding-left: 10%;" href="{{ route('agencies.edit', $item->id) }}" class="float-left"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('agencies.destroy', $item->id) }}" method="POST">
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
                        @if (auth()->user()->role->name == 'Administrator')

                        {{ $agencies->links() }}
                        @endif
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
