@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach

              <div class="card-body">
                <form method="POST" action="{{ route('register') }}" novalidate="">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" tabindex="1" required autofocus>
                                @error('name')
                                    <div class="invalid-feedback">
                                        Please fill in your email
                                    </div>
                                @enderror
                            </div>
        
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" tabindex="1" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">
                                        Please fill in your email
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" tabindex="2" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        Please fill in your password
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password-confirm" class="control-label">Confirm password</label>
                                </div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" tabindex="2" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Register
                    </button>
                    </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; LaraPOS 2020
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
