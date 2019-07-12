@extends('auth')
@section('content')
<!-- Container start -->
<div class="container">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row justify-content-md-center">
            <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12">
                <div class="login-screen">
                    <div class="login-box">
                        <a href="#" class="login-logo">
                            <span class="text-danger">R</span><span class="text-warning">e</span><span
                                class="text-success">t</span><span class="text-info">a</span><span
                                class="text-royal-orange">i</span><span class="text-jungle-green">l</span>
                        </a>
                        <h5>Welcome,<br />Create your Admin Account.</h5>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="first_name" type="text" placeholder="Enter Your First Name *"
                                            class="form-control @error('first_name') is-invalid @enderror"
                                            name="first_name" value="{{ old('first_name') }}" required
                                            autocomplete="first_name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="last_name" type="text" placeholder="Enter Your Last Name *"
                                            class="form-control @error('first_name') is-invalid @enderror"
                                            name="last_name" value="{{ old('last_name') }}" required
                                            autocomplete="last_name">
                                    </div>

                                </div>
                            </div>
                        </div>
                        @error('first_name')
                        <span id="first_name" class="text-muted">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        @error('last_name')
                        <span id="last_name" class="text-muted">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="form-group">
                            <input id="email" type="email" placeholder="Enter Valid Email Address *"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email">
                        </div>
                        @error('email')
                        <span id="email" class="text-muted">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="form-group">
                            <div class="input-group">
                                <input id="password" placeholder="Enter Password *" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">
                                <input id="password-confirm" placeholder="Confirm Your Password *" type="password"
                                    class="form-control" name="password_confirmation" required
                                    autocomplete="new-password">

                            </div>
                            @error('password')
                            <span id="passwordHelpInline" class="text-muted">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="actions">
                            <button type="submit" class="btn btn-primary">Signup</button>
                        </div>

                        <div class="m-0">
                            <span class="additional-link">Already have an account? <a href="login.html">Login</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection