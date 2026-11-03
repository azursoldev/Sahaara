@extends('layouts.app')

@section('title', 'Inteqal Ke Waqt Rehnumai (Step-by-Step Guide) - Sahaara')

@section('content')
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <!-- Guide Header -->
            <div class="card card-custom border-0 p-4 p-md-5 mb-4 text-white" style="background: linear-gradient(135deg, #0b1528, #172a45, #1e3a8a); box-shadow: 0 10px 30px rgba(15, 23, 42, 0.2);">
                <div class="text-center">
                    <div class="font-arabic fs-3 text-warning mb-2">إِنَّا لِلَّٰهِ وَإِنَّا إِلَيْهِ رَاجِعُونَ</div>
                    <h2 class="fw-bold mb-2">Inteqal Ke Baad Pehle Kya Karein?</h2>
                    <p class="text-white-50 small mb-0">
                        Mushkil aur gham-zada waqt mein lawahiqeen ke liye aasan aur tarteeb-waar rehnumai.
                    </p>
                </div>
            </div>

            <!-- Steps List -->
            <div class="card card-custom p-4 p-md-5 border-0 shadow-sm mb-4">

                <!-- Step 1 -->
                <div class="d-flex gap-4 mb-4 pb-4 border-bottom">
                    <div class="rounded-circle bg-danger bg-opacity-10 text-danger p-3 fs-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 55px; height: 55px;">
                        <strong>1</strong>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Doctor Ki Tasdeeq & Death Certificate</h5>
                        <p class="text-muted small mb-2">
                            Agar inteqal hospital mein hua hai, toh foran hospital administration se official Death Certificate lein. Agar ghar par hua hai, toh qareebi certified doctor ya hospital se tasdeeq karwayein. Qabristan mein tadfeen ke liye doctor certificate ya Union Council parchi zaroori hoti hai.
                        </p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="d-flex gap-4 mb-4 pb-4 border-bottom">
                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-3 fs-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 55px; height: 55px;">
                        <strong>2</strong>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Ambulance & Maiyat Ko Ghar Muntaqil Karna</h5>
                        <p class="text-muted small mb-2">
                            Hospital se ghar ya mortuary muntaqil karne ke liye ambulance helpline par call karein. Agar inteqal garmi ke mausam mein hua ho ya janazah mein waqt ho, toh ice slabs (baraf) ya mortuary chiller ka intezam karein.
                        </p>
                        <a href="{{ route('requests.create') }}?service=ambulance" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-truck-front-fill me-1"></i> Fauri Ambulance Call Karein
                        </a>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="d-flex gap-4 mb-4 pb-4 border-bottom">
                    <div class="rounded-circle bg-indigo bg-opacity-10 text-indigo p-3 fs-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 55px; height: 55px; background-color: #ede9fe; color: #6d28d9;">
                        <strong>3</strong>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Ghusl Aur Kafan Ka Intezam</h5>
                        <p class="text-muted small mb-2">
                            <strong>Mard ke liye:</strong> 3 kapray (Lifafah, Izaar, Qamees/Kurta).<br>
                            <strong>Aurat ke liye:</strong> 5 kapray (Lifafah, Izaar, Qamees, Orhni/Dopatta, Seena-band).<br>
                            Sunnat ke mutabiq ghusl dene ke liye ba-shara tajurbakar Ghassal (Mard ya Aurat) ka intezam karein. Kafoor, gulab arq, sabun aur bardana sath tayyar rakhein.
                        </p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('requests.create') }}?service=ghusl" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-droplet-half me-1"></i> Ghassal Book Karein
                            </a>
                            <a href="{{ route('requests.create') }}?service=kafan" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-box-seam me-1"></i> Kafan Box Mangwayein
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="d-flex gap-4 mb-4 pb-4 border-bottom">
                    <div class="rounded-circle bg-secondary bg-opacity-10 text-secondary p-3 fs-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 55px; height: 55px;">
                        <strong>4</strong>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Qabristan & Gor-kan Ko Itla (Qabar Khudaai)</h5>
                        <p class="text-muted small mb-2">
                            Mutalliqah qabristan ke Gor-kan ko waqt se pehle itla dein taaki tadfeen se pehle qabar tayyar ho sake (khudaai mein taqreeban 3 se 5 ghantay lagte hain). Cement ke paat (slabs) aur eenton ka pehle se bandobast karein.
                        </p>
                        <a href="{{ route('graveyards.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pin-map me-1"></i> Qabristan Directory Dekhein
                        </a>
                    </div>
                </div>

                <!-- Step 5 -->
                <div class="d-flex gap-4">
                    <div class="rounded-circle bg-warning bg-opacity-10 text-warning p-3 fs-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 55px; height: 55px;">
                        <strong>5</strong>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Namaz-e-Janazah Ka Waqt Aur Ailaan</h5>
                        <p class="text-muted small mb-2">
                            Masjid ke Imam sahab se Namaz-e-Janazah ka waqt (e.g. Baad Namaz-e-Asr ya Zohr) tay karein. Digital Janazah Card banayein aur WhatsApp ke zariye azizo, dosto aur qareebi rishtedaaron ko muttala karein.
                        </p>
                        <a href="{{ route('janazah.create') }}" class="btn btn-sm btn-warning text-dark fw-bold">
                            <i class="bi bi-megaphone-fill me-1"></i> Digital Janazah Card Banayein
                        </a>
                    </div>
                </div>

            </div>

            <!-- 24/7 Helpline Card -->
            <div class="card card-custom p-4 bg-light border text-center">
                <h5 class="fw-bold mb-1">Koi Bhi Sawal Ya Fauri Zaroorat?</h5>
                <p class="text-muted small mb-3">Sahaara team 24 ghante aapki khidmat aur rehnumai ke liye tayyar hai:</p>
                <div>
                    <a href="tel:03007242272" class="btn btn-primary btn-lg px-4 fw-bold" style="background-color: var(--primary-color);">
                        <i class="bi bi-telephone-fill me-2"></i> 0300-SAHAARA (7242272)
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
