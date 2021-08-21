@extends('layouts.app')
@section('content')

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class=" heading col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class=" offset-sm-4  col-sm-2">
                    <h1 class="float-sm-right"><span
                        style="background-image: linear-gradient(121deg, #13547a 1%, #80d0c7 250%);color: white"
                            class="badge badge-pill">{{ $users->total() }}</span></h1>
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
                    <form action="{{ route('users.filter') }}" >
                        @csrf
                        <div class="col-md-12">


                            <div class="float-left mx-3 my-3">
                                <label>Role:</label>
                                <select style="width: 120%" class="form-control filter-control filter-select" name="role_id">
                                    <option @if (request()->get('role_id') == null) selected @endif value="">Select
                                    </option>
                                    @foreach ($roles as $item)


                                    <option @if (request()->get('role_id') == $item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach

                                </select>
                            </div>



                        </div>


                        <div class="col-md-0 mx-3 my-3">
                            <button class="btn btn-primary">Submit</button>
                            <a href="{{ route('users.index') }}"><button type="button"
                                    class="btn btn-danger">Cancel</button></a>

                        </div>
                </div>
                </form>
            </div>
            <div class="col-12">
                <div class="card searcharea">
                    <div class="align-right">
                    </div>
                    <div class="card-header">
                        <br>
                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <form action="{{ route('users.index') }}" style="display: flex;">
                                    <div class="input-group border rounded-pill ">
                                        <input name="keyword" type="search" placeholder="Search"
                                            aria-describedby="button-addon3" class="form-control bg-none border-0">
                                        <div class="input-group-append border-0">
                                            <button id="button-addon3" type="submit" class="btn btn-link text-blue"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>

                                <a href="{{ route('users.create') }}"><button type="button"
                                        class="btn btn-primary rounded-pill rounded-bill">Add
                                        User</button></a>
                            </div>
                        </div>

                    </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Firebase ID</th>
                                <th>Role</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Phone</th>
                                <th>Mobile</th>
                                <th>Created At</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                    @if ($item->thumbnail!=null)
                                    <img class="rounded-circle" style="height: 50px;width: 50px;"
                                            src="https://chhatt.s3.ap-south-1.amazonaws.com/users/{{$item->thumbnail}}" id="dpuser">
                                            @else
                                    <img class="rounded-circle" style="height: 50px;width: 50px;"
                                            src="{{ asset('images/userdp/default.png') }}" id="dpuser">
                                  @endif
                                            </td>
                                    <td>{{ $item->firebase_id }}</td>
                                    <td>{{ $item->role->name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{ optional($item)->created_at->diffForHumans() }}</td>

                                    <td>
                                        <a href="{{ route('users.edit', $item->id) }}" class="float-left"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('users.destroy', $item->id) }}" method="POST">
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
                        {{ $users->links() }}
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
