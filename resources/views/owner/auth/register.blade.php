@extends('owner.auth.layout')

@push('title')
Registration
@endpush

@section('body')
<div class="card-body">
    <div class="text-center">
        <h4>Join us today</h4>
        <p>Enter your email and password to register</p>
    </div>

    <form class="form-body row g-3" action="{{ route('owner.register') }}" method="POST">
        @csrf

        {{-- Name --}}
        <div class="col-12">
            <label for="inputName" class="form-label">Name</label>
            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="inputName"
                name="name"
                value="{{ old('name') }}"
                placeholder="Your Name">

            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Email --}}
        <div class="col-12">
            <label for="inputEmail" class="form-label">Email</label>
            <input
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                id="inputEmail"
                name="email"
                value="{{ old('email') }}"
                placeholder="Enter Email">

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Password --}}
        <div class="col-12">
            <label for="inputPassword" class="form-label">Password</label>
            <input
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                id="inputPassword"
                name="password"
                placeholder="Enter Password">

            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        
         <div class="col-12">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        {{-- Terms --}}
        <div class="col-12 col-lg-12">
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="flexCheckChecked"
                    required>
                <label class="form-check-label" for="flexCheckChecked">
                    I agree to the Terms and Conditions
                </label>
            </div>
        </div>

        {{-- Submit Button --}}
        <div class="col-12 col-lg-12">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </div>
        </div>

        {{-- Login link --}}
        <div class="col-12 col-lg-12 text-center">
            <p class="mb-0">
                Already have an account?
                <a href="{{ route('owner.login') }}">Sign In</a>
            </p>
        </div>

    </form>
</div>
@endsection
