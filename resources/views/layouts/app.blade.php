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
            /* Modern Dignified Royal Navy & Slate Palette */
            --primary-color: #1e3a8a;       /* Royal Midnight Navy */
            --primary-hover: #172554;       /* Deep Navy */
            --primary-light: #eff6ff;       /* Light Soft Blue */
            --secondary-color: #334155;     /* Slate */
            --accent-gold: #d97706;         /* Dignified Warm Amber / Gold */
            --accent-gold-light: #fef3c7;
            --bg-soft: #f8fafc;             /* Clean Light Canvas */
            --border-soft: #e2e8f0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-soft);
            color: #1e293b;
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

        /* Top Emergency Hotline Bar */
        .top-emergency-bar {
            background-color: #0b1329;
            color: #94a3b8;
            font-size: 0.84rem;
            padding: 7px 0;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .top-emergency-bar a {
            color: #f1f5f9;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .top-emergency-bar a:hover {
            color: #fbbf24;
        }

        /* Modern Sleek Navbar */
        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid #e2e8f0;
            min-height: 72px;
            padding: 0;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: linear-gradient(135deg, #1e3a8a, #0f172a);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            box-shadow: 0 4px 10px rgba(30, 58, 138, 0.25);
            flex-shrink: 0;
        }

        .brand-title {
            font-size: 1.35rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.1;
            letter-spacing: -0.5px;
        }

        .brand-urdu {
            font-size: 1rem;
            font-weight: 700;
            color: #2563eb;
            margin-left: 4px;
        }

        .sub-brand {
            font-size: 0.74rem;
            font-weight: 500;
            color: #64748b;
            letter-spacing: 0.2px;
            display: block;
        }

        /* Clean Unified Nav Links */
        .navbar-nav .nav-link {
            font-size: 0.92rem;
            font-weight: 600;
            color: #475569 !important;
            padding: 10px 16px !important;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease-in-out;
            position: relative;
        }

        .navbar-nav .nav-link i {
            font-size: 1.05rem;
            color: #64748b;
            transition: color 0.2s;
        }

        .navbar-nav .nav-link:hover {
            color: #1e3a8a !important;
            background-color: #f8fafc;
        }

        .navbar-nav .nav-link:hover i {
            color: #1e3a8a;
        }

        /* Active link indicator */
        .navbar-nav .nav-link.active {
            color: #1e3a8a !important;
            background-color: transparent !important;
            font-weight: 700;
        }

        .navbar-nav .nav-link.active i {
            color: #2563eb;
        }

        .navbar-nav .nav-link.active::after {
            content: "";
            position: absolute;
            bottom: 0px;
            left: 14px;
            right: 14px;
            height: 3px;
            background-color: #2563eb;
            border-radius: 4px 4px 0 0;
        }

        @media (max-width: 991.98px) {
            .navbar-nav {
                padding: 12px 0;
            }
            .navbar-nav .nav-link.active::after {
                display: none;
            }
            .navbar-nav .nav-link.active {
                background-color: #eff6ff !important;
            }
        }

        /* Clean Modern SOS Button */
        .btn-sos-clean {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: #ffffff !important;
            font-size: 0.88rem;
            font-weight: 700;
            padding: 9px 20px;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
            transition: all 0.2s ease;
            border: none;
        }

        .btn-sos-clean:hover {
            background: #b91c1c;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(220, 38, 38, 0.4);
            color: #ffffff !important;
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
            transition: all 0.2s;
        }

        .btn-outline-custom:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .card-custom {
            background: #ffffff;
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.04);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card-custom:hover {
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
        }

        /* Footer */
        footer {
            background-color: #0b1329;
            color: #94a3b8;
            margin-top: auto;
            padding-top: 55px;
            padding-bottom: 25px;
            border-top: 1px solid rgba(255,255,255,0.06);
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
                <span><i class="bi bi-clock-history text-warning me-1"></i> 24/7 Helpline: <strong>0300-SAHAARA (7242272)</strong></span>
                <span class="d-none d-md-inline text-secondary">|</span>
                <span class="d-none d-md-inline"><i class="bi bi-heart-pulse-fill text-danger me-1"></i> Edhi: <strong>115</strong></span>
                <span class="d-none d-md-inline"><i class="bi bi-shield-check text-info me-1"></i> Chhipa: <strong>1020</strong></span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('requests.track') }}"><i class="bi bi-geo-alt-fill me-1 text-warning"></i> Track Request</a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand d-flex align-items-center gap-3 text-decoration-none py-2" href="{{ route('home') }}">
                <div class="brand-icon">
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>
                <div>
                    <div class="brand-title">
                        SAHAARA <span class="font-urdu brand-urdu">سہارا</span>
                    </div>
                    <span class="sub-brand">Funeral & Janazah Assistance</span>
                </div>
            </a>

            <!-- Mobile Toggler -->
            <button class="navbar-toggler border-0 shadow-none py-2 px-1" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-2 text-dark"></i>
            </button>

            <!-- Links -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1 my-3 my-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-door"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}">
                            <i class="bi bi-grid"></i>
                            <span>Khidmaat</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('janazah.*') ? 'active' : '' }}" href="{{ route('janazah.index') }}">
                            <i class="bi bi-megaphone"></i>
                            <span>Janazah Board</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('graveyards.*') ? 'active' : '' }}" href="{{ route('graveyards.index') }}">
                            <i class="bi bi-pin-map"></i>
                            <span>Qabristan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('guide') ? 'active' : '' }}" href="{{ route('guide') }}">
                            <i class="bi bi-journal-bookmark"></i>
                            <span>Rehnumai</span>
                        </a>
                    </li>
                </ul>

                <!-- Right Action Button -->
                <div class="d-flex align-items-center ms-lg-3 my-2 my-lg-0">
                    <a class="btn-sos-clean" href="{{ route('requests.create') }}">
                        <i class="bi bi-bell-fill"></i>
                        <span>Fauri Madad (SOS)</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Global Alerts -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill fs-5 me-2 text-success"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill fs-5 me-2 text-danger"></i>
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
                        <div class="rounded-3 p-2 d-inline-flex text-white" style="background: linear-gradient(135deg, #1e3a8a, #3b82f6);">
                            <i class="bi bi-heart-fill"></i>
                        </div>
                        <h5 class="text-white mb-0 fw-bold">SAHAARA (سہارا)</h5>
                    </div>
                    <p class="small text-secondary mb-3">
                        Kisi bhi azeez ke inteqal ke foran baad hone wale tamam zaroori intezamat (Ambulance, Ghusl, Kafan, Qabar, Janazah Ailaan) mein lawahiqeen ki sahoolat aur rehnumai ke liye ek dignified aur trustworthy platform.
                    </p>
                    <div class="font-arabic fs-5 text-warning">
                        إِنَّا لِلَّٰهِ وَإِنَّا إِلَيْهِ رَاجِعُونَ
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6 class="text-white fw-bold mb-3">Aham Khidmaat</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2">
                        <li><a href="{{ route('requests.create') }}?service=ambulance"><i class="bi bi-chevron-right me-1 text-primary"></i> Fauri Ambulance</a></li>
                        <li><a href="{{ route('requests.create') }}?service=ghusl"><i class="bi bi-chevron-right me-1 text-primary"></i> Ba-Shara Ghassal</a></li>
                        <li><a href="{{ route('requests.create') }}?service=kafan"><i class="bi bi-chevron-right me-1 text-primary"></i> Kafan Saman Box</a></li>
                        <li><a href="{{ route('requests.create') }}?service=qabar"><i class="bi bi-chevron-right me-1 text-primary"></i> Gor-kan & Qabar</a></li>
                        <li><a href="{{ route('requests.create') }}?mustahiq=1"><i class="bi bi-chevron-right me-1 text-primary"></i> Mustahiq Imdaad (Free)</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="text-white fw-bold mb-3">Public Features</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2">
                        <li><a href="{{ route('janazah.create') }}"><i class="bi bi-plus-circle me-1 text-info"></i> Janazah Card Maker</a></li>
                        <li><a href="{{ route('janazah.index') }}"><i class="bi bi-card-list me-1 text-info"></i> Aaj Ke Janazah Ailaanat</a></li>
                        <li><a href="{{ route('graveyards.index') }}"><i class="bi bi-compass me-1 text-info"></i> Qabristan Directory</a></li>
                        <li><a href="{{ route('guide') }}"><i class="bi bi-journal-text me-1 text-info"></i> Inteqal ke waqt Rehnumai</a></li>
                        <li><a href="{{ route('requests.track') }}"><i class="bi bi-search me-1 text-info"></i> Online Request Tracking</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="text-white fw-bold mb-3">24/7 Helpline & Support</h6>
                    <p class="small text-secondary mb-2">Emergency mein kisi bhi waqt rabta karein:</p>
                    <div class="p-3 rounded-3 border mb-3" style="background-color: #111d38; border-color: #1e293b !important;">
                        <div class="text-warning fw-bold fs-5"><i class="bi bi-telephone-fill me-2"></i> 0300-SAHAARA</div>
                        <div class="text-white-50 small mt-1">UAN: (0300) 7242272</div>
                    </div>
                    <div class="small text-secondary">
                        Pakistan Multi-City General Support System
                    </div>
                </div>
            </div>

            <hr class="border-secondary my-4" style="opacity: 0.15;">

            <div class="d-flex flex-wrap justify-content-between align-items-center small text-secondary">
                <div>&copy; {{ date('Y') }} Sahaara. All rights reserved. Khidmat-e-Khalq Platform.</div>
                <div>Built with Laravel & Bootstrap &middot; Modern Navy Theme</div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
