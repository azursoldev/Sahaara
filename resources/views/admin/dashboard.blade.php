@extends('layouts.app')

@section('title', 'Admin Dashboard - Sahaara Management')

@section('content')
<div class="container-fluid px-lg-5 py-3">

    <!-- Admin Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1"><i class="bi bi-speedometer2 text-success me-2"></i>Sahaara Admin Operations</h2>
            <p class="text-muted small mb-0">Emergency requests dispatching, tracking, and volunteer network monitoring.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('requests.create') }}" class="btn btn-sos btn-sm">
                <i class="bi bi-plus-circle me-1"></i> Manual Request Add Karein
            </a>
            <a href="{{ route('janazah.create') }}" class="btn btn-primary-custom btn-sm">
                <i class="bi bi-megaphone me-1"></i> Janazah Ailaan
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card card-custom p-3 border-start border-4 border-warning">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">Pending Requests</div>
                        <h2 class="fw-bold text-warning mb-0">{{ $stats['pending_requests'] }}</h2>
                    </div>
                    <div class="rounded-3 p-3 bg-warning bg-opacity-10 text-warning fs-3">
                        <i class="bi bi-clock-history"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-custom p-3 border-start border-4 border-info">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">Assigned / In Progress</div>
                        <h2 class="fw-bold text-info mb-0">{{ $stats['assigned_requests'] }}</h2>
                    </div>
                    <div class="rounded-3 p-3 bg-info bg-opacity-10 text-info fs-3">
                        <i class="bi bi-truck"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-custom p-3 border-start border-4 border-success">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">Completed Services</div>
                        <h2 class="fw-bold text-success mb-0">{{ $stats['completed_requests'] }}</h2>
                    </div>
                    <div class="rounded-3 p-3 bg-success bg-opacity-10 text-success fs-3">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-custom p-3 border-start border-4 border-danger">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">Mustahiq (Free Support)</div>
                        <h2 class="fw-bold text-danger mb-0">{{ $stats['mustahiq_requests'] }}</h2>
                    </div>
                    <div class="rounded-3 p-3 bg-danger bg-opacity-10 text-danger fs-3">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Requests Table -->
    <div class="card card-custom border-0 shadow-sm mb-5">
        <div class="card-header bg-white py-3 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h5 class="fw-bold mb-0">Emergency Service Requests (Ambulance, Ghusl, Kafan, Qabar)</h5>

            <!-- Status Filters -->
            <div class="btn-group btn-group-sm">
                <a href="{{ route('admin.dashboard') }}" class="btn {{ !$statusFilter ? 'btn-success' : 'btn-outline-secondary' }}">All ({{ $stats['total_requests'] }})</a>
                <a href="{{ route('admin.dashboard', ['status' => 'pending']) }}" class="btn {{ $statusFilter == 'pending' ? 'btn-warning' : 'btn-outline-secondary' }}">Pending</a>
                <a href="{{ route('admin.dashboard', ['status' => 'assigned']) }}" class="btn {{ $statusFilter == 'assigned' ? 'btn-info' : 'btn-outline-secondary' }}">Assigned</a>
                <a href="{{ route('admin.dashboard', ['status' => 'completed']) }}" class="btn {{ $statusFilter == 'completed' ? 'btn-success' : 'btn-outline-secondary' }}">Completed</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small text-uppercase">
                    <tr>
                        <th>Tracking ID</th>
                        <th>City / Shehar</th>
                        <th>Marhoom Info</th>
                        <th>Rabta (Contact)</th>
                        <th>Khidmaat (Services)</th>
                        <th>Status</th>
                        <th>Welfare</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $req)
                        <tr>
                            <td>
                                <a href="{{ route('requests.show', $req->tracking_code) }}" class="fw-bold text-success text-decoration-none" target="_blank">
                                    {{ $req->tracking_code }} <i class="bi bi-box-arrow-up-right small"></i>
                                </a>
                                <div class="text-muted" style="font-size: 0.75rem;">
                                    {{ $req->created_at->diffForHumans() }}
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $req->city->name ?? 'General' }}</span>
                            </td>
                            <td>
                                <div class="fw-bold small">{{ $req->deceased_name ?? 'N/A' }}</div>
                                <div class="text-muted small text-capitalize">{{ $req->deceased_gender }}</div>
                            </td>
                            <td>
                                <div class="small fw-bold">{{ $req->contact_name }}</div>
                                <div class="small">
                                    <a href="tel:{{ $req->contact_phone }}" class="text-decoration-none">{{ $req->contact_phone }}</a>
                                </div>
                            </td>
                            <td>
                                @if($req->services_needed)
                                    @foreach($req->services_needed as $srv)
                                        <span class="badge bg-secondary-subtle text-dark border small me-1 mb-1">{{ ucfirst($srv) }}</span>
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
                                <!-- Quick Status Update Modal Button -->
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#updateModal{{ $req->id }}">
                                    <i class="bi bi-pencil-square"></i> Update
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="updateModal{{ $req->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.requests.update-status', $req->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h6 class="modal-title fw-bold">Update Request #{{ $req->tracking_code }}</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Request Status</label>
                                                        <select name="status" class="form-select">
                                                            <option value="pending" {{ $req->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="assigned" {{ $req->status == 'assigned' ? 'selected' : '' }}>Assigned (Driver/Ghassal Dispatched)</option>
                                                            <option value="in_progress" {{ $req->status == 'in_progress' ? 'selected' : '' }}>In Progress (On The Way)</option>
                                                            <option value="completed" {{ $req->status == 'completed' ? 'selected' : '' }}>Completed (Done)</option>
                                                            <option value="cancelled" {{ $req->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Admin Remarks / Driver & Ghassal Notes</label>
                                                        <textarea name="admin_remarks" rows="3" class="form-control" placeholder="e.g. Driver Aslam (Ambulance # 442, 0300-XXXXXXX) dispatched. Reaching in 20 mins.">{{ $req->admin_remarks }}</textarea>
                                                        <div class="form-text small">Yeh note user ke tracking page par bhi nazar aayega.</div>
                                                    </div>

                                                    <div class="p-2 bg-light rounded small">
                                                        <div><strong>Pickup:</strong> {{ $req->pickup_address }}</div>
                                                        @if($req->destination_address)
                                                            <div><strong>Destination:</strong> {{ $req->destination_address }}</div>
                                                        @endif
                                                        @if($req->notes)
                                                            <div class="text-danger mt-1"><strong>User Note:</strong> {{ $req->notes }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success fw-bold">Save Status</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                Koi service request nahi mili.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-white border-0 py-3">
            {{ $requests->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- Active Field Providers / Volunteers -->
    <div class="card card-custom border-0 p-4 shadow-sm mb-4">
        <h5 class="fw-bold mb-3"><i class="bi bi-people-fill text-success me-2"></i>Field Providers & Volunteers (Ghassal, Drivers, Gor-kan)</h5>
        <div class="row g-3">
            @foreach($volunteers as $v)
                <div class="col-md-4">
                    <div class="p-3 border rounded-3 bg-light">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <h6 class="fw-bold mb-0 text-dark">{{ $v->name }}</h6>
                            <span class="badge bg-success-subtle text-success small">{{ str_replace('_', ' ', ucfirst($v->service_type)) }}</span>
                        </div>
                        <div class="small text-muted mb-2">
                            <i class="bi bi-geo-alt me-1"></i> {{ $v->city->name ?? 'City' }} ({{ $v->area ?? 'General' }})
                        </div>
                        <div class="small">
                            <i class="bi bi-telephone text-primary me-1"></i> <a href="tel:{{ $v->phone }}" class="text-decoration-none fw-bold">{{ $v->phone }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
