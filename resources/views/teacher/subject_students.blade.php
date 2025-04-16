@extends('layouts.app')

@section('title')
    Grades
@endsection

@section('content')
    <div x-data="{ isExportModalOpen: false }">
        <main>
            <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                <div class="space-y-5 sm:space-y-6">
                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <!-- Header -->
                        <div class="px-5 py-4 sm:px-6 sm:py-5">
                            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                                Grades - {{ $classroomSubject->subject->name }} ({{ $classroomSubject->subject->subject_code }})
                            </h3>
                        </div>

                        <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6 max-w-6xl mx-auto">
                            @include('layouts.messages')

                            <!-- Grades Form -->
                            <form action="{{ route('grades.save') }}" method="POST" id="grades-form">
                                @csrf
                                <input type="hidden" name="classroom_subject_id" value="{{ $classroomSubject->id }}">

                                <!-- Grades Table -->
                                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] mt-6">
                                    <div class="max-w-full overflow-x-auto">
                                        <table class="min-w-full">
                                            <thead>
                                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                                <th class="px-5 py-3 sm:px-6">
                                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Student Name</p>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Grade</p>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Status</p>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                            @if($students->isEmpty())
                                                <tr>
                                                    <td colspan="3" class="px-5 py-4 sm:px-6 text-center text-gray-500 dark:text-gray-400">
                                                        No students enrolled in this subject.
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach($students as $student)
                                                    @php $grade = $student->grades->first(); @endphp
                                                    <tr>
                                                        <td class="px-5 py-4 sm:px-6">
                                                            <p class="text-gray-800 text-theme-sm dark:text-white/90">
                                                                {{ $student->student->user->last_name }} {{ $student->student->user->first_name }}
                                                            </p>
                                                            <input type="hidden" name="students[{{ $loop->index }}][student_id]" value="{{ $student->student_id }}">
                                                        </td>
                                                        <td class="px-5 py-4 sm:px-6">
                                                            <input type="text"
                                                                   name="students[{{ $loop->index }}][grade]"
                                                                   value="{{ $grade->grade ?? '' }}"
                                                                   class="w-20 px-2 py-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white"
                                                                   placeholder="Grade">
                                                        </td>
                                                        <td class="px-5 py-4 sm:px-6">
                                                            @if($grade)
                                                                @if($grade->status === 'draft')
                                                                    <span class="inline-flex items-center justify-center gap-1 rounded-full bg-warning-500 px-2.5 py-0.5 text-sm font-medium text-white">
                                                                        Draft
                                                                    </span>
                                                                @elseif($grade->status === 'sent')
                                                                    <span class="inline-flex items-center justify-center gap-1 rounded-full bg-success-500 px-2.5 py-0.5 text-sm font-medium text-white">
                                                                        Sent
                                                                    </span>
                                                                @else
                                                                    <span class="inline-flex items-center justify-center gap-1 rounded-full bg-gray-500 px-2.5 py-0.5 text-sm font-medium text-white">
                                                                        {{ ucfirst($grade->status) }}
                                                                    </span>
                                                                @endif
                                                            @else
                                                                <span class="inline-flex items-center justify-center gap-1 rounded-full bg-error-500 px-2.5 py-0.5 text-sm font-medium text-white">
                                                                    Not Graded
                                                                </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="border-t border-gray-100 px-6 py-6.5 dark:border-gray-800">
                                    <div class="flex justify-end gap-5">
                                        <!-- Save Button -->
                                        <button type="submit" formaction="{{ route('grades.save') }}"
                                                class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-warning-500 shadow-theme-xs">
                                            Save Grades
                                        </button>

                                        <!-- Submit to Admin Button -->
                                        <button type="submit" formaction="{{ route('grades.submit') }}"
                                                class="inline-flex items-center gap-2 px-4 py-3 text-sm bg-success-500  font-medium text-white rounded-lg">
                                            Send to Student
                                        </button>

                                        <!-- Export Button -->
                                        <button type="button" @click="isExportModalOpen = true"
                                                class="inline-flex items-center gap-2 px-4 py-3 text-sm bg-brand-500 font-medium text-white rounded-lg">
                                            Export Grades
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- End Container -->
                    </div> <!-- End Card -->
                </div>
            </div>
        </main>

        <!-- Export Modal -->
        <div x-show="isExportModalOpen" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
            <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
            <div @click.outside="isExportModalOpen = false" class="no-scrollbar relative flex w-full max-w-[700px] flex-col overflow-y-auto rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-11">
                <!-- Close Button -->
                <button @click="isExportModalOpen = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
                    <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z" fill="" />
                    </svg>
                </button>

                <div class="px-2 pr-14">
                    <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Export Grades</h4>
                    <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Export student grades to Excel format.</p>
                </div>

                <!-- Form -->
                <form action="{{ route('grades.export') }}" method="POST" enctype="multipart/form-data" class="flex flex-col">
                    @csrf
                    <input type="hidden" name="classroom_subject_id" value="{{ $classroomSubject->id }}">

                    <div class="px-2 overflow-y-auto custom-scrollbar">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-5">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Excel File</label>
                                <input type="file" name="grades_excel" accept=".xls,.xlsx" required
                                       class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mt-6 lg:justify-end">
                        <button @click="isExportModalOpen = false" type="button"
                                class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                            Cancel
                        </button>
                        <button type="submit"
                                class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                            Export
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
