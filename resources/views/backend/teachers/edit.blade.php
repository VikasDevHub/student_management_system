@extends('backend.layouts.main')
@section('title', 'Edit Teacher')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Teachers</li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

        <div class="row">

            <!-- Card with header and footer -->
            <div class="card">
                <div class="card-header">
                    <h1>Edit</h1>
                </div>

                <!-- Start Form -->
                <form action="{{ route('teachers.update',$teacher->id) }}" method="POST" enctype="multipart/form-data">
                    @CSRF
                    @method('PUT')
                    <div class="card-body">

                        <div class="row my-4">
                            <div class="col-md-6 mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Your Name" name="name" value="{{ old('name',$teacher->name) }}">
                                    <label for="name">Your Name</label>
                                </div>
                                @error('name')
                                    <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Your Email" name="email" value="{{ old('email',$teacher->email) }}">
                                    <label for="email">Your Email</label>
                                </div>
                                @error('email')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="phone_no" placeholder="Your Phone" name="phone_no" value="{{ old('phone_no',$teacher->phone_no) }}">
                                    <label for="phone_no">Your Phone</label>
                                </div>
                                @error('phone_no')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>
                            {{--<div class="col-md-6 mb-4">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" placeholder="Your Password" name="password">
                                    <label for="password">Your Password</label>
                                </div>
                                @error('password')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>--}}
                            <div class="col-12 mb-4">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Address" id="floatingTextarea" style="height: 100px;" name="address">{{ old('address',$teacher->address) }}</textarea>
                                    <label for="floatingTextarea">Address</label>
                                </div>
                                @error('address')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingCity" placeholder="City" name="city" value="{{ old('city',$teacher->city) }}">
                                    <label for="floatingCity">City</label>
                                </div>
                                @error('city')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="tel" placeholder="Tel" name="tel" value=" {{ old('tel',$teacher->tel) }}">
                                    <label for="tel">Tel</label>
                                    @error('tel')
                                    <div class="text-danger text-sm my-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3 mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="dist" placeholder="Dist" name="dist" value=" {{ old('dist',$teacher->dist) }}">
                                    <label for="dist">Dist</label>
                                </div>
                                @error('dist')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="zipcode" placeholder="Zip Code" name="zipcode" value=" {{ old('zipcode',$teacher->zipcode) }}">
                                    <label for="zipcode">Zip Code</label>
                                </div>
                                @error('zipcode')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="">
                                    <label for="profile_image" class="form-label">Upload Profile Image</label>
                                    <input type="file" class="form-control" id="profile_image" name="profile_image"}}>
                                </div>
                                @error('profile_image')
                                <div class="text-danger text-sm my-1">{{ $message }}</div>
                                @enderror
                                <div class="my-2">
                                    <img src="{{ url('backend/uploads/teachers/profile-images/' .$teacher->profile_image)  }}" alt="{{ $teacher->profile_image }}" width="200px">
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary me-2" type="submit">Submit</button>
                        <a href="{{ route('teachers.index') }}">
                            <button class="btn btn-danger" type="button">Back</button>
                        </a>
                    </div>
                </form>
                <!-- End Form -->


            </div><!-- End Card with header and footer -->


        </div>

    </section>
@endsection
