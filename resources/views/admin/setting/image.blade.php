@extends('admin.layout.index')
@push('title')
General Setting
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
                    <li class="breadcrumb-item" aria-current="page">Setting</li>
                    <li class="breadcrumb-item active" aria-current="page">General Setting</li>
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
                    <h5 class="mb-0 mt-4">General Setting</h5>
                    <hr>

                   <form action="{{ route('admin.setting.image') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Logo</label>
                                <input type="file" name="site_logo" class="form-control">
                                <img src="{{asset(setting('site_logo'))}}" alt="" height="50">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Dark Logo</label>
                                <input type="file" name="site_dark_logo" class="form-control">
                                <img src="{{asset(setting('site_dark_logo'))}}" alt="" height="50">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Favicon</label>
                                <input type="file" name="site_favicon" class="form-control">
                                <img src="{{asset(setting('site_favicon'))}}" alt="" height="50">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Default Profile Image</label>
                                <input type="file" name="default_profile_image" class="form-control">
                                <img src="{{asset(setting('default_profile_image'))}}" alt="" height="50">
                            </div>

                        </div>

                        <div class="text-start mt-3">
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div><!--end row-->
</div>
@endsection
