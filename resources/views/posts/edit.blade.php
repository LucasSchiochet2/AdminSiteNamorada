@extends('layouts.app')
@section('title', 'Edit Post')
@section('content')
@session('status')
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
@endsession
<a href="{{ route('posts.index') }}" class="btn btn-secondary mb-3">Return</a>
@include('posts.parts.basic-details')
<br>
@include('posts.parts.category')
@endsection
