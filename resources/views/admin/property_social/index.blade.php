@extends('layouts.app')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lead</h1>
                </div>
                <div class=" offset-sm-4  col-sm-2">
                    <h1 class="float-sm-right"><span
                            style="background-image: linear-gradient(121deg, #13547a 1%, #80d0c7 250%);color: white"
                            class="badge badge-pill">{{ $propertysocials->total() }}</span></h1>
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
                                TOTAL <span class="badge badge-pill badge-light">{{$propertysocials->total()}}</span>
                            </button></h3>
                        <br> --}}

                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <form action="{{ route('propertysocials.index') }}" style="display: flex;">
                                    <input type="text" name="keyword" id="keyword" class="form-control check"
                                        placeholder="Search" style="height:93%; width:40%; margin-left:auto;">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default mr-2  "><i
                                                class="fas fa-search"></i></button>
                                </form>

                                {{-- <a href="{{ route('propertysocials.create') }}"><button type="button" class="btn btn-primary">Add
                                        Category</button></a> --}}
                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Property</th>
                                <th>Likes</th>
                                <th>Views</th>
                                <th>Clicks</th>
                                <th>Impressions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($propertysocials as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->property->name }}</td>
                                    <td>{{$item->likes}}</td>
                                    <td>{{$item->views}}</td>
                                    <td>{{$item->clicks}}</td>
                                    <td>{{$item->impressions}}</td>
                                </tr>
                            @empty
                                <p>No Data Found</p>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="align-right paginationstyle">
                        {{ $propertysocials->links() }}
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
