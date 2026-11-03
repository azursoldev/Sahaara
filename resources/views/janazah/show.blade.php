@extends('layouts.app')

@section('title', 'Namaz-e-Janazah: ' . $announcement->deceased_name . ' - Sahaara')

@push('styles')
<style>
    @media print {
        .no-print {
            display: none !important;
        }
        body {
            background-color: white !important;
        }
        .janazah-card {
            box-shadow: none !important;
            border: 2px solid #1e3a8a !important;
        }
    }

    .janazah-card {
        background: #ffffff;
        border: 3px double #d97706;
        border-radius: 18px;
        position: relative;
        overflow: hidden;
    }

    .ornament-corner {
        position: absolute;
        width: 40px;
        height: 40px;
        border-color: #d97706;
        border-style: solid;
    }
    .top-left { top: 10px; left: 10px; border-width: 3px 0 0 3px; }
    .top-right { top: 10px; right: 10px; border-width: 3px 3px 0 0; }
    .bottom-left { bottom: 10px; left: 10px; border-width: 0 0 3px 3px; }
    .bottom-right { bottom: 10px; right: 10px; border-width: 0 3px 3px 0; }
</style>
@endpush

@section('content')
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- Action Bar (Top) -->
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3 no-print">
                <a href="{{ route('janazah.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Tamam Ailaanat
                </a>

                <div class="d-flex flex-wrap gap-2">
                    <!-- Download Card as Image (PNG) Button -->
                    <button type="button" id="btnDownloadImage" class="btn btn-primary btn-sm fw-bold shadow-sm" style="background-color: #1e3a8a; border: none;">
                        <i class="bi bi-download me-1"></i> Card Image Download Karein (PNG)
                    </button>

                    <button onclick="window.print()" class="btn btn-outline-dark btn-sm">
                        <i class="bi bi-printer-fill me-1"></i> Print / PDF
                    </button>

                    @php
                        $shareText = "Namaz-e-Janazah Ailaan:\n\n"
                            . "Marhoom: " . $announcement->deceased_name . ($announcement->relation_title ? " (" . $announcement->relation_title . ")" : "") . "\n"
                            . "Tareekh: " . $announcement->janazah_date->format('d M, Y') . "\n"
                            . "Waqt: " . $announcement->janazah_prayer_time . "\n"
                            . "Maqam: " . $announcement->mosque_or_place . "\n"
                            . ($announcement->graveyard_name ? "Tadfeen: " . $announcement->graveyard_name . "\n" : "")
                            . "Rabta: " . $announcement->family_member_name . " (" . $announcement->contact_phone . ")\n\n"
                            . "Card Link: " . route('janazah.show', $announcement->unique_code) . "\n\n"
                            . "Dua-e-Maghfirat ki darkhwast hai.";
                    @endphp

                    <a href="https://api.whatsapp.com/send?text={{ urlencode($shareText) }}" target="_blank" class="btn btn-success btn-sm fw-bold">
                        <i class="bi bi-whatsapp me-1"></i> WhatsApp
                    </a>
                </div>
            </div>

            <!-- Islamic Janazah Card (Capture Target) -->
            <div id="janazahCardToDownload" class="janazah-card p-4 p-md-5 shadow-lg position-relative bg-white">
                <div class="ornament-corner top-left"></div>
                <div class="ornament-corner top-right"></div>
                <div class="ornament-corner bottom-left"></div>
                <div class="ornament-corner bottom-right"></div>

                <div class="text-center mb-4">
                    <div class="font-arabic fs-4 text-secondary mb-1">
                        بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
                    </div>
                    <div class="font-arabic fs-3 text-primary fw-bold mb-1">
                        كُلُّ نَفۡسٍ ذَآئِقَۃُ الۡمَوۡتِ ؕ
                    </div>
                    <div class="font-arabic fs-2 text-danger fw-bold mb-3">
                        إِنَّا لِلَّٰهِ وَإِنَّا إِلَيْهِ رَاجِعُونَ
                    </div>
                    <div class="badge bg-secondary-subtle text-dark px-3 py-1">
                        Janazah Card Code: {{ $announcement->unique_code }}
                    </div>
                </div>

                <!-- Announcement Body -->
                <div class="text-center mb-4">
                    <p class="text-muted small mb-2">Afsos-naak ailaan kiya jata hai ke hamare azeez</p>
                    
                    <h2 class="fw-bold text-dark mb-1" style="color: #1e3a8a !important;">
                        {{ $announcement->deceased_name }}
                    </h2>

                    @if($announcement->relation_title)
                        <h5 class="text-muted fst-italic mb-3">
                            ({{ $announcement->relation_title }})
                        </h5>
                    @endif

                    <p class="text-muted small">
                        Raza-e-Ilahi se wafat pa gaye hain. Unki Namaz-e-Janazah ki tafseelat darj zail hain:
                    </p>
                </div>

                <!-- Schedule Details Box -->
                <div class="bg-light p-4 rounded-4 border mb-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-danger bg-opacity-10 text-danger p-3 fs-4">
                                    <i class="bi bi-calendar-event"></i>
                                </div>
                                <div>
                                    <div class="small text-muted fw-bold">Tareekh (Date)</div>
                                    <div class="fw-bold fs-5 text-dark">{{ $announcement->janazah_date->format('l, d F Y') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-warning bg-opacity-10 text-warning p-3 fs-4">
                                    <i class="bi bi-clock-fill"></i>
                                </div>
                                <div>
                                    <div class="small text-muted fw-bold">Namaz Ka Waqt (Time)</div>
                                    <div class="fw-bold fs-5 text-dark">{{ $announcement->janazah_prayer_time }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 border-top pt-3">
                            <div class="d-flex align-items-start gap-3">
                                <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-3 fs-4">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div>
                                    <div class="small text-muted fw-bold">Namaz-e-Janazah Ka Maqam (Location)</div>
                                    <div class="fw-bold text-dark fs-6">{{ $announcement->mosque_or_place }}</div>
                                    <div class="small text-muted">{{ $announcement->city->name ?? '' }}</div>
                                </div>
                            </div>
                        </div>

                        @if($announcement->graveyard_name)
                            <div class="col-12 border-top pt-3">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="rounded-circle bg-secondary bg-opacity-10 text-secondary p-3 fs-4">
                                        <i class="bi bi-layers-fill"></i>
                                    </div>
                                    <div>
                                        <div class="small text-muted fw-bold">Tadfeen (Graveyard)</div>
                                        <div class="fw-bold text-dark fs-6">{{ $announcement->graveyard_name }}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Additional Instructions / Soyem -->
                @if($announcement->additional_details)
                    <div class="p-3 bg-white border border-secondary border-opacity-25 rounded-3 mb-4">
                        <div class="small fw-bold text-primary mb-1"><i class="bi bi-info-circle me-1"></i> Mazeed Maloomat / Soyem:</div>
                        <div class="text-secondary small">{{ $announcement->additional_details }}</div>
                    </div>
                @endif

                <!-- Family Contact -->
                <div class="pt-3 border-top text-center">
                    <div class="small text-muted mb-1">Dua-e-Maghfirat ke talabgaar:</div>
                    <div class="fw-bold text-dark fs-6">{{ $announcement->family_member_name }}</div>
                    <div class="small">
                        <i class="bi bi-telephone-fill text-primary me-1"></i>
                        <a href="tel:{{ $announcement->contact_phone }}" class="text-decoration-none text-primary fw-bold">
                            {{ $announcement->contact_phone }}
                        </a>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top text-center small text-muted">
                    <i class="bi bi-shield-heart me-1"></i> Sahaara - Free Janazah Notice & Community Assistance
                </div>
            </div>

            <!-- Share Bottom Bar -->
            <div class="mt-4 text-center no-print">
                <button class="btn btn-outline-secondary btn-sm me-2" onclick="navigator.clipboard.writeText(window.location.href); alert('Card Link Copied!');">
                    <i class="bi bi-link-45deg me-1"></i> Card Link Copy Karein
                </button>
                <a href="{{ route('janazah.create') }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Ek Aur Janazah Card Banayein
                </a>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- html2canvas for Image Generation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    document.getElementById('btnDownloadImage').addEventListener('click', function() {
        const btn = this;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Image Tayyar Ho Rahi Hai...';
        btn.disabled = true;

        const cardElement = document.getElementById('janazahCardToDownload');

        html2canvas(cardElement, {
            scale: 2, // High resolution for mobile screens
            useCORS: true,
            backgroundColor: '#ffffff'
        }).then(function(canvas) {
            // Create download link
            const image = canvas.toDataURL('image/png');
            const link = document.createElement('a');
            const cleanName = '{{ Str::slug($announcement->deceased_name) }}' || 'janazah-card';
            link.download = cleanName + '-card.png';
            link.href = image;
            link.click();

            btn.innerHTML = '<i class="bi bi-check2-circle me-1"></i> Downloaded!';
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;
            }, 2500);
        }).catch(function(err) {
            console.error('Error creating card image:', err);
            alert('Image generate karne mein masla hua. Aap screenshot le sakte hain ya PDF print kar sakte hain.');
            btn.innerHTML = originalText;
            btn.disabled = false;
        });
    });
</script>
@endpush
