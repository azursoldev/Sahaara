@extends('layouts.admin')

@section('title', 'Emergency Service Requests - Sahaara Admin')

@section('content')
<div>
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1"><i class="bi bi-bell-fill text-danger me-2"></i>Emergency Service Requests</h3>
            <p class="text-muted small mb-0">Ambulance, Ghusl, Kafan Box, aur Qabar khudaai ki tamam mosool shuda requests.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('requests.create') }}" class="btn btn-danger btn-sm fw-bold" target="_blank">
                <i class="bi bi-plus-circle me-1"></i> New Request Form
            </a>
        </div>
    </div>

    <!-- Filter Bar & Search -->
    <div class="card card-custom p-3 mb-4">
        <form action="{{ route('admin.requests') }}" method="GET">
            <div class="row g-2 align-items-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Search by Tracking Code, Name, Phone...">
                    </div>
                </div>

                <div class="col-md-4">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">Tamam Status (All Requests)</option>
                        <option value="pending" {{ $statusFilter == 'pending' ? 'selected' : '' }}>Pending ({{ $pendingCount }})</option>
                        <option value="assigned" {{ $statusFilter == 'assigned' ? 'selected' : '' }}>Assigned</option>
                        <option value="in_progress" {{ $statusFilter == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ $statusFilter == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $statusFilter == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary-custom w-100">
                        <i class="bi bi-funnel"></i> Apply
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Requests Table -->
    <div class="card card-custom border-0 shadow-sm mb-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small text-uppercase">
                    <tr>
                        <th>Tracking ID</th>
                        <th>City</th>
                        <th>Marhoom Info</th>
                        <th>Contact Person</th>
                        <th>Services Needed</th>
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
                                <div class="text-muted" style="font-size: 0.72rem;">{{ $req->created_at->format('d M, h:i A') }}</div>
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ $req->city->name ?? 'General' }}</span></td>
                            <td>
                                <div class="fw-bold small">{{ $req->deceased_name ?? 'N/A' }}</div>
                                <div class="text-muted small text-capitalize">{{ $req->deceased_gender }}</div>
                            </td>
                            <td>
                                <div class="small fw-bold">{{ $req->contact_name }} ({{ $req->contact_relation ?? 'Family' }})</div>
                                <div class="small"><a href="tel:{{ $req->contact_phone }}" class="text-decoration-none fw-bold text-success">{{ $req->contact_phone }}</a></div>
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
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $req->id }}">
                                    <i class="bi bi-pencil-square"></i> Update / Dispatch
                                </button>

                                <!-- Update Modal -->
                                <div class="modal fade" id="editModal{{ $req->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.requests.update-status', $req->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title fw-bold">Manage Request #{{ $req->tracking_code }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="p-3 bg-light rounded-3 mb-3 small">
                                                        <div><strong>Pickup Address:</strong> {{ $req->pickup_address }}</div>
                                                        @if($req->destination_address)
                                                            <div><strong>Destination:</strong> {{ $req->destination_address }}</div>
                                                        @endif
                                                        @if($req->notes)
                                                            <div class="text-danger mt-1"><strong>User Notes:</strong> {{ $req->notes }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Status Tabdeel Karein</label>
                                                        <select name="status" class="form-select">
                                                            <option value="pending" {{ $req->status == 'pending' ? 'selected' : '' }}>Pending (Nayi Darkhwast)</option>
                                                            <option value="assigned" {{ $req->status == 'assigned' ? 'selected' : '' }}>Assigned (Driver/Ghassal Muntakhib)</option>
                                                            <option value="in_progress" {{ $req->status == 'in_progress' ? 'selected' : '' }}>In Progress (Gaari Rawan Dawan Hai)</option>
                                                            <option value="completed" {{ $req->status == 'completed' ? 'selected' : '' }}>Completed (Kaam Mukammal)</option>
                                                            <option value="cancelled" {{ $req->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Admin Remarks / Driver & Ghassal Info</label>
                                                        <textarea name="admin_remarks" rows="3" class="form-control" placeholder="e.g. Driver Aslam (Ambulance # 442, Phone: 0300-XXXXXXX) dispatched.">{{ $req->admin_remarks }}</textarea>
                                                        <div class="form-text small text-muted">Yeh note user ke tracking page par nazar aayega.</div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success fw-bold">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">Koi emergency request nahi mili.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-white border-0 py-3">
            {{ $requests->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection

