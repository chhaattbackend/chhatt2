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
                        <h3 class="card-title">Add users</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="col-md-8">
                        <form action="{{ route('users.update', $user->id) }}" method="POST" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Roles</label>
                                    <div class="col-sm-6">
                                        <select required class="form-control" name="role_id" id="role_id">
                                            @foreach ($roles as $item)
                                                <option @if ($user->role_id == $item->id) selected @endif value="{{ $item->id }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-6">
                                        <input value="{{ $user->name }}" required type="text" name="name"
                                            class="form-control">
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-6">
                                        <input type="email" value="{{ $user->email }}" required type="text" name="email"
                                            class="form-control">
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-6">
                                        <input value="{{ $user->phone }}" required type="number" name="phone"
                                            class="form-control">
                                    </div>

                                </div>



                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-6">
                                        <select required class="form-control" name="status" id="status">
                                            <option value="">Select</option>
                                            <option @if ($user->status == 1) selected @endif value="1">Active</option>
                                            <option @if ($user->status == 0) selected @endif value="0">In Active</option>

                                        </select>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-6">
                                        <textarea required class="form-control" name="address" id="" cols="30"
                                            rows="8">{{ $user->address }}</textarea>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-6">
                                        <input type='file' name="image" onchange="readURL(this);" />
                                        @if ($user->image == null)
                                        <img id="blah" src="#" />
                                        @else
                                        <img id="blah" width="10%" src="https://chhatt.s3.ap-south-1.amazonaws.com/users/{{$item->image}}" />
                                        @endif
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Firebase ID</label>
                                    <div class="col-sm-6">
                                        <input disabled value="{{$user->firebase_id}}" required type="text" name="firebase_id" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                        <button type="button" class="btn btn-danger" onclick="show()">Change User
                                            Password</button>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                            {{-- <div class="card-footer">
                                <button type="submit" class="btn btn-default float-right">Cancel</button>
                            </div>
                            <!-- /.card-footer --> --}}
                        </form>
                        <form id="changepass" style="display: none" action="{{ route('users.update', $user->id) }}"
                            method="POST" class="form-horizontal">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">New Password</label>
                                <div class="col-sm-6">
                                    <input type="password" name="newpassword" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">Change Password</button>
                                </div>
                            </div>
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
    <script>
        var toggle = 0;

        function show() {
            if (toggle == 0) {
                $('#changepass').show();
                toggle = 1;
            } else {
                $('#changepass').hide();
                toggle = 0;
            }
        }

    </script>
@endsection
