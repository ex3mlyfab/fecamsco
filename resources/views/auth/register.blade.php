@extends('auth.master')

@section('title')
    Sign Up
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
@endpush

@section('content')
    <section>
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-xl-5 p-0"><img class="bg-img-cover bg-center" src="{{ asset('2.png') }}" alt="looginpage" />
                </div>
                <div class="col-xl-7 p-0">
                    <div class="login-card">
                        <form class="theme-form login-form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <h4>{{ __('Create New Account') }} <img src="{{ asset('2.png') }}" alt="FEMCAS logo"
                                width="70"></h4>
                            <h6>Enter your personal details to create account</h6>
                            <div class="form-group">
                                <label>Name </label>
                                <div class="small-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="icon-user"></i></span>
                                        <input class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                            type="text" value="{{ old('last_name') }}" required autocomplete="last_name"
                                            autofocus placeholder="Last Name">
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="icon-user"></i></span>
                                        <input class="form-control @error('first_name') is-invalid @enderror" type="text"
                                            name="first_name" value="{{ old('first_name') }}" required
                                            autocomplete="first_name" placeholder="First Name">
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email_address">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-email"></i></span>
                                    <input id="email_address"
                                        class="form-control @error('email') is-invalid @enderror"type="email"
                                        name="email" value="{{ old('email') }}" required autocomplete="email"
                                        placeholder="E-Mail Address">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required />
                                    <div class="show-hide"><span class="show"> </span></div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required />
                                    <div class="show-hide"><span class="show"></span></div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <input id="checkbox1" type="checkbox" />
                                    <label class="text-muted" for="checkbox1">Agree with <span>Privacy Policy
                                        </span></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                            </div>

                            <p>Already have an account?<a class="ms-2" href="{{ route('login') }}">Sign in</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @push('scripts')
        <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    @endpush
@endsection
