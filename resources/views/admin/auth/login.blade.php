@extends('admin.auth.layout')
@push('title')
Log In
@endpush
@section('body')
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

        <div class="col-12 col-lg-6 text-end">
            <a href="{{ route('owner.password.request') }}">Forgot Password?</a>
        </div>

        <div class="col-12 col-lg-12">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Sign In</button>
            </div>
        </div>

        <div class="col-12 col-lg-12 text-center">
            <p class="mb-0">
                Don't have an account?
                <a href="{{ route('owner.register') }}">Sign up</a>
            </p>
        </div>
    </form>

</div>
@endsection

