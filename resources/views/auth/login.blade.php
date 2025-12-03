@extends('layouts.lte.plain')

@section('content')
<div class="login-box">
    <div class="card card-outline card-primary">

        <div class="card-header text-center">
            <h1><b>RSHP</b>UNAIR</h1>
        </div>

        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group mb-3">
                    <div class="form-floating flex-grow-1">
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autofocus>
                        <label for="email">Email</label>
                    </div>
                    <div class="input-group-text">
                        <span class="bi bi-envelope"></span>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <div class="form-floating flex-grow-1">
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="input-group-text">
                        <span class="bi bi-lock-fill"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8 d-flex align-items-center">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remember">
                            Remember Me
                        </label>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary w-100">Sign In</button>
                    </div>
                </div>
            </form>

            <div class="social-auth-links text-center mb-3 d-grid gap-2">
            <p>- OR -</p>
            <a href="#" class="btn btn-primary">
              <i class="bi bi-facebook me-2"></i> Sign in using Facebook
            </a>
            <a href="#" class="btn btn-danger">
              <i class="bi bi-google me-2"></i> Sign in using Google+
            </a>
          </div>

            <p class="mb-1 mt-2">
                <a href="{{ route('password.request') }}">I forgot my password</a>
            </p>

        </div>
    </div>
</div>
@endsection
