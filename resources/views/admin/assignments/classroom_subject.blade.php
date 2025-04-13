@extends('layouts.app')

@section('title')
    Assign Subjects to Classroom
@endsection

@section('content')
    <main>
        <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
            <div x-data="{ pageName: 'Assign Subjects to Classroom' }">
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

            <!-- Assign Subjects to Classroom Form -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Assign Subjects to Classroom</h3>
                </div>
                <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                    @include('layouts.messages')
                    <form action="{{ route('admin.storeSubjectClassroom') }}" method="POST">
                        @csrf

                        <!-- Classroom-School Year Dropdown -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Classroom-School Year</label>
                            <select
                                name="classroom_school_year_id"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required
                            >
                                <option value="" disabled selected>[Select]</option>
                                @foreach($classroomSchoolYears as $classroomSchoolYear)
                                    <option value="{{ $classroomSchoolYear->id }}">
                                        {{ $classroomSchoolYear->classroom->name }} - {{ $classroomSchoolYear->school_year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Subject Dropdown -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Subject</label>
                            <select
                                name="subject_id"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required
                            >
                                <option value="" disabled selected>[Select]</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Subject Code Input -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Subject Code</label>
                            <select
                                name="subject_code"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required
                            >
                                <option value="" disabled selected>[Select]</option>
                                <option value="M1">M1</option>
                                <option value="M1.1">M1.1</option>
                                <option value="M1.2">M1.2</option>
                                <option value="M1.3">M1.3</option>
                                <option value="M2">M2</option>
                                <option value="M2.1">M2.1</option>
                                <option value="M2.2">M2.2</option>
                                <option value="M2.3">M2.3</option>
                                <option value="M3">M3</option>
                                <option value="M3.1">M3.1</option>
                                <option value="M3.2">M3.2</option>
                                <option value="M3.3">M3.3</option>
                                <option value="M4">M4</option>
                                <option value="M4.1">M4.1</option>
                                <option value="M4.2">M4.2</option>
                                <option value="M4.3">M4.3</option>
                                <option value="M5">M5</option>
                                <option value="M5.1">M5.1</option>
                                <option value="M5.2">M5.2</option>
                                <option value="M5.3">M5.3</option>
                                <option value="M6">M6</option>
                                <option value="M6.1">M6.1</option>
                                <option value="M6.2">M6.2</option>
                                <option value="M6.3">M6.3</option>
                                <!-- Add more as needed -->
                            </select>
                        </div>

                        <!-- Semester Input -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Semester</label>
                            <select
                                name="semester"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required
                            >
                                <option value="" disabled selected>[Select]</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                                <option value="S4">S4</option>
                                <option value="S5">S5</option>
                                <option value="S6">S6</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button
                                type="submit"
                                class="w-full rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 dark:bg-brand-600 dark:hover:bg-brand-700 dark:focus:ring-brand-600"
                            >
                                Assign Subject to Classroom
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Existing Classroom-Subject Assignments Table -->
            <div class="mt-6 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Existing Classroom-Subject Assignments</h3>
                </div>
                <div class="border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-800 dark:bg-gray-900">
                            <!-- Loop through classroom_subject assignments -->
                            @foreach($classroomSubjects as $classroomSubject)
                                <tr>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-white/90">
                                        {{ $classroomSubject->classroomSchoolYear->classroom->name }} - {{ $classroomSubject->classroomSchoolYear->school_year }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-white/90">
                                        {{ $classroomSubject->subject->name }} ({{ $classroomSubject->subject_code }} - {{ $classroomSubject->semester }})
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-white/90">
                                        <div class="flex items-center gap-2">
                                            <!-- Edit Button -->
                                            <a href="" class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                                                Edit
                                            </a>
                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.deleteSubjectClassroom', $classroomSubject->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this assignment?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-inset ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03]">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
