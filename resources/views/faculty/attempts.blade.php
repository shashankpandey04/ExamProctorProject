@extends('layouts.app')

@section('title', 'Attempts')
@section('eyebrow', 'Faculty')

@section('content')
<section class="panel">
    <h2 class="section-title">Student attempts</h2>
    <p class="muted">Monitor submission states and scores from the live attempts table.</p>
</section>

<section class="table-card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Exam</th>
                    <th>Status</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($attempts as $attempt)
                    <tr>
                        <td>{{ $attempt->student_name }}</td>
                        <td>{{ $attempt->exam_title }}</td>
                        <td>{{ $attempt->status }}</td>
                        <td>{{ $attempt->score ?? '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">No attempts yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">{{ $attempts->links() }}</div>
</section>
@endsection