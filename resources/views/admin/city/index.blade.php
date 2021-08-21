@extends('layouts.app')
@section('content')
    <style>


    </style>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="heading col-sm-6">
                    <h1>Cities</h1>
                </div>
                <div class="offset-sm-4  col-sm-2">
                    <h1 class="float-sm-right"><span
                        style="background-image: linear-gradient(121deg,black  1%, white 300%);
                        color: white;"
                            class="badge badge-pill">{{ $cities->total() }}</span></h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card searcharea">
                    <div class="align-right">
                    </div>
                    <div class="card-header">
                        <br>
                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <form action="{{ route('cities.index') }}" style="display: flex;">
                                    <div class="input-group border rounded-pill ">
                                        <input name="keyword" type="search" placeholder="Search"
                                            aria-describedby="button-addon3" class="form-control bg-none border-0">
                                        <div class="input-group-append border-0">
                                            <button id="button-addon3" type="submit" class="btn btn-link text-blue"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>

                                <a href="{{ route('cities.create') }}"><button type="button"
                                        class="btn btn-primary rounded-pill rounded-bill">Add
                                        City</button></a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>States</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cities as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ optional($item->state)->name }}</td>

                                        <td>
                                            <a href="{{ route('cities.edit', $item->id) }}" class="float-left"><i
                                                    class="fas fa-edit"></i></a>
                                            <form action="{{ route('cities.destroy', $item->id) }}" method="POST">
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
                            {{ $cities->links() }}
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

@endsection
