@extends('layouts.admin')

@section('title', 'Manage Qabristan Directory - Sahaara Admin')

@section('content')
<div>
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1"><i class="bi bi-pin-map-fill text-success me-2"></i>Qabristan Directory Management</h3>
            <p class="text-muted small mb-0">Mukhtalif shehron ke qabristan, unke Gor-kan aur committee contacts manage karein.</p>
        </div>

        <button type="button" class="btn btn-primary-custom btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#addGraveyardModal">
            <i class="bi bi-plus-circle me-1"></i> Naya Qabristan Add Karein
        </button>
    </div>

    <!-- Graveyards Table -->
    <div class="card card-custom border-0 shadow-sm mb-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small text-uppercase">
                    <tr>
                        <th>City</th>
                        <th>Qabristan Name</th>
                        <th>Address / Area</th>
                        <th>Phone / Committee</th>
                        <th>Space Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($graveyards as $g)
                        <tr>
                            <td><span class="badge bg-light text-dark border">{{ $g->city->name ?? 'General' }}</span></td>
                            <td class="fw-bold text-success">{{ $g->name }}</td>
                            <td class="small text-muted">{{ $g->address }}</td>
                            <td>
                                @if($g->phone)
                                    <a href="tel:{{ $g->phone }}" class="text-decoration-none fw-bold small text-dark">{{ $g->phone }}</a>
                                @else
                                    <span class="text-muted small">Direct Gate Office</span>
                                @endif
                            </td>
                            <td>
                                @if($g->has_space)
                                    <span class="badge bg-success-subtle text-success">Jagah Dastiyab</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger">Limited / Full</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.graveyards.delete', $g->id) }}" method="POST" onsubmit="return confirm('Kya aap waqai yeh qabristan delete karna chahte hain?');">
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
                            <td colspan="6" class="text-center py-4 text-muted">Koi qabristan list nahi hai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-white border-0 py-3">
            {{ $graveyards->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- Add Graveyard Modal -->
    <div class="modal fade" id="addGraveyardModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.graveyards.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Naya Qabristan Add Karein</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Shehar (City) <span class="text-danger">*</span></label>
                            <select name="city_id" class="form-select" required>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }} ({{ $city->province }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Qabristan Ka Naam <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Sakhi Hassan Qabristan" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Mukammal Pata (Address) <span class="text-danger">*</span></label>
                            <input type="text" name="address" class="form-control" placeholder="e.g. Block N, North Nazimabad" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Rabta Phone Number</label>
                            <input type="tel" name="phone" class="form-control" placeholder="021-3XXXXXXX ya 03XX-XXXXXXX">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Contact Person / Gor-kan Head</label>
                            <input type="text" name="contact_person" class="form-control" placeholder="e.g. Gor-kan Committee Incharge">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Zaroori Notes / Hidayat</label>
                            <textarea name="notes" rows="2" class="form-control" placeholder="Computerized record, Gate timings waghera..."></textarea>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="has_space" id="has_space" value="1" checked>
                            <label class="form-check-label fw-bold" for="has_space">
                                Jagah Dastiyab Hai (Has Space)
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success fw-bold">Save Qabristan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

