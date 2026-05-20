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
            --panel: rgba(255,255,255,.94);
            --line: rgba(15, 23, 42, 0.12);
            --text: #0f172a;
            --muted: #5b6476;
            --accent: #ff7a18;
            --accent-2: #d9480f;
            --shadow: 0 32px 80px rgba(2, 6, 23, 0.22);
        }
        * { box-sizing: border-box; }
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
        .guest-wrap {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
        }
        .guest-shell {
            width: min(980px, 100%);
            border-radius: 36px;
            background: var(--panel);
            border: 1px solid rgba(255, 255, 255, 0.28);
            box-shadow: var(--shadow);
            backdrop-filter: blur(18px);
            padding: 28px;
        }
        .guest-grid {
            display: grid;
            grid-template-columns: 1.1fr .9fr;
            gap: 20px;
        }
        .hero,
        .card {
            border-radius: 28px;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(255,255,255,.98), rgba(250,250,252,.95));
            padding: 24px;
        }
        .eyebrow {
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--accent-2);
            font-size: .75rem;
            font-weight: 700;
        }
        h1, h2, p { margin-top: 0; }
        h1 { font-size: clamp(2rem, 4vw, 4rem); line-height: .98; margin-bottom: 14px; }
        .muted { color: var(--muted); }
        .button,
        .button-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 14px;
            border: 1px solid transparent;
            padding: 11px 16px;
            font-weight: 700;
        }
        .button { color: #fff; background: linear-gradient(135deg, var(--accent), var(--accent-2)); }
        .button-secondary { color: var(--text); background: rgba(255,255,255,.8); border-color: var(--line); }
        .field-grid { display: grid; gap: 16px; }
        .field-grid.cols-2 { grid-template-columns: repeat(2, minmax(0,1fr)); }
        label { display: grid; gap: 8px; font-weight: 700; }
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
        .stack { display: grid; gap: 12px; }
        .badge {
            display: inline-flex;
            border-radius: 999px;
            padding: 8px 12px;
            background: rgba(255,122,24,.12);
            color: #9a3412;
            font-size: .88rem;
            font-weight: 700;
        }
        @media (max-width: 860px) {
            .guest-grid { grid-template-columns: 1fr; }
            .guest-shell { padding: 18px; border-radius: 28px; }
        }
    </style>
</head>
<body>
<div class="guest-wrap">
    <div class="guest-shell">
        @yield('content')
    </div>
</div>
</body>
</html>