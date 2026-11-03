<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sahaara - Funeral & Janazah Assistance Platform')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts: Plus Jakarta Sans & Amiri for Arabic/Urdu -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Noto+Nastaliq+Urdu:wght@400;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #1a4d3e;
            --primary-hover: #13392e;
            --primary-light: #e8f3ef;
            --secondary-color: #2c3e50;
            --accent-gold: #c29b38;
            --bg-soft: #f8fafc;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-soft);
            color: #334155;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .font-arabic {
            font-family: 'Amiri', serif;
        }

        .font-urdu {
            font-family: 'Noto Nastaliq Urdu', serif;
        }

        /* Top Bar */
        .top-emergency-bar {
            background-color: #142821;
            color: #d1e7dd;
            font-size: 0.88rem;
            padding: 7px 0;
        }

        .top-emergency-bar a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
        }

        .top-emergency-bar a:hover {
            color: #f1c40f;
        }

        /* Navbar */
        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0 2px 15px rgba(0,0,0,0.06);
            padding: 12px 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary-color) !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand span.sub-brand {
            font-size: 0.85rem;
            font-weight: 500;
            color: #64748b;
            display: block;
            line-height: 1;
        }

        .nav-link {
            font-weight: 600;
            color: #475569 !important;
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-color) !important;
            background-color: var(--primary-light);
        }

        .btn-sos {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: #ffffff !important;
            font-weight: 700;
            padding: 9px 20px;
            border-radius: 50px;
            box-shadow: 0 4px 14px rgba(220, 38, 38, 0.35);
            animation: pulse-red 2s infinite;
        }

        .btn-sos:hover {
            background: #991b1b;
            transform: translateY(-1px);
        }

        @keyframes pulse-red {
            0% { box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(220, 38, 38, 0); }
            100% { box-shadow: 0 0 0 0 rgba(220, 38, 38, 0); }
        }

        .btn-primary-custom {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            border: none;
            padding: 10px 22px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-hover);
            color: white;
        }

        .btn-outline-custom {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
            border-radius: 8px;
            padding: 8px 20px;
        }

        .btn-outline-custom:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .card-custom {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card-custom:hover {
            box-shadow: 0 8px 24px rgba(0,0,0,0.07);
        }

        /* Footer */
        footer {
            background-color: #10221c;
            color: #cbd5e1;
            margin-top: auto;
            padding-top: 50px;
            padding-bottom: 25px;
        }

        footer a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.2s;
        }

        footer a:hover {
            color: #ffffff;
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Emergency Hotline Banner -->
    <div class="top-emergency-bar">
        <div class="container d-flex flex-wrap justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <span><i class="bi bi-clock-history text-warning me-1"></i> 24/7 Fauri Madad Helpline: <strong>0300-SAHAARA (7242272)</strong></span>
                <span class="d-none d-md-inline text-secondary">|</span>
                <span class="d-none d-md-inline"><i class="bi bi-heart-pulse-fill text-danger me-1"></i> Edhi: <strong>115</strong></span>
                <span class="d-none d-md-inline"><i class="bi bi-shield-check text-info me-1"></i> Chhipa: <strong>1020</strong></span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('requests.track') }}"><i class="bi bi-geo-alt-fill me-1"></i> Track Request</a>
                <span class="text-secondary">|</span>
                <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-1"></i> Admin</a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <div class="bg-success text-white rounded-3 p-2 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background-color: var(--primary-color) !important;">
                    <i class="bi bi-heart-fill"></i>
                </div>
                <div>
                    <div>SAHAARA <span class="font-urdu fs-6 text-success fw-bold ms-1">سہارا</span></div>
                    <span class="sub-brand">Funeral & Janazah Assistance</span>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}">
                            <i class="bi bi-grid me-1"></i> Khidmaat (Services)
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('janazah.*') ? 'active' : '' }}" href="{{ route('janazah.index') }}">
                            <i class="bi bi-megaphone me-1"></i> Janazah Board
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('graveyards.*') ? 'active' : '' }}" href="{{ route('graveyards.index') }}">
                            <i class="bi bi-pin-map me-1"></i> Qabristan Directory
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('guide') ? 'active' : '' }}" href="{{ route('guide') }}">
                            <i class="bi bi-book me-1"></i> Rehnumai (Guide)
                        </a>
                    </li>
                    <li class="nav-item ms-lg-2 my-2 my-lg-0">
                        <a class="btn btn-sos d-flex align-items-center gap-2" href="{{ route('requests.create') }}">
                            <i class="bi bi-bell-fill"></i> Fauri Madad (SOS)
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Global Alerts -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill fs-5 me-2"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>
                <div>{{ session('error') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="bg-success text-white rounded-3 p-2 d-inline-flex" style="background-color: var(--primary-color) !important;">
                            <i class="bi bi-heart-fill"></i>
                        </div>
                        <h5 class="text-white mb-0 fw-bold">SAHAARA (سہارا)</h5>
                    </div>
                    <p class="small text-muted mb-3">
                        Kisi bhi azeez ke inteqal ke foran baad hone wale tamam zaroori intezamat (Ambulance, Ghusl, Kafan, Qabar, Janazah Ailaan) mein lawahiqeen ki sahoolat aur rehnumai ke liye ek comprehensive platform.
                    </p>
                    <div class="font-arabic fs-5 text-warning">
                        إِنَّا لِلَّٰهِ وَإِنَّا إِلَيْهِ رَاجِعُونَ
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6 class="text-white fw-bold mb-3">Aham Khidmaat</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2">
                        <li><a href="{{ route('requests.create') }}"><i class="bi bi-chevron-right me-1 text-success"></i> Fauri Ambulance</a></li>
                        <li><a href="{{ route('services.category', 'ghusl') }}"><i class="bi bi-chevron-right me-1 text-success"></i> Ba-Shara Ghassal</a></li>
                        <li><a href="{{ route('services.category', 'kafan-package') }}"><i class="bi bi-chevron-right me-1 text-success"></i> Kafan Saman Box</a></li>
                        <li><a href="{{ route('services.category', 'qabar-intezamat') }}"><i class="bi bi-chevron-right me-1 text-success"></i> Gor-kan & Qabar</a></li>
                        <li><a href="{{ route('requests.create') }}?mustahiq=1"><i class="bi bi-chevron-right me-1 text-success"></i> Mustahiq Imdaad (Free)</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="text-white fw-bold mb-3">Public Features</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2">
                        <li><a href="{{ route('janazah.create') }}"><i class="bi bi-plus-circle me-1 text-success"></i> Janazah Card Maker</a></li>
                        <li><a href="{{ route('janazah.index') }}"><i class="bi bi-card-list me-1 text-success"></i> Aaj Ke Janazah Ailaanat</a></li>
                        <li><a href="{{ route('graveyards.index') }}"><i class="bi bi-compass me-1 text-success"></i> Qabristan Directory</a></li>
                        <li><a href="{{ route('guide') }}"><i class="bi bi-journal-text me-1 text-success"></i> Inteqal ke waqt Rehnumai</a></li>
                        <li><a href="{{ route('requests.track') }}"><i class="bi bi-search me-1 text-success"></i> Online Request Tracking</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="text-white fw-bold mb-3">24/7 Helpline & Support</h6>
                    <p class="small text-muted mb-2">Emergency mein kisi bhi waqt call karein:</p>
                    <div class="bg-dark p-3 rounded-3 border border-secondary mb-3">
                        <div class="text-warning fw-bold fs-5"><i class="bi bi-telephone-fill me-2"></i> 0300-SAHAARA</div>
                        <div class="text-white-50 small mt-1">UAN: (0300) 7242272</div>
                    </div>
                    <div class="small text-muted">
                        Shahrah / General City System (Pakistan Multi-City Support)
                    </div>
                </div>
            </div>

            <hr class="border-secondary my-4">

            <div class="d-flex flex-wrap justify-content-between align-items-center small text-muted">
                <div>&copy; {{ date('Y') }} Sahaara. All rights reserved. Khidmat-e-Khalq Platform.</div>
                <div>Sadqah-e-Jariyah &middot; Built with Laravel & Bootstrap</div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
