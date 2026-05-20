@extends('layouts.app')

@section('title', 'Result Details')
@section('eyebrow', 'Assessment')

@section('content')
<section class="hero">
    <div class="eyebrow">Result detail</div>
    <h1>{{ optional($result->exam)->title ?? 'Result' }}</h1>
    <p class="muted">Published for {{ optional($result->student)->name ?? 'the student' }}.</p>
</section>

<section class="grid cols-2">
    <div class="card">
        <h2>Scores</h2>
        <div class="summary-list">
            <li><span>Obtained marks</span><strong>{{ $result->obtained_marks }}</strong></li>
            <li><span>Total marks</span><strong>{{ $result->total_marks }}</strong></li>
            <li><span>Percentage</span><strong>{{ $result->percentage }}%</strong></li>
            <li><span>Status</span><strong>{{ $result->status }}</strong></li>
        </div>
    </div>
    <div class="card">
        <h2>Remarks</h2>
        <p>{{ $result->remarks ?: 'No remarks supplied.' }}</p>
    </div>
</section>
@endsection