@extends('layouts.app')

@section('title', 'Qabristan Directory - Sahaara')

@section('content')
<div class="container py-3">

    <!-- Header Banner -->
    <div class="card card-custom border-0 p-4 mb-4 text-white" style="background: linear-gradient(135deg, #1b382b, #2f5a48);">
        <div class="row align-items-center g-3">
            <div class="col-md-8">
                <span class="badge bg-warning text-dark mb-2 fw-bold">Tadfeen Sahoolat</span>
                <h3 class="fw-bold mb-1">Qabristan Directory & Gor-kan Contacts</h3>
                <p class="mb-0 text-white-50 small">
                    Mukhtalif shehron ke mashhoor qabristano ki fehrist, unke intizamia ke rabta number, aur qabar ki khudaai ki maloomat.
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('requests.create') }}?service=qabar" class="btn btn-warning btn-lg fw-bold text-dark">
                    <i class="bi bi-layers-fill me-1"></i> Qabar / Gor-kan Book Karein
                </a>
            </div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="card card-custom p-3 mb-4">
        <form action="{{ route('graveyards.index') }}" method="GET">
            <div class="row g-2 align-items-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Qabristan ka naam ya area search karein...">
                    </div>
                </div>

                <div class="col-md-4">
                    <select name="city_id" class="form-select">
                        <option value="">Tamam Shehar (All Cities)</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ $cityId == $city->id ? 'selected' : '' }}>
                                {{ $city->name }} ({{ $city->province }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary-custom w-100">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Graveyards List -->
    <div class="row g-4 mb-4">
        @forelse($graveyards as $graveyard)
            <div class="col-md-6 col-lg-4">
                <div class="card card-custom h-100 p-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge bg-light text-dark border">{{ $graveyard->city->name ?? 'Pakistan' }}</span>
                        @if($graveyard->has_space)
                            <span class="badge bg-success-subtle text-success">Jagah Dastiyab Hai</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger">Limited / Full</span>
                        @endif
                    </div>

                    <h5 class="fw-bold text-success mb-2">{{ $graveyard->name }}</h5>

                    <p class="small text-muted mb-3">
                        <i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $graveyard->address }}
                    </p>

                    <div class="p-3 bg-light rounded-3 mb-3 small">
                        <div class="mb-1">
                            <i class="bi bi-telephone-fill text-primary me-2"></i>
                            <strong>Rabta:</strong> 
                            @if($graveyard->phone)
                                <a href="tel:{{ $graveyard->phone }}" class="text-decoration-none fw-bold">{{ $graveyard->phone }}</a>
                            @else
                                <span class="text-muted">Direct Visit / Gate Office</span>
                            @endif
                        </div>
                        @if($graveyard->notes)
                            <div class="text-muted mt-2">
                                <i class="bi bi-info-circle me-1"></i> {{ $graveyard->notes }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ route('graveyards.show', $graveyard->id) }}" class="btn btn-sm btn-outline-success">
                            Tafseelat <i class="bi bi-chevron-right"></i>
                        </a>
                        <a href="{{ route('requests.create') }}?service=qabar" class="btn btn-sm btn-primary-custom">
                            Gor-kan Intezam
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-geo-alt fs-1 text-muted mb-3 d-block"></i>
                <h5 class="fw-bold text-secondary">Koi Qabristan Nahi Mila</h5>
                <p class="text-muted small">Barah-e-karam search term tabdeel karein ya tamam shehar dekhein.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $graveyards->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection
