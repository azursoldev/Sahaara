@extends('layouts.admin')

@section('title', 'Manage Cities - Sahaara Admin')

@section('content')
<div>
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1"><i class="bi bi-building text-secondary me-2"></i>Shehar (General Cities Management)</h3>
            <p class="text-muted small mb-0">Pakistan ke mukhtalif shehron ka intezam taaki har shehar ke log apne shehar ki services dekh sakein.</p>
        </div>

        <button type="button" class="btn btn-primary-custom btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#addCityModal">
            <i class="bi bi-plus-circle me-1"></i> Naya Shehar Shamil Karein
        </button>
    </div>

    <!-- Cities Grid -->
    <div class="row g-3 mb-4">
        @foreach($cities as $city)
            <div class="col-md-6 col-lg-4">
                <div class="card card-custom p-4 h-100">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="fw-bold text-dark mb-0">{{ $city->name }}</h5>
                        <span class="badge bg-light text-dark border">{{ $city->province }}</span>
                    </div>

                    <div class="d-flex gap-3 my-3 py-2 border-top border-bottom small text-muted">
                        <div><i class="bi bi-grid text-primary me-1"></i> {{ $city->services_count }} Services</div>
                        <div><i class="bi bi-pin-map text-success me-1"></i> {{ $city->graveyards_count }} Qabristan</div>
                        <div><i class="bi bi-bell text-danger me-1"></i> {{ $city->service_requests_count }} Requests</div>
                    </div>

                    <div class="mt-auto d-flex justify-content-between align-items-center">
                        <span class="badge bg-success-subtle text-success">Active City</span>

                        <form action="{{ route('admin.cities.delete', $city->id) }}" method="POST" onsubmit="return confirm('Kya aap is shehar ko delete karna chahte hain?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Add City Modal -->
    <div class="modal fade" id="addCityModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.cities.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Naya Shehar Shamil Karein</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Shehar Ka Naam (City Name) <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Abbottabad, Sukkur, Bahawalpur" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Sooba (Province) <span class="text-danger">*</span></label>
                            <select name="province" class="form-select" required>
                                <option value="Sindh">Sindh</option>
                                <option value="Punjab">Punjab</option>
                                <option value="KPK">Khyber Pakhtunkhwa (KPK)</option>
                                <option value="Balochistan">Balochistan</option>
                                <option value="Federal">Islamabad Capital Territory</option>
                                <option value="AJK">Azad Jammu & Kashmir</option>
                                <option value="Gilgit-Baltistan">Gilgit-Baltistan</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success fw-bold">Save City</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
