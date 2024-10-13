@extends('backend.layouts.main')
@section('title', 'Edit Role')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Role</li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

        <div class="row">

            <!-- Card with header and footer -->
            <div class="card col-12">
                <div class="card-header">
                    <h1>Edit</h1>
                </div>

                <!-- Start Form -->
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @CSRF
                    @METHOD('PUT')
                    <div class="card-body">

                        <div class="row my-4">

                            <div class="col-12 mb-3">
                                <label for="name" class="form-label">Role Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role->name) }}" placeholder="Enter Role Name">
                                @error('name')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label for="permissions" class="form-label">Permissions</label>
                                @if(isset($permissions) && count($permissions) > 0)
                                    <div class="row">
                                        @foreach($permissions as $permission)
                                            <div class="col-4">
                                                <input type="checkbox" class="me-2" id="permission_{{ $permission->id }}" name="permission[]" value="{{ $permission->name }}" {{ ($hasPermissions->contains($permission->name)) ? 'checked' : '' }}>
                                                <label for="permission_{{ $permission->id }}" class="me-4">{{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                @error('permission.*')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary me-2" type="submit">Submit</button>
                        <a href="{{ route('roles.index') }}">
                            <button class="btn btn-danger" type="button">Back</button>
                        </a>
                    </div>
                </form>
                <!-- End Form -->


            </div><!-- End Card with header and footer -->


        </div>

    </section>
@endsection

