@extends('layouts.app')

@section('title', 'Reports')
@section('eyebrow', 'Administration')

@section('content')
<section class="grid cols-2">
    <div class="metric"><strong>{{ $proctorLogs->total() }}</strong><span class="muted">Proctor logs</span></div>
    <div class="metric"><strong>{{ $results->total() }}</strong><span class="muted">Result records</span></div>
</section>

<section class="table-card">
    <h2>Latest result records</h2>
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
                        <td>{{ $result->student_name }}</td>
                        <td>{{ $result->exam_title }}</td>
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

<section class="table-card">
    <h2>Proctor logs</h2>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Exam</th>
                    <th>Violation</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($proctorLogs as $log)
                    <tr>
                        <td>{{ optional($log->student)->name ?? '—' }}</td>
                        <td>{{ optional($log->exam)->title ?? '—' }}</td>
                        <td>{{ $log->violation_type }}</td>
                        <td>{{ optional($log->timestamp)->format('M d, Y h:i A') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">No proctor logs recorded.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">{{ $proctorLogs->links() }}</div>
</section>
@endsection