<?php

namespace App\Http\Controllers;


use App\Models\Major;
use App\Models\Subject;
use App\Models\Classroom;
use Illuminate\Http\Request;

class AcademicController extends Controller
{
    //Majors
    public function createMajor()
    {
        $majors = Major::all();

        return view('admin.majors.majors', compact('majors'));
    }

    public function storeMajor(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:10|unique:majors,code',
            'name' => 'required|string|max:255',
        ]);

        try {
            Major::create([
                'code' => $request->code,
                'name' => $request->name,
            ]);

            return redirect()->route('major.create')->with('success', 'Major created successfully!');

        }catch (\Exception $e) {

            return redirect()->route('major.create')->with('error', 'An error occurred while adding the student: ' . $e->getMessage());
        }

    }

    public function deleteMajor($id)
    {
        $major = Major::findOrFail($id);
        $major->delete();

        return redirect()->route('major.create')->with('success', 'Major deleted successfully!');
    }

    //Subjects
    public function createSubject()
    {
        $subjects = Subject::all();

        return view('admin.subjects.subjects', compact('subjects'));
    }

    public function storeSubject(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name',
        ]);

        try {
            Subject::create([
                'name' => $request->name,
            ]);

            return redirect()->route('subject.create')->with('success', 'Subject created successfully!');

        } catch (\Exception $e) {

            return redirect()->route('subject.create')->with('error', 'An error occurred while adding the subject: ' . $e->getMessage());
        }
    }

    public function deleteSubject($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('subject.create')->with('success', 'Subject deleted successfully!');
    }

    //Classrooms
    public function createClassroom()
    {
        $classrooms = Classroom::with(['major'])->get();
        $majors = Major::all();

        return view('admin.classrooms.classrooms', compact('classrooms', 'majors'));
    }

    public function storeClassroom(Request $request)
    {
        $request->validate([
            'major_id' => 'required|exists:majors,id',
            'level' => 'required|in:first,second,third',
        ]);

        try {
            // Create the classroom in the database
            Classroom::create([
                'major_id' => $request->major_id,
                'level' => $request->level,
            ]);

            return redirect()->route('classroom.create')->with('success', 'Classroom created successfully!');

        } catch (\Exception $e) {

            return redirect()->route('classroom.create')->with('error', 'An error occurred while adding the classroom: ' . $e->getMessage());
        }
    }

    public function deleteClassroom($id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->delete();

        return redirect()->route('classroom.create')->with('success', 'Classroom deleted successfully!');
    }
}
