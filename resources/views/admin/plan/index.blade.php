@extends('admin.layout.index')
@push('title')
Plans
@endpush
@section('body')
<div class="page-content">
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Plans</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Plans</li>
                </ol>
                </nav>
            </div>
        </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center mb-3">
            <h5 class="mb-0">Subscription Plans</h5>
            <form class="ms-auto position-relative" method="GET" action="{{ route('admin.plans.index') }}">
                <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                <ion-icon name="search-sharp"></ion-icon>
                </div>
                <input class="form-control ps-5" type="text" name="search" placeholder="Search Plan" value="{{ request('search') }}">
            </form>
            <a href="{{ route('admin.plans.create') }}" class="btn btn-primary ms-3">Add Plan</a>
            </div>

            <div class="table-responsive mt-3">
                <table class="table align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>Plan Name</th>
                            <th>Price / Month</th>
                            <th>Website</th>
                            <th>Online Ordering</th>
                            <th>Menu Management</th>
                            <th>Analytics</th>
                            <th>Support</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plans as $key => $plan)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $plan->name }}</td>
                                <td>{{ $plan->currency }}{{ $plan->price }}</td>

                                @php
                                    $features = $plan->features ?? [];
                                @endphp

                                <td>{{ $features['Website'] ?? '✖' }}</td>
                                <td>{{ $features['Online Ordering'] ?? '✖' }}</td>
                                <td>{{ $features['Menu Management'] ?? '✖' }}</td>
                                <td>{{ $features['Analytics'] ?? '✖' }}</td>
                                <td>{{ $features['Support'] ?? '✖' }}</td>

                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    <a href="{{ route('admin.plans.edit', $plan->id) }}" class="text-warning" title="Edit"><i class="fadeIn animated bx bx-edit-alt"></i></a>

                                    <form action="{{ route('admin.plans.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this plan?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0 m-0 text-danger" title="Delete">
                                        <i class="fadeIn animated bx bx-trash-alt"></i>
                                        </button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
