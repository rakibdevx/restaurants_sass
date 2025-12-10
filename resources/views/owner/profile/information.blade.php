@extends('owner.layout.index')
@push('title')
Profile
@endpush
@section('body')
<div class="page-content">
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Profile</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item"><a href="{{route('owner.dashboard')}}"><ion-icon name="home-outline"></ion-icon></a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Profile</li>
                    <li class="breadcrumb-item active" aria-current="page">Information</li>
                </ol>
                </nav>
            </div>
        </div>
    <!--end breadcrumb-->
    <div class="row">
         <div class="col-lg-6">
            <div class="card radius-10">
                <div class="card-body">
                    <form action="{{route('owner.profile.information')}}" method="POST">
                        @csrf
                        <h5 class="mb-0 mt-4">Contact Information</h5>
                        <hr>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone"
                                    value="{{ old('phone') ?? Auth::guard('owner')->user()->phone }}">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address"
                                    value="{{ old('address') ?? Auth::guard('owner')->user()->address }}">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control" name="city"
                                    value="{{ old('city') ?? Auth::guard('owner')->user()->city }}">
                                @error('city')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Division</label>
                                <input type="text" class="form-control" name="state"
                                    value="{{ old('state') ?? Auth::guard('owner')->user()->state }}">
                                @error('state')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Country</label>
                                <input type="text" class="form-control" name="country"
                                    value="{{ old('country') ?? Auth::guard('owner')->user()->country }}">
                                @error('country')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                             <div class="col-12">
                                <label class="form-label">Post Code</label>
                                <input type="text" class="form-control" name="postal_code"
                                    value="{{ old('postal_code') ?? Auth::guard('owner')->user()->postal_code }}">
                                @error('postal_code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="text-start mt-3">
                            <button  type="submit" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--end row-->
</div>
@endsection
