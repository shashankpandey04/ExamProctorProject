@extends('layouts.app')

@section('title', $exam->title)
@section('eyebrow', 'Examination')

@section('content')
<section class="hero">
    <div class="eyebrow">Exam details</div>
    <h1>{{ $exam->title }}</h1>
    <p class="muted">{{ $exam->instructions ?: 'No instructions supplied.' }}</p>
</section>

<section class="grid cols-4">
    <div class="metric"><strong>{{ optional($exam->subject)->name ?? '—' }}</strong><span class="muted">Subject</span></div>
    <div class="metric"><strong>{{ optional($exam->faculty)->name ?? '—' }}</strong><span class="muted">Faculty</span></div>
    <div class="metric"><strong>{{ $exam->room_code }}</strong><span class="muted">Room code</span></div>
    <div class="metric"><strong>{{ $exam->is_active ? 'Live' : 'Draft' }}</strong><span class="muted">Status</span></div>
</section>

<section class="grid cols-2">
    <div class="card">
        <h2>Schedule</h2>
        <div class="summary-list">
            <li><span>Start</span><strong>{{ optional($exam->start_time)->format('M d, Y h:i A') }}</strong></li>
            <li><span>End</span><strong>{{ optional($exam->end_time)->format('M d, Y h:i A') }}</strong></li>
            <li><span>Duration</span><strong>{{ $exam->duration_minutes }} minutes</strong></li>
            <li><span>Published</span><strong>{{ optional($exam->published_at)->format('M d, Y h:i A') ?? '—' }}</strong></li>
        </div>
    </div>
    <div class="card">
        <h2>Marks and access</h2>
        <div class="summary-list">
            <li><span>Total marks</span><strong>{{ $exam->total_marks }}</strong></li>
            <li><span>Passing marks</span><strong>{{ $exam->passing_marks }}</strong></li>
            <li><span>Questions</span><strong>{{ $exam->questions->count() }}</strong></li>
            <li><span>Students</span><strong>{{ $exam->students->count() }}</strong></li>
        </div>
    </div>
</section>

<section class="table-card">
    <h2>Questions</h2>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Type</th>
                    <th>Marks</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($exam->questions as $question)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($question->question_text, 110) }}</td>
                        <td>{{ $question->question_type }}</td>
                        <td>{{ $question->marks }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">No questions linked to this exam.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

<section class="table-card">
    <h2>Assigned students</h2>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($exam->students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                    </tr>
                @empty
                    <tr><td colspan="2">No students have been assigned.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection