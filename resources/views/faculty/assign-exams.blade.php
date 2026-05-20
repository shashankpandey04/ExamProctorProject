@extends('layouts.app')

@section('title', 'Assign Exams')
@section('eyebrow', 'Faculty')

@section('content')
<section class="panel">
    <h2 class="section-title">Assign and manage exams</h2>
    <p class="muted">Exams linked to your account can be reviewed, published, or assigned from here.</p>
</section>

<section class="table-card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Room code</th>
                    <th>Start</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($exams as $exam)
                    <tr>
                        <td>{{ $exam->title }}</td>
                        <td>{{ $exam->room_code }}</td>
                        <td>{{ optional($exam->start_time)->format('M d, Y h:i A') }}</td>
                        <td><span class="badge {{ $exam->is_active ? 'success' : 'warning' }}">{{ $exam->is_active ? 'Active' : 'Draft' }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="4">No exams assigned to you yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">{{ $exams->links() }}</div>
</section>
@endsection