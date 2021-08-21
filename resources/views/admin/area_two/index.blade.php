@extends('layouts.app')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="heading col-sm-6">
                    <h1>Area Two</h1>
                </div>
                {{-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Simple Tables</li>
                    </ol>
                </div> --}}
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card searcharea">
                    <div class="align-right">
                    </div>
                    <div class="card-header" style="padding-left:1% ">
                        <h3 class="card-title"><button style="padding: 3px" type="button" class="btn btn-primary">
                                TOTAL <span class="badge badge-pill badge-light">{{$areatwos->total()}}</span>
                            </button></h3>
                        <br>

                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <form action="{{ route('areatwos.index') }}" style="display: flex;">
                                    <div class="input-group border rounded-pill ">
                                        <input name="keyword" type="search" placeholder=" Search"
                                            aria-describedby="button-addon3" class="form-control bg-none border-0">
                                        <div class="input-group-append border-0">
                                            <button id="button-addon3" type="submit" class="btn btn-link text-blue"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>


                                <a href="{{ route('areatwos.create') }}"><button type="button" class="btn btn-primary rounded-pill rounded-bill">Add
                                        Area Two</button></a>
                            </div>
                        </div>
                    </div>


                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>Parent</th>
                                    <th>City</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($areatwos as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->area_one->name }}</td>
                                        <td>{{ $item->area_one->city->name }}</td>

                                        <td>
                                            <a href="{{ route('areatwos.edit', $item->id) }}" class="float-left"><i
                                                    class="fas fa-edit"></i></a>
                                            <form action="{{ route('areatwos.destroy', $item->id) }}" method="POST">
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
                            {{ $areatwos->links() }}
                        </div>
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
