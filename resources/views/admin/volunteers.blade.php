@extends('layouts.admin')

@section('title', 'Manage Field Providers & Volunteers - Sahaara Admin')

@section('content')
<div>
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1"><i class="bi bi-people-fill text-info me-2"></i>Field Providers & Volunteers</h3>
            <p class="text-muted small mb-0">Tajurbakar Mard/Aurat Ghassal, Ambulance Drivers, aur Gor-kan ki team manage karein.</p>
        </div>

        <button type="button" class="btn btn-primary-custom btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#addVolunteerModal">
            <i class="bi bi-plus-circle me-1"></i> Naya Provider / Ghassal Register Karein
        </button>
    </div>

    <!-- Volunteers Table -->
    <div class="card card-custom border-0 shadow-sm mb-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small text-uppercase">
                    <tr>
                        <th>City</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Khidmat Type (Role)</th>
                        <th>Designated Area</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($volunteers as $v)
                        <tr>
                            <td><span class="badge bg-light text-dark border">{{ $v->city->name ?? 'General' }}</span></td>
                            <td class="fw-bold text-dark">{{ $v->name }}</td>
                            <td>
                                <a href="tel:{{ $v->phone }}" class="text-decoration-none fw-bold text-success">{{ $v->phone }}</a>
                            </td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary">
                                    {{ str_replace('_', ' ', ucfirst($v->service_type)) }}
                                </span>
                            </td>
                            <td class="small text-muted">{{ $v->area ?? 'Across City' }}</td>
                            <td>
                                <span class="badge bg-success-subtle text-success">Active & Verified</span>
                            </td>
                            <td>
                                <form action="{{ route('admin.volunteers.delete', $v->id) }}" method="POST" onsubmit="return confirm('Kya aap is provider ko remove karna chahte hain?');">
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
                            <td colspan="7" class="text-center py-4 text-muted">Koi field provider dastyab nahi hai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-white border-0 py-3">
            {{ $volunteers->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- Add Volunteer Modal -->
    <div class="modal fade" id="addVolunteerModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.volunteers.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Naya Provider Register Karein</h5>
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
                            <label class="form-label fw-bold">Pura Naam <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Qari Abdul Rehman" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" name="phone" class="form-control" placeholder="03XX-XXXXXXX" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Khidmat Type (Role) <span class="text-danger">*</span></label>
                            <select name="service_type" class="form-select" required>
                                <option value="ghassal_male">Male Ghassal (Mard Ba-Shara)</option>
                                <option value="ghassal_female">Female Ghassal (Khatoon Ghassala)</option>
                                <option value="driver">Ambulance / Hearse Driver</option>
                                <option value="gor_kan">Gor-kan (Qabar Digging Incharge)</option>
                                <option value="volunteer">General Welfare Volunteer</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Area / Towns Covered</label>
                            <input type="text" name="area" class="form-control" placeholder="e.g. Gulshan, Nazimabad, PECHS">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success fw-bold">Register Provider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

