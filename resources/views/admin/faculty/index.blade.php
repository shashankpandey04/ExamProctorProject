@extends('layouts.app')

@section('title', 'Faculty')
@section('eyebrow', 'Administration')

@section('content')
<section class="panel">
    <h2 class="section-title">Faculty directory</h2>
    <p class="muted">Users assigned the faculty role and able to create content.</p>
</section>

<section class="table-card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Last login</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($faculty as $member)
                    <tr>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email }}</td>
                        <td><span class="badge success">{{ ucfirst($member->role) }}</span></td>
                        <td>{{ $member->last_login_at ?? '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">No faculty members found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">{{ $faculty->links() }}</div>
</section>
@endsection