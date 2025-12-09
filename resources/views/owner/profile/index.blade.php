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
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
                </nav>
            </div>
        </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-lg-6">
            <div class="card radius-10">
                <div class="card-body">
                    {{-- ================= USER INFORMATION ================= --}}
                    <h5 class="mb-0 mt-4">User Information</h5>
                    <hr>

                    <form action="{{ route('owner.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Username</label>
                                <input type="text" name="user_name" class="form-control"
                                    value="{{ Auth::guard('owner')->user()->username }}">
                                @error('user_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email address</label>
                                <input type="text" name="email" class="form-control"
                                    value="{{ Auth::guard('owner')->user()->email }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ Auth::guard('owner')->user()->name }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="text-start mt-3">
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="row mt-4">
                        {{-- ================= PROFILE PHOTO ================= --}}
                        <div class="col-md-6">
                            <h5 class="mb-3 ">Profile Photo</h5>
                            <hr>

                            <div class="mb-4 d-flex flex-column gap-3 align-items-start justify-content-center">

                                <div class="user-change-photo shadow" style="width: 140px; height: 140px; overflow:hidden; border-radius:10px;">
                                    <img id="profilePreview"
                                        src="{{ Auth::guard('owner')->user()->profile_image
                                            ? asset(Auth::guard('owner')->user()->profile_image)
                                            : asset('backend/assets/images/no-profile.png') }}"
                                        width="140">
                                </div>

                                <!-- Hidden File Input -->
                                <input type="file" name="photo" id="profileInput" class="d-none">

                                <!-- Button Trigger -->
                                <button type="button" class="btn btn-outline-primary btn-sm radius-30 px-4"
                                    id="profileButton">
                                    <ion-icon name="image-sharp"></ion-icon> Change Photo
                                </button>

                            </div>
                        </div>

                        {{-- ================= BUSINESS LOGO ================= --}}
                        <div class="col-md-6">
                            <h5 class="mb-3">Business Logo</h5>
                            <hr>

                            <div class="mb-4 d-flex flex-column gap-3 align-items-start justify-content-center">

                                <div class="user-change-photo shadow" style="width: 140px; height: 140px; overflow:hidden; border-radius:10px;">
                                    <img id="logoPreview"
                                        src="{{ Auth::guard('owner')->user()->company_logo
                                            ? asset(Auth::guard('owner')->user()->company_logo)
                                            : asset('backend/assets/images/no-logo.png') }}"
                                        width="140">
                                </div>

                                <!-- Hidden File Input -->
                                <input type="file" name="logo" id="logoInput" class="d-none">

                                <!-- Button Trigger -->
                                <button type="button" class="btn btn-outline-primary btn-sm radius-30 px-4"
                                    id="logoButton">
                                    <ion-icon name="image-sharp"></ion-icon> Change Logo
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="col-lg-6">
            <div class="card radius-10">
                <div class="card-body">
                    <form action="{{route('owner.information.update')}}" method="POST">
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
@push('js')
    <script>
        $('#profileButton').click(function() {
            $('#profileInput').click();
        });

       $('#profileInput').change(function() {
            let file = this.files[0];
            if (!file) return;

            // Swal confirmation
            Swal.fire({
                title: 'Are you sure to update profile?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    // Preview update
                    let reader = new FileReader();

                    let formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('photo', file);

                    $.ajax({
                        url: "{{ route('owner.profile.update') }}",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            reader.onload = function(e) {
                                $('#profilePreview').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(file);

                            // AJAX upload

                            console.log('Profile photo updated successfully');
                            Swal.fire(
                                'Updated!',
                                'Your profile photo has been updated.',
                                'success'
                            );
                        },
                        error: function(err) {
                            console.error('Profile photo update failed');
                            Swal.fire(
                                'Error!',
                                'Failed to update profile photo.',
                                'error'
                            );
                        }
                    });

                } else {
                    // User cancelled, clear file input
                    $(this).val('');
                }
            });
        });


        // ========== Business Logo ==========
        $('#logoButton').click(function() {
            $('#logoInput').click();
        });

       $('#logoInput').change(function() {
            let file = this.files[0];
            let inputElement = this; // preserve reference for clearing later
            if (!file) return;

            // Swal confirmation
            Swal.fire({
                title: 'Are you sure to update logo?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Preview update
                    let reader = new FileReader();

                    // AJAX upload
                    let formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('logo', file);

                    $.ajax({
                        url: "{{ route('owner.profile.update') }}",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            reader.onload = function(e) {
                                $('#logoPreview').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(file);

                            Swal.fire(
                                'Success!',
                                'Business logo updated successfully',
                                'success'
                            );
                        },
                        error: function(err) {
                            Swal.fire(
                                'Error!',
                                'Business logo update failed',
                                'error'
                            );
                        }
                    });

                } else {
                    // User cancelled, clear file input
                    $(inputElement).val('');
                }
            });
        });

    </script>
@endpush
