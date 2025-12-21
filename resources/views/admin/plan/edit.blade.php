@extends('admin.layout.index')
@push('title')
Edit Plan
@endpush
@section('body')
<div class="page-content">
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Plan</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Plan</li>
                </ol>
                </nav>
            </div>
        </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body">
            <h5>Edit Plan</h5>
            <form action="{{ route('admin.plans.update', $plan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $plan->name) }}" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $plan->slug) }}" required>
                    @error('slug')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $plan->price) }}" required>
                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Currency</label>
                    <input type="text" name="currency" class="form-control" value="{{ old('currency', $plan->currency) }}" required>
                    @error('currency')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Duration</label>
                    <input type="text" name="duration" class="form-control" value="{{ old('duration', $plan->duration) }}" required>
                    @error('duration')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Duration Type</label>
                    <input type="text" name="duration_type" class="form-control" value="{{ old('duration_type', $plan->duration_type) }}" required>
                    @error('duration_type')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control">{{ old('description', $plan->description) }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Features</label>
                    <div class="row">
                    @foreach($features as $feature)
                        <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="features[{{ $feature }}]" value="✔" id="feature-{{ $loop->index }}"
                            @if(isset($plan->features[$feature])) checked @endif
                            >
                            <label class="form-check-label" for="feature-{{ $loop->index }}">{{ $feature }}</label>
                        </div>
                        </div>
                    @endforeach
                    </div>
                    @error('features')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                    <option value="active" @if($plan->status=='active') selected @endif>Active</option>
                    <option value="inactive" @if($plan->status=='inactive') selected @endif>Inactive</option>
                    </select>
                    @error('status')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Plan</button>
            </form>
        </div>
    </div>
</div>
@endsection
