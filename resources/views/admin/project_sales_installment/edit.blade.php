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
                        <h3 class="card-title">Add Agency</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="col-md-8">
                        <form action="{{ route('agencies.update',$agency->id) }}" method="POST" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">User ID</label>
                                    <div class="col-sm-6">
                                     <select class="form-control" name="user_id" id="user_id">
                                        @foreach ($users as $item)
                                        <option value="{{$item->id}}">{{$item->id}}</option>
                                        @endforeach
                                    </select>   
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Area </label>
                                    <div class="col-sm-6">
                                     <select class="form-control" name="area_threes" id="area_threes">
                                        @foreach ($area_three as $item)
                                        <option value="{{$item->id}}">{{$item->id}}</option>
                                        @endforeach
                                    </select>   
                                    </div>
                                    
                                </div>
                                
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-6">
                                        <input required type="text" class="form-control" value="{{$agency->name}}" id="name" name="name"
                                            placeholder="Enter Name">
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Contact</label>
                                    <div class="col-sm-6">
                                        <input required type="number" class="form-control" value="{{$agency->contact}}" id="contact" name="contact"
                                            placeholder="Enter Contact Number">
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-6">
                                        <textarea required  rows="4"  value="{{$agency->address}}" class="form-control" id="address" name="address"
                                            placeholder="Enter Address">
                                            </textarea>
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Latitude</label>
                                    <div class="col-sm-6">
                                        <input required type="text" value="{{$agency->latitude}}" class="form-control" id="latitude" name="latitude"
                                            placeholder="Enter Latitude">
                                    </div>
                                    
                                </div>
                                
                                
                                    
                                
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Longitude</label>
                                    <div class="col-sm-6">
                                        <input required type="text" class="form-control" id="longitude" name="longitude" value="{{$agency->longitude}}"
                                            placeholder="Enter longitude">
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-6">
                                        <input required type="text" class="form-control" id="status" name="status"
                                            placeholder="Enter Status" value="{{$agency->status}}">
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Verified</label>
                                    <div class="col-sm-6">
                                        <input required type="text" class="form-control" id="verified" name="verified"
                                            placeholder="Enter Verification" value="{{$agency->verified}}">
                                    </div>
                                    
                                </div>

                                {{--
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="inputPassword3"
                                            placeholder="Password">
                                    </div>
                                </div>
                                --}}
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        {{--
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                            <label class="form-check-label" for="exampleCheck2">Remember me</label>
                                        </div>
                                        --}}
                                        <button type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            {{--
                            <div class="card-footer">
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
