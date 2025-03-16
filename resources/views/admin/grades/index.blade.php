@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Submitted Grades for Approval</h1>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Student</th>
                <th>Subject</th>
                <th>Classroom</th>
                <th>Major</th>
                <th>School Year</th>
                <th>Grade</th>
                <th>Semester</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($grades as $grade)
                <tr>
                    <td>{{ $grade->student_name }}</td>
                    <td>{{ $grade->subject_name }} ({{ $grade->subject_code }})</td>
                    <td>{{ $grade->classroom_name }} (Year {{ $grade->year_of_study }})</td>
                    <td>{{ $grade->major_name }} ({{ $grade->major_code }})</td>
                    <td>{{ $grade->school_year }}</td>
                    <td>{{ $grade->grade }}</td>
                    <td>{{ $grade->semester }}</td>
                    <td>{{ $grade->status }}</td>
                    <td>
                        <form action="{{ route('admin.grades.approve', $grade->grade_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form action="{{ route('admin.grades.reject', $grade->grade_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
