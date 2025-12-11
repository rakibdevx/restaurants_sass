@extends('admin.layout.index')
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
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><ion-icon name="home-outline"></ion-icon></a>
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

                    <form action="{{ route('admin.profile.index') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Username</label>
                                <input type="text" name="user_name" class="form-control"
                                    value="{{ Auth::guard('admin')->user()->username }}">
                                @error('user_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email address</label>
                                <input type="text" name="email" class="form-control"
                                    value="{{ Auth::guard('admin')->user()->email }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ Auth::guard('admin')->user()->name }}">
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
                        <div class="col-md-12">
                            <h5 class="mb-3 text-center">Profile Photo</h5>
                            <hr>

                            <div class="mb-4 d-flex flex-column gap-3 align-items-center justify-content-center">

                                <div class="user-change-photo shadow" style="width: 210px; height: 210px; overflow:hidden; border-radius:10px;">
                                    <img id="profilePreview"
                                        src="
                                        {{ Auth::guard('admin')->user()->avatar
                                            ? asset(Auth::guard('admin')->user()->avatar)
                                            : asset(setting('default_profile_image')) }}
                                            " class="user-img" alt="{{Auth::guard('admin')->user()->name}}
                                            "
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
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card radius-10">
                <div class="card-body">

                    {{-- ================= PASSWORD CHANGE ================= --}}
                    <h5 class="mb-0 mt-4">Change Password</h5>
                    <hr>

                    <form action="{{ route('admin.profile.password') }}" method="POST">
                        @csrf

                        <div class="row g-3">

                            <div class="col-12">
                                <label class="form-label">Old Password</label>
                                <input type="password" name="old_password" class="form-control">
                                @error('old_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">New Password</label>
                                <input type="password" name="new_password" class="form-control">
                                @error('new_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" class="form-control">
                                @error('new_password_confirmation')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        <div class="text-start mt-3">
                            <button type="submit" class="btn btn-warning px-4 text-white">Update Password</button>
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
                        url: "{{ route('admin.profile.index') }}",
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
    </script>
@endpush
