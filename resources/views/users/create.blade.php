@extends('layouts.app')
@section('title', 'Create User')
@section('content')
    <form action ="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="Name" class="form-label">Name</label>
            <input id="registerFullName" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                placeholder="" value="{{ old('name') }}" />
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="Email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" />
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="Password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                />

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        {{-- <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> --}}
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
