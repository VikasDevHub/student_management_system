@extends('backend.layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Role</li>
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
                    <a href="{{ route('roles.create') }}">
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
                            <th>Permissions</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        @if(isset($roles) && $roles->count() > 0)
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->permissions->pluck('name')->implode(', ') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($role->created_at )->format('d M, Y') }}</td>
                                    <td>
                                        <a href="{{ route('roles.edit',$role->id) }}">
                                            <button class="btn btn-sm btn-warning m-2" type="button">Edit</button>
                                        </a>
                                        <a href="javascript:void(0)">
                                            <button class="btn btn-sm btn-danger m-2" type="button" onclick="deleteData({{$role->id}})">Delete</button>
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
                    url: `roles/${id}`,
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
