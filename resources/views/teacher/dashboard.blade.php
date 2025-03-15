@extends('layouts.app')

@section('title')
    Teacher Dashboard
@endsection

@section('content')
    <main>
        <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
            <div class="space-y-5 sm:space-y-6">
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="px-5 py-4 sm:px-6 sm:py-5">
                        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                            Dashboard
                        </h3>
                    </div>
                    <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6 max-w-6xl mx-auto">
                        <!-- Upper Section -->
                        <div class="flex flex-col md:flex-row items-center md:justify-between space-y-8 md:space-y-0 md:space-x-12">
                            <!-- Image -->
                            <div class="flex-shrink-0">
                                <img src="{{ url('../images/logo/ensam-logo.png') }}" alt="School Image" class="w-48 h-auto rounded-lg shadow-lg">
                            </div>
                            <!-- Text -->
                            <div class="space-y-4 mx-auto w-fit text-center">
                                <div>
                                    <h3 class="mb-4 text-theme-xl font-semibold text-gray-800 dark:text-white/90 sm:text-2xl">
                                        Welcome, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 sm:text-base">
                                        We hope that this school year is going well for you so far. As part of the process of collecting
                                        grades for continuous assessment (CC), we would like to remind you of the subjects you teach. This
                                        will help us organize the compilation of grades for each student effectively.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Table Section -->
                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] mt-6">
                            <div class="max-w-full overflow-x-auto">
                                <table class="min-w-full">
                                    <!-- Table Header -->

                                    <!-- Table Body -->
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @if($assignedSubjects->isEmpty())
                                        <tr>
                                            <td colspan="3" class="px-5 py-4 sm:px-6 text-center text-gray-500 dark:text-gray-400">
                                                No subjects assigned yet.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($assignedSubjects as $schoolYear => $yearAssignments)
                                            <!-- School Year Header -->
                                            <tr>
                                                <td colspan="3" class="px-5 py-3 bg-gray-50 dark:bg-gray-800">
                                                    <strong class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                        School Year: {{ $schoolYear }}
                                                    </strong>
                                                </td>
                                            </tr>
                                            <!-- List of subjects for this school year -->
                                            @foreach($yearAssignments as $assignment)
                                                <tr>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <div class="flex items-center">
                                                            <a href="{{ route('teacher.subject.students', $assignment->classroomSubject->id) }}" class="text-gray-800 text-theme-sm dark:text-white/90 hover:text-brand-500">
                                                                {{ $assignment->classroomSubject->subject_code }}
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <div class="flex items-center">
                                                            <a href="{{ route('teacher.subject.students', $assignment->classroomSubject->id) }}" class="text-gray-800 text-theme-sm dark:text-white/90 hover:text-brand-500">
                                                                {{ $assignment->classroomSubject->subject->name }}
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
