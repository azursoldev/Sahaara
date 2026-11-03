@extends('layouts.app')

@section('title', 'Sahaara - Inteqal Ke Baad Zaroori Khidmaat Ka Wahid Platform')

@section('content')
<div class="container">

    <!-- Hero Section -->
    <div class="p-4 p-md-5 mb-4 rounded-4 text-white position-relative overflow-hidden" 
         style="background: linear-gradient(135deg, #0b1528 0%, #172a45 55%, #1e3a5f 100%); box-shadow: 0 12px 36px rgba(11, 21, 40, 0.25);">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-warning small fw-bold mb-3 border border-warning border-opacity-25">
                    <i class="bi bi-shield-heart"></i> 24/7 Muft & Paid Khidmat-e-Khalq Platform
                </div>
                <div class="font-arabic fs-4 text-warning mb-2">
                    كُلُّ نَفۡسٍ ذَآئِقَۃُ الۡمَوۡتِ ؕ
                </div>
                <h1 class="display-6 fw-bold lh-sm mb-3">
                    Mushkil Ghari Mein Aapka Mukammal <span class="text-warning">"Sahaara"</span>
                </h1>
                <p class="lead fs-6 text-white-50 mb-4">
                    Kisi azeez ke inteqal ke baad tamam zaroori intezamat — Ambulance, Ba-Shara Ghassal, Kafan Saman Box, Qabristan & Gor-kan, aur Namaz-e-Janazah Ailaan — ab ek hi jagah dastiyab hain.
                </p>

                <!-- Action Buttons -->
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('requests.create') }}" class="btn btn-sos btn-lg px-4 fs-6">
                        <i class="bi bi-bell-fill me-2"></i> Fauri Madad (Emergency SOS)
                    </a>
                    <a href="{{ route('janazah.create') }}" class="btn btn-light btn-lg px-4 fs-6 fw-bold text-dark">
                        <i class="bi bi-megaphone-fill me-2 text-primary"></i> Janazah Card Banayein
                    </a>
                </div>
            </div>

            <!-- City Selection & Quick Lookup Card -->
            <div class="col-lg-5">
                <div class="card border-0 rounded-4 shadow-lg p-4 bg-white text-dark">
                    <h5 class="fw-bold mb-3 d-flex align-items-center justify-content-between">
                        <span><i class="bi bi-geo-alt-fill text-danger me-1"></i> Apna Shehar Muntakhib Karein</span>
                        <span class="badge bg-primary-subtle text-primary small">General Cities</span>
                    </h5>
                    
                    <form action="{{ route('home') }}" method="GET" class="mb-3">
                        <div class="input-group mb-3">
                            <label class="input-group-text bg-light"><i class="bi bi-building"></i></label>
                            <select name="city_id" class="form-select form-select-lg" onchange="this.form.submit()">
                                <option value="">Tamam Shehar (All Cities)</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" {{ $selectedCityId == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }} ({{ $city->province }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>

                    <!-- Emergency Phone Callout -->
                    <div class="p-3 rounded-3 bg-light border d-flex align-items-center justify-content-between">
                        <div>
                            <div class="small text-muted fw-bold">Emergency 24/7 Helpline</div>
                            <div class="fw-bold fs-5 text-primary">0300-SAHAARA</div>
                            <div class="text-secondary small">(0300-7242272)</div>
                        </div>
                        <a href="tel:03007242272" class="btn btn-primary rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: var(--primary-color);">
                            <i class="bi bi-telephone-fill fs-5"></i>
                        </a>
                    </div>

                    <!-- Quick Tracking lookup -->
                    <form action="{{ route('requests.track') }}" method="GET" class="mt-3">
                        <div class="input-group">
                            <input type="text" name="tracking_code" class="form-control" placeholder="Tracking code (e.g. SHR-12345)" required>
                            <button class="btn btn-outline-secondary" type="submit">Track</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Service Categories Grid -->
    <div class="mb-5">
        <div class="text-center mb-4">
            <h6 class="text-primary text-uppercase fw-bold letter-spacing-1">Khidmaat-e-Mayyat</h6>
            <h2 class="fw-bold">Inteqal Ke Baad Kin Cheezon Ki Zaroorat Hai?</h2>
            <p class="text-muted">Aapki sahoolat ke liye har marhalay ke intezamat alag se dastyab hain:</p>
        </div>

        <div class="row g-4">
            <!-- 1. Ambulance & Transport -->
            <div class="col-md-6 col-lg-4">
                <div class="card card-custom h-100 p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-3 p-3 bg-danger bg-opacity-10 text-danger fs-3">
                            <i class="bi bi-truck-front-fill"></i>
                        </div>
                        <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">24/7 Dastiyab</span>
                    </div>
                    <h5 class="fw-bold">Ambulance & Maiyat Bus</h5>
                    <p class="text-muted small">
                        Hospital se ghar, ghar se janazah-gah ya qabristan le jaane ke liye AC ambulance aur 30-afraad wali Maiyat Bus.
                    </p>
                    <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                        <a href="{{ route('requests.create') }}?service=ambulance" class="btn btn-sm btn-outline-danger fw-bold">
                            Fauri Book Karein <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="{{ route('services.category', 'transport') }}" class="small text-muted text-decoration-none">Tafseelat</a>
                    </div>
                </div>
            </div>

            <!-- 2. Ghusl & Ghassal -->
            <div class="col-md-6 col-lg-4">
                <div class="card card-custom h-100 p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-3 p-3 bg-primary bg-opacity-10 text-primary fs-3">
                            <i class="bi bi-droplet-half"></i>
                        </div>
                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">Ba-Shara</span>
                    </div>
                    <h5 class="fw-bold">Ghusl & Ghassal Khidmat</h5>
                    <p class="text-muted small">
                        Tajurbakar Mard (Male) aur Aurat (Female) ba-shara Ghassal. Ghar par aakar ya markazi ghusl khana mein sunnat ke mutabiq ghusl.
                    </p>
                    <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                        <a href="{{ route('requests.create') }}?service=ghusl" class="btn btn-sm btn-outline-primary fw-bold">
                            Ghassal Bulayein <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="{{ route('services.category', 'ghusl') }}" class="small text-muted text-decoration-none">Tafseelat</a>
                    </div>
                </div>
            </div>

            <!-- 3. Kafan & Saman Package -->
            <div class="col-md-6 col-lg-4">
                <div class="card card-custom h-100 p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-3 p-3 bg-indigo bg-opacity-10 text-indigo fs-3" style="background-color: #ede9fe; color: #6d28d9;">
                            <i class="bi bi-box-seam-fill"></i>
                        </div>
                        <span class="badge bg-secondary-subtle text-dark px-3 py-2 rounded-pill">Complete Box</span>
                    </div>
                    <h5 class="fw-bold">Kafan & Tajheez Saman</h5>
                    <p class="text-muted small">
                        Lattha/Cotton kafan (Mardana 3 pieces, Zananah 5 pieces), Kafoor, Gulab Arq, Itar, Sabun, Looban aur tamam zaroori ashiya.
                    </p>
                    <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                        <a href="{{ route('requests.create') }}?service=kafan" class="btn btn-sm btn-outline-dark fw-bold">
                            Kafan Box Mangwayein <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="{{ route('services.category', 'kafan-package') }}" class="small text-muted text-decoration-none">Tafseelat</a>
                    </div>
                </div>
            </div>

            <!-- 4. Qabristan & Gor-kan -->
            <div class="col-md-6 col-lg-4">
                <div class="card card-custom h-100 p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-3 p-3 bg-secondary bg-opacity-10 text-dark fs-3">
                            <i class="bi bi-layers-fill"></i>
                        </div>
                        <span class="badge bg-secondary-subtle text-dark px-3 py-2 rounded-pill">Tadfeen Support</span>
                    </div>
                    <h5 class="fw-bold">Qabar & Gor-kan Intezamat</h5>
                    <p class="text-muted small">
                        Qabar ki khudaai (Gor-kan), cement ke paat/takhtay, eentein, mitti, aur nameplate (takhti) ka mukammal bandobast.
                    </p>
                    <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                        <a href="{{ route('requests.create') }}?service=qabar" class="btn btn-sm btn-outline-secondary fw-bold">
                            Gor-kan Intezam <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="{{ route('services.category', 'qabar-intezamat') }}" class="small text-muted text-decoration-none">Tafseelat</a>
                    </div>
                </div>
            </div>

            <!-- 5. Janazah Announcement Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card card-custom h-100 p-4 border-warning">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-3 p-3 bg-warning bg-opacity-10 text-warning fs-3">
                            <i class="bi bi-megaphone-fill"></i>
                        </div>
                        <span class="badge bg-warning-subtle text-dark px-3 py-2 rounded-pill">Free WhatsApp Card</span>
                    </div>
                    <h5 class="fw-bold">Namaz-e-Janazah Ailaan</h5>
                    <p class="text-muted small">
                        Marhoom ke janazah ka waqt, masjid/maidan aur qabristan ka digital card banayein aur WhatsApp par aasaani se share karein.
                    </p>
                    <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                        <a href="{{ route('janazah.create') }}" class="btn btn-sm btn-warning fw-bold text-dark">
                            Abhi Ailaan Banayein <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="{{ route('janazah.index') }}" class="small text-muted text-decoration-none">Tamam Ailaanat</a>
                    </div>
                </div>
            </div>

            <!-- 6. Mustahiq & Free Welfare Support -->
            <div class="col-md-6 col-lg-4">
                <div class="card card-custom h-100 p-4 border-primary" style="background-color: #f8fafc;">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-3 p-3 bg-primary text-white fs-3">
                            <i class="bi bi-hand-thumbs-up-fill"></i>
                        </div>
                        <span class="badge bg-primary text-white px-3 py-2 rounded-pill">100% Muft (Free)</span>
                    </div>
                    <h5 class="fw-bold text-primary">Mustahiq Imdaad (Free Support)</h5>
                    <p class="text-muted small">
                        Agar koi khandan kharche bardasht nahi kar sakta, toh Sadqah-e-Jariyah aur welfare trusts ke tehat muft kafan dafan kiya jata hai.
                    </p>
                    <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                        <a href="{{ route('requests.create') }}?mustahiq=1" class="btn btn-sm btn-outline-primary fw-bold">
                            Muft Sahulat Request <i class="bi bi-arrow-right"></i>
                        </a>
                        <span class="small text-primary fw-bold">Sadqah Fund</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Live Cost Estimator / Calculator Section -->
    <div class="card card-custom border-0 shadow-sm p-4 p-md-5 mb-5" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border: 1px solid #e2e8f0;">
        <div class="row align-items-center g-4">
            <div class="col-lg-5">
                <span class="badge bg-primary-subtle text-primary mb-2 px-3 py-1 fw-bold">
                    <i class="bi bi-calculator me-1"></i> Shaffaf Nizam (Transparency)
                </span>
                <h3 class="fw-bold text-dark mb-2">Kharche Ka Taqmeena (Cost Estimator)</h3>
                <p class="text-muted small mb-4">
                    Ghar walon ki sahoolat ke liye mukhtalif khidmaat ka majmooee andaza lagayein. Aap apni zaroorat ke mutabiq items tick ya uncheck kar sakte hain.
                </p>

                <!-- Mustahiq switch -->
                <div class="p-3 rounded-3 border border-primary bg-primary bg-opacity-10 mb-3">
                    <div class="form-check form-switch fs-6 mb-0">
                        <input class="form-check-input" type="checkbox" role="switch" id="calcMustahiqSwitch">
                        <label class="form-check-label fw-bold text-primary" for="calcMustahiqSwitch">
                            Mustahiq Imdaad (Free Support)
                        </label>
                    </div>
                    <div class="small text-muted mt-1" style="font-size: 0.8rem;">
                        Kharcha ada na karne ki soorat mein Sadqah Fund ke tehat tamam khidmaat 100% muft hain.
                    </div>
                </div>

                <div class="small text-muted">
                    <i class="bi bi-info-circle me-1 text-primary"></i> Yeh taqmeena aam market aur welfare trusts ke miyari kharchon par mabni hai.
                </div>
            </div>

            <div class="col-lg-7">
                <div class="bg-white p-4 rounded-4 border shadow-sm">
                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">Matlooba Khidmaat Ka Intekhab Karein:</h6>

                    <div class="d-flex flex-column gap-2 mb-3">
                        <label class="d-flex align-items-center justify-content-between p-2 rounded-3 border bg-light cursor-pointer">
                            <div class="form-check mb-0">
                                <input class="form-check-input calc-item" type="checkbox" value="1500" data-service="ambulance" id="calc_amb" checked>
                                <span class="form-check-label fw-bold text-dark small">🚑 Ambulance / Hearse Van</span>
                            </div>
                            <span class="badge bg-white text-dark border small fw-bold">Rs. 1,500</span>
                        </label>

                        <label class="d-flex align-items-center justify-content-between p-2 rounded-3 border bg-light cursor-pointer">
                            <div class="form-check mb-0">
                                <input class="form-check-input calc-item" type="checkbox" value="1000" data-service="ghusl" id="calc_ghusl" checked>
                                <span class="form-check-label fw-bold text-dark small">💧 Ba-Shara Ghassal (Mard / Aurat)</span>
                            </div>
                            <span class="badge bg-white text-dark border small fw-bold">Rs. 1,000</span>
                        </label>

                        <label class="d-flex align-items-center justify-content-between p-2 rounded-3 border bg-light cursor-pointer">
                            <div class="form-check mb-0">
                                <input class="form-check-input calc-item" type="checkbox" value="2200" data-service="kafan" id="calc_kafan" checked>
                                <span class="form-check-label fw-bold text-dark small">📦 Complete Kafan Saman Box</span>
                            </div>
                            <span class="badge bg-white text-dark border small fw-bold">Rs. 2,200</span>
                        </label>

                        <label class="d-flex align-items-center justify-content-between p-2 rounded-3 border bg-light cursor-pointer">
                            <div class="form-check mb-0">
                                <input class="form-check-input calc-item" type="checkbox" value="2000" data-service="qabar" id="calc_qabar">
                                <span class="form-check-label fw-bold text-dark small">🪦 Qabar Khudaai (Gor-kan)</span>
                            </div>
                            <span class="badge bg-white text-dark border small fw-bold">Rs. 2,000</span>
                        </label>

                        <label class="d-flex align-items-center justify-content-between p-2 rounded-3 border bg-light cursor-pointer">
                            <div class="form-check mb-0">
                                <input class="form-check-input calc-item" type="checkbox" value="3000" data-service="qabar" id="calc_paat">
                                <span class="form-check-label fw-bold text-dark small">🧱 Cement Paat (Slabs) & Eentein</span>
                            </div>
                            <span class="badge bg-white text-dark border small fw-bold">Rs. 3,000</span>
                        </label>
                    </div>

                    <!-- Total & Booking Action -->
                    <div class="p-3 rounded-3 bg-light border d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div>
                            <div class="text-muted small fw-bold text-uppercase">Takhmeena Total (Estimated Cost):</div>
                            <h3 class="fw-bold mb-0 text-primary" id="calcTotalDisplay">Rs. 4,700</h3>
                            <div class="small text-success fw-bold d-none" id="calcFreeBadge">
                                <i class="bi bi-heart-fill"></i> 100% Free (Sadqah Fund Sponsored)
                            </div>
                        </div>

                        <a href="{{ route('requests.create') }}?service=ambulance,ghusl,kafan" id="btnBookPackage" class="btn btn-primary-custom fw-bold px-4">
                            <i class="bi bi-check2-circle me-1"></i> Yeh Package Book Karein <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Step-by-Step Practical Funeral Guide Banner -->
    <div class="card border-0 rounded-4 shadow-sm p-4 mb-5" style="background: #ffffff; border-left: 6px solid var(--primary-color) !important;">
        <div class="row align-items-center g-4">
            <div class="col-md-8">
                <span class="badge bg-primary-subtle text-primary mb-2 px-3 py-1">Rehnumai (Guide)</span>
                <h4 class="fw-bold mb-2">Kisi Ke Inteqal Par Pehle Kya Karna Chahiye?</h4>
                <p class="text-muted mb-0 small">
                    Mushkil waqt mein ghabrayein nahi. Step-1: Doctor/Hospital se Death Certificate lein &rarr; Step-2: Ghusl aur Kafan ka intezam &rarr; Step-3: Qabristan mein qabar ki khudaai ki confirmation &rarr; Step-4: Namaz-e-Janazah ka waqt aur ailaan.
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('guide') }}" class="btn btn-outline-custom">
                    <i class="bi bi-book-half me-1"></i> Mukammal Rehnumai Padhein
                </a>
            </div>
        </div>
    </div>

    <!-- Upcoming Namaz-e-Janazah Announcements -->
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="fw-bold mb-1"><i class="bi bi-megaphone-fill text-primary me-2"></i>Aane Wali Namaz-e-Janazah</h4>
                <p class="text-muted small mb-0">Haqooq-ul-Ibaad aur Maghfirat ki dua ke liye shareek hon</p>
            </div>
            <a href="{{ route('janazah.index') }}" class="btn btn-outline-secondary btn-sm">
                Tamam Dekhein (View All) <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-3">
            @forelse($upcomingJanazahs as $janazah)
                <div class="col-md-6 col-lg-4">
                    <div class="card card-custom h-100 p-4 border-top border-4 border-primary">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-light text-dark border">{{ $janazah->city->name ?? 'General' }}</span>
                            <span class="badge bg-danger-subtle text-danger">{{ $janazah->janazah_date->format('d M, Y') }}</span>
                        </div>
                        <h6 class="fw-bold text-dark mb-1 fs-5">{{ $janazah->deceased_name }}</h6>
                        @if($janazah->relation_title)
                            <div class="small text-muted mb-2">({{ $janazah->relation_title }})</div>
                        @endif

                        <div class="small mb-1 text-secondary">
                            <i class="bi bi-clock-fill text-warning me-1"></i> <strong>Waqt:</strong> {{ $janazah->janazah_prayer_time }}
                        </div>
                        <div class="small mb-2 text-secondary">
                            <i class="bi bi-geo-alt-fill text-danger me-1"></i> <strong>Jaga:</strong> {{ Str::limit($janazah->mosque_or_place, 50) }}
                        </div>

                        <div class="pt-2 border-top mt-auto d-flex justify-content-between align-items-center">
                            <a href="{{ route('janazah.show', $janazah->unique_code) }}" class="btn btn-sm btn-light fw-bold text-primary">
                                View Card <i class="bi bi-eye"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode('Namaz-e-Janazah Ailaan: ' . $janazah->deceased_name . ' | Waqt: ' . $janazah->janazah_prayer_time . ' | Jaga: ' . $janazah->mosque_or_place . ' | Details: ' . route('janazah.show', $janazah->unique_code)) }}" 
                               target="_blank" class="btn btn-sm btn-outline-success">
                                <i class="bi bi-whatsapp"></i> Share
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card p-4 text-center text-muted border-dashed">
                        <i class="bi bi-info-circle fs-3 text-secondary mb-2"></i>
                        <p class="mb-2">Is waqt koi naya janazah ailaan nahi mila.</p>
                        <div>
                            <a href="{{ route('janazah.create') }}" class="btn btn-sm btn-primary-custom">Naya Ailaan Add Karein</a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Graveyards (Qabristan) Section -->
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="fw-bold mb-1"><i class="bi bi-pin-map-fill text-primary me-2"></i>Qabristan Directory</h4>
                <p class="text-muted small mb-0">Mukhtalif shehron ke qabristano ke rabta number aur tafseelat</p>
            </div>
            <a href="{{ route('graveyards.index') }}" class="btn btn-outline-secondary btn-sm">
                Tamam Qabristan Dekhein <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-3">
            @foreach($graveyards as $graveyard)
                <div class="col-md-6 col-lg-4">
                    <div class="card card-custom h-100 p-4">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="fw-bold mb-0 text-dark">{{ $graveyard->name }}</h6>
                            <span class="badge bg-secondary-subtle text-dark">{{ $graveyard->city->name ?? '' }}</span>
                        </div>
                        <div class="small text-muted mb-2">
                            <i class="bi bi-geo-alt me-1 text-danger"></i> {{ $graveyard->address }}
                        </div>
                        <div class="small mb-3 text-dark">
                            <i class="bi bi-telephone me-1 text-primary"></i> <strong>Rabta:</strong> {{ $graveyard->phone ?? 'N/A' }}
                        </div>
                        <div class="mt-auto pt-2 border-top">
                            <a href="{{ route('graveyards.show', $graveyard->id) }}" class="small text-decoration-none fw-bold text-primary">
                                Details & Gor-kan Info <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.calc-item');
        const mustahiqSwitch = document.getElementById('calcMustahiqSwitch');
        const totalDisplay = document.getElementById('calcTotalDisplay');
        const freeBadge = document.getElementById('calcFreeBadge');
        const btnBook = document.getElementById('btnBookPackage');

        function calculateCost() {
            let total = 0;
            const selectedServices = new Set();

            checkboxes.forEach(cb => {
                if (cb.checked) {
                    total += parseFloat(cb.value) || 0;
                    selectedServices.add(cb.getAttribute('data-service'));
                }
            });

            const isMustahiq = mustahiqSwitch.checked;

            if (isMustahiq) {
                totalDisplay.innerText = "Rs. 0 (Free)";
                totalDisplay.classList.remove('text-primary');
                totalDisplay.classList.add('text-success');
                freeBadge.classList.remove('d-none');
            } else {
                totalDisplay.innerText = "Rs. " + total.toLocaleString();
                totalDisplay.classList.remove('text-success');
                totalDisplay.classList.add('text-primary');
                freeBadge.classList.add('d-none');
            }

            // Build dynamic booking URL
            const servicesArray = Array.from(selectedServices);
            let url = "{{ route('requests.create') }}";
            const params = [];
            if (servicesArray.length > 0) {
                params.push("service=" + servicesArray.join(','));
            }
            if (isMustahiq) {
                params.push("mustahiq=1");
            }
            if (params.length > 0) {
                url += "?" + params.join('&');
            }

            btnBook.href = url;
        }

        checkboxes.forEach(cb => cb.addEventListener('change', calculateCost));
        mustahiqSwitch.addEventListener('change', calculateCost);

        calculateCost();
    });
</script>
@endpush
