@extends('layouts.layoutAdmin')

@section('body')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
             <!-- Logo -->
             <div style=" display: flex ;justify-content: center;">
              <img src= {{ asset('assets/t2/img/7.png')}} style="height: 100px; width: auto;">
            </div>

            <!-- /Logo -->
            <h4 class="mb-2">Halo, Selamat Datang 👋</h4>
            <p class="mb-4">Di Aplikasi Absensi Sebelas</hp>

            @if(session('error'))
            <p class="alert alert-danger">{{ session('error') }}</p>
            @endif

            <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
            @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email atau Username</label>
                <input
                  type="text"
                  class="form-control @error('email') is-invalid @enderror"
                  id="email"
                  name="email"
                  placeholder="Enter your email or username"
                  autofocus
                  required autocomplete="email"/>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                </div>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password"
                    required autocomplete="password"
                    />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="mb-3">
                <button type="submit" class="btn btn-primary d-grid w-100">
                    {{ __('Login') }}
                </button>
                @if (Route::has('password.request'))
                    <a class="btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
              </div>

            </form>
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>
@endsection
