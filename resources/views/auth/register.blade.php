@extends('layouts.loglayout', ['title' => 'Register'])
@section('content')
<style>
    @media (min-width: 320px) and (max-width: 480px) {
      .logo-tni
      {
          max-width: 100% !important;  
            height: auto !important;  
          margin-top: 0px;
          margin: 60px;
      }
      .logo-btn
      {
         max-width: 100% !important;  
            height: auto !important;  
          margin-top: 0px;
          margin: 60px;
      }
    }
    
    @media (min-width: 700px) {
      .logo-btn
      {
          margin-top: 50px;
      }
    }
</style>
<div class="content">
  <div class="container">
    <div class="row mt-5">
      <div class="col-3">
        <img src="{{ asset('assets/images/fixlogo.png') }}" alt="logoweb" width="250px" class="img-fluid logo-tni">
      </div>
      <div class="col-3 mt-5">
        <img src="{{ asset('assets/images/btnlogo.jpg') }}" alt="logoweb" width="200px" class="img-fluid logo-btn">
      </div>
      <div class="col-md-6 contents">
        <div class="row justify-content-center">
          <div class="col-md-8 col-sm-12">
            <div class="mb-4">
            <h1>Register</h1>
            <h5 class="mb-4">Isilah data dengan baik dan benar.</h5>
          </div>
          <form method="POST" action="{{ route('register') }}" class="theme-form">
              @csrf
                    <div class="form-group">
                      <label class="col-form-label" for="name">Name:</label>
                      <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" id="name" required autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label class="col-form-label" for="email">E-Mail:</label>
                      <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" id="email" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                      <select name="pangkat" id="pangkat" class="form-control custom-select text @error('pangkat') is-invalid @enderror"
                        style="background-color: #edf2f5; font-size: 18px" required>
                        <option value="" disabled selected>Pangkat</option>
                        @foreach($pangkat as $value)
                          <option value="{{ $value['pangkat'] }}" 
                            {{ old('pangkat')== $value['pangkat'] ? 'selected' : '' }}>
                            {{ $value['pangkat'] }}
                          </option>
                        @endforeach
                      </select>
                      @error('pangkat')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label class="col-form-label" for="username">NRP:</label>
                      <input class="form-control @error('nrp') is-invalid @enderror" type="number" name="nrp" value="{{ old('nrp') }}" id="nrp" required>
                        @error('nrp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label class="col-form-label" for="password">Password:</label>
                      <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" autocomplete="new-password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>password harus terdiri dari huruf besar, huruf kecil, angka dan symbol.</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group last mb-4">
                        <label class="col-form-label" for="password-confirm">Confirm Password:</label>
                        <input class="form-control" type="password" name="password_confirmation" id="password-confirm" autocomplete="new-password" required>
                    </div>
                    <a href="{{ route('login') }}" class="btn btn-danger btn-sm" style="color: white; text-decoration: none; padding: 15px;" role="button">Back</a>
                    <button type="submit" class="btn btn-primary btn-sm" type="submit">Register</button>
            </form>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>
@endsection
