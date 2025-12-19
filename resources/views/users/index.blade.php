@extends('layouts.app')
@section('title', 'Users')
@section('page-actions')
    <a href="{{ route('users.create') }}" class="btn btn-primary">
        <i class="fas fa-user-plus mr-1"></i> Add User
    </a>
@endsection
@section('content')
    @session('status')
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endsession
    <form action="{{ route('users.index') }}" method="GET"class="mb-4 d-flex gap-2">
        <input type="text" name="keyword" class="form-control max-w:300px" value="{{ request('keyword') }}"
            placeholder="Search users...">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-users mr-1"></i>
                        Users List
                    </h3>
                    <div class="card-tools">
                        <span class="badge bg-info">{{ $users->total() }} Total Users</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @can('edit', App\Models\User::class)
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        @endcan
                                        @can('destroy', App\Models\User::class)
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="dataTables_info">
                                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }}
                                results
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex justify-content-end">
                                {{ $users->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Row-->
@endsection
