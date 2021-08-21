@extends('layouts.app')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="heading col-sm-6">
                    <h1>ProjectSaleInstallemnt</h1>
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
                    <div class="card-header">
                        <br>
                        {{-- <h3 class="card-title">Responsive Hover Table</h3> --}}

                        <div class="card-tools">
                            <div class="input-group input-group-sm" >
                                <form action="{{ route('projectsalesinstallments.index') }}" style="display: flex;">
                                    <input type="text" name="keyword" id="keyword" class="form-control check"
                                        placeholder="Search" style="height:93%; width:40%; margin-left:auto;">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default mr-2  "><i
                                                class="fas fa-search"></i></button>
                                </form>

                                <a href="{{ route('projectsalesinstallments.create') }}"><button type="button" class="btn btn-primary">Add Agency</button></a>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>User</th>
                                <th>Area</th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th>Verified</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ProjectSaleInstallments as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ optional($item->user)->name }}</td>
                                    <td>{{ optional($item->area)->name }}</td>
                                    <td>{{ $item->contact }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->verified }}</td>
                                    <td>
                                        <a href="{{ route('agencies.edit', $item->id) }}" class="float-left"><i
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
                        {{ $ProjectSaleInstallments->links() }}
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
