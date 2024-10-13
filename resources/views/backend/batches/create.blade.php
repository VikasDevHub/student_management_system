@extends('backend.layouts.main')
@section('title', 'Create Batch')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Batch</li>
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
                <form action="{{ route('batch.store') }}" method="POST">
                    @CSRF
                    <div class="card-body">

                        <div class="row my-4">

                            <div class="col-12 mb-3">
                                <label for="name" class="form-label">Batch Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Name">
                                @error('name')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="size_of_batch" class="form-label">Enter Batch Size</label>
                                <input type="number" class="form-control" id="size_of_batch" name="size_of_batch" value="{{ old('size_of_batch') }}" placeholder="Enter Size">
                                @error('size_of_batch')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="batch_admin" class="form-label">Select Person to whom you want to assign this batch</label>
                                <select class="form-select" name="batch_admin">
                                    <option value="select">Select Person</option>
                                    @if(!empty($teachers))
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher}}">{{ $teacher}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('batch_admin')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary me-2" type="submit">Submit</button>
                        <a href="{{ route('batch.index') }}">
                            <button class="btn btn-danger" type="button">Back</button>
                        </a>
                    </div>
                </form>
                <!-- End Form -->


            </div><!-- End Card with header and footer -->


        </div>

    </section>
@endsection

