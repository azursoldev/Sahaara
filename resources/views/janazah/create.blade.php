@extends('layouts.app')

@section('title', 'Namaz-e-Janazah Card Banayein - Sahaara')

@section('content')
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card card-custom p-4 p-md-5 border-0 shadow">
                <div class="text-center mb-4">
                    <span class="badge bg-success-subtle text-success px-3 py-1 mb-2 fw-bold">100% Muft Service</span>
                    <h3 class="fw-bold mb-1">Digital Janazah Card Maker</h3>
                    <p class="text-muted small">
                        Yeh form bharein aur chand seconds mein WhatsApp par share karne ke liye khubsoorat Islamic Janazah Card hasil karein.
                    </p>
                </div>

                <form action="{{ route('janazah.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <!-- City -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Shehar (City) <span class="text-danger">*</span></label>
                            <select name="city_id" class="form-select @error('city_id') is-invalid @enderror" required>
                                <option value="">-- Shehar Muntakhib Karein --</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }} ({{ $city->province }})
                                    </option>
                                @endforeach
                            </select>
                            @error('city_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Relation Title -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Khandan Ka Rishta (Title)</label>
                            <input type="text" name="relation_title" value="{{ old('relation_title') }}" class="form-control" placeholder="e.g. Walid-e-Mohtaram, Walida-e-Mohtarma, Bhai">
                        </div>

                        <!-- Deceased Name -->
                        <div class="col-12">
                            <label class="form-label fw-bold">Marhoom / Marhooma Ka Naam <span class="text-danger">*</span></label>
                            <input type="text" name="deceased_name" value="{{ old('deceased_name') }}" class="form-control form-control-lg @error('deceased_name') is-invalid @enderror" placeholder="e.g. Haji Muhammad Younus (Late)" required>
                            @error('deceased_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Janazah Date -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Janazah Ki Tareekh (Date) <span class="text-danger">*</span></label>
                            <input type="date" name="janazah_date" value="{{ old('janazah_date', now()->toDateString()) }}" class="form-control @error('janazah_date') is-invalid @enderror" required>
                            @error('janazah_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Prayer Time -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Namaz Ka Waqt (Prayer Time) <span class="text-danger">*</span></label>
                            <input type="text" name="janazah_prayer_time" value="{{ old('janazah_prayer_time') }}" class="form-control @error('janazah_prayer_time') is-invalid @enderror" placeholder="e.g. Baad Namaz-e-Asr (5:15 PM)" required>
                            @error('janazah_prayer_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Mosque / Place -->
                        <div class="col-12">
                            <label class="form-label fw-bold">Namaz-e-Janazah Ka Maqam (Masjid / Ground) <span class="text-danger">*</span></label>
                            <input type="text" name="mosque_or_place" value="{{ old('mosque_or_place') }}" class="form-control @error('mosque_or_place') is-invalid @enderror" placeholder="e.g. Jamia Masjid Bait-ul-Mukarram, Gulshan-e-Iqbal, Karachi" required>
                            @error('mosque_or_place') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Graveyard Name -->
                        <div class="col-12">
                            <label class="form-label fw-bold">Tadfeen Ka Qabristan (Graveyard)</label>
                            <input type="text" name="graveyard_name" value="{{ old('graveyard_name') }}" class="form-control" placeholder="e.g. Yasinabad Qabristan / Miani Sahib Qabristan">
                        </div>

                        <!-- Contact Details -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Lawahiqeen / Rabta Karne Wale Ka Naam <span class="text-danger">*</span></label>
                            <input type="text" name="family_member_name" value="{{ old('family_member_name') }}" class="form-control @error('family_member_name') is-invalid @enderror" placeholder="e.g. Muhammad Farooq (Beta)" required>
                            @error('family_member_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Rabta Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" name="contact_phone" value="{{ old('contact_phone') }}" class="form-control @error('contact_phone') is-invalid @enderror" placeholder="03XX-XXXXXXX" required>
                            @error('contact_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Additional Details -->
                        <div class="col-12">
                            <label class="form-label fw-bold">Mazeed Tafseelat / Soyem / Quran Khwani</label>
                            <textarea name="additional_details" rows="3" class="form-control" placeholder="Dua-e-Maghfirat ki darkhwast ya Soyem ka waqt...">{{ old('additional_details') }}</textarea>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary-custom btn-lg w-100 fw-bold shadow">
                            <i class="bi bi-file-earmark-check-fill me-1"></i> Digital Card Generate Karein
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
