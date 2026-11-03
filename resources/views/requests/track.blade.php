@extends('layouts.app')

@section('title', 'Track Service Request - Sahaara')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">

            <div class="card card-custom p-4 p-md-5 border-0 shadow text-center">
                <div class="rounded-circle bg-success bg-opacity-10 text-success p-3 mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                    <i class="bi bi-geo-alt-fill fs-2"></i>
                </div>

                <h3 class="fw-bold mb-2">Apni Request Track Karein</h3>
                <p class="text-muted small mb-4">
                    Apna 8-hindo ka Tracking Code (jaise <strong>SHR-84920</strong>) darj karein taaki aap ambulance, ghassal ya delivery ki live position aur status jaan sakein.
                </p>

                <form action="{{ route('requests.track') }}" method="GET">
                    <div class="mb-4">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                            <input type="text" name="tracking_code" class="form-control text-uppercase" placeholder="e.g. SHR-ABC123" required autofocus>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary-custom btn-lg w-100 fw-bold">
                        <i class="bi bi-arrow-right-circle me-1"></i> Status Check Karein
                    </button>
                </form>

                <div class="mt-4 pt-3 border-top small text-muted">
                    Code nahi mil raha? SMS ya WhatsApp par aayi receipt check karein, ya helpline <a href="tel:03007242272" class="text-success fw-bold">0300-SAHAARA</a> par call karein.
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

