@extends('layouts.auth')
@section('content')
@section('title')
    <title>Register</title>
@endsection
@section('body-class')
    register-page
@endsection
<div class="register-box">
      <!-- /.register-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header">
          <a
            href="{{ route('login') }}"
            class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover"
          >
            <h1 class="mb-0"><b>Admin</b>LTE</h1>
          </a>
        </div>
        <div class="card-body register-card-body">
          <p class="register-box-msg">Register a new membership</p>
          <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="input-group mb-1">
                <div class="input-group-text"><span class="bi bi-person"></span></div>
                <div class="form-floating">
                  <input id="registerFullName" name="name" type="text" class="form-control @error('name') is-invalid @enderror"  placeholder="" value="{{ old('name') }}"/>
                  <label for="registerFullName">Name</label>
                </div>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-1">
                <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                <div class="form-floating">
                  <input id="registerEmail"  name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="" value="{{ old('email') }}"/>
                  <label for="registerEmail">Email</label>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-1">
                <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                <div class="form-floating">
                  <input id="registerPassword" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="" />
                  <label for="registerPassword">Password</label>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-1">
                <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                <div class="form-floating">
                  <input id="registerPasswordConfirmation" name="password_confirmation" type="password" class="form-control" placeholder="" />
                  <label for="registerPasswordConfirmation">Password Confirmation</label>
                </div>
            </div>
            <!--begin::Row-->
            <div class="row">
              <div class="col-8 d-inline-flex align-items-center">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  <label class="form-check-label" for="flexCheckDefault">
                    I agree to the <a href="#">terms</a>
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary">Register</button>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </form>
          <!-- /.social-auth-links -->
          <p class="mb-0">
            <a href="{{ route('login') }}" class="link-primary text-center"> Back to Login </a>
          </p>
        </div>
        <!-- /.register-card-body -->
      </div>
    </div>
@endsection
