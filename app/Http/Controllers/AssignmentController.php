<?php

namespace App\Http\Controllers;



use App\Models\ClassroomSchoolYear;
use App\Models\ClassroomStudent;
use App\Models\ClassroomSubject;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeacherSubjectAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    // Teacher
    public function assignTeacherToSubject() {
        $teachers = Teacher::with('user')->whereHas('user')->get();
        $classroomSubjects = ClassroomSubject::with(['classroomSchoolYear.classroom', 'subject'])->get();
        $teacherSubjectAssignments = TeacherSubjectAssignment::with(['teacher.user', 'classroomSubject.classroomSchoolYear.classroom', 'classroomSubject.subject'])->get();

        return view('admin.assignments.teacher_subject_assignment', compact('teachers', 'classroomSubjects', 'teacherSubjectAssignments'));
    }

    public function storeTeacherSubjectAssignment(Request $request) {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'classroom_subject_id' => 'required|exists:classroom_subject,id',
        ]);

        TeacherSubjectAssignment::create([
            'teacher_id' => $request->teacher_id,
            'classroom_subject_id' => $request->classroom_subject_id,
        ]);

        return redirect()->route('admin.assignTeacherToSubject')->with('success', 'Teacher assigned to subject successfully.');
    }

    public function deleteTeacherSubjectAssignment($id) {
        TeacherSubjectAssignment::findOrFail($id)->delete();
        return redirect()->route('admin.assignTeacherToSubject')->with('success', 'Assignment deleted successfully.');
    }

    // Student
    public function assignStudentToClassroom()
    {
        // Fetch all students with their user details
        $students = Student::with('user')->get();

        // Fetch all classroom-school year combinations with classroom details
        $classroomSchoolYears = ClassroomSchoolYear::with('classroom')->get();

        // Fetch all existing classroom-student assignments with related data
        $classroomStudents = ClassroomStudent::with(['student.user', 'classroomSchoolYear.classroom'])->get();

        return view('admin.assignments.classroom_student', compact('students', 'classroomSchoolYears', 'classroomStudents'));
    }

    // Store a new classroom-student assignment
    public function storeClassroomStudentAssignment(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'classroom_school_year_id' => 'required|exists:classroom_school_year,id',
        ]);

        try {
            DB::beginTransaction();

            // Check if the assignment already exists
            $existingAssignment = ClassroomStudent::where('student_id', $request->student_id)
                ->where('classroom_school_year_id', $request->classroom_school_year_id)
                ->exists();

            if ($existingAssignment) {
                return redirect()->back()->with('error', 'This student is already assigned to the selected classroom for this school year.');
            }

            // Create the assignment
            ClassroomStudent::create([
                'student_id' => $request->student_id,
                'classroom_school_year_id' => $request->classroom_school_year_id,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Student assigned to classroom successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while assigning the student to the classroom.');
        }
    }

    // Delete a classroom-student assignment
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $assignment = ClassroomStudent::findOrFail($id);
            $assignment->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Assignment deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while deleting the assignment.');
        }
    }

}
