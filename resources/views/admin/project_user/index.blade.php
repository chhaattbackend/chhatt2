@extends('layouts.app')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="heading col-sm-6">
                    <h1>User Projects </h1>
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



                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <form action="{{ route('projectusers.index') }}" style="display: flex;">
                                    <div class="input-group border rounded-pill ">
                                        <input name="keyword" type="search" placeholder=" Search"
                                            aria-describedby="button-addon3" class="form-control bg-none border-0">
                                        <div class="input-group-append border-0">
                                            <button id="button-addon3" type="submit" class="btn btn-link text-blue"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>


                                <a href="{{ route('projectusers.create') }}"><button type="button" class="btn btn-primary rounded-pill rounded-bill">Add
                                        </button></a>
                            </div>
                        </div>
                    </div>


                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Project</th>


                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projectusers as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td ><a style="color: black;" href="{{route('users.edit',$item->id)}}"> {{optional($item->user)->name }}</a></td>
                                        <td>{{ optional($item->project)->name }}</td>


                                    </tr>
                                @empty
                                    <p>No Data Found</p>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="align-right paginationstyle">
                            {{ $projectusers->links() }}
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
