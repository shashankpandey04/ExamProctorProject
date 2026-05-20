@extends('layouts.app')

@section('title', 'Exam Hall')
@section('eyebrow', 'Student')

@section('content')
<section class="hero">
    <div class="eyebrow">Virtual hall</div>
    <h1>{{ $exam->title }}</h1>
    <p class="muted">You are signed in as {{ $student->name }}. Keep the camera on, stay within the exam window, and submit before time expires.</p>
</section>

<section class="grid cols-4">
    <div class="metric"><strong>{{ optional($exam->subject)->name ?? '—' }}</strong><span class="muted">Subject</span></div>
    <div class="metric"><strong>{{ $exam->room_code }}</strong><span class="muted">Room code</span></div>
    <div class="metric"><strong>{{ $exam->duration_minutes }}m</strong><span class="muted">Duration</span></div>
    <div class="metric"><strong>{{ $exam->questions->count() }}</strong><span class="muted">Questions</span></div>
</section>

<section class="grid cols-2">
    <div class="card">
        <h2>Instructions</h2>
        <p class="muted">{{ $exam->instructions ?: 'Follow the proctoring prompts, keep your face visible, and avoid leaving the exam window.' }}</p>
        <div class="summary-list">
            <li><span>Start time</span><strong>{{ optional($exam->start_time)->format('M d, Y h:i A') }}</strong></li>
            <li><span>End time</span><strong>{{ optional($exam->end_time)->format('M d, Y h:i A') }}</strong></li>
            <li><span>Total marks</span><strong>{{ $exam->total_marks }}</strong></li>
            <li><span>Passing marks</span><strong>{{ $exam->passing_marks }}</strong></li>
        </div>
    </div>

    <div class="card">
        <h2>Session checklist</h2>
        <ul style="line-height:1.9; color:#334155; padding-left:18px;">
            <li>Keep your camera active during the whole session.</li>
            <li>Do not refresh or leave the browser tab unnecessarily.</li>
            <li>Submit the attempt before the exam end time.</li>
        </ul>
    </div>
</section>

<section class="table-card">
    <h2>Question outline</h2>
    <div class="stack">
        @forelse ($exam->questions as $question)
            <div class="muted-box">
                <strong>{{ $loop->iteration }}. {{ $question->question_text }}</strong>
                <div class="muted">Type: {{ $question->question_type }} | Marks: {{ $question->marks }}</div>
                @if ($question->options)
                    <div style="display:grid; gap:6px; margin-top:10px;">
                        @foreach ($question->options as $option)
                            <div class="badge">{{ $option }}</div>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <p class="muted">No questions have been loaded for this exam yet.</p>
        @endforelse
    </div>
</section>
@endsection