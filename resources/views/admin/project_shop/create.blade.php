@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <!-- /.card -->
                <!-- Form Element sizes -->
                <!-- /.card -->
                <!-- /.card -->
                <!-- Input addon -->
                <!-- /.card -->
                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Add Project Buyer</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="col-md-8">
                        <form action="{{ route('projectshops.store') }}" method="POST" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Project</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="project_id">
                                            <option disabled selected value="">Select Project</option>
                                            @foreach ($projects as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Shop Name</label>
                                    <div class="col-sm-6">
                                        <input required type="text" class="form-control" name="name"
                                            placeholder="Enter Name">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Floor</label>
                                    <div class="col-sm-6">
                                        <input required type="number" class="form-control" name="floor"
                                            placeholder="Enter Floor">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Size</label>
                                    <div class="col-sm-6">
                                        <input required type="number" class="form-control" name="size"
                                            placeholder="Enter Size">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Size Type</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="size_type">
                                            <option disabled selected value="">Select Size Type</option>
                                            <option value="sq ft.">Square ft.</option>
                                            <option value="yards">Square Yards</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Code</label>
                                    <div class="col-sm-6">
                                        <input required type="number" class="form-control" name="code"
                                            placeholder="Enter Code">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="type">
                                            <option disabled selected value="">Select Type</option>
                                            <option value="residential">Residential</option>
                                            <option value="commercial">Commercial</option>
                                        </select>
                                    </div>
                                </div>


                                {{-- <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="inputPassword3"
                                            placeholder="Password">
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        {{-- <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                            <label class="form-check-label" for="exampleCheck2">Remember me</label>
                                        </div> --}}
                                        <button
                                            type="submit" class="btn btn-info col-sm-7 rounded-bill rounded-pill">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            {{-- <div class="card-footer">
                                <button type="submit" class="btn btn-default float-right">Cancel</button>
                            </div>
                            <!-- /.card-footer --> --}}
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div>
@endsection
