@extends('layouts.app')

@section('title', $graveyard->name . ' - Qabristan Directory - Sahaara')

@section('content')
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="mb-3">
                <a href="{{ route('graveyards.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Wapas Qabristan Directory
                </a>
            </div>

            <div class="card card-custom p-4 p-md-5 border-0 shadow">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <span class="badge bg-success-subtle text-success px-3 py-1">
                        {{ $graveyard->city->name ?? 'Pakistan' }}
                    </span>
                    @if($graveyard->has_space)
                        <span class="badge bg-success text-white px-3 py-1">Jagah Dastiyab Hai</span>
                    @else
                        <span class="badge bg-danger text-white px-3 py-1">Limited Space</span>
                    @endif
                </div>

                <h2 class="fw-bold text-success mb-2">{{ $graveyard->name }}</h2>
                <p class="text-muted mb-4"><i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $graveyard->address }}</p>

                <!-- Information Grid -->
                <div class="bg-light p-4 rounded-4 border mb-4">
                    <h5 class="fw-bold mb-3 border-bottom pb-2">Rabta & Intezamiya Maloomat</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="small text-muted fw-bold">Office / Committee Phone</div>
                            <div class="fw-bold fs-5 text-dark">
                                @if($graveyard->phone)
                                    <a href="tel:{{ $graveyard->phone }}" class="text-decoration-none text-success">
                                        <i class="bi bi-telephone-fill me-1"></i> {{ $graveyard->phone }}
                                    </a>
                                @else
                                    <span class="text-muted">Direct Gate Office</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="small text-muted fw-bold">Nigraan / Contact Person</div>
                            <div class="fw-bold fs-5 text-dark">
                                {{ $graveyard->contact_person ?? 'Qabristan Committee & Gor-kan' }}
                            </div>
                        </div>

                        @if($graveyard->notes)
                            <div class="col-12 border-top pt-3">
                                <div class="small text-muted fw-bold">Zaroori Hidayat</div>
                                <div class="text-secondary small">{{ $graveyard->notes }}</div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Gor-kan & Slabs Advice -->
                <div class="p-4 rounded-4 border border-success bg-success bg-opacity-10 mb-4">
                    <h5 class="fw-bold text-success mb-2"><i class="bi bi-info-circle-fill me-2"></i> Qabar Ki Khudaai Ke Zaroori Qadam</h5>
                    <ul class="small text-muted mb-0 ps-3">
                        <li class="mb-1">Tadfeen se kam az kam 4 se 6 ghantay pehle Gor-kan ko itla dein taaki khudaai mukammal ho sake.</li>
                        <li class="mb-1">Cement ke paat (slabs), eentein aur bardana pehle se pohnchane ka intezam karein.</li>
                        <li>Agar aapko qabar ki khudaai aur saman mein madad chahiye toh Sahaara team aapke liye intezam kar sakti hai.</li>
                    </ul>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('requests.create') }}?service=qabar" class="btn btn-primary-custom flex-grow-1">
                        <i class="bi bi-layers-fill me-1"></i> Qabar & Gor-kan Intezam Request Karein
                    </a>
                    <a href="tel:03007242272" class="btn btn-outline-success">
                        <i class="bi bi-telephone me-1"></i> Helpline Rabta
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
