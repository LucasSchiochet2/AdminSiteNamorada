@extends('layouts.auth')
@section('title')
    <title>Login</title>
@endsection
@section('body-class')
    login-page
@endsection
@section('content')
   <div class="login-box">
      <div class="login-logo">
        <a href="{{ route('login') }}"><b>Admin</a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">

          <p class="login-box-msg">Recovery your password</p>

          @session('status')
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
          @endsession

          <form action="{{ route('password.email') }}" method="post">
            @csrf
            <div class="input-group mb-3">
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" />
              <div class="input-group-text"><span class="bi bi-envelope"></span></div>
              @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
              <!-- /.col -->
              <div class="col-4">
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary">Sign In</button>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </form>
          <p class="mb-3 text-center ">
            <a href="{{ route('login') }}" class="text-center"> Back to Login </a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
@endsection
