@extends('layouts.app')

@section('title', 'Request Status #' . $serviceRequest->tracking_code . ' - Sahaara')

@section('content')
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <!-- Card Header -->
            <div class="card card-custom p-4 mb-4 border-0 shadow-sm">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <span class="badge bg-secondary-subtle text-dark px-3 py-1 mb-2">Tracking ID</span>
                        <h3 class="fw-bold text-success mb-0 d-flex align-items-center gap-2">
                            <span>{{ $serviceRequest->tracking_code }}</span>
                            <button class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2" onclick="navigator.clipboard.writeText('{{ $serviceRequest->tracking_code }}'); alert('Tracking code copied!');" title="Copy code">
                                <i class="bi bi-clipboard"></i>
                            </button>
                        </h3>
                        <div class="small text-muted mt-1">
                            Darj Kiya Gaya: {{ $serviceRequest->created_at->format('d M, Y - h:i A') }}
                        </div>
                    </div>

                    <div class="text-md-end">
                        <span class="badge 
                            @if($serviceRequest->status == 'completed') bg-success 
                            @elseif($serviceRequest->status == 'in_progress') bg-primary 
                            @elseif($serviceRequest->status == 'assigned') bg-info text-dark 
                            @elseif($serviceRequest->status == 'cancelled') bg-danger 
                            @else bg-warning text-dark @endif 
                            px-3 py-2 fs-6 rounded-pill">
                            Status: {{ strtoupper($serviceRequest->status) }}
                        </span>
                        @if($serviceRequest->is_mustahiq)
                            <div class="mt-2">
                                <span class="badge bg-success-subtle text-success border border-success">
                                    <i class="bi bi-heart-fill me-1"></i> Mustahiq Imdaad (Free)
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Visual Step Progress Bar -->
                <div class="mt-4 pt-3 border-top">
                    <div class="row text-center g-2 position-relative">
                        @php
                            $stepIndex = match($serviceRequest->status) {
                                'pending' => 1,
                                'assigned' => 2,
                                'in_progress' => 3,
                                'completed' => 4,
                                default => 1
                            };
                        @endphp

                        <div class="col-3">
                            <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center {{ $stepIndex >= 1 ? 'bg-success text-white' : 'bg-light text-muted border' }}" style="width: 40px; height: 40px;">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <div class="small fw-bold {{ $stepIndex >= 1 ? 'text-success' : 'text-muted' }}">1. Request Mosool</div>
                        </div>

                        <div class="col-3">
                            <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center {{ $stepIndex >= 2 ? 'bg-success text-white' : 'bg-light text-muted border' }}" style="width: 40px; height: 40px;">
                                <i class="bi bi-person-check-fill"></i>
                            </div>
                            <div class="small fw-bold {{ $stepIndex >= 2 ? 'text-success' : 'text-muted' }}">2. Team Assigned</div>
                        </div>

                        <div class="col-3">
                            <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center {{ $stepIndex >= 3 ? 'bg-success text-white' : 'bg-light text-muted border' }}" style="width: 40px; height: 40px;">
                                <i class="bi bi-truck"></i>
                            </div>
                            <div class="small fw-bold {{ $stepIndex >= 3 ? 'text-success' : 'text-muted' }}">3. On The Way</div>
                        </div>

                        <div class="col-3">
                            <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center {{ $stepIndex >= 4 ? 'bg-success text-white' : 'bg-light text-muted border' }}" style="width: 40px; height: 40px;">
                                <i class="bi bi-heart-pulse-fill"></i>
                            </div>
                            <div class="small fw-bold {{ $stepIndex >= 4 ? 'text-success' : 'text-muted' }}">4. Mukammal</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Request Details Grid -->
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="card card-custom h-100 p-4">
                        <h6 class="fw-bold text-success border-bottom pb-2 mb-3">
                            <i class="bi bi-box2-heart me-1"></i> Matlooba Khidmaat (Services Needed)
                        </h6>
                        <ul class="list-group list-group-flush mb-3">
                            @if($serviceRequest->services_needed)
                                @foreach($serviceRequest->services_needed as $srv)
                                    <li class="list-group-item px-0 d-flex align-items-center gap-2">
                                        <i class="bi bi-check-circle-fill text-success"></i>
                                        <span class="text-capitalize fw-bold">{{ str_replace('_', ' ', $srv) }}</span>
                                    </li>
                                @endforeach
                            @endif
                        </ul>

                        <h6 class="fw-bold text-success border-bottom pb-2 mb-2">
                            <i class="bi bi-person me-1"></i> Marhoom Ki Maloomat
                        </h6>
                        <div class="small mb-1"><strong>Naam:</strong> {{ $serviceRequest->deceased_name ?? 'N/A' }}</div>
                        <div class="small mb-1"><strong>Jins:</strong> <span class="text-capitalize">{{ $serviceRequest->deceased_gender }}</span></div>
                        <div class="small mb-1"><strong>Shehar:</strong> {{ $serviceRequest->city->name ?? 'General' }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-custom h-100 p-4">
                        <h6 class="fw-bold text-success border-bottom pb-2 mb-3">
                            <i class="bi bi-telephone-inbound me-1"></i> Rabta & Maqam (Contact & Address)
                        </h6>
                        <div class="small mb-2"><strong>Rabta Karne Wale:</strong> {{ $serviceRequest->contact_name }} ({{ $serviceRequest->contact_relation ?? 'Family' }})</div>
                        <div class="small mb-3"><strong>Phone:</strong> <a href="tel:{{ $serviceRequest->contact_phone }}" class="text-decoration-none fw-bold text-success">{{ $serviceRequest->contact_phone }}</a></div>

                        <div class="p-3 bg-light rounded-3 mb-2 small">
                            <div class="fw-bold text-secondary mb-1"><i class="bi bi-geo-alt-fill text-danger me-1"></i> Pickup Pata:</div>
                            <div>{{ $serviceRequest->pickup_address }}</div>
                        </div>

                        @if($serviceRequest->destination_address)
                            <div class="p-3 bg-light rounded-3 small">
                                <div class="fw-bold text-secondary mb-1"><i class="bi bi-pin-map-fill text-primary me-1"></i> Destination:</div>
                                <div>{{ $serviceRequest->destination_address }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Admin Remarks / Dispatch Update Note -->
            @if($serviceRequest->admin_remarks)
                <div class="card border-info rounded-3 p-4 mb-4 bg-info bg-opacity-10">
                    <h6 class="fw-bold text-info-emphasis mb-2 d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill"></i> Sahaara Helpline Update & Remarks
                    </h6>
                    <p class="mb-0 text-dark">{{ $serviceRequest->admin_remarks }}</p>
                </div>
            @endif

            <!-- Help Box -->
            <div class="card card-custom p-4 bg-light border text-center">
                <h5 class="fw-bold mb-2">Kisi Madad Ki Zaroorat Hai?</h5>
                <p class="text-muted small mb-3">Agar gaari ya ghassal abhi tak nahi pohnche ya koi sawal hai, foran helpline par call karein:</p>
                <div>
                    <a href="tel:03007242272" class="btn btn-success px-4 fw-bold">
                        <i class="bi bi-telephone-fill me-2"></i> Call Helpline: 0300-SAHAARA
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

