@extends('layouts.app')

@section('title', 'Suspicious Activity')
@section('eyebrow', 'Administration')

@section('content')
<section class="panel">
    <h2 class="section-title">Suspicious activity feed</h2>
    <p class="muted">Session-level proctoring violations that need examiner review.</p>
</section>

<section class="table-card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Exam</th>
                    <th>Violation</th>
                    <th>Description</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr>
                        <td>{{ optional($log->student)->name ?? '—' }}</td>
                        <td>{{ optional($log->exam)->title ?? '—' }}</td>
                        <td>{{ $log->violation_type }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($log->description, 120) }}</td>
                        <td>{{ optional($log->timestamp)->format('M d, Y h:i A') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5">No suspicious activity yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">{{ $logs->links() }}</div>
</section>
@endsection