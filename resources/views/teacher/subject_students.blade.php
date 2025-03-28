@extends('layouts.app')

@section('title')
    Grades
@endsection

@section('content')
    <main>
        <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
            <div class="space-y-5 sm:space-y-6">
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <!-- Header -->
                    <div class="px-5 py-4 sm:px-6 sm:py-5">
                        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                            Grades - {{ $classroomSubject->subject->name }} ({{ $classroomSubject->subject_code }})
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
                                                            {{ $student->student->user->first_name }} {{ $student->student->user->last_name }}
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
                                                            @elseif($grade->status === 'submitted')
                                                                <span class="inline-flex items-center justify-center gap-1 rounded-full bg-brand-500 px-2.5 py-0.5 text-sm font-medium text-white">
                                                                    Submitted
                                                                </span>
                                                            @elseif($grade->status === 'approved')
                                                                <span class="inline-flex items-center justify-center gap-1 rounded-full bg-success-500 px-2.5 py-0.5 text-sm font-medium text-white">
                                                                    Approved
                                                                </span>
                                                            @elseif($grade->status === 'rejected')
                                                                <span class="inline-flex items-center justify-center gap-1 rounded-full bg-error-500 px-2.5 py-0.5 text-sm font-medium text-white">
                                                                    Rejected
                                                                </span>
                                                            @else
                                                                <span class="inline-flex items-center justify-center gap-1 rounded-full bg-gray-500 px-2.5 py-0.5 text-sm font-medium text-white">
                                                                    {{ ucfirst($grade->status) }}
                                                                </span>
                                                            @endif
                                                        @else
                                                            <span class="inline-flex items-center justify-center gap-1 rounded-full bg-gray-500 px-2.5 py-0.5 text-sm font-medium text-white">
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
                                            class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                                        Save
                                    </button>

                                    <!-- Submit to Admin Button -->
                                    <button type="submit" formaction="{{ route('grades.submit') }}"
                                            class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-5 py-3.5 text-sm font-medium text-white shadow-theme-xs transition hover:bg-brand-600">
                                        Submit to Admin
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- End Container -->
                </div> <!-- End Card -->
            </div>
        </div>
    </main>
@endsection
