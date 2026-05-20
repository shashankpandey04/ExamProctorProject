@extends('layouts.app')

@section('title', 'Announcements')
@section('eyebrow', 'Broadcasts')

@section('content')
<section class="panel" style="display:flex; justify-content:space-between; gap:12px; align-items:center; flex-wrap:wrap;">
    <div>
        <h2 class="section-title">Announcement board</h2>
        <p class="muted">System notices and schedule updates for students and faculty.</p>
    </div>
    <a class="button" href="{{ url('/announcements/create') }}">New announcement</a>
</section>

<section class="stack">
    @forelse ($announcements as $announcement)
        <article class="card">
            <div style="display:flex; justify-content:space-between; gap:12px; flex-wrap:wrap; align-items:flex-start;">
                <div>
                    <div class="eyebrow">{{ $announcement->audience }}</div>
                    <h2 style="margin-bottom:8px;">{{ $announcement->title }}</h2>
                    <p class="muted">{{ $announcement->message }}</p>
                </div>
                <div class="stack" style="gap:8px; min-width: 180px;">
                    <span class="badge {{ $announcement->is_active ? 'success' : 'warning' }}">{{ $announcement->is_active ? 'Active' : 'Draft' }}</span>
                    <span class="muted">{{ optional($announcement->publish_at)->format('M d, Y h:i A') ?? 'No publish date' }}</span>
                    <span class="muted">By {{ optional($announcement->creator)->name ?? 'system' }}</span>
                </div>
            </div>
        </article>
    @empty
        <div class="card">No announcements available.</div>
    @endforelse
</section>

<div style="margin-top:16px;">{{ $announcements->links() }}</div>
@endsection