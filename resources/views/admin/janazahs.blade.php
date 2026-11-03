@extends('layouts.admin')

@section('title', 'Manage Janazah Announcements - Sahaara Admin')

@section('content')
<div>
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1"><i class="bi bi-megaphone-fill text-warning me-2"></i>Namaz-e-Janazah Ailaanat</h3>
            <p class="text-muted small mb-0">Platform par banaye gaye tamam digital janazah cards aur notices ki fehrist.</p>
        </div>

        <a href="{{ route('janazah.create') }}" class="btn btn-warning btn-sm fw-bold text-dark" target="_blank">
            <i class="bi bi-plus-circle me-1"></i> Naya Janazah Card Banayein
        </a>
    </div>

    <!-- Janazahs Table -->
    <div class="card card-custom border-0 shadow-sm mb-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small text-uppercase">
                    <tr>
                        <th>Code</th>
                        <th>Marhoom / Deceased</th>
                        <th>Tareekh & Waqt</th>
                        <th>Maqam (Mosque / Place)</th>
                        <th>Tadfeen</th>
                        <th>Rabta (Family)</th>
                        <th>Views</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($janazahs as $j)
                        <tr>
                            <td>
                                <span class="badge bg-secondary-subtle text-dark">{{ $j->unique_code }}</span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $j->deceased_name }}</div>
                                @if($j->relation_title)
                                    <div class="text-muted small">({{ $j->relation_title }})</div>
                                @endif
                                <span class="badge bg-light text-muted border small">{{ $j->city->name ?? '' }}</span>
                            </td>
                            <td>
                                <div class="fw-bold small text-danger">{{ $j->janazah_date->format('d M, Y') }}</div>
                                <div class="small text-muted">{{ $j->janazah_prayer_time }}</div>
                            </td>
                            <td class="small">{{ $j->mosque_or_place }}</td>
                            <td class="small text-muted">{{ $j->graveyard_name ?? 'N/A' }}</td>
                            <td>
                                <div class="small fw-bold">{{ $j->family_member_name }}</div>
                                <div class="small"><a href="tel:{{ $j->contact_phone }}" class="text-decoration-none">{{ $j->contact_phone }}</a></div>
                            </td>
                            <td>
                                <span class="badge bg-light text-secondary border"><i class="bi bi-eye"></i> {{ $j->views }}</span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('janazah.show', $j->unique_code) }}" class="btn btn-sm btn-outline-success" target="_blank" title="View Card">
                                        <i class="bi bi-box-arrow-up-right"></i>
                                    </a>
                                    <form action="{{ route('admin.janazahs.delete', $j->id) }}" method="POST" onsubmit="return confirm('Kya aap waqai yeh ailaan delete karna chahte hain?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Koi janazah notice nahi mila.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-white border-0 py-3">
            {{ $janazahs->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
