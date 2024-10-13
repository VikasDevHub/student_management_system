<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMS</title>

    <!-- Favicons -->
    <link href="{{ url('backend/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ url('backend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ url('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Login As</h1>
            </div>
            <div class="card-body">
               <div class="">
                   <a href="{{ route('student.login') }}">
                       <button  type="button" class="btn btn-success mr-3">Student</button>
                   </a>
                   <a href="{{ route('teacher.login') }}">
                       <button type="button" class="btn btn-warning mx-3">Teacher</button>
                   </a>
               </div>
            </div>
        </div>
    </div>
</div>

<!-- Vendor JS Files -->

<script src="{{ url('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('backend/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>


<!-- Template Main JS File -->
<script src="{{ url('backend/assets/js/main.js')}}"></script>

<!-- Jquery File -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Toaster JS File -->
<script src="{{ url('backend/assets/vendor/toastr/toastr.min.js') }}"></script>

<!-- Script JS File -->
@stack('script')

</body>
</html>
