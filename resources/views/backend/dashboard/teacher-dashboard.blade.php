@extends('backend.layouts.teacher')
@section('title','Dashboard')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->



    <section class="section dashboard">
        <div class="row">

            <h1>Dashboard For Teacher</h1>

        </div>

    </section>
@endsection

@push('script')
    <script>
        @if(session()->has('success'))
        toastr.success('{{ session()->get('success') }}', 'Success', { "progressBar": true });
        @endif
    </script>
@endpush
