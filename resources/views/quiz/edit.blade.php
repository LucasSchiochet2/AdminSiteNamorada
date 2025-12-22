@extends('layouts.app')
@section('title', 'Edit Quiz')
@section('content')
 @session('status')
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endsession

<a href="{{ route('quiz.index') }}" class="btn btn-secondary mb-3">Return</a>
@include('quiz.parts.basic-details')
@endsection
