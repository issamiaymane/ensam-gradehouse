<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function create()
    {
        // Retrieve all subjects and eager load the classroom relationship
        $subjects = Subject::with('classroom')->get();

        // Fetch all classrooms
        $classrooms = Classroom::all();

        // Pass both subjects and classrooms to the view
        return view('admin.subjects.subjects', compact('subjects', 'classrooms'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'code' => 'required|string|max:10|unique:majors,code',
            'name' => 'required|string|max:255',
        ]);

        try {
            // Create the subject in the database
            Subject::create([
                'classroom_id' => $request->classroom_id,
                'code' => $request->code,
                'name' => $request->name,
            ]);

            // Redirect back to the subjects list or another page
            return redirect()->route('subject.create')->with('success', 'Subject created successfully!');
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->route('subject.create')->with('error', 'An error occurred while adding the subject: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        // Redirect back with a success message
        return redirect()->route('subject.create')->with('success', 'Subject deleted successfully!');
    }

    public function assign()
    {
        // Fetch all teachers and subjects
        $teachers = Teacher::with('user')->get(); // Include user details for teacher name
        $subjects = Subject::all();

        // Fetch existing assignments with teacher and subject relationships
        $assignments = Assignment::with('teacher.user', 'subject')->get();

        return view('admin.subjects.assign', compact('teachers', 'subjects', 'assignments'));
    }

    public function assignStore(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        try {
            // Check if the assignment already exists
            $existingAssignment = Assignment::where('teacher_id', $request->teacher_id)
                ->where('subject_id', $request->subject_id)
                ->exists();

            if ($existingAssignment) {
                return redirect()->route('subject.assign')->with('error', 'This teacher is already assigned to the selected subject.');
            }

            // Create the assignment in the database
            Assignment::create([
                'teacher_id' => $request->teacher_id,
                'subject_id' => $request->subject_id,
            ]);

            // Redirect back with a success message
            return redirect()->route('subject.assign')->with('success', 'Teacher assigned to subject successfully!');
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->route('subject.assign')->with('error', 'An error occurred while assigning the teacher: ' . $e->getMessage());
        }
    }

    public function assignDelete($assignmentId)
    {
        try {
            // Find and delete the assignment
            $assignment = Assignment::findOrFail($assignmentId);
            $assignment->delete();

            // Redirect back with a success message
            return redirect()->route('subject.assign')->with('success', 'Assignment deleted successfully!');
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->route('subject.assign')->with('error', 'An error occurred while deleting the assignment: ' . $e->getMessage());
        }
    }
}
