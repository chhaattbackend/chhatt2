@extends('layouts.app')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="heading col-sm-6">
                    <h1>Project Shops</h1>
                </div>
                <div class="offset-sm-4  col-sm-2">
                    <h1 class="float-sm-right"><span
                            style="background-image: linear-gradient(121deg, #13547a 1%, #80d0c7 250%);color: white"
                            class="badge badge-pill">{{ $projectshops->total() }}</span></h1>
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
                        {{-- <h3 class="card-title">Responsive Hover Table</h3> --}}

                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <form action="{{ route('projectshops.index') }}" style="display: flex;">
                                    <div class="input-group border rounded-pill ">
                                        <input name="keyword" type="search" placeholder="Search"
                                            aria-describedby="button-addon3" class="form-control bg-none border-0">
                                        <div class="input-group-append border-0">
                                            <button id="button-addon3" type="submit" class="btn btn-link text-blue"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </div>

                                </form>

                                <a href="{{ route('projectshops.create') }}"><button type="button"
                                        class="btn btn-primary rounded-pill">Add Project Shop</button></a>
                            </div>
                        </div>


                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Project</th>
                                    <th>Shop Name</th>
                                    <th>Floor</th>
                                    <th>Size</th>
                                    <th>Size Type</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projectshops as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ optional($item->project)->name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->floor }}</td>
                                        <td>{{ $item->size }}</td>
                                        <td>{{ $item->size_type }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>
                                            <a href="{{ route('projectshops.edit', $item->id) }}" class="float-left"><i
                                                    class="fas fa-edit"></i></a>
                                            <form action="{{ route('projectshops.destroy', $item->id) }}" method="POST">
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
                            {{ $projectshops->links() }}
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
