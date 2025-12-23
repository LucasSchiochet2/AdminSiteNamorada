@extends('layouts.app')
@section('title', 'Trash Posts')
@section('page-actions')
    <a href="{{ route('posts.index') }}" class="btn btn-primary">
        <i class="fas fa-post-plus mr-1"></i> Return to Posts
    </a>
@endsection
@section('content')
    @session('status')
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endsession
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-posts mr-1"></i>
                        Trash Posts List
                    </h3>
                    <div class="card-tools">
                        <span class="badge bg-info">{{ $trashedPosts->total() }} Total Posts</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Title</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trashedPosts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        <div class= "d-flex gap-2">
                                        @can('edit', App\Models\User::class)
                                            <form action="{{ route('posts.restore', $post->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    Restore</button>
                                            </form>
                                        @endcan
                                        @can('destroy', App\Models\User::class)
                                            <form action="{{ route('posts.forceDelete', $post->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
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
                                Showing {{ $trashedPosts->firstItem() }} to {{ $trashedPosts->lastItem() }} of
                                {{ $trashedPosts->total() }}
                                results
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex justify-content-end">
                                {{ $trashedPosts->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Row-->
@endsection
