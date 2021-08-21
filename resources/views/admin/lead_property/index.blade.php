@extends('layouts.app')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lead Property</h1>
                </div>
                <div class=" offset-sm-4  col-sm-2">
                    <h1 class="float-sm-right"><span
                        style="background-image: linear-gradient(121deg,black  1%, white 300%);
                        color: white;"
                            class="badge badge-pill">{{ $leadProperties->total() }}</span></h1>
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
                                <form action="{{ route('leadproperties.index') }}" style="display: flex;">
                                    <input type="text" name="keyword" id="keyword" class="form-control check"
                                        placeholder="Search" style="height:93%; width:40%; margin-left:auto;">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default mr-2  "><i
                                                class="fas fa-search"></i></button>
                                </form>

                                <a href="{{ route('leadproperties.create') }}"><button type="button" class="btn btn-primary abs rounded-bill rounded-pill">Add
                                        Lead Property</button></a>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Area One</th>
                                <th>Area Two</th>
                                <th>Contact</th>
                                <th>Size</th>
                                <th>Size Type</th>
                                <th>Lead Name</th>
                                <th>Contact</th>
                                <th>Family Members</th>
                                <th>Budget</th>
                                <th>Call Status</th>
                                <th>Lead Status</th>
                                <th>Chat Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leadProperties as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{optional($item->property)->category}}</td>
                                    <td>{{optional($item->property->areaOne)->name}}</td>
                                    <td>{{optional($item->property->areaTwo)->name}}</td>
                                    <td>{{optional($item->property->user)->phone}}</td>
                                    <td>{{optional($item->property)->size}}</td>
                                    <td>{{optional($item->property)->size_type}}</td>
                                    <td>{{ optional($item->lead)->name}}</td>
                                    <td>{{ optional($item->lead)->phone}}</td>
                                    <td>{{ optional($item->lead)->family_members}}</td>
                                    <td>{{ optional($item->lead)->budget}}</td>
                                    <td> @if ($item->call_status == 1)
                                        <span class="badge badge-pill badge-success">Active</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Inactive</span>
                                    @endif</td>



                                    <td>
                                        @if ($item->lead_status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">Inactive</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($item->chat_status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('leadproperties.edit', $item->id) }}" class="float-left"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('leadproperties.destroy', $item->id) }}" method="POST">
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
                        {{ $leadProperties->links() }}
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
