@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('eyebrow', 'Administration')

@section('content')
<section class="hero">
    <div class="eyebrow">Control center</div>
    <h1>Track the whole exam program from one dashboard.</h1>
    <p class="muted">Keep an eye on users, active exams, and the latest broadcasts while the proctoring feed stays under review.</p>
</section>

<section class="grid cols-4">
    <div class="metric"><strong>{{ $studentsCount }}</strong><span class="muted">Students</span></div>
    <div class="metric"><strong>{{ $facultyCount }}</strong><span class="muted">Faculty</span></div>
    <div class="metric"><strong>{{ $examsCount }}</strong><span class="muted">Total exams</span></div>
    <div class="metric"><strong>{{ $activeExamsCount }}</strong><span class="muted">Active exams</span></div>
</section>

<section class="grid cols-2">
    <div class="card">
        <h2>Latest announcements</h2>
        <div class="stack">
            @forelse ($latestAnnouncements as $announcement)
                <div class="muted-box">
                    <strong>{{ $announcement->title }}</strong>
                    <div class="muted">{{ \Illuminate\Support\Str::limit($announcement->message, 140) }}</div>
                </div>
            @empty
                <p class="muted">No announcements published yet.</p>
            @endforelse
        </div>
    </div>

    <div class="card">
        <h2>Risk snapshot</h2>
        <div class="summary-list">
            <li><span>Suspicious logs</span><strong>{{ $suspiciousLogsCount }}</strong></li>
            <li><span>Publish cadence</span><strong>Live</strong></li>
            <li><span>Recommended action</span><strong>Review activity</strong></li>
        </div>
    </div>
</section>
@endsection