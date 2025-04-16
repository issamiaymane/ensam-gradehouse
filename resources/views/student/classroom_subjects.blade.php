@extends('layouts.app')

@section('title')
    Grades
@endsection

@section('content')
    <div x-data="{ isSubjectDetailsModal: false, selectedSubject: null, showDebug: false }">
        <main>
            <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                <div class="space-y-5 sm:space-y-6">
                    <!-- Dashboard Card -->
                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <!-- Card Header -->
                        <div class="px-5 py-4 sm:px-6 sm:py-5">
                            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                                Grades for {{ $classroomSchoolYear->classroom->name }} ({{ $classroomSchoolYear->school_year }})
                            </h3>
                        </div>

                        <!-- Card Content -->
                        <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6 max-w-6xl mx-auto">
                            <!-- Upper Section: Student Name and Apogee Logo -->
                            <div class="flex flex-col md:flex-row items-center md:justify-between space-y-8 md:space-y-0 md:space-x-12">
                                <!-- Apogee School Logo -->
                                <div class="flex-shrink-0">
                                    <img src="{{ url('../images/logo/ensam-logo.png') }}" alt="Apogee School Logo" class="w-48 h-auto rounded-lg shadow-lg">
                                </div>

                                <!-- Student Name and Welcome Text -->
                                <div class="space-y-4 mx-auto w-fit text-center">
                                    <div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</p>
                                            <p class="text-lg font-semibold text-gray-800 dark:text-white/90">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Apogee Code</p>
                                            <p class="text-lg font-semibold text-gray-800 dark:text-white/90">{{ Auth::user()->student->apogee }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 sm:text-base">
                                                Below are your grades for the {{ $classroomSchoolYear->school_year }} school year. Please review them carefully.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Table Section: Grades -->
                            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] mt-6">
                                <div class="max-w-full overflow-x-auto">
                                    <table class="min-w-full">
                                        <!-- Table Header -->
                                        <thead>
                                        <tr class="border-b border-gray-100 dark:border-gray-800">
                                            <th class="px-5 py-3 sm:px-6">
                                                <div class="flex items-center">
                                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                        Subject
                                                    </p>
                                                </div>
                                            </th>
                                            <th class="px-5 py-3 sm:px-6">
                                                <div class="flex items-center">
                                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                        Grade
                                                    </p>
                                                </div>
                                            </th>
                                            <th class="px-5 py-3 sm:px-6">
                                                <div class="flex items-center">
                                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                        View details
                                                    </p>
                                                </div>
                                            </th>
                                        </tr>
                                        </thead>

                                        <!-- Table Body -->
                                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                        @if($subjects->isEmpty())
                                            <!-- No Subjects Found -->
                                            <tr>
                                                <td colspan="3" class="px-5 py-4 sm:px-6 text-center text-gray-500 dark:text-gray-400">
                                                    No subjects found for this classroom.
                                                </td>
                                            </tr>
                                        @else
                                            <!-- Loop Through Subjects -->
                                            @foreach($subjects as $subject)
                                                <tr>
                                                    <!-- Subject Name -->
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <div class="flex items-center">
                                                            <p class="text-gray-800 text-theme-sm dark:text-white/90">
                                                                {{ $subject->subject->name }}
                                                            </p>
                                                        </div>
                                                    </td>

                                                    <!-- Subject Grade -->
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <div class="flex items-center">
                                                            <p class="text-gray-800 text-theme-sm dark:text-white/90">
                                                                @if($subject->grades->isNotEmpty())
                                                                    {{ $subject->grades->first()->grade }}
                                                                @else
                                                                    N/A
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </td>

                                                    <!-- View Details Button -->
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <div class="flex items-center">
                                                            <button
                                                                @click="isSubjectDetailsModal = true; selectedSubject = {{ json_encode([
                                                                    'subject' => $subject->subject,
                                                                    'teacher' => optional($subject->teacherSubjectAssignments->first())->teacher,
                                                                    'grades' => $subject->grades
                                                                ]) }}"
                                                                class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300"
                                                            >
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6h.01M12 12h.01M12 18h.01"></path>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Footer Note -->
                            <div class="flex justify-end mt-6">
                                <p class="p-1 text-xs font-semibold text-gray-800 dark:text-white/90">
                                    ***If N/A is displayed next to a grade in your CC results, it means that
                                    the grade for that item is not yet available because the teacher
                                    has not yet sent the grade.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Subject Details Modal -->
        <div x-show="isSubjectDetailsModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
            <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
            <div @click.outside="isSubjectDetailsModal = false" class="no-scrollbar relative flex w-full max-w-[700px] flex-col overflow-y-auto rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-11">
                <!-- Close Button -->
                <button @click="isSubjectDetailsModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
                    <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z" fill="" />
                    </svg>
                </button>

                <!-- Modal Content -->
                <div class="px-2 pr-14">
                    <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
                        Subject Details
                    </h4>
                    <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
                        View additional details for this subject.
                    </p>
                </div>

                <!-- Subject Details -->
                <div class="px-2 overflow-y-auto custom-scrollbar">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Subject:
                            </label>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="selectedSubject?.subject?.name"></p>
                        </div>
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Teacher:
                            </label>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                <template x-if="selectedSubject?.teacher">
                                    <span>
                                        <span x-text="selectedSubject.teacher.user.first_name"></span>
                                        <span x-text="' ' + selectedSubject.teacher.user.last_name"></span>
                                    </span>
                                </template>
                                <template x-if="!selectedSubject?.teacher">
                                    <span>No teacher assigned</span>
                                </template>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
