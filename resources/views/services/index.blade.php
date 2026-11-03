@extends('layouts.app')

@section('title', 'Tamam Khidmaat (Services Directory) - Sahaara')

@section('content')
<div class="container py-3">

    <!-- Header Banner -->
    <div class="card card-custom border-0 p-4 p-md-5 mb-5 text-white" style="background: linear-gradient(135deg, #0b1528, #172a45, #1e3a8a); box-shadow: 0 10px 30px rgba(15, 23, 42, 0.2);">
        <div class="row align-items-center g-3">
            <div class="col-md-8">
                <span class="badge bg-warning text-dark mb-2 fw-bold">Khidmat-e-Mayyat Directory</span>
                <h2 class="fw-bold mb-1">Tamam Khidmaat & Packages</h2>
                <p class="mb-0 text-white-50 small">
                    Ambulance, Ghusl, Kafan Box, Qabar khudaai aur Mustahiq Imdaad ke mukammal packages.
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('requests.create') }}" class="btn btn-sos btn-lg fs-6">
                    <i class="bi bi-bell-fill me-1"></i> Fauri Emergency SOS
                </a>
            </div>
        </div>
    </div>

    <!-- Category Loop -->
    @foreach($categories as $category)
        <div class="mb-5" id="{{ $category->slug }}">
            <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 p-2 bg-primary text-white fs-4" style="background-color: var(--primary-color) !important;">
                        <i class="bi {{ $category->icon }}"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">{{ $category->name }}</h4>
                        <div class="small text-muted">{{ $category->description }}</div>
                    </div>
                </div>
                <a href="{{ route('services.category', $category->slug) }}" class="btn btn-sm btn-outline-primary">
                    Tafseelat <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="row g-4">
                @forelse($category->services as $service)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-custom h-100 p-4">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="fw-bold text-dark mb-0">{{ $service->name }}</h5>
                                @if($service->estimated_cost == 0)
                                    <span class="badge bg-primary">Muft / Free</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-dark">Rs. {{ number_format($service->estimated_cost) }}</span>
                                @endif
                            </div>

                            <p class="small text-muted mb-3">{{ $service->description }}</p>

                            <div class="p-2 bg-light rounded-2 small text-secondary mb-3 border">
                                <i class="bi bi-shield-check text-primary me-1"></i> Provider: {{ $service->provider_name ?? 'Sahaara Certified Network' }}
                            </div>

                            <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                                <a href="{{ route('requests.create') }}?service={{ match($category->slug) { 'transport' => 'ambulance', 'ghusl' => 'ghusl', 'kafan-package' => 'kafan', 'qabar-intezamat' => 'qabar', default => 'all' } }}" 
                                   class="btn btn-sm btn-primary-custom w-100 fw-bold">
                                    <i class="bi bi-check2-circle me-1"></i> Request This Service
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-muted small">
                        Is category mein filhal koi service list nahi hai.
                    </div>
                @endforelse
            </div>
        </div>
    @endforeach

</div>
@endsection
