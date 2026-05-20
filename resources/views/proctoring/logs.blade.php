@extends('layouts.app')

@section('title', 'Proctoring Logs')
@section('eyebrow', 'Student')

@section('content')
<section class="grid cols-2">
    <div class="card">
        <h2>Camera snapshots</h2>
        <div class="stack">
            @forelse ($cameraLogs as $log)
                <div class="muted-box">
                    <div class="muted">Captured {{ optional($log->captured_at)->format('M d, Y h:i A') }}</div>
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($log->image_path) }}" alt="Snapshot" style="width:100%; margin-top:10px; border-radius:18px;">
                </div>
            @empty
                <p class="muted">No snapshots recorded yet.</p>
            @endforelse
        </div>
        <div style="margin-top:16px;">{{ $cameraLogs->links() }}</div>
    </div>

    <div class="card">
        <h2>Violations</h2>
        <div class="stack">
            @forelse ($violations as $violation)
                <div class="muted-box">
                    <strong>{{ $violation->violation_type }}</strong>
                    <div class="muted">{{ $violation->description }}</div>
                    <div class="muted" style="margin-top:6px;">{{ optional($violation->timestamp)->format('M d, Y h:i A') }}</div>
                </div>
            @empty
                <p class="muted">No violations recorded.</p>
            @endforelse
        </div>
        <div style="margin-top:16px;">{{ $violations->links() }}</div>
    </div>
</section>
@endsection