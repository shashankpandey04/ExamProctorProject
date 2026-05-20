@extends('layouts.app')

@section('title', 'Student Dashboard')
@section('eyebrow', 'Student')

@section('content')
<section class="hero">
    <div class="eyebrow">Student workspace</div>
    <h1>See your upcoming exams and results at a glance.</h1>
    <p class="muted">Enter the hall only when the exam window is open, then review your score history after submission.</p>
</section>

<section class="grid cols-3">
    <div class="metric"><strong>{{ $upcomingExams->total() }}</strong><span class="muted">Upcoming exams</span></div>
    <div class="metric"><strong>{{ $results->total() }}</strong><span class="muted">Result entries</span></div>
    <div class="metric"><strong>{{ $violationsCount }}</strong><span class="muted">Violations</span></div>
</section>

<section class="table-card">
    <h2>Upcoming exams</h2>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Subject</th>
                    <th>Start</th>
                    <th>Room</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($upcomingExams as $exam)
                    <tr>
                        <td>{{ $exam->title }}</td>
                        <td>{{ optional($exam->subject)->name ?? '—' }}</td>
                        <td>{{ optional($exam->start_time)->format('M d, Y h:i A') }}</td>
                        <td>{{ $exam->room_code }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">No upcoming exams have been published.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">{{ $upcomingExams->links() }}</div>
</section>

<section class="table-card">
    <h2>Recent results</h2>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Exam</th>
                    <th>Percentage</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($results as $result)
                    <tr>
                        <td>{{ optional($result->exam)->title ?? '—' }}</td>
                        <td>{{ $result->percentage }}%</td>
                        <td><span class="badge {{ $result->status === 'passed' ? 'success' : ($result->status === 'failed' ? 'danger' : 'warning') }}">{{ $result->status }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="3">No results published yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">{{ $results->links() }}</div>
</section>
@endsection