@extends('layouts.app')

@section('title')
    Assign Student to Classroom
@endsection

@section('content')
    <main>
        <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
            <div x-data="{ pageName: 'Assign Student to Classroom' }">
                <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>
                    <nav>
                        <ol class="flex items-center gap-1.5">
                            <li>
                                <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{ url('admin/dashboard') }}">
                                    Home
                                    <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </li>
                            <li class="text-sm text-gray-800 dark:text-white/90" x-text="pageName"></li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Assign Student to Classroom Form -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Assign Student to Classroom</h3>
                </div>
                <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                    @include('layouts.messages')
                    <form action="{{ route('admin.storeClassroomStudent') }}" method="POST">
                        @csrf

                        <!-- Student Dropdown -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Student</label>
                            <select
                                name="student_id"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required
                            >
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->apogee }} - {{ $student->user->first_name }} {{ $student->user->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Classroom-School Year Dropdown -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Classroom-School Year</label>
                            <select
                                name="classroom_school_year_id"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required
                            >
                                @foreach($classroomSchoolYears as $classroomSchoolYear)
                                    <option value="{{ $classroomSchoolYear->id }}">
                                        {{ $classroomSchoolYear->classroom->name }} - {{ $classroomSchoolYear->school_year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button
                                type="submit"
                                class="w-full rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 dark:bg-brand-600 dark:hover:bg-brand-700 dark:focus:ring-brand-600"
                            >
                                Assign Student to Classroom
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Existing Classroom-Student Assignments Table -->
            <div class="mt-6 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Existing Classroom-Student Assignments</h3>
                </div>
                <div class="border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Student</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Classroom</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">School Year</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-800 dark:bg-gray-900">
                            @forelse($classroomStudents as $assignment)
                                <tr>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-white/90">
                                        {{ $assignment->student->apogee }} - {{ $assignment->student->user->first_name }} {{ $assignment->student->user->last_name }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-white/90">
                                        {{ $assignment->classroomSchoolYear->classroom->name }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-white/90">
                                        {{ $assignment->classroomSchoolYear->school_year }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-white/90">
                                        <form action="{{ route('admin.deleteClassroomStudent', $assignment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this assignment?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">No assignments found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
