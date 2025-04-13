<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassroomSchoolYear;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\ClassroomSubject;
use App\Models\TeacherSubjectAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectTeacherAssignmentController extends Controller
{
    public function index()
    {
        // Fetch Classroom-School Years ordered by ID
        $classroomSchoolYears = ClassroomSchoolYear::with('classroom')
            ->orderBy('id')  // Changed from orderBy('school_year') to orderBy('id')
            ->get();

        $teachers = Teacher::with('user')->orderBy('id')->get();

        // Get selected classroom or default to first one
        $selectedClassroomId = request('classroom_school_year_id', $classroomSchoolYears->first()->id ?? null);

        // Get classroom ID from the selected classroom-school year
        $classroomId = null;
        $subjects = collect();
        $existingAssignments = [];

        if ($selectedClassroomId) {
            $classroomSchoolYear = ClassroomSchoolYear::with('classroom')->find($selectedClassroomId);
            $classroomId = $classroomSchoolYear->classroom_id;

            // Get subjects for this classroom ordered by ID
            $subjects = Subject::where('classroom_id', $classroomId)
                ->orderBy('id')
                ->get();

            // Get existing assignments grouped by subject ID
            $existingAssignments = ClassroomSubject::with(['teacherAssignments' => function($query) {
                $query->with('teacher.user');
            }])
                ->where('classroom_school_year_id', $selectedClassroomId)
                ->get()
                ->mapWithKeys(function ($item) {
                    return [
                        $item->subject_id => [
                            'classroom_subject_id' => $item->id,
                            'teacher_id' => $item->teacherAssignments->first()->teacher_id ?? null,
                            'teacher_name' => $item->teacherAssignments->first()->teacher->user->name ?? null
                        ]
                    ];
                });
        }

        return view('admin.upload.subject-teacher-assignments', compact(
            'classroomSchoolYears',
            'subjects',
            'teachers',
            'selectedClassroomId',
            'existingAssignments'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'classroom_school_year_id' => 'required|exists:classroom_school_year,id',
            'subjects' => 'required|array',
            'subjects.*.teacher_id' => 'nullable|exists:teachers,id'
        ]);

        // Get classroom ID to verify subjects belong to this classroom
        $classroomSchoolYear = ClassroomSchoolYear::find($request->classroom_school_year_id);
        $classroomId = $classroomSchoolYear->classroom_id;

        DB::transaction(function () use ($request, $classroomId) {
            foreach ($request->subjects as $subjectId => $data) {
                // Verify subject belongs to this classroom
                $subject = Subject::where('id', $subjectId)
                    ->where('classroom_id', $classroomId)
                    ->first();

                if (!$subject) continue;

                // Update or create classroom_subject record
                $classroomSubject = ClassroomSubject::updateOrCreate(
                    [
                        'classroom_school_year_id' => $request->classroom_school_year_id,
                        'subject_id' => $subjectId,
                    ]
                );

                // Handle teacher assignment
                if (!empty($data['teacher_id'])) {
                    TeacherSubjectAssignment::updateOrCreate(
                        ['classroom_subject_id' => $classroomSubject->id],
                        ['teacher_id' => $data['teacher_id']]
                    );
                } else {
                    // Remove assignment if no teacher selected
                    TeacherSubjectAssignment::where('classroom_subject_id', $classroomSubject->id)->delete();
                }
            }
        });

        return redirect()
            ->route('admin.subjectTeacherAssignments.index', [
                'classroom_school_year_id' => $request->classroom_school_year_id
            ])
            ->with('success', 'Assignments updated successfully');
    }
}
