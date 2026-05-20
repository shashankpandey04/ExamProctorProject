@extends('layouts.app')

@section('title', 'Questions')
@section('eyebrow', 'Question bank')

@section('content')
<section class="panel" style="display:flex; justify-content:space-between; gap:12px; align-items:center; flex-wrap:wrap;">
    <div>
        <h2 class="section-title">Question inventory</h2>
        <p class="muted">All questions ordered by sequence across exams.</p>
    </div>
    <a class="button" href="{{ url('/questions/create') }}">New question</a>
</section>

<section class="table-card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Exam</th>
                    <th>Sequence</th>
                    <th>Question</th>
                    <th>Type</th>
                    <th>Marks</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($questions as $question)
                    <tr>
                        <td>{{ optional($question->exam)->title ?? '—' }}</td>
                        <td>{{ $question->sequence }}</td>
                        <td><a href="{{ url('/questions/'.$question->id) }}">{{ \Illuminate\Support\Str::limit($question->question_text, 100) }}</a></td>
                        <td>{{ $question->question_type }}</td>
                        <td>{{ $question->marks }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5">No questions found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">{{ $questions->links() }}</div>
</section>
@endsection