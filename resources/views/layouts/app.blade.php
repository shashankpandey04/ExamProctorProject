<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $appTitle ?? config('app.name', 'Laravel'))</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #07111f;
            --bg-soft: rgba(255, 255, 255, 0.08);
            --panel: rgba(255, 255, 255, 0.92);
            --panel-strong: #ffffff;
            --line: rgba(15, 23, 42, 0.12);
            --text: #0f172a;
            --muted: #5b6476;
            --accent: #ff7a18;
            --accent-2: #d9480f;
            --success: #0f766e;
            --danger: #b42318;
            --shadow: 0 32px 80px rgba(2, 6, 23, 0.22);
        }

        * { box-sizing: border-box; }
        html, body { min-height: 100%; }
        body {
            margin: 0;
            font-family: 'Space Grotesk', sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(255, 122, 24, 0.28), transparent 26%),
                radial-gradient(circle at 80% 10%, rgba(247, 148, 54, 0.22), transparent 24%),
                linear-gradient(135deg, #07111f 0%, #0f172a 38%, #111827 100%);
        }

        a { color: inherit; text-decoration: none; }

        .frame {
            min-height: 100vh;
            padding: 24px;
        }

        .chrome {
            display: grid;
            grid-template-columns: minmax(240px, 280px) 1fr;
            gap: 20px;
            min-height: calc(100vh - 48px);
        }

        .sidebar,
        .workspace,
        .guest-shell {
            background: var(--panel);
            border: 1px solid rgba(255, 255, 255, 0.28);
            box-shadow: var(--shadow);
            backdrop-filter: blur(18px);
        }

        .sidebar {
            border-radius: 28px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 24px;
            position: sticky;
            top: 24px;
            height: fit-content;
        }

        .brand {
            display: grid;
            gap: 8px;
        }

        .brand h1,
        .hero h1,
        .section-title {
            margin: 0;
            line-height: 1.05;
        }

        .brand h1 {
            font-size: 1.7rem;
        }

        .tagline,
        .meta,
        .muted {
            color: var(--muted);
        }

        .stack {
            display: grid;
            gap: 10px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 16px;
            border: 1px solid transparent;
            color: #102033;
            background: rgba(255, 255, 255, 0.62);
            transition: transform .2s ease, border-color .2s ease, background .2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            transform: translateX(2px);
            border-color: rgba(255, 122, 24, 0.35);
            background: rgba(255, 244, 233, 0.96);
        }

        .workspace {
            border-radius: 34px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 6px 6px 0;
        }

        .user-chip,
        .pill,
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: .88rem;
            border: 1px solid rgba(15, 23, 42, 0.08);
            background: rgba(255,255,255,0.7);
        }

        .pill.success,
        .badge.success { color: var(--success); background: rgba(15, 118, 110, 0.10); }
        .pill.warning,
        .badge.warning { color: #9a3412; background: rgba(249, 115, 22, 0.12); }
        .pill.danger,
        .badge.danger { color: var(--danger); background: rgba(180, 35, 24, 0.10); }

        .hero,
        .panel {
            border-radius: 28px;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(255,255,255,.98), rgba(250, 250, 252, .96));
            padding: 24px;
        }

        .hero {
            display: grid;
            gap: 18px;
        }

        .eyebrow {
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--accent-2);
            font-size: .75rem;
            font-weight: 700;
        }

        .hero h1 {
            font-size: clamp(2rem, 3vw, 3.4rem);
            max-width: 16ch;
        }

        .grid {
            display: grid;
            gap: 16px;
        }

        .grid.cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .grid.cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .grid.cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }

        .metric {
            padding: 18px;
            border-radius: 22px;
            background: linear-gradient(135deg, rgba(255, 122, 24, 0.12), rgba(255,255,255,.95));
            border: 1px solid rgba(255, 122, 24, 0.18);
        }

        .metric strong,
        .figure {
            display: block;
            font-size: 2rem;
            line-height: 1;
            margin-bottom: 8px;
        }

        .card,
        .table-card,
        .form-card {
            border-radius: 26px;
            border: 1px solid var(--line);
            background: rgba(255,255,255,.98);
            padding: 22px;
        }

        .table-wrap { overflow-x: auto; }
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 720px;
        }
        th, td {
            padding: 14px 12px;
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
            text-align: left;
            vertical-align: top;
        }
        th {
            font-size: .82rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--muted);
        }

        .button,
        .button-secondary,
        .button-danger {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 14px;
            border: 1px solid transparent;
            padding: 11px 16px;
            font-weight: 700;
            cursor: pointer;
            transition: transform .18s ease, opacity .18s ease, border-color .18s ease;
        }

        .button { color: #fff; background: linear-gradient(135deg, var(--accent), var(--accent-2)); }
        .button-secondary { color: var(--text); background: rgba(255,255,255,.8); border-color: var(--line); }
        .button-danger { color: #fff; background: linear-gradient(135deg, #d92d20, #8a1f11); }
        .button:hover,
        .button-secondary:hover,
        .button-danger:hover { transform: translateY(-1px); }

        .field-grid { display: grid; gap: 16px; }
        .field-grid.cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .field-grid.cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }

        label { display: grid; gap: 8px; font-weight: 700; color: #132238; }
        .input,
        .select,
        .textarea {
            width: 100%;
            border-radius: 16px;
            border: 1px solid rgba(15, 23, 42, 0.14);
            background: #fff;
            padding: 12px 14px;
            color: var(--text);
            font: inherit;
        }
        .textarea { min-height: 140px; resize: vertical; }

        .flash {
            border-radius: 20px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            padding: 14px 16px;
            background: rgba(255,255,255,.96);
        }

        .content {
            display: grid;
            gap: 18px;
        }

        .muted-box {
            border-radius: 20px;
            background: rgba(15, 23, 42, 0.04);
            padding: 14px 16px;
        }

        .summary-list {
            display: grid;
            gap: 12px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .summary-list li {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
        }

        .summary-list li:last-child { border-bottom: 0; }

        @media (max-width: 1120px) {
            .chrome { grid-template-columns: 1fr; }
            .sidebar { position: static; }
        }

        @media (max-width: 760px) {
            .frame { padding: 12px; }
            .workspace,
            .sidebar { border-radius: 24px; padding: 18px; }
            .grid.cols-2,
            .grid.cols-3,
            .grid.cols-4,
            .field-grid.cols-2,
            .field-grid.cols-3 { grid-template-columns: 1fr; }
            .topbar { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>
<div class="frame">
    <div class="chrome">
        <aside class="sidebar">
            <div class="brand">
                <span class="eyebrow">{{ $examHallTagline ?? 'Virtual Exam Hall' }}</span>
                <h1>{{ $appTitle ?? config('app.name', 'Laravel') }}</h1>
                <p class="tagline">{{ auth()->check() ? ucfirst(auth()->user()->role).' workspace' : 'Secure access for proctored exams and reporting.' }}</p>
            </div>

            @auth
                <div class="stack">
                    @if (auth()->user()->role === 'admin')
                        <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard <span class="muted">Overview</span></a>
                        <a class="nav-link" href="{{ url('/admin/students') }}">Students <span class="muted">Roster</span></a>
                        <a class="nav-link" href="{{ url('/admin/faculty') }}">Faculty <span class="muted">Team</span></a>
                        <a class="nav-link" href="{{ url('/subjects') }}">Subjects <span class="muted">Catalog</span></a>
                        <a class="nav-link" href="{{ url('/exams') }}">Exams <span class="muted">Schedule</span></a>
                        <a class="nav-link" href="{{ url('/announcements') }}">Announcements <span class="muted">Broadcasts</span></a>
                        <a class="nav-link" href="{{ url('/admin/reports') }}">Reports <span class="muted">Audit</span></a>
                        <a class="nav-link" href="{{ url('/admin/suspicious-activity') }}">Suspicious Activity <span class="muted">Flags</span></a>
                    @elseif (auth()->user()->role === 'faculty')
                        <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard <span class="muted">Teaching</span></a>
                        <a class="nav-link" href="{{ url('/questions') }}">Questions <span class="muted">Banks</span></a>
                        <a class="nav-link" href="{{ url('/faculty/assign-exams') }}">Assign Exams <span class="muted">Target</span></a>
                        <a class="nav-link" href="{{ url('/faculty/attempts') }}">Attempts <span class="muted">Monitor</span></a>
                        <a class="nav-link" href="{{ url('/faculty/reports') }}">Reports <span class="muted">Results</span></a>
                        <a class="nav-link" href="{{ url('/exams') }}">Exams <span class="muted">Schedule</span></a>
                        <a class="nav-link" href="{{ url('/announcements') }}">Announcements <span class="muted">Bulletins</span></a>
                    @else
                        <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard <span class="muted">Today</span></a>
                        <a class="nav-link" href="{{ url('/student/history') }}">History <span class="muted">Past exams</span></a>
                        <a class="nav-link" href="{{ url('/student/results') }}">Results <span class="muted">Scores</span></a>
                        <a class="nav-link" href="{{ url('/proctoring/logs') }}">Proctoring <span class="muted">Logs</span></a>
                        <a class="nav-link" href="{{ url('/announcements') }}">Announcements <span class="muted">Notices</span></a>
                    @endif
                </div>

                <div class="muted-box">
                    <div class="muted">Signed in as</div>
                    <strong>{{ auth()->user()->name }}</strong><br>
                    <span class="pill">{{ auth()->user()->email }}</span>
                </div>
            @else
                <div class="stack">
                    <a class="nav-link" href="{{ url('/') }}">Home <span class="muted">Landing</span></a>
                    <a class="nav-link" href="{{ url('/login') }}">Log in <span class="muted">Access</span></a>
                    <a class="nav-link" href="{{ url('/register') }}">Register <span class="muted">Student</span></a>
                </div>
            @endauth
        </aside>

        <section class="workspace">
            <header class="topbar">
                <div>
                    <div class="eyebrow">@yield('eyebrow', 'Dashboard')</div>
                    <h2 class="section-title">@yield('title', $appTitle ?? config('app.name', 'Laravel'))</h2>
                </div>
                <div class="user-chip">
                    <span>{{ now()->format('M d, Y') }}</span>
                    @auth
                        <span class="badge success">{{ ucfirst(auth()->user()->role) }}</span>
                        <form method="POST" action="{{ url('/logout') }}">
                            @csrf
                            <button type="submit" class="button-secondary" style="padding:8px 12px;">Logout</button>
                        </form>
                    @else
                        <a class="button-secondary" href="{{ url('/login') }}">Log in</a>
                    @endauth
                </div>
            </header>

            @if (session('success'))
                <div class="flash badge success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="flash">
                    <strong style="color: var(--danger);">Please fix the highlighted form fields.</strong>
                    <ul class="summary-list" style="margin-top: 12px;">
                        @foreach ($errors->all() as $error)
                            <li><span>{{ $error }}</span></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <main class="content">
                @yield('content')
            </main>
        </section>
    </div>
</div>
@stack('scripts')
</body>
</html>