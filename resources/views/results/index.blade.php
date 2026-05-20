@extends('layouts.app')

@section('title', 'Results')
@section('eyebrow', 'Assessment')

@section('content')
<section class="panel" style="display:flex; justify-content:space-between; gap:12px; align-items:center; flex-wrap:wrap;">
    <div>
        <h2 class="section-title">Result records</h2>
        <p class="muted">Published scoring data for all students and exams.</p>
    </div>
    <a class="button" href="{{ url('/results/create') }}">New result</a>
</section>

<section class="table-card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Exam</th>
                    <th>Percentage</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($results as $result)
                    <tr>
                        <td>{{ optional($result->student)->name ?? '—' }}</td>
                        <td>{{ optional($result->exam)->title ?? '—' }}</td>
                        <td>{{ $result->percentage }}%</td>
                        <td><span class="badge {{ $result->status === 'passed' ? 'success' : ($result->status === 'failed' ? 'danger' : 'warning') }}">{{ $result->status }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="4">No results stored yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">{{ $results->links() }}</div>
</section>
@endsection