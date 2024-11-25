@extends('auth.master')

@section('title')
    FEMCAS | login
@endsection

@push('css')
@endpush

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-5"><img class="bg-img-cover bg-center" src="{{ asset('2.png') }}" alt="looginpage" /></div>
                <div class="col-xl-7 p-0">
                    <div class="login-card">
                        <form class="theme-form login-form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <h4><img src="{{ asset('2.png') }}" alt="FEMCAS logo" width="70">Login</h4>
                            <h6>Welcome back! Log in to your account.</h6>
                            <div class="form-group">
                                <label>{{ __('Email Address') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-email"></i></span>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                        placeholder="Your Email" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ __('Password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control @error('password') is-invalid @enderror" name="password"
                                        required type="password" />
                                    <div class="show-hide"><span class="show"> </span></div>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <input id="checkbox1" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }} />
                                    <label class="text-muted" for="checkbox1"> {{ __('Remember Me') }}</label>
                                </div>

                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <div class="form-group">
                                @if (Route::has('password.request'))
                                    <a class="ms-2" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <a class="ms-2 f-right" href="{{ route('register') }}">Create Account</a>

                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @push('scripts')
    @endpush
@endsection
