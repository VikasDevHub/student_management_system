@extends('backend.layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Teachers</li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Card with header and footer -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1>List</h1>
                    <a href="{{ route('teachers.create') }}">
                        <button class="btn btn-dark">Create</button>
                    </a>
                </div>

                <div class="card-body">
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Profile Image</th>
                            <th>Email</th>
                            <th>Phone</th>
                            {{--<th data-type="date" data-format="YYYY/MM/DD">Created at</th>--}}
                            <th>Action</th>
                        </tr>
                        </thead>
                        @if($teachers->isNotEmpty())
                            <tbody>
                            @foreach($teachers as $teacher)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $teacher->name }}</td>
                                    <td>
                                        <img src="{{ url('backend/uploads/teachers/profile-images/'. $teacher->profile_image ) }}" alt="{{ $teacher->profile_image }}" width="100px"; height="100px">
                                    </td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>{{ $teacher->phone_no ?? 'N/A' }}</td>
                                    {{--<td>{{ \Carbon\Carbon::parse($teacher->created_at)->format('Y/m/d') }}</td>--}}
                                    <td>
                                        <a href="{{ route('teachers.edit',$teacher->id) }}">
                                            <button class="btn btn-sm btn-warning m-2" type="button">Edit</button>
                                        </a>
                                        <a href="javascript:void(0)">
                                            <button class="btn btn-sm btn-danger m-2" type="button" onclick="deleteData({{$teacher->id}})">Delete</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        @else
                            <tr>
                                <td colspan="9" class="text-center">No Data Found</td>
                            </tr>
                        @endif
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div><!-- End Card with header and footer -->
        </div>
    </section>
@endsection

@push('script')
    @if(session('success'))
        <script>
            toastr.success("{!! session('success') !!}", 'Success', { "progressBar": true });
        </script>
    @endif
    @if(session('error'))
        <script>
            toastr.error("{!! session('error') !!}", 'Error', { "progressBar": true });
        </script>
    @endif

    <script>
        function deleteData(id){

            if(confirm('Are you sure you want to delete')){
                $.ajax({
                    url: `teachers/${id}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function (response){
                        if(response.status == 200){
                            toastr.success(response.message, 'Success',{ "progressBar": true })
                            window.location.reload();
                        }else{
                            toastr.error(response.message, 'Error',{ "progressBar": true })
                        }
                    }
                })
            }

        }
    </script>
@endpush
