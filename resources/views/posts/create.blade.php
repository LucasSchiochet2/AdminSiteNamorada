@extends('layouts.app')
@section('title', 'Create Post')
@section('content')
 @session('status')
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endsession
    <form action ="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        <a href="{{ route('posts.index') }}" class="btn btn-secondary mb-3">Return</a>
        @csrf
        <div class="mb-3">
            <label for="Title" class="form-label">Title</label>
            <input id="registerTitle" name="title" type="text" class="form-control @error('title') is-invalid @enderror"
                placeholder="" value="{{ old('title') }}" />
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="Body" class="form-label">Content</label>
            <textarea name="body" class="form-control @error('body') is-invalid @enderror">{{ old('body') }}</textarea>
            @error('body')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="Photos" class="form-label">Photos</label>
            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
            @error('photos')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
