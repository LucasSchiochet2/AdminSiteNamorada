@extends('layouts.app')
@section('title', 'Posts')
@section('page-actions')
    <a href="{{ route('posts.create') }}" class="btn btn-primary">
        <i class="fas fa-post-plus mr-1"></i> Add Post
    </a>
@endsection
@section('content')
    @session('status')
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endsession
    <form action="{{ route('posts.index') }}" method="GET"class="mb-4 d-flex gap-2">
        <input type="text" name="keyword" class="form-control max-w:300px" value="{{ request('keyword') }}"
            placeholder="Search posts...">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-posts mr-1"></i>
                        Posts List
                    </h3>
                    <div class="card-tools">
                        <span class="badge bg-info">{{ $posts->total() }} Total Posts</span>
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
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title}}</td>
                                    <td>
                                        @can('edit', App\Models\User::class)
                                        <a href="{{ route('posts.edit', $post->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        @endcan
                                        @can('destroy', App\Models\User::class)
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
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
                                Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }}
                                results
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex justify-content-end">
                                {{ $posts->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Row-->
@endsection
