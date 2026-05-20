@extends('layouts.app')

@section('title', 'Exam History')
@section('eyebrow', 'Student')

@section('content')
<section class="panel">
    <h2 class="section-title">Exam history</h2>
    <p class="muted">Past exam attempts and their submission states.</p>
</section>

<section class="table-card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Exam</th>
                    <th>Status</th>
                    <th>Started</th>
                    <th>Submitted</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($history as $attempt)
                    <tr>
                        <td>{{ optional($attempt->subject)->name ?? optional($attempt->exam)->title ?? '—' }}</td>
                        <td>{{ $attempt->pivot->status ?? '—' }}</td>
                        <td>{{ optional($attempt->pivot->started_at)->format('M d, Y h:i A') ?? '—' }}</td>
                        <td>{{ optional($attempt->pivot->submitted_at)->format('M d, Y h:i A') ?? '—' }}</td>
                        <td>{{ $attempt->pivot->score ?? '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5">No history yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">{{ $history->links() }}</div>
</section>
@endsection