<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use App\Http\Requests\ExamRequest;
use App\Models\Announcement;
use App\Models\Exam;
use App\Models\ProctorLog;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        return app(DashboardController::class)->adminDashboard();
    }

    public function manageStudents(Request $request): View
    {
        $students = DB::table('users')
            ->where('role', 'student')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.students.index', compact('students'));
    }

    public function manageFaculty(): View
    {
        $faculty = User::query()->where('role', 'faculty')->latest()->paginate(10);

        return view('admin.faculty.index', compact('faculty'));
    }

    public function manageSubjects(): View
    {
        $subjects = Subject::query()->latest()->paginate(10);

        return view('subjects.index', compact('subjects'));
    }

    public function createExam(): View
    {
        return view('exams.create', [
            'subjects' => Subject::query()->where('is_active', true)->orderBy('name')->get(),
            'facultyMembers' => User::query()->where('role', 'faculty')->orderBy('name')->get(),
        ]);
    }

    public function storeExam(ExamRequest $request): RedirectResponse
    {
        Exam::create($request->validated());

        return redirect()->route('admin.exams.index')->with('success', 'Exam created successfully.');
    }

    public function exams(): View
    {
        return view('exams.index', [
            'exams' => Exam::query()->with(['subject', 'faculty'])->latest()->paginate(10),
        ]);
    }

    public function toggleExam(Exam $exam): RedirectResponse
    {
        $exam->update(['is_active' => ! $exam->is_active, 'published_at' => $exam->is_active ? null : now()]);

        return back()->with('success', 'Exam status updated.');
    }

    public function reports(): View
    {
        return view('admin.reports', [
            'proctorLogs' => ProctorLog::query()->with(['student', 'exam'])->latest()->paginate(15),
            'results' => DB::table('results')
                ->join('users', 'results.student_id', '=', 'users.id')
                ->join('exams', 'results.exam_id', '=', 'exams.id')
                ->select('users.name as student_name', 'exams.title as exam_title', 'results.percentage', 'results.status')
                ->orderByDesc('results.id')
                ->paginate(15),
        ]);
    }

    public function announcements(): View
    {
        return view('announcements.index', [
            'announcements' => Announcement::query()->with('creator')->latest()->paginate(10),
        ]);
    }

    public function storeAnnouncement(AnnouncementRequest $request): RedirectResponse
    {
        Announcement::create($request->validated() + ['created_by' => $request->user()->id]);

        return redirect()->route('admin.announcements')->with('success', 'Announcement published.');
    }

    public function suspiciousActivity(): View
    {
        return view('admin.suspicious-activity', [
            'logs' => ProctorLog::query()->with(['student', 'exam'])->latest()->paginate(20),
        ]);
    }
}
