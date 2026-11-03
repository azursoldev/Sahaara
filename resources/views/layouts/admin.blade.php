<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Sahaara')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Noto+Nastaliq+Urdu:wght@700&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Executive Slate & Royal Blue Theme */
            --admin-sidebar-bg: #0f172a;     /* Midnight Slate */
            --admin-sidebar-hover: #1e293b;  /* Dark Slate */
            --admin-sidebar-active: #1d4ed8; /* Vibrant Royal Indigo */
            --admin-sidebar-text: #94a3b8;
            --admin-primary: #1e3a8a;
            --admin-accent: #3b82f6;
            --admin-bg: #f8fafc;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--admin-bg);
            color: #1e293b;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        #adminSidebar {
            width: 270px;
            background-color: var(--admin-sidebar-bg);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            z-index: 1040;
            border-right: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-brand {
            padding: 22px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .sidebar-brand h5 {
            color: #ffffff;
            font-weight: 800;
            margin: 0;
            font-size: 1.15rem;
            letter-spacing: 0.5px;
        }

        .sidebar-nav {
            padding: 15px 12px;
            list-style: none;
            margin: 0;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .sidebar-nav .nav-link {
            color: var(--admin-sidebar-text) !important;
            font-weight: 600;
            font-size: 0.92rem;
            padding: 11px 16px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .sidebar-nav .nav-link i {
            font-size: 1.15rem;
            width: 24px;
            text-align: center;
        }

        .sidebar-nav .nav-link:hover {
            color: #ffffff !important;
            background-color: var(--admin-sidebar-hover);
        }

        .sidebar-nav .nav-link.active {
            color: #ffffff !important;
            background-color: var(--admin-sidebar-active);
            box-shadow: 0 4px 14px rgba(29, 78, 216, 0.35);
        }

        .sidebar-user {
            padding: 16px 20px;
            border-top: 1px solid rgba(255,255,255,0.08);
            background-color: rgba(0,0,0,0.25);
        }

        /* Top Navbar */
        .admin-topbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 14px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .content-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .card-custom {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
        }

        .btn-primary-custom {
            background-color: #1e3a8a;
            color: white;
            font-weight: 600;
            border: none;
            padding: 8px 18px;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-primary-custom:hover {
            background-color: #172554;
            color: white;
        }

        @media (max-width: 991.98px) {
            #adminSidebar {
                position: fixed;
                left: -270px;
                top: 0;
                bottom: 0;
            }
            #adminSidebar.show {
                left: 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <aside id="adminSidebar">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                <div class="rounded-3 p-2 d-inline-flex text-white shadow-sm" style="background: linear-gradient(135deg, #2563eb, #1d4ed8) !important;">
                    <i class="bi bi-shield-heart-fill fs-5"></i>
                </div>
                <div>
                    <h5>SAHAARA <span class="badge bg-primary text-white small" style="font-size: 0.65rem;">CONTROL</span></h5>
                    <div class="text-white-50" style="font-size: 0.75rem;">Operations Portal</div>
                </div>
            </a>

            @php
                $pendingBadge = \App\Models\ServiceRequest::where('status', 'pending')->count();
            @endphp

            <ul class="sidebar-nav">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 text-info"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.requests') }}" class="nav-link {{ request()->routeIs('admin.requests*') ? 'active' : '' }}">
                        <i class="bi bi-bell-fill text-danger"></i>
                        <span class="flex-grow-1">Emergency Requests</span>
                        @if($pendingBadge > 0)
                            <span class="badge bg-danger rounded-pill">{{ $pendingBadge }}</span>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.services') }}" class="nav-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}">
                        <i class="bi bi-grid-fill text-primary"></i>
                        <span>Khidmaat (Services)</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.graveyards') }}" class="nav-link {{ request()->routeIs('admin.graveyards*') ? 'active' : '' }}">
                        <i class="bi bi-pin-map-fill text-warning"></i>
                        <span>Qabristan Directory</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.janazahs') }}" class="nav-link {{ request()->routeIs('admin.janazahs*') ? 'active' : '' }}">
                        <i class="bi bi-megaphone-fill text-warning"></i>
                        <span>Janazah Ailaanat</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.volunteers') }}" class="nav-link {{ request()->routeIs('admin.volunteers*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill text-info"></i>
                        <span>Field Providers / Volunteers</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.cities') }}" class="nav-link {{ request()->routeIs('admin.cities*') ? 'active' : '' }}">
                        <i class="bi bi-building text-secondary"></i>
                        <span>Shehar (General Cities)</span>
                    </a>
                </li>
            </ul>

            <!-- Bottom User Details -->
            <div class="sidebar-user text-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 38px; height: 38px;">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div>
                            <div class="fw-bold small">{{ Auth::user()->name ?? 'Admin Sahaara' }}</div>
                            <div class="text-white-50" style="font-size: 0.72rem;">{{ Auth::user()->email ?? 'admin@sahaara.com' }}</div>
                        </div>
                    </div>

                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger p-1 rounded-circle" title="Logout" style="width: 32px; height: 32px;">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="content-wrapper">
            <!-- Topbar -->
            <header class="admin-topbar">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-outline-secondary btn-sm d-lg-none" type="button" onclick="document.getElementById('adminSidebar').classList.toggle('show');">
                        <i class="bi bi-list fs-5"></i>
                    </button>
                    <span class="fw-bold text-dark fs-5">Sahaara Operations Control</span>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm" target="_blank">
                        <i class="bi bi-globe me-1"></i> Public Website <i class="bi bi-box-arrow-up-right small ms-1"></i>
                    </a>

                    <div class="dropdown">
                        <button class="btn btn-light btn-sm border dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle text-primary"></i>
                            <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                            <li><span class="dropdown-item-text small text-muted">{{ Auth::user()->email ?? '' }}</span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('admin.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger small fw-bold">
                                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Main Body -->
            <main class="p-3 p-lg-4">
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

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
