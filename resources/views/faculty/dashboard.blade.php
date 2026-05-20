@extends('layouts.app')

@section('title', 'Faculty Dashboard')
@section('eyebrow', 'Faculty')

@section('content')
<section class="hero">
    <div class="eyebrow">Teaching workspace</div>
    <h1>Shape exams and review performance in one place.</h1>
    <p class="muted">Build question banks, assign exams, and monitor student attempts without leaving the faculty console.</p>
</section>

<section class="grid cols-2">
    <div class="metric"><strong>{{ $exams->total() }}</strong><span class="muted">Managed exams</span></div>
    <div class="metric"><strong>{{ $resultsCount }}</strong><span class="muted">Result records</span></div>
</section>

<section class="table-card">
    <h2>Recent exams</h2>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Subject</th>
                    <th>Schedule</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($exams as $exam)
                    <tr>
                        <td>{{ $exam->title }}</td>
                        <td>{{ optional($exam->subject)->name ?? '—' }}</td>
                        <td>{{ optional($exam->start_time)->format('M d, Y h:i A') }}</td>
                        <td><span class="badge {{ $exam->is_active ? 'success' : 'warning' }}">{{ $exam->is_active ? 'Active' : 'Draft' }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="4">No exams assigned yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">{{ $exams->links() }}</div>
</section>
@endsection