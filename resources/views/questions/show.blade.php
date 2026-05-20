@extends('layouts.app')

@section('title', 'Question Details')
@section('eyebrow', 'Question bank')

@section('content')
<section class="hero">
    <div class="eyebrow">Question detail</div>
    <h1>{{ optional($question->exam)->title ?? 'Question' }}</h1>
    <p class="muted">Sequence {{ $question->sequence }} | {{ $question->question_type }} | {{ $question->marks }} marks</p>
</section>

<section class="grid cols-2">
    <div class="card">
        <h2>Prompt</h2>
        <p>{{ $question->question_text }}</p>
    </div>
    <div class="card">
        <h2>Metadata</h2>
        <div class="summary-list">
            <li><span>Exam</span><strong>{{ optional($question->exam)->title ?? '—' }}</strong></li>
            <li><span>Correct answer</span><strong>{{ $question->correct_answer ?: '—' }}</strong></li>
            <li><span>Marks</span><strong>{{ $question->marks }}</strong></li>
        </div>
    </div>
</section>

@if ($question->options)
<section class="table-card">
    <h2>Options</h2>
    <div class="grid cols-2">
        @foreach ($question->options as $option)
            <div class="muted-box">{{ $option }}</div>
        @endforeach
    </div>
</section>
@endif
@endsection