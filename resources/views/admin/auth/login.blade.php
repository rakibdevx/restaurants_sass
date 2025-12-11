@extends('admin.auth.layout')
@push('title')
Log In
@endpush
@section('body')
    <div class="row g-0 m-0">
        <div class="col-xl-6 col-lg-12">
            <div class="login-cover-wrapper">
                <div class="card shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            <h4>Sign In</h4>
                            <p>Sign In to your account</p>
                        </div>
                        <form class="form-body row g-3" method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <div class="col-12">
                                <label for="inputEmail" class="form-label">Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    id="inputEmail"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                >
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="inputPassword" class="form-label">Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    id="inputPassword"
                                    required
                                >
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-check form-switch">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        role="switch"
                                        name="remember"
                                        id="flexSwitchCheckRemember"
                                    >
                                    <label class="form-check-label" for="flexSwitchCheckRemember">Remember Me</label>
                                </div>
                            </div>

                            <div class="col-12 col-lg-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Sign In</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12">
            <div class="position-fixed top-0 h-100 d-xl-block d-none register-cover-img"
            @if (setting("sign_in_image") )
                style="background-image: url('{{ asset(setting("sign_in_image")) }}');"
            @endif
            ></div>
        </div>
    </div>
@endsection
