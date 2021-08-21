@extends('layouts.app')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class=" heading col-sm-6">
                    <h1>Lead Assgin</h1>
                </div>
                <div class=" offset-sm-4  col-sm-2">
                    <h1 class="float-sm-right"><span
                        style="background-image: linear-gradient(121deg,black  1%, white 300%);
                        color: white;"
                            class="badge badge-pill">{{ $leadAssigns->total() }}</span></h1>
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
                    <div class="card-header" style="padding-left:1% ">
                        {{-- <h3 class="card-title"><button style="padding: 3px" type="button" class="btn btn-primary">
                                TOTAL <span class="badge badge-pill badge-light">{{$count}}</span>
                            </button></h3>
                        <br> --}}

                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <form action="{{ route('leadassigns.index') }}" style="display: flex;">
                                    <input type="text" name="keyword" id="keyword" class="form-control check"
                                        placeholder="Search" style="height:93%; width:40%; margin-left:auto;">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default mr-2  "><i
                                                class="fas fa-search"></i></button>
                                </form>

                                
                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Agent</th>
                                <th>Contact</th>
                                <th>Major Area</th>
                                <th>Lead Name</th>
                                <th>Contact</th>
                                <th>Family Members</th>
                                <th>Budget</th>
                                <th>client_feedback</th>
                                <th>realtor_feedback</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leadAssigns as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->agent->user->name }}</td>
                                    <td>{{ $item->agent->user->phone }}</td>
                                    <td> </td>
                                    <td>{{ optional($item->lead)->name}}</td>
                                    <td>{{ optional($item->lead)->phone}}</td>
                                    <td>{{ optional($item->lead)->family_members}}</td>
                                    <td>{{ optional($item->lead)->budget}}</td>
                                    <td>{{ $item->client_feedback }}</td>
                                    <td>{{ $item->realtor_feedback }}</td>
                                    <td>
                                        <a href="{{ route('leadassigns.edit', $item->id) }}" class="float-left"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('leadassigns.destroy', $item->id) }}" method="POST">
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
                        {{ $leadAssigns->links() }}
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
