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
                    <li class="breadcrumb-item active" aria-current="page">Business Information</li>
                </ol>
                </nav>
            </div>
        </div>
    <!--end breadcrumb-->
    <div class="row">

         <div class="col-lg-6">
            <div class="card radius-10">
                <div class="card-body">
                    <form action="{{route('owner.profile.business')}}" method="POST">
                        @csrf
                        <h5 class="mb-0 mt-4">Business Information</h5>
                        <hr>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Business Name</label>
                                <input type="text" class="form-control" name="company_name"
                                    value="{{ old('company_name') ?? Auth::guard('owner')->user()->company_name }}">
                                @error('company_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Domain</label>
                                <input type="text" class="form-control" name="domain"
                                    value="{{ old('domain') ?? Auth::guard('owner')->user()->domain }}">
                                @error('domain')
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
        <div class="col-lg-6">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="row mt-4">
                        {{-- ================= BUSINESS LOGO ================= --}}
                        <div class="col-md-12">
                            <h5 class="mb-3 text-center">Business Logo</h5>
                            <hr>

                            <div class="mb-4 d-flex flex-column gap-3 align-items-center justify-content-center">

                                <div class="user-change-photo shadow" style="width: 200px; height: 200px; overflow:hidden; border-radius:10px;">
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
    </div><!--end row-->
</div>
@endsection
@push('js')
    <script>
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
                        url: "{{ route('owner.profile.index') }}",
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
