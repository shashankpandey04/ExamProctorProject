@extends('layouts.app')

@section('title', 'Subjects')
@section('eyebrow', 'Catalog')

@section('content')
<section class="panel">
    <h2 class="section-title">Subject catalog</h2>
    <p class="muted">The academic units that exams can be attached to.</p>
</section>

<section class="table-card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($subjects as $subject)
                    <tr>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $subject->code }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($subject->description, 120) }}</td>
                        <td><span class="badge {{ $subject->is_active ? 'success' : 'warning' }}">{{ $subject->is_active ? 'Active' : 'Inactive' }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="4">No subjects available.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">{{ $subjects->links() }}</div>
</section>
@endsection