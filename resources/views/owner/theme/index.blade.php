@extends('owner.layout.index')
@push('title')
Theme
@endpush
@section('body')
<div class="page-content">
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Theme</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item"><a href="{{route('owner.dashboard')}}"><ion-icon name="home-outline"></ion-icon></a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Theme</li>
                </ol>
                </nav>
            </div>
        </div>
    <!--end breadcrumb-->
    <div class="row">
         <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="row">
                        @foreach ($themes as $theme)
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="{{asset($theme->preview_image)}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$theme->name}}</h5>
                                        <p class="card-text">{{$theme->description}}</p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <a href="{{$theme->preview_link}}" target="_blank" class="btn btn-primary">Watch Demo</a>
                                            @php
                                                $ownerTheme = Auth::guard('owner')->user()->theme;
                                                $isActive =
                                                    $ownerTheme == $theme->id ||
                                                    ($ownerTheme == 'default' && $theme->is_default);
                                            @endphp

                                            @if($isActive)
                                                <a href="#" class="btn btn-success disabled">Actived</a>
                                            @else
                                                <a href="javascript:void(0)"
                                                class="btn btn-success active-theme-btn"
                                                data-url="{{ route('owner.theme.active', $theme->id) }}">
                                                Active Theme
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->
</div>
@endsection
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.active-theme-btn').forEach(button => {
            button.addEventListener('click', function () {
                let url = this.getAttribute('data-url');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to activate this theme?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, activate it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    });
</script>
@endpush
