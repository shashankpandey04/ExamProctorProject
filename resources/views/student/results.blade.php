@extends('layouts.app')

@section('title', 'My Results')
@section('eyebrow', 'Student')

@section('content')
<section class="panel">
    <h2 class="section-title">Results overview</h2>
    <p class="muted">Published result records for your completed exams.</p>
</section>

<section class="table-card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Exam</th>
                    <th>Obtained</th>
                    <th>Total</th>
                    <th>Percentage</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($results as $result)
                    <tr>
                        <td>{{ optional($result->exam)->title ?? '—' }}</td>
                        <td>{{ $result->obtained_marks }}</td>
                        <td>{{ $result->total_marks }}</td>
                        <td>{{ $result->percentage }}%</td>
                        <td><span class="badge {{ $result->status === 'passed' ? 'success' : ($result->status === 'failed' ? 'danger' : 'warning') }}">{{ $result->status }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="5">No results have been published.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">{{ $results->links() }}</div>
</section>
@endsection