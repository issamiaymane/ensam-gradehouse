@extends('layouts.app')

@section('title')
    Subject Students
@endsection

@section('content')
    <main>
        <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
            <div class="space-y-5 sm:space-y-6">
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="px-5 py-4 sm:px-6 sm:py-5">
                        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                            Students for {{ $classroomSubject->subject->name }} ({{ $classroomSubject->subject_code }})
                        </h3>
                    </div>
                    <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6 max-w-6xl mx-auto">
                        <!-- Table Section -->
                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] mt-6">
                            <div class="max-w-full overflow-x-auto">
                                <table class="min-w-full">
                                    <!-- Table Header -->
                                    <thead>
                                    <tr class="border-b border-gray-100 dark:border-gray-800">
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Student
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
                                    </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @if($students->isEmpty())
                                        <tr>
                                            <td colspan="2" class="px-5 py-4 sm:px-6 text-center text-gray-500 dark:text-gray-400">
                                                No students enrolled in this subject.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($students as $student)
                                            <tr>
                                                <td class="px-5 py-4 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p class="text-gray-800 text-theme-sm dark:text-white/90">
                                                            {{ $student->student->user->first_name }} {{ $student->student->user->last_name }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-4 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p class="text-gray-800 text-theme-sm dark:text-white/90">
                                                            {{ $student->grades->first()->grade ?? 'N/A' }}
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
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
