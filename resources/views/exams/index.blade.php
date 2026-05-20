@extends('layouts.app')

@section('title', 'Exams')
@section('eyebrow', 'Examination')

@section('content')
<section class="panel" style="display:flex; justify-content:space-between; gap:12px; align-items:center; flex-wrap:wrap;">
    <div>
        <h2 class="section-title">Exam schedule</h2>
        <p class="muted">Published and draft exams with their timing and room codes.</p>
    </div>
    <a class="button" href="{{ url('/exams/create') }}">New exam</a>
</section>

<section class="table-card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Subject</th>
                    <th>Faculty</th>
                    <th>Start</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($exams as $exam)
                    <tr>
                        <td><a href="{{ url('/exams/'.$exam->id) }}">{{ $exam->title }}</a></td>
                        <td>{{ optional($exam->subject)->name ?? '—' }}</td>
                        <td>{{ optional($exam->faculty)->name ?? '—' }}</td>
                        <td>{{ optional($exam->start_time)->format('M d, Y h:i A') }}</td>
                        <td><span class="badge {{ $exam->is_active ? 'success' : 'warning' }}">{{ $exam->is_active ? 'Active' : 'Draft' }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="5">No exams available.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">{{ $exams->links() }}</div>
</section>
@endsection