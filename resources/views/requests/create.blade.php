@extends('layouts.app')

@section('title', 'Fauri Madad (Emergency Request) - Sahaara')

@section('content')
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            @php
                // Handle preselection cleanly
                $selectedServices = old('services_needed');
                if ($selectedServices === null) {
                    if (!empty($preselectedService)) {
                        $selectedServices = [$preselectedService];
                    } else {
                        $selectedServices = ['ambulance']; // Default if general SOS
                    }
                }
            @endphp

            <!-- Header Banner -->
            <div class="text-white rounded-4 p-4 mb-4 shadow-sm position-relative overflow-hidden" 
                 style="background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-white text-danger p-3 d-flex align-items-center justify-content-center fs-2 shadow-sm" style="width: 60px; height: 60px;">
                        <i class="bi bi-bell-fill"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-1">Fauri Madad Form (Emergency Request)</h3>
                        <p class="mb-0 text-white-50 small">
                            Ambulance, Ghassal, Kafan Box ya Qabar intezam ke liye niche diya gaya form bharein. Hamari team foran rabta karegi.
                        </p>
                    </div>
                </div>
            </div>

            <form action="{{ route('requests.store') }}" method="POST" class="card card-custom p-4 p-md-5 border-0 shadow">
                @csrf

                <!-- Section 1: Services Selection -->
                <div class="mb-4">
                    <h5 class="fw-bold text-primary border-bottom pb-2 mb-3">
                        <i class="bi bi-check2-square me-2"></i> 1. Aapko Kin Khidmaat Ki Zaroorat Hai? (Select Services)
                    </h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-check p-3 border rounded-3 bg-light h-100">
                                <input class="form-check-input ms-0 me-3" type="checkbox" name="services_needed[]" value="ambulance" id="srv_ambulance" 
                                    {{ in_array('ambulance', $selectedServices) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold d-block" for="srv_ambulance">
                                    <i class="bi bi-truck-front-fill text-danger me-1"></i> Ambulance / Hearse Van
                                    <span class="d-block small text-muted fw-normal">Hospital se ghar ya ghar se janazah/qabristan muntaqili.</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check p-3 border rounded-3 bg-light h-100">
                                <input class="form-check-input ms-0 me-3" type="checkbox" name="services_needed[]" value="ghusl" id="srv_ghusl" 
                                    {{ in_array('ghusl', $selectedServices) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold d-block" for="srv_ghusl">
                                    <i class="bi bi-droplet-half text-primary me-1"></i> Ghusl & Ghassal (Mard / Aurat)
                                    <span class="d-block small text-muted fw-normal">Ba-shara trained ghassal ghar par ya markazi ghusl-khana.</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check p-3 border rounded-3 bg-light h-100">
                                <input class="form-check-input ms-0 me-3" type="checkbox" name="services_needed[]" value="kafan" id="srv_kafan" 
                                    {{ in_array('kafan', $selectedServices) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold d-block" for="srv_kafan">
                                    <i class="bi bi-box-seam-fill text-secondary me-1"></i> Kafan & Tajheez Saman Box
                                    <span class="d-block small text-muted fw-normal">Lattha kapra, Kafoor, Gulab Arq, Itar, Sabun, Bardana.</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check p-3 border rounded-3 bg-light h-100">
                                <input class="form-check-input ms-0 me-3" type="checkbox" name="services_needed[]" value="qabar" id="srv_qabar" 
                                    {{ in_array('qabar', $selectedServices) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold d-block" for="srv_qabar">
                                    <i class="bi bi-layers-fill text-dark me-1"></i> Qabar & Gor-kan Intezamat
                                    <span class="d-block small text-muted fw-normal">Qabar ki khudaai, cement ke paat (slabs), eentein, takhti.</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    @error('services_needed')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Section 2: City & Marhoom Details -->
                <div class="mb-4">
                    <h5 class="fw-bold text-primary border-bottom pb-2 mb-3">
                        <i class="bi bi-person-heart me-2"></i> 2. Shehar & Marhoom/Marhooma Ki Maloomat
                    </h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Shehar (City) <span class="text-danger">*</span></label>
                            <select name="city_id" class="form-select form-select-lg @error('city_id') is-invalid @enderror" required>
                                <option value="">-- Shehar Muntakhib Karein --</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }} ({{ $city->province }})
                                    </option>
                                @endforeach
                            </select>
                            @error('city_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Jins (Gender) <span class="text-danger">*</span></label>
                            <select name="deceased_gender" class="form-select form-select-lg @error('deceased_gender') is-invalid @enderror" required>
                                <option value="male" {{ old('deceased_gender') == 'male' ? 'selected' : '' }}>Mard (Male) - Ghassal/Kafan</option>
                                <option value="female" {{ old('deceased_gender') == 'female' ? 'selected' : '' }}>Aurat (Female) - Khatoon Ghassala/5-pc Kafan</option>
                                <option value="child" {{ old('deceased_gender') == 'child' ? 'selected' : '' }}>Bacha / Masoom (Child)</option>
                                <option value="unspecified" {{ old('deceased_gender') == 'unspecified' ? 'selected' : '' }}>Baad Mein Batayein (Unspecified)</option>
                            </select>
                            @error('deceased_gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Marhoom / Marhooma Ka Naam (Optional)</label>
                            <input type="text" name="deceased_name" value="{{ old('deceased_name') }}" class="form-control" placeholder="Marhoom ka mukammal naam (e.g. Haji Muhammad Aslam)">
                        </div>
                    </div>
                </div>

                <!-- Section 3: Contact Person Details -->
                <div class="mb-4">
                    <h5 class="fw-bold text-primary border-bottom pb-2 mb-3">
                        <i class="bi bi-telephone-fill me-2"></i> 3. Rabta Karne Wale Ki Maloomat (Contact Person)
                    </h5>

                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label fw-bold">Aapka Naam <span class="text-danger">*</span></label>
                            <input type="text" name="contact_name" value="{{ old('contact_name') }}" class="form-control @error('contact_name') is-invalid @enderror" placeholder="Aapka pura naam" required>
                            @error('contact_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Mobile Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" name="contact_phone" value="{{ old('contact_phone') }}" class="form-control @error('contact_phone') is-invalid @enderror" placeholder="03XX-XXXXXXX" required>
                            <div class="form-text small text-muted">Is number par hamara representative foran call karega.</div>
                            @error('contact_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Marhoom Se Rishta</label>
                            <input type="text" name="contact_relation" value="{{ old('contact_relation') }}" class="form-control" placeholder="Beta, Bhai, Rishtedaar waghera">
                        </div>
                    </div>
                </div>

                <!-- Section 4: Address / Location -->
                <div class="mb-4">
                    <h5 class="fw-bold text-primary border-bottom pb-2 mb-3">
                        <i class="bi bi-geo-alt-fill me-2"></i> 4. Pata (Location / Address)
                    </h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Pickup Address (Ghar ya Hospital) <span class="text-danger">*</span></label>
                            <textarea name="pickup_address" rows="3" class="form-control @error('pickup_address') is-invalid @enderror" 
                                      placeholder="Makan number, Gali, Area ya Hospital ka naam jahan se maiyat leni hai..." required>{{ old('pickup_address') }}</textarea>
                            @error('pickup_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Destination Address (Qabristan ya Masjid)</label>
                            <textarea name="destination_address" rows="3" class="form-control" 
                                      placeholder="Qabristan ya Masjid ka naam jahan tadfeen ya janazah hona hai (agar maloom ho)...">{{ old('destination_address') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Section 5: Welfare / Mustahiq Support -->
                <div class="mb-4 p-3 rounded-3 border border-primary bg-primary bg-opacity-10">
                    <div class="form-check form-switch fs-5">
                        <input class="form-check-input" type="checkbox" role="switch" name="is_mustahiq" id="is_mustahiq" value="1" 
                            {{ old('is_mustahiq') || request()->query('mustahiq') ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold text-primary" for="is_mustahiq">
                            Mustahiq Imdaad (Free Support Chahiye)
                        </label>
                    </div>
                    <div class="small text-muted mt-2">
                        Agar aap ya mutalliqah khandan kharcha bardasht karne ki isteta'at nahi rakhta, toh bilkul na ghabrayein. "Sahaara Welfare Fund" aur hamare aizaazi shuraka ke tehat ye tamam khidmaat bilkul <strong>muft (free)</strong> faraham ki jayengi.
                    </div>
                </div>

                <!-- Section 6: Additional Notes -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Mazeed Hidayat / Khas Zaroorat (Optional)</label>
                    <textarea name="notes" rows="2" class="form-control" placeholder="Waqt ki pabandi, stretcher ki zaroorat, ya koi aur zaroori baat...">{{ old('notes') }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-sos btn-lg py-3 fw-bold fs-5 shadow">
                        <i class="bi bi-send-fill me-2"></i> Request Submit Karein (Foran Rabta Hoga)
                    </button>
                    <div class="text-center small text-muted mt-2">
                        <i class="bi bi-shield-lock-fill text-primary"></i> Aapki maloomat mehfooz hain aur sirf zaroori helpline & providers ko assign hongi.
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
