@extends('backend.layouts.main')
@section('title', 'Create Permission')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Permission</li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

        <div class="row">

            <!-- Card with header and footer -->
            <div class="card col-6">
                <div class="card-header">
                    <h1>Create</h1>
                </div>

                <!-- Start Form -->
                <form action="{{ route('permissions.store') }}" method="POST">
                    @CSRF
                    <div class="card-body">

                        <div class="row my-4">

                            <div class="col-12 mb-3">
                                <label for="name" class="form-label">Permission Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Permission Name">
                                @error('name')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary me-2" type="submit">Submit</button>
                        <a href="{{ route('permissions.index') }}">
                            <button class="btn btn-danger" type="button">Back</button>
                        </a>
                    </div>
                </form>
                <!-- End Form -->


            </div><!-- End Card with header and footer -->


        </div>

    </section>
@endsection

