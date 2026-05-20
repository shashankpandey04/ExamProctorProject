@extends('layouts.guest')

@section('title', config('app.name', 'Laravel'))

@section('content')
    <div class="guest-grid">
        <section class="hero">
            <div class="eyebrow">Proctored assessments</div>
            <h1>Run exams, monitor sessions, and publish results from one console.</h1>
            <p class="muted">Virtual Exam Hall keeps administrative, faculty, and student workflows in one place with audit-friendly reporting.</p>

            <div class="field-grid cols-2" style="margin-top: 10px;">
                <div class="badge">Secure exam room access</div>
                <div class="badge">Live proctoring logs</div>
                <div class="badge">Faculty question banks</div>
                <div class="badge">Student result history</div>
            </div>

            <div style="display:flex; gap:12px; flex-wrap:wrap; margin-top: 18px;">
                <a class="button" href="{{ url('/login') }}">Log in</a>
                <a class="button-secondary" href="{{ url('/register') }}">Register</a>
            </div>
        </section>

        <section class="card">
            <h2>What the platform covers</h2>
            <ul style="line-height:1.9; color:#334155; padding-left:18px; margin-bottom:0;">
                <li>Admin dashboards for users, subjects, exams, reports, and announcements.</li>
                <li>Faculty tools for question banks, exam assignment, and attempt monitoring.</li>
                <li>Student access to hall entry, history, results, and violation visibility.</li>
            </ul>
        </section>
    </div>
@endsection
