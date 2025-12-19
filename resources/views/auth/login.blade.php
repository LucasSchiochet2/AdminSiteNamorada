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
          @session('status')
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
          @endsession
          <p class="login-box-msg">Sign in to start your session</p>
          <form action="{{ route('login') }}" method="post">
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

            <div class="input-group mb-3">
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" />
              <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
              @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--begin::Row-->
            <div class="row">
              <div class="col-8">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  <label class="form-check-label" for="flexCheckDefault"> Remember Me </label>
                </div>
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
          <!-- /.social-auth-links -->
          <p class="mb-1"><a href="{{ route('password.request') }}">I forgot my password</a></p>
          <p class="mb-0">
            <a href="{{ route('register') }}" class="text-center"> Register a new membership </a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
@endsection
