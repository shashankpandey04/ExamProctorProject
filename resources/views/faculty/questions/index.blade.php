@extends('layouts.app')

@section('title', 'Question Bank')
@section('eyebrow', 'Faculty')

@section('content')
<section class="panel" style="display:flex; justify-content:space-between; gap:12px; align-items:center; flex-wrap:wrap;">
    <div>
        <h2 class="section-title">Question bank</h2>
        <p class="muted">Questions grouped by exam and sorted by sequence.</p>
    </div>
    <a class="button" href="{{ url('/questions/create') }}">New question</a>
</section>

<section class="table-card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Exam</th>
                    <th>Type</th>
                    <th>Question</th>
                    <th>Marks</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($questions as $question)
                    <tr>
                        <td>{{ optional($question->exam)->title ?? '—' }}</td>
                        <td>{{ $question->question_type }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($question->question_text, 100) }}</td>
                        <td>{{ $question->marks }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">No questions available.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">{{ $questions->links() }}</div>
</section>
@endsection