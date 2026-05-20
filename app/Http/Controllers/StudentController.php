<?php

namespace App\Http\Controllers;

use App\Mail\ExamReminderMail;
use App\Models\CameraLog;
use App\Models\Exam;
use App\Models\ProctorLog;
use App\Models\Result;
use App\Models\StudentExam;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function dashboard(): View
    {
        return app(DashboardController::class)->studentDashboard();
    }

    public function joinHall(Request $request, Exam $exam): View
    {
        $student = $request->user();

        StudentExam::firstOrCreate([
            'student_id' => $student->id,
            'exam_id' => $exam->id,
        ], [
            'status' => 'in_progress',
            'started_at' => now(),
        ]);

        session([
            'active_exam_id' => $exam->id,
            'exam_started_at' => now()->toIso8601String(),
            'violation_count' => 0,
        ]);

        return view('student.hall', [
            'exam' => $exam->load('questions', 'subject', 'faculty'),
            'student' => $student,
        ]);
    }

    public function profileImage(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_image' => ['required', 'image', 'max:2048'],
        ]);

        $path = $request->file('profile_image')->store('profiles', 'public');
        $request->user()->update(['profile_image' => $path]);

        return back()->with('success', 'Profile image updated.');
    }

    public function history(Request $request): View
    {
        return view('student.history', [
            'history' => $request->user()->takenExams()->with('subject')->latest()->paginate(10),
        ]);
    }

    public function results(Request $request): View
    {
        return view('student.results', [
            'results' => $request->user()->results()->with('exam')->latest()->paginate(10),
        ]);
    }

    public function remind(Request $request, Exam $exam): RedirectResponse
    {
        Mail::to($request->user()->email)->send(new ExamReminderMail($request->user(), $exam));

        return back()->with('success', 'Reminder email queued in the log mailer.');
    }

    public function submitExam(Request $request, Exam $exam): RedirectResponse
    {
        $studentExam = StudentExam::where('student_id', $request->user()->id)->where('exam_id', $exam->id)->firstOrFail();
        $studentExam->update([
            'submitted_at' => now(),
            'status' => 'submitted',
            'attempt_data' => $request->input('attempt_data', []),
        ]);

        session()->forget(['active_exam_id', 'exam_started_at']);

        return redirect()->route('student.results')->with('success', 'Exam submitted successfully.');
    }
}
