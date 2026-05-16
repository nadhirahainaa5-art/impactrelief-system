<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NGO Fund Management')</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --bg: #f6fbf7;
            --panel: #ffffff;
            --panel-soft: #f0fdf4;
            --line: #d8eadc;
            --line-strong: #b7d9bf;
            --text: #10351f;
            --muted: #617767;
            --primary: #15803d;
            --primary-dark: #166534;
            --primary-soft: #dcfce7;
            --success: #15803d;
            --warning: #d97706;
            --danger: #dc2626;
            --blue: #2563eb;
            --shadow: 0 14px 35px rgba(21, 128, 61, 0.10);
            --radius-lg: 22px;
            --radius-md: 16px;
            --radius-sm: 12px;
            --sidebar-width: 260px;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: linear-gradient(180deg, #fbfffc 0%, #f2faf4 100%);
            color: var(--text);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        textarea,
        select {
            font-family: inherit;
        }

        .app-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: var(--sidebar-width) 1fr;
        }

        .sidebar {
            position: sticky;
            top: 0;
            height: 100vh;
            background: rgba(255, 255, 255, 0.94);
            border-right: 1px solid var(--line);
            padding: 20px 16px;
            display: flex;
            flex-direction: column;
            box-shadow: 10px 0 30px rgba(21, 128, 61, 0.06);
            z-index: 20;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 8px 20px;
            border-bottom: 1px solid var(--line);
        }

        .brand-mark {
            width: 46px;
            height: 46px;
            border-radius: 16px;
            background: linear-gradient(135deg, #15803d, #166534);
            color: white;
            display: grid;
            place-items: center;
            font-weight: 900;
            box-shadow: 0 12px 24px rgba(21, 128, 61, 0.20);
        }

        .brand-title {
            font-weight: 900;
            color: var(--text);
            line-height: 1.1;
        }

        .brand-subtitle {
            font-size: 0.78rem;
            color: var(--muted);
            margin-top: 3px;
        }

        .sidebar-section-title {
            margin: 22px 8px 8px;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--muted);
            font-weight: 900;
        }

        .side-nav {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .side-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 12px;
            border-radius: 14px;
            color: #31533f;
            font-weight: 750;
            font-size: 0.92rem;
            transition: 0.2s ease;
        }

        .side-link:hover {
            background: #f0fdf4;
            color: var(--primary-dark);
        }

        .side-link.active {
            background: #dcfce7;
            color: var(--primary-dark);
            box-shadow: inset 0 0 0 1px #bbf7d0;
        }

        .side-footer {
            margin-top: auto;
            border-top: 1px solid var(--line);
            padding-top: 16px;
        }

        .user-box {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 8px;
        }

        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--primary-soft);
            color: var(--primary-dark);
            display: grid;
            place-items: center;
            font-weight: 900;
        }

        .user-name {
            font-size: 0.9rem;
            font-weight: 900;
            color: var(--text);
        }

        .user-role {
            font-size: 0.78rem;
            color: var(--muted);
            margin-top: 2px;
            text-transform: capitalize;
        }

        .logout-btn {
            width: 100%;
            margin-top: 8px;
            border: 0;
            border-radius: 14px;
            padding: 11px 14px;
            background: #052e16;
            color: white;
            font-weight: 800;
            cursor: pointer;
        }

        .main-area {
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 10;
            background: rgba(255, 255, 255, 0.86);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--line);
            padding: 16px 26px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .topbar-title {
            font-weight: 900;
            color: var(--text);
        }

        .topbar-subtitle {
            color: var(--muted);
            font-size: 0.86rem;
            margin-top: 3px;
        }

        .role-chip {
            padding: 8px 13px;
            border-radius: 999px;
            background: #ecfdf3;
            color: #166534;
            border: 1px solid #bbf7d0;
            font-size: 0.78rem;
            font-weight: 900;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .page-shell {
            width: 100%;
            max-width: 1420px;
            margin: 0 auto;
            padding: 30px 28px 46px;
        }

        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 22px;
        }

        .page-header h1,
        .page-header h2 {
            margin: 0 0 8px;
            line-height: 1.1;
            color: var(--text);
        }

        .page-header h1 {
            font-size: 2rem;
        }

        .page-header h2 {
            font-size: 1.35rem;
        }

        .eyebrow {
            margin: 0 0 10px;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            font-size: 0.75rem;
            font-weight: 900;
            color: var(--primary);
        }

        .muted {
            margin: 0;
            color: var(--muted);
        }

        .toolbar {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn,
        .btn-secondary,
        .btn-danger,
        .btn-warning {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            padding: 12px 16px;
            font-weight: 800;
            transition: 0.2s ease;
            border: 1px solid transparent;
            cursor: pointer;
            font-size: 0.94rem;
        }

        .btn {
            background: linear-gradient(135deg, #15803d, #166534);
            color: white;
            box-shadow: 0 14px 30px rgba(21, 128, 61, 0.18);
        }

        .btn:hover {
            transform: translateY(-1px);
            filter: brightness(1.03);
        }

        .btn-secondary {
            background: white;
            color: var(--primary-dark);
            border-color: var(--line-strong);
        }

        .btn-secondary:hover {
            background: #f0fdf4;
            border-color: #86efac;
        }

        .btn-danger {
            background: #fee2e2;
            color: #b91c1c;
            border-color: #fecaca;
        }

        .btn-warning {
            background: #fff7ed;
            color: #9a3412;
            border-color: #fdba74;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 24px;
        }

        .metric-card,
        .content-card,
        .table-shell,
        .form-shell,
        .chart-card {
            background: white;
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
        }

        .metric-card {
            padding: 22px;
            background:
                radial-gradient(circle at top right, rgba(21, 128, 61, 0.08), transparent 34%),
                linear-gradient(180deg, #ffffff 0%, #fbfffc 100%);
        }

        .metric-label {
            font-size: 0.88rem;
            color: var(--muted);
            margin-bottom: 10px;
            font-weight: 800;
        }

        .metric-value {
            margin: 0;
            font-size: 2rem;
            font-weight: 950;
            letter-spacing: -0.04em;
            color: var(--primary-dark);
        }

        .metric-note {
            margin-top: 8px;
            font-size: 0.82rem;
            color: var(--muted);
        }

        .content-card,
        .form-shell,
        .chart-card {
            padding: 22px;
        }

        .chart-card canvas {
            max-height: 320px;
        }

        .grid-two {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .grid-three {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .section-gap {
            margin-top: 28px;
        }

        .table-shell {
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: transparent;
        }

        th,
        td {
            padding: 15px 18px;
            text-align: left;
            border-bottom: 1px solid #e5f2e8;
            vertical-align: middle;
        }

        th {
            background: #fbfffc;
            color: var(--primary-dark);
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            font-weight: 900;
        }

        tbody tr:hover {
            background: #f7fcf8;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 16px;
        }

        .field label {
            font-size: 0.92rem;
            font-weight: 800;
            color: var(--text);
        }

        .field input,
        .field select,
        .field textarea {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 14px;
            background: white;
            padding: 12px 14px;
            font: inherit;
            color: var(--text);
            outline: none;
            transition: 0.18s ease;
        }

        .field input:focus,
        .field select:focus,
        .field textarea:focus {
            border-color: #86efac;
            box-shadow: 0 0 0 4px rgba(21, 128, 61, 0.12);
        }

        .alert {
            border-radius: 16px;
            padding: 14px 16px;
            margin-bottom: 18px;
            font-weight: 700;
        }

        .alert-success {
            background: #ecfdf3;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .alert-warning {
            background: #fff7ed;
            border: 1px solid #fdba74;
            color: #9a3412;
        }

        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            border-radius: 999px;
            padding: 7px 11px;
            font-size: 0.78rem;
            font-weight: 900;
            letter-spacing: 0.02em;
        }

        .badge-active,
        .badge-approved {
            background: #dcfce7;
            color: #166534;
        }

        .badge-pending,
        .badge-under_review {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty-state {
            padding: 36px 24px;
            text-align: center;
            color: var(--muted);
        }

        .campaign-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .campaign-card {
            background: white;
            border: 1px solid var(--line);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: 0.2s ease;
        }

        .campaign-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 34px rgba(21, 128, 61, 0.15);
        }

        .campaign-image {
            height: 135px;
            display: grid;
            place-items: center;
            font-size: 2rem;
            color: white;
        }

        .gradient-1 { background: linear-gradient(135deg, #15803d, #22c55e); }
        .gradient-2 { background: linear-gradient(135deg, #0f766e, #2dd4bf); }
        .gradient-3 { background: linear-gradient(135deg, #166534, #84cc16); }
        .gradient-4 { background: linear-gradient(135deg, #16a34a, #bbf7d0); }
        .gradient-5 { background: linear-gradient(135deg, #14532d, #4ade80); }
        .gradient-6 { background: linear-gradient(135deg, #047857, #6ee7b7); }

        .campaign-body {
            padding: 16px;
        }

        .campaign-meta {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 8px;
        }

        .campaign-meta span {
            color: #15803d;
            font-size: 0.78rem;
            font-weight: 900;
        }

        .campaign-meta small {
            color: var(--muted);
            font-weight: 800;
        }

        .campaign-card h3 {
            margin: 0 0 8px;
            font-size: 1rem;
            color: var(--text);
        }

        .campaign-desc {
            margin: 0 0 12px;
            color: var(--muted);
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .campaign-info {
            display: grid;
            gap: 5px;
            margin-bottom: 14px;
        }

        .campaign-info p {
            margin: 0;
            font-size: 0.82rem;
            color: #466150;
        }

        .campaign-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .campaign-footer strong {
            color: #166534;
            font-size: 1rem;
        }

        .details-btn {
            background: #15803d;
            color: white;
            padding: 9px 12px;
            border-radius: 12px;
            font-size: 0.82rem;
            font-weight: 900;
        }

        .details-btn:hover {
            background: #166534;
        }

        .progress-wrap {
            margin-top: 12px;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            color: var(--muted);
            font-size: 0.8rem;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .progress-track {
            height: 9px;
            border-radius: 999px;
            background: #e5f2e8;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #15803d, #22c55e);
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .detail-box {
            background: #fbfffc;
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 18px;
        }

        .detail-box span {
            display: block;
            color: var(--muted);
            font-size: 0.86rem;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .detail-box strong {
            color: #166534;
            font-size: 1.05rem;
        }

        .footer-space {
            height: 20px;
        }

        @media (max-width: 1100px) {
            .app-shell {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: relative;
                height: auto;
                border-right: 0;
                border-bottom: 1px solid var(--line);
            }

            .side-nav {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .cards,
            .detail-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .campaign-grid,
            .grid-three {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 760px) {
            .page-shell {
                padding: 24px 18px 38px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .page-header {
                flex-direction: column;
            }

            .toolbar,
            .toolbar a,
            .toolbar button {
                width: 100%;
            }

            .cards,
            .grid-two,
            .grid-three,
            .campaign-grid,
            .detail-grid,
            .side-nav {
                grid-template-columns: 1fr;
            }

            th,
            td {
                padding: 12px;
                font-size: 0.9rem;
            }
        }
       /* =========================
   PREMIUM SIDEBAR
========================= */

.sidebar {
    background:
        linear-gradient(180deg, #052e16 0%, #06351d 45%, #041b10 100%) !important;
    border-right: 1px solid rgba(255,255,255,.06) !important;
    color: white !important;
    box-shadow: 18px 0 55px rgba(4, 27, 16, 0.28);
    padding: 22px 16px !important;

    overflow-y: auto;
    overflow-x: hidden;
}

.sidebar::before {
    content: "";
    position: absolute;
    top: -120px;
    right: -90px;
    width: 240px;
    height: 240px;
    background: radial-gradient(circle, rgba(34,197,94,.22), transparent 70%);
    pointer-events: none;
}

.brand {
    padding: 10px 10px 22px !important;
    border-bottom: 1px solid rgba(255,255,255,.08) !important;
    margin-bottom: 6px;
}

.brand-mark {
    width: 52px !important;
    height: 52px !important;
    border-radius: 18px !important;
    background: linear-gradient(135deg, #22c55e, #86efac) !important;
    color: #052e16 !important;
    font-size: 18px;
    font-weight: 900;
    box-shadow:
        0 12px 30px rgba(34,197,94,.30),
        inset 0 1px 0 rgba(255,255,255,.35);
}

.brand-title {
    color: white !important;
    font-size: 1.25rem !important;
    font-weight: 900 !important;
    letter-spacing: -.03em;
}

.brand-subtitle {
    color: rgba(255,255,255,.60) !important;
    font-size: .78rem !important;
    margin-top: 5px !important;
    line-height: 1.4;
}

.sidebar-section-title {
    color: rgba(255,255,255,.42) !important;
    font-size: .70rem !important;
    letter-spacing: .18em !important;
    margin: 24px 10px 10px !important;
    font-weight: 900 !important;
}

.side-nav {
    gap: 8px !important;
}

.side-link {
    position: relative;
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 13px 14px !important;
    border-radius: 18px !important;
    color: rgba(255,255,255,.72) !important;
    font-weight: 800 !important;
    transition: .22s ease !important;
    overflow: hidden;
}

.side-link span:first-child {
    width: 22px;
    display: flex;
    justify-content: center;
    font-size: 17px;
}

.side-link:hover {
    background: rgba(255,255,255,.07) !important;
    color: white !important;
    transform: translateX(4px);
}

.side-link.active {
    background:
        linear-gradient(135deg,
        rgba(255,255,255,.18),
        rgba(255,255,255,.08)) !important;

    color: white !important;

    border: 1px solid rgba(255,255,255,.10) !important;

    box-shadow:
        inset 0 1px 0 rgba(255,255,255,.10),
        0 10px 24px rgba(0,0,0,.12);
}

.side-link.active::before {
    content: "";
    position: absolute;
    left: 0;
    top: 12%;
    width: 4px;
    height: 76%;
    border-radius: 999px;
    background: linear-gradient(180deg, #4ade80, #22c55e);
}

.side-footer {
    margin-top: 25px;
    border-top: 1px solid rgba(255,255,255,.08) !important;
    padding-top: 18px !important;
}

.user-box {
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 22px;
    padding: 14px !important;
    backdrop-filter: blur(12px);
}

.avatar {
    width: 48px !important;
    height: 48px !important;
    background: linear-gradient(135deg, #dcfce7, #86efac) !important;
    color: #052e16 !important;
    font-size: 17px;
    font-weight: 900;
    box-shadow: 0 10px 22px rgba(34,197,94,.18);
}

.user-name {
    color: white !important;
    font-size: .96rem;
    font-weight: 900 !important;
}

.user-role {
    color: rgba(255,255,255,.58) !important;
    font-size: .78rem !important;
    margin-top: 3px;
}

.logout-btn {
    width: 100%;
    margin-top: 14px !important;
    border: none !important;
    border-radius: 18px !important;
    padding: 13px 14px !important;

    background:
        linear-gradient(135deg,
        #ffffff,
        #f0fdf4) !important;

    color: #052e16 !important;
    font-weight: 900 !important;
    font-size: .92rem;

    transition: .2s ease;
    cursor: pointer;
}

.logout-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 28px rgba(255,255,255,.12);
}
    </style>
</head>

<body>
@php
    use Illuminate\Support\Facades\Route;

    $user = auth()->user();

    $dashboardRoute = 'dashboard';

    if ($user) {
        if (method_exists($user, 'isAdmin') && $user->isAdmin() && Route::has('admin.dashboard')) {
            $dashboardRoute = 'admin.dashboard';
        } elseif (method_exists($user, 'isStaff') && $user->isStaff() && Route::has('staff.dashboard')) {
            $dashboardRoute = 'staff.dashboard';
        } elseif (method_exists($user, 'isDonor') && $user->isDonor() && Route::has('donor.dashboard')) {
            $dashboardRoute = 'donor.dashboard';
        }
    }

    $role = $user->role ?? 'user';
@endphp

<div class="app-shell">
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-mark">IR</div>
            <div>
    <div class="brand-title">ImpactRelief</div>
    <div class="brand-subtitle">
        Humanitarian Operations Platform
    </div>
</div>
        </div>

        <div class="sidebar-section-title">Main</div>

        <nav class="side-nav">
            @if(Route::has($dashboardRoute))
                <a class="side-link {{ request()->routeIs($dashboardRoute) ? 'active' : '' }}"
                   href="{{ route($dashboardRoute) }}">
                    <span>🏠</span>
                    <span>Dashboard</span>
                </a>
            @endif

@if(Route::has('profile.edit'))
    <a class="side-link {{ request()->routeIs('profile.*') ? 'active' : '' }}"
       href="{{ route('profile.edit') }}">
        <span>👤</span>
        <span>My Profile</span>
    </a>
@endif

            @if(Route::has('campaigns.index'))
                <a class="side-link {{ request()->routeIs('campaigns.*') ? 'active' : '' }}"
                   href="{{ route('campaigns.index') }}">
                    <span>📢</span>
                    <span>Campaigns</span>
                </a>
            @endif

            @if($user && method_exists($user, 'isDonor') && $user->isDonor() && Route::has('public-donations.create'))
                <a class="side-link {{ request()->routeIs('public-donations.*') ? 'active' : '' }}"
                   href="{{ route('public-donations.create') }}">
                    <span>💚</span>
                    <span>Donate</span>
                </a>
            @endif

            @if(Route::has('donations.index'))
                <a class="side-link {{ request()->routeIs('donations.*') ? 'active' : '' }}"
                   href="{{ route('donations.index') }}">
                    <span>🎁</span>
                    <span>Donations</span>
                </a>
            @endif
        </nav>

        @if($user && (method_exists($user, 'isStaff') && $user->isStaff() || method_exists($user, 'isAdmin') && $user->isAdmin()))
            <div class="sidebar-section-title">Operations</div>

            <nav class="side-nav">
                @if(Route::has('fund-allocations.index'))
                    <a class="side-link {{ request()->routeIs('fund-allocations.*') ? 'active' : '' }}"
                       href="{{ route('fund-allocations.index') }}">
                        <span>💰</span>
                        <span>Allocations</span>
                    </a>
                @endif

                @if(Route::has('expenses.index'))
                    <a class="side-link {{ request()->routeIs('expenses.*') ? 'active' : '' }}"
                       href="{{ route('expenses.index') }}">
                        <span>🧾</span>
                        <span>Expenses</span>
                    </a>
                @endif
            </nav>
        @endif

        @if($user && method_exists($user, 'isAdmin') && $user->isAdmin())
            <div class="sidebar-section-title">Admin</div>

            <nav class="side-nav">

                <a class="side-link {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}"
                    href="{{ route('admin.staff.index') }}">
                    <span>🧑‍💼</span>
                    <span>Staff</span>
                </a>

                @if(Route::has('donors.index'))
                    <a class="side-link {{ request()->routeIs('donors.*') ? 'active' : '' }}"
                       href="{{ route('donors.index') }}">
                        <span>👥</span>
                        <span>Donors</span>
                    </a>
                @endif

                @if(Route::has('audit-logs.index'))
                    <a class="side-link {{ request()->routeIs('audit-logs.*') ? 'active' : '' }}"
                       href="{{ route('audit-logs.index') }}">
                        <span>📋</span>
                        <span>Audit Logs</span>
                    </a>
                @endif
            </nav>
        @endif

        <div class="side-footer">
            @if($user)
                <div class="user-box">
                    <div class="avatar">
                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                    </div>
                    <div>
                        <div class="user-name">{{ $user->name }}</div>
                        <div class="user-role">{{ $role }}</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout-btn" type="submit">Sign Out</button>
                </form>
            @endif
        </div>
    </aside>

    <div class="main-area">
        <header class="topbar">
            <div>
                <div class="topbar-title">@yield('page_title', 'NGO Fund Management')</div>
                <div class="topbar-subtitle">Professional NGO donation </div>
            </div>

            @if($user)
                <span class="role-chip">{{ $role }}</span>
            @endif
        </header>

        <main class="page-shell">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning">{{ session('warning') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Please fix the following:</strong>
                    <ul style="margin: 10px 0 0 18px; padding: 0;">
                        @foreach($errors->all() as $error)
                            <li style="margin-bottom: 4px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

            <div class="footer-space"></div>
        </main>
    </div>
</div>
</body>
</html>