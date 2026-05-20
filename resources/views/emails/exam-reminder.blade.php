<!doctype html>
<html>
<body style="font-family: Arial, sans-serif; background:#f4f7fb; margin:0; padding:24px; color:#0f172a;">
    <div style="max-width:640px; margin:0 auto; background:#fff; border-radius:24px; padding:28px; border:1px solid #dbe4f0;">
        <p style="text-transform:uppercase; letter-spacing:.18em; color:#c2410c; font-weight:700; font-size:12px;">Exam reminder</p>
        <h1 style="margin-top:0;">{{ $exam->title }}</h1>
        <p>Hello {{ $student->name }}, your upcoming exam is scheduled for {{ optional($exam->start_time)->format('M d, Y h:i A') }}.</p>
        <ul style="line-height:1.8; color:#334155;">
            <li>Room code: {{ $exam->room_code }}</li>
            <li>Duration: {{ $exam->duration_minutes }} minutes</li>
            <li>Total marks: {{ $exam->total_marks }}</li>
        </ul>
    </div>
</body>
</html>