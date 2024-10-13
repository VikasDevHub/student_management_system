@extends('backend.layouts.main')
@section('title', 'Edit Student')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Student</li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

        <div class="row">

            <!-- Card with header and footer -->
            <div class="card col-6">
                <div class="card-header">
                    <h1>Edit</h1>
                </div>

                <!-- Start Form -->
                <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                    @CSRF
                    @METHOD('PUT')
                    <div class="card-body">

                        <div class="row my-4">

                            <div class="col-12 mb-3">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $student->name) }}" placeholder="Enter Name">
                                @error('name')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email',$student->email) }}" placeholder="Enter Email">
                                @error('email')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="" placeholder="Enter Password">
                                @error('password')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="phone_no" class="form-label">Mobile No</label>
                                <input type="text" class="form-control" id="phone_no" name="phone_no" value="" placeholder="Enter Mobile Number" value="{{ old('phone_no',$student->phone_no) }}">
                                @error('phone_no')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="1234 Main St" value="{{ old('address',$student->address) }}">
                                @error('address')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" value="{{ old('city',$student->city) }}" placeholder="Enter City">
                                @error('city')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="tel" class="form-label">Tel</label>
                                <input type="text" class="form-control" id="tel" value="{{ old('tel',$student->tel) }}" placeholder="Enter Tel">
                                @error('tel')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="dist" class="form-label">Dist</label>
                                <input type="text" class="form-control" id="dist"  value="{{ old('dist',$student->dist) }}" placeholder="Enter Dist">
                                @error('dist')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="zipcode" class="form-label">Zipcode</label>
                                <input type="text" class="form-control" id="zipcode"  value="{{ old('zipcode',$student->zipcode) }}" placeholder="Enter Zipcode">
                                @error('zipcode')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <div class="">
                                    <label for="profile_image" class="form-label">Upload Profile Image</label>
                                    <input type="file" class="form-control" id="profile_image" name="profile_image"}}>
                                </div>
                                @error('profile_image')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                                <div class="my-2">
                                    <img src="{{ url('backend/uploads/students/profile-images/' .$student->profile_image)  }}" alt="{{ $student->profile_image }}" width="200px">
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary me-2" type="submit">Submit</button>
                        <a href="{{ route('students.index') }}">
                            <button class="btn btn-danger" type="button">Back</button>
                        </a>
                    </div>
                </form>
                <!-- End Form -->


            </div><!-- End Card with header and footer -->


        </div>

    </section>
@endsection

