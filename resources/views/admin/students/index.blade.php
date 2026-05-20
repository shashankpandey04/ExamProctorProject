@extends('layouts.app')

@section('title', 'Students')
@section('eyebrow', 'Administration')

@section('content')
<section class="panel">
    <div style="display:flex; justify-content:space-between; gap:12px; align-items:center; flex-wrap:wrap;">
        <div>
            <h2 class="section-title">Student roster</h2>
            <p class="muted">All student accounts registered in the system.</p>
        </div>
        <a class="button-secondary" href="{{ url('/register') }}">Add student</a>
    </div>
</section>

<section class="table-card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Last login</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td><span class="badge {{ ($student->status ?? 'active') === 'active' ? 'success' : 'warning' }}">{{ $student->status ?? 'active' }}</span></td>
                        <td>{{ $student->last_login_at ?? '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">No students found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">{{ $students->links() }}</div>
</section>
@endsection