@extends('layouts.admin')

@section('title', 'Manage Khidmaat (Services) - Sahaara Admin')

@section('content')
<div>
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1"><i class="bi bi-grid-fill text-primary me-2"></i>Khidmaat (Services & Packages)</h3>
            <p class="text-muted small mb-0">Platform par mojood tamam khidmaat, unki prices aur providers manage karein.</p>
        </div>

        <button type="button" class="btn btn-primary-custom btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#addServiceModal">
            <i class="bi bi-plus-circle me-1"></i> Nayi Service Shamil Karein
        </button>
    </div>

    <!-- Services Table -->
    <div class="card card-custom border-0 shadow-sm mb-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small text-uppercase">
                    <tr>
                        <th>Category</th>
                        <th>Service Name</th>
                        <th>Price / Cost</th>
                        <th>Provider / Trust</th>
                        <th>Contact</th>
                        <th>Availability</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $srv)
                        <tr>
                            <td>
                                <span class="badge bg-success-subtle text-success border border-success">
                                    {{ $srv->category->name ?? 'General' }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $srv->name }}</div>
                                <div class="text-muted small">{{ Str::limit($srv->description, 60) }}</div>
                            </td>
                            <td>
                                @if($srv->estimated_cost == 0)
                                    <span class="badge bg-success">Muft (Free)</span>
                                @else
                                    <span class="fw-bold text-dark">Rs. {{ number_format($srv->estimated_cost) }}</span>
                                @endif
                            </td>
                            <td>{{ $srv->provider_name ?? 'Sahaara Fleet' }}</td>
                            <td>{{ $srv->contact_phone ?? 'Helpline' }}</td>
                            <td>
                                @if($srv->is_available)
                                    <span class="badge bg-success-subtle text-success">Active</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-muted">Paused</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.services.delete', $srv->id) }}" method="POST" onsubmit="return confirm('Kya aap waqai yeh service delete karna chahte hain?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Koi service dastyab nahi hai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-white border-0 py-3">
            {{ $services->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- Add Service Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Nayi Service Add Karein</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Service Ka Naam <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. AC Ambulance Van" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Price / Estimated Cost (Rs.) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="estimated_cost" class="form-control" placeholder="0 for Free/Welfare" required>
                            <div class="form-text small">Agar muft hai toh 0 darj karein.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Provider / Welfare Trust Ka Naam</label>
                            <input type="text" name="provider_name" class="form-control" placeholder="e.g. Sahaara Ambulance Wing">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Direct Phone Number</label>
                            <input type="tel" name="contact_phone" class="form-control" placeholder="03XX-XXXXXXX">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tafseelat (Description)</label>
                            <textarea name="description" rows="3" class="form-control" placeholder="Service ki tafseelat..."></textarea>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_available" id="is_available" value="1" checked>
                            <label class="form-check-label fw-bold" for="is_available">
                                Available for Booking
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary-custom fw-bold">Save Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

