@extends('layouts.app')

@section('title', 'Namaz-e-Janazah Ailaanat & Notice Board - Sahaara')

@section('content')
<div class="container py-3">

    <!-- Header Banner -->
    <div class="card card-custom border-0 p-4 p-md-5 mb-4 text-white" style="background: linear-gradient(135deg, #0b1528, #1e293b, #1e3a8a); box-shadow: 0 10px 30px rgba(15, 23, 42, 0.2);">
        <div class="row align-items-center g-3">
            <div class="col-md-8">
                <span class="badge bg-warning text-dark mb-2 fw-bold">Khidmat-e-Ailaan</span>
                <h3 class="fw-bold mb-1">Namaz-e-Janazah Ailaanat (Death Notice Board)</h3>
                <p class="mb-0 text-white-50 small">
                    Aane wali Namaz-e-Janazah ke auqaat, maqamat aur tadfeen ki maloomat taaki aap maghfirat ki dua aur janazah mein shareek ho sakein.
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('janazah.create') }}" class="btn btn-warning btn-lg fw-bold text-dark shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i> Naya Janazah Card Banayein
                </a>
            </div>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="card card-custom p-3 mb-4">
        <form action="{{ route('janazah.index') }}" method="GET">
            <div class="row g-2 align-items-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Marhoom ka naam, masjid ya qabristan...">
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

    <!-- Announcements Grid -->
    <div class="row g-4 mb-4">
        @forelse($announcements as $announcement)
            <div class="col-md-6 col-lg-4">
                <div class="card card-custom h-100 p-4 border-top border-4 border-primary">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge bg-light text-dark border">{{ $announcement->city->name ?? 'Pakistan' }}</span>
                        <span class="badge bg-danger-subtle text-danger fw-bold">{{ $announcement->janazah_date->format('d M, Y') }}</span>
                    </div>

                    <div class="font-arabic text-center text-muted small my-1">
                        إِنَّا لِلَّٰهِ وَإِنَّا إِلَيْهِ رَاجِعُونَ
                    </div>

                    <h5 class="fw-bold text-dark text-center mb-1">{{ $announcement->deceased_name }}</h5>
                    @if($announcement->relation_title)
                        <div class="text-center small text-muted mb-3">({{ $announcement->relation_title }})</div>
                    @endif

                    <div class="bg-light p-3 rounded-3 mb-3 small border">
                        <div class="mb-2">
                            <i class="bi bi-clock-fill text-warning me-2"></i>
                            <strong>Waqt:</strong> {{ $announcement->janazah_prayer_time }}
                        </div>
                        <div class="mb-2">
                            <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                            <strong>Masjid/Jaga:</strong> {{ $announcement->mosque_or_place }}
                        </div>
                        @if($announcement->graveyard_name)
                            <div>
                                <i class="bi bi-layers-fill text-secondary me-2"></i>
                                <strong>Tadfeen:</strong> {{ $announcement->graveyard_name }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ route('janazah.show', $announcement->unique_code) }}" class="btn btn-sm btn-outline-primary fw-bold">
                            Mukammal Card <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode('Namaz-e-Janazah Ailaan: ' . $announcement->deceased_name . ' | Waqt: ' . $announcement->janazah_prayer_time . ' | Jaga: ' . $announcement->mosque_or_place . ' | Card: ' . route('janazah.show', $announcement->unique_code)) }}" 
                           target="_blank" class="btn btn-sm btn-success text-white">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-card-heading fs-1 text-muted mb-3 d-block"></i>
                <h5 class="fw-bold text-secondary">Koi Janazah Ailaan Nahi Mila</h5>
                <p class="text-muted small">Aap pehla card bana sakte hain:</p>
                <a href="{{ route('janazah.create') }}" class="btn btn-primary-custom">
                    <i class="bi bi-plus-circle me-1"></i> Naya Janazah Card Banayein
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $announcements->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection
