@extends('layouts.app')

@section('title', 'Faculty Reports')
@section('eyebrow', 'Faculty')

@section('content')
<section class="grid cols-2">
    <div class="metric"><strong>{{ $subjects }}</strong><span class="muted">Subjects covered</span></div>
    <div class="metric"><strong>{{ $results->total() }}</strong><span class="muted">Result rows</span></div>
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
                    <tr><td colspan="4">No result records yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">{{ $results->links() }}</div>
</section>
@endsection