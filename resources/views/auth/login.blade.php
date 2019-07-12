@extends('auth')
@section('content')
<!-- Container start -->
<div class="container">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="row justify-content-md-center">
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                <div class="login-screen">
                    <div class="login-box">
                        <a href="#" class="login-logo">
                            <span class="text-danger">R</span><span class="text-warning">e</span><span
                                class="text-success">t</span><span class="text-info">a</span><span
                                class="text-royal-orange">i</span><span class="text-jungle-green">l</span>
                        </a>
                        <h5>Welcome back,<br />Please Login to your Account.</h5>
                        <div class="form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" placeholder="Enter Your Email" required
                                autocomplete="email" autofocus>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="form-group">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="Enter Your Password">
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        @if (Route::has('password.request'))
                        <div class="actions">
                            <a href="{{ route('password.request') }}">Recover password</a>
                            <button type="submit" class="btn btn-info">Login</button>
                        </div>
                        @endif

                        <div class="m-0">
                            <span class="additional-link">No account? <a href="{{ route('register') }}">Signup
                                    Now</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Container end
 <input class="form-check-input" type="checkbox" name="remember" id="remember"
                {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
            </label>
         -->

@endsection