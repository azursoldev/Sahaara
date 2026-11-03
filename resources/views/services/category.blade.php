@extends('layouts.app')

@section('title', $category->name . ' - Sahaara')

@section('content')
<div class="container py-3">

    <div class="mb-3">
        <a href="{{ route('services.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Tamam Khidmaat
        </a>
    </div>

    <!-- Category Header -->
    <div class="card card-custom border-0 p-4 mb-4 text-white" style="background: linear-gradient(135deg, #1b3d31, #285d4b);">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-3 p-3 bg-white text-success fs-1">
                <i class="bi {{ $category->icon }}"></i>
            </div>
            <div>
                <h2 class="fw-bold mb-1">{{ $category->name }}</h2>
                <p class="mb-0 text-white-50 small">{{ $category->description }}</p>
            </div>
        </div>
    </div>

    <!-- Services Grid -->
    <div class="row g-4 mb-5">
        @forelse($category->services as $service)
            <div class="col-md-6 col-lg-4">
                <div class="card card-custom h-100 p-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="fw-bold text-dark mb-0">{{ $service->name }}</h5>
                        @if($service->estimated_cost == 0)
                            <span class="badge bg-success">Muft / Free</span>
                        @else
                            <span class="badge bg-secondary-subtle text-dark">Rs. {{ number_format($service->estimated_cost) }}</span>
                        @endif
                    </div>

                    <p class="small text-muted mb-3">{{ $service->description }}</p>

                    <div class="p-2 bg-light rounded-2 small text-secondary mb-3">
                        <i class="bi bi-shield-check text-success me-1"></i> {{ $service->provider_name ?? 'Sahaara Certified Network' }}
                    </div>

                    <div class="mt-auto pt-3 border-top">
                        <a href="{{ route('requests.create') }}?service={{ match($category->slug) { 'transport' => 'ambulance', 'ghusl' => 'ghusl', 'kafan-package' => 'kafan', 'qabar-intezamat' => 'qabar', default => 'all' } }}" 
                           class="btn btn-primary-custom w-100 fw-bold">
                            <i class="bi bi-check2-circle me-1"></i> Yeh Service Book Karein
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">
                Is category mein abhi koi services dastyab nahi hain.
            </div>
        @endforelse
    </div>

    <!-- Need Free Help? Banner -->
    <div class="p-4 rounded-4 border border-success bg-success bg-opacity-10 text-center">
        <h4 class="fw-bold text-success mb-2">Kya Aap Kharcha Ada Nahi Kar Sakte?</h4>
        <p class="text-muted small mb-3">
            Sahaara Welfare Fund aur Sadqah-e-Jariyah shuraka ke tehat zaroorat-mand khandano ke liye ye tamam khidmaat 100% muft hain.
        </p>
        <a href="{{ route('requests.create') }}?mustahiq=1" class="btn btn-success fw-bold px-4">
            Mustahiq Free Request Submit Karein
        </a>
    </div>

</div>
@endsection

