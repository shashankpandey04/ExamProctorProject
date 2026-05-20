<!doctype html>
<html>
<body style="font-family: Arial, sans-serif; background:#f4f7fb; margin:0; padding:24px; color:#0f172a;">
    <div style="max-width:640px; margin:0 auto; background:#fff; border-radius:24px; padding:28px; border:1px solid #dbe4f0;">
        <p style="text-transform:uppercase; letter-spacing:.18em; color:#0f766e; font-weight:700; font-size:12px;">Result update</p>
        <h1 style="margin-top:0;">{{ $result->exam->title }}</h1>
        <p>Hello {{ $student->name }}, your result has been published.</p>
        <div style="background:#ecfeff; padding:16px; border-radius:16px; border:1px solid #a5f3fc; line-height:1.8;">
            <div>Obtained marks: {{ $result->obtained_marks }}</div>
            <div>Total marks: {{ $result->total_marks }}</div>
            <div>Percentage: {{ $result->percentage }}%</div>
            <div>Status: {{ ucfirst($result->status) }}</div>
        </div>
    </div>
</body>
</html>