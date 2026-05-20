@extends('layouts.guest')

@section('title', 'Log in')

@section('content')
<div class="guest-grid">
    <section class="hero">
        <div class="eyebrow">Secure access</div>
        <h1>Step into the exam console.</h1>
        <p class="muted">Log in to manage exams, monitor attempts, review results, and enter the proctored hall.</p>
        <div class="stack">
            <span class="badge">Admin, faculty, and student workspaces</span>
            <span class="muted">If your account is inactive, the system will block access until it is reactivated.</span>
        </div>
        <div class="stack" style="grid-auto-flow: column; justify-content:flex-start; gap: 12px; margin-top: 12px;">
            <a class="button" href="{{ url('/register') }}">Create account</a>
            <a class="button-secondary" href="{{ url('/') }}">Back to home</a>
        </div>
    </section>

    <section class="card">
        <form method="POST" action="{{ url('/login') }}" class="stack">
            @csrf
            <label>
                Email address
                <input class="input" type="email" name="email" value="{{ old('email') }}" required autofocus>
            </label>
            <label>
                Password
                <input class="input" type="password" name="password" required>
            </label>
            <label style="display:flex; align-items:center; gap:10px; font-weight:500;">
                <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                Remember me
            </label>
            <button type="submit" class="button">Log in</button>
        </form>
    </section>
</div>
@endsection