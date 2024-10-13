<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Login</title>
    <link href="{{ url('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="card mt-5 mx-auto" style="width: 400px;">
        <div class="card-header">
            <h2 class="text-center my-2"><b>Student Login</b></h2>
        </div>
        <form action="{{ route('student.login') }}" method="post" class="p-4">
            @csrf
            <div class="form-group mb-3">
                <label for="email">Email<span class="text-danger">*</span></label>
                <input type="email" placeholder="enter email" name="email" class="form-control">
                @error('email')
                <p class="text-sm text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password">Password<span class="text-danger">*</span></label>
                <input type="password" placeholder="enter password" name="password" class="form-control">
                @error('password')
                <p class="text-sm text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="">
                <button class="btn btn-dark" type="submit">Login</button>
            </div>
        </form>

    </div>
</div>
</body>
</html>
