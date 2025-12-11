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

                   <form action="{{ route('admin.setting.index') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">

                            <div class="col-12">
                                <label class="form-label">Site Name</label>
                                <input type="text" name="site_title" class="form-control"
                                    value="{{ setting('site_title') }}">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Site URL</label>
                                <input type="text" name="site_url" class="form-control"
                                    value="{{ setting('site_url') }}">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Tagline</label>
                                <input type="text" name="site_tagline" class="form-control"
                                    value="{{ setting('site_tagline') }}">
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
