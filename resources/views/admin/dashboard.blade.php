@extends('layouts.admin')

@section('title', 'Operations Dashboard - Sahaara Admin')

@section('content')
<div>
    <!-- Welcome Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1">Assalam-o-Alaikum, {{ Auth::user()->name ?? 'Admin' }}! 👋</h3>
            <p class="text-muted small mb-0">Yeh raha Sahaara platform ki emergency requests aur services ka taza tareen jaiza.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('requests.create') }}" class="btn btn-danger btn-sm fw-bold" target="_blank">
                <i class="bi bi-bell-fill me-1"></i> New SOS Request
            </a>
            <a href="{{ route('janazah.create') }}" class="btn btn-warning btn-sm fw-bold text-dark" target="_blank">
                <i class="bi bi-megaphone-fill me-1"></i> New Janazah Card
            </a>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card card-custom p-3 border-start border-4 border-warning h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">Pending SOS</div>
                        <h2 class="fw-bold text-warning mb-0">{{ $stats['pending_requests'] }}</h2>
                        <div class="small text-muted mt-1">Fauri tavajjah ki zaroorat</div>
                    </div>
                    <div class="rounded-circle p-3 bg-warning bg-opacity-10 text-warning fs-3">
                        <i class="bi bi-clock-history"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card card-custom p-3 border-start border-4 border-info h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">Assigned / Dispatched</div>
                        <h2 class="fw-bold text-info mb-0">{{ $stats['assigned_requests'] }}</h2>
                        <div class="small text-muted mt-1">Team on the way</div>
                    </div>
                    <div class="rounded-circle p-3 bg-info bg-opacity-10 text-info fs-3">
                        <i class="bi bi-truck"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card card-custom p-3 border-start border-4 border-success h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">Completed Services</div>
                        <h2 class="fw-bold text-success mb-0">{{ $stats['completed_requests'] }}</h2>
                        <div class="small text-muted mt-1">Kamyab tadfeen & support</div>
                    </div>
                    <div class="rounded-circle p-3 bg-success bg-opacity-10 text-success fs-3">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card card-custom p-3 border-start border-4 border-danger h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">Mustahiq (Free Support)</div>
                        <h2 class="fw-bold text-danger mb-0">{{ $stats['mustahiq_requests'] }}</h2>
                        <div class="small text-muted mt-1">Sadqah Fund sponsored</div>
                    </div>
                    <div class="rounded-circle p-3 bg-danger bg-opacity-10 text-danger fs-3">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Emergency Requests Section -->
    <div class="card card-custom border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0"><i class="bi bi-bell-fill text-danger me-2"></i>Taza Tareen Emergency Requests</h5>
            <a href="{{ route('admin.requests') }}" class="btn btn-outline-success btn-sm">
                Tamam Requests Dekhein <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small text-uppercase">
                    <tr>
                        <th>Tracking ID</th>
                        <th>Shehar (City)</th>
                        <th>Marhoom</th>
                        <th>Rabta (Contact)</th>
                        <th>Khidmaat (Services)</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentRequests as $req)
                        <tr>
                            <td>
                                <a href="{{ route('requests.show', $req->tracking_code) }}" class="fw-bold text-success text-decoration-none" target="_blank">
                                    {{ $req->tracking_code }} <i class="bi bi-box-arrow-up-right small"></i>
                                </a>
                                <div class="text-muted" style="font-size: 0.72rem;">{{ $req->created_at->diffForHumans() }}</div>
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ $req->city->name ?? 'General' }}</span></td>
                            <td>
                                <div class="fw-bold small">{{ $req->deceased_name ?? 'N/A' }}</div>
                                <div class="text-muted small text-capitalize">{{ $req->deceased_gender }}</div>
                            </td>
                            <td>
                                <div class="small fw-bold">{{ $req->contact_name }}</div>
                                <div class="small"><a href="tel:{{ $req->contact_phone }}" class="text-decoration-none">{{ $req->contact_phone }}</a></div>
                            </td>
                            <td>
                                @if($req->services_needed)
                                    @foreach($req->services_needed as $srv)
                                        <span class="badge bg-secondary-subtle text-dark border small me-1">{{ ucfirst($srv) }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <span class="badge 
                                    @if($req->status == 'completed') bg-success 
                                    @elseif($req->status == 'in_progress') bg-primary 
                                    @elseif($req->status == 'assigned') bg-info text-dark 
                                    @elseif($req->status == 'cancelled') bg-danger 
                                    @else bg-warning text-dark @endif">
                                    {{ strtoupper($req->status) }}
                                </span>
                            </td>
                            <td>
                                @if($req->is_mustahiq)
                                    <span class="badge bg-danger-subtle text-danger border border-danger">Mustahiq (Free)</span>
                                @else
                                    <span class="badge bg-light text-muted border">Standard</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $dashDispatchMsg = "*SAHAARA EMERGENCY DISPATCH*\n"
                                        . "Tracking ID: #" . $req->tracking_code . "\n"
                                        . "Marhoom: " . ($req->deceased_name ?? 'N/A') . " (" . ucfirst($req->deceased_gender) . ")\n"
                                        . "Services: " . implode(', ', $req->services_needed ?? []) . "\n"
                                        . "Contact: " . $req->contact_name . " (" . $req->contact_phone . ")\n"
                                        . "Pickup: " . $req->pickup_address . "\n"
                                        . ($req->destination_address ? "Destination: " . $req->destination_address . "\n" : "");
                                @endphp
                                <div class="d-flex align-items-center gap-1">
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode($dashDispatchMsg) }}" target="_blank" class="btn btn-sm btn-outline-success" title="Forward to Driver on WhatsApp">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                    <a href="{{ route('admin.requests') }}?search={{ $req->tracking_code }}" class="btn btn-sm btn-outline-primary">
                                        Manage
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Abhi tak koi emergency request nahi aayi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bottom Row: Recent Janazahs & Active Volunteers -->
    <div class="row g-4">
        <!-- Recent Janazah Announcements -->
        <div class="col-lg-6">
            <div class="card card-custom h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0"><i class="bi bi-megaphone-fill text-warning me-2"></i>Haliya Janazah Ailaanat</h5>
                    <a href="{{ route('admin.janazahs') }}" class="small text-success text-decoration-none fw-bold">View All</a>
                </div>

                <div class="list-group list-group-flush">
                    @forelse($recentJanazahs as $jnz)
                        <div class="list-group-item px-0 py-3">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h6 class="fw-bold mb-0 text-dark">{{ $jnz->deceased_name }}</h6>
                                <span class="badge bg-danger-subtle text-danger">{{ $jnz->janazah_date->format('d M') }}</span>
                            </div>
                            <div class="small text-muted mb-1"><i class="bi bi-clock me-1"></i> {{ $jnz->janazah_prayer_time }} &middot; {{ $jnz->city->name ?? '' }}</div>
                            <div class="small text-secondary"><i class="bi bi-geo-alt me-1"></i> {{ Str::limit($jnz->mosque_or_place, 45) }}</div>
                        </div>
                    @empty
                        <div class="text-muted small py-3">Koi janazah notice nahi mila.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Registered Field Providers -->
        <div class="col-lg-6">
            <div class="card card-custom h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0"><i class="bi bi-people-fill text-info me-2"></i>Field Providers / Ghassal</h5>
                    <a href="{{ route('admin.volunteers') }}" class="small text-success text-decoration-none fw-bold">Manage All</a>
                </div>

                <div class="list-group list-group-flush">
                    @forelse($volunteers as $v)
                        <div class="list-group-item px-0 py-2 d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-bold text-dark small">{{ $v->name }}</div>
                                <div class="small text-muted">{{ $v->city->name ?? '' }} &middot; {{ $v->area ?? 'General Area' }}</div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-light text-dark border small mb-1">{{ str_replace('_', ' ', ucfirst($v->service_type)) }}</span>
                                <div><a href="tel:{{ $v->phone }}" class="small text-success fw-bold text-decoration-none">{{ $v->phone }}</a></div>
                            </div>
                        </div>
                    @empty
                        <div class="text-muted small py-3">Koi volunteer register nahi hai.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
