@extends('layouts.loglayout', ['title' => 'Sign In'])
@section('content')
<style>
    .form-login {
        margin-top: 1rem;
    }
    
    @media (min-width: 320px) and (max-width: 480px) {
      .logo-tni
      {
          max-width: 100% !important;  
          height: auto !important;  
          /*margin-top: 0px;*/
          margin: 0px 60px 30px 100px;
      }
      .logo-btn
      {
         max-width: 100% !important;  
            height: auto !important;  
          /*margin-top: 0px;*/
          margin: 0px 60px 30px 100px;
      }
    }
    @media (min-width: 700px) {
      .logo-btn
      {
          margin-top: 100px;
      }
    }
    
    @media screen and (min-width: 768px) {
        .form-login {
            margin-top: 4rem;
        }
    }
</style>
<div class="content">
  <div class="container">
    <div class="row form-login">
      <div class="col-3">
        <img src="{{asset('assets/images/fixlogo.png')}}" alt="logoweb" class="img-fluid logo-tni">
      </div>
      <div class="col-3 mt-5">
        <img src="{{ asset('assets/images/btnlogo.jpg') }}" alt="logoweb"  class="img-fluid logo-btn">
      </div>
      <div class="col-md-6 col-sm-12 contents mt-5">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="mb-4">
            <h1>Login</h1>
            <h5 class="mb-4 text-dark">Silahkan login untuk melanjutkan.</h5>
          </div>
            @if (session()->has('error'))
                <div class="alert alert-danger mt-1 alert-dismissible" role="alert">
                    <div class="alert-body">
                        <i class="fa fa-info"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @error('throttle')
                <div class="alert alert-danger mt-1 alert-dismissible" role="alert">
                    <div class="alert-body">
                        <i class="fa fa-info"></i>
                        <span>{{ $message }}</span>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @enderror
          <form action="{{ route('login') }}" method="post" >
            {{ csrf_field() }}
            <div class="form-group">
              <label for="nrp">NRP</label>
              <input class="form-control @error('nrp') is-invalid @enderror" type="number" name="nrp" id="nrp" autofocus required>
              @error('nrp')
                  <span class="invalid-feedback" role="alert">
                      <strong>NRP / Password yang dimasukan salah!</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input class="form-control" type="password" name="password" id="password" required>
            </div>
            
            <div class="d-flex mb-5 mt-2 align-items-center">
              <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                <input type="checkbox" name="remember" />
                <div class="control__indicator"></div>
              </label>
              <span class="ml-auto"><a href="{{ route('user.register') }}" class="forgot-pass">Register Account</a></span> 
            </div>
            <input type="submit" value="Log In" class="btn btn-block btn-primary">
          </form>
          </div>
        </div>
        
      </div>
      
    </div>
  </div>
</div>
@endsection