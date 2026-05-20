@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<div class="guest-grid">
    <section class="hero">
        <div class="eyebrow">Student onboarding</div>
        <h1>Create your exam identity.</h1>
        <p class="muted">Register as a student to join live exams, track your history, and receive result notifications.</p>
        <div class="stack">
            <span class="badge">Profile photo optional</span>
            <span class="muted">Use a strong password with confirmation before joining the hall.</span>
        </div>
        <div class="stack" style="grid-auto-flow: column; justify-content:flex-start; gap: 12px; margin-top: 12px;">
            <a class="button-secondary" href="{{ url('/login') }}">Already have an account?</a>
            <a class="button-secondary" href="{{ url('/') }}">Back to home</a>
        </div>
    </section>

    <section class="card">
        <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data" class="stack">
            @csrf
            <label>
                Full name
                <input class="input" type="text" name="name" value="{{ old('name') }}" required>
            </label>
            <label>
                Email address
                <input class="input" type="email" name="email" value="{{ old('email') }}" required>
            </label>
            <label>
                Password
                <input class="input" type="password" name="password" required>
            </label>
            <label>
                Confirm password
                <input class="input" type="password" name="password_confirmation" required>
            </label>
            <label>
                Profile image
                <input class="input" type="file" name="profile_image" accept="image/*">
            </label>
            <label style="display:flex; align-items:center; gap:10px; font-weight:500;">
                <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                Keep me signed in
            </label>
            <button type="submit" class="button">Create account</button>
        </form>
    </section>
</div>
@endsection