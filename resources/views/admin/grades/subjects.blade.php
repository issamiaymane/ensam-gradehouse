@extends('layouts.app')

@section('title')
    Subjects for {{ $classroomSchoolYear->classroom->name }}
@endsection

@section('content')
    <main>
        <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
            <div class="space-y-5 sm:space-y-6">
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <!-- Header -->
                    <div class="px-5 py-4 sm:px-6 sm:py-5">
                        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                            Subjects for {{ $classroomSchoolYear->classroom->name }} ({{ $classroomSchoolYear->school_year }})
                        </h3>
                    </div>

                    <!-- Table -->
                    <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6 max-w-6xl mx-auto">
                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                            <div class="max-w-full overflow-x-auto">
                                <table class="min-w-full">
                                    <thead>
                                    <tr class="border-b border-gray-100 dark:border-gray-800">
                                        <th class="px-5 py-3 sm:px-6">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Subject</p>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Subject Code</p>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Semester</p>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Status</p>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Actions</p>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @foreach ($classroomSchoolYear->classroomSubjects as $cs)
                                        <tr>
                                            <td class="px-5 py-4 sm:px-6">
                                                <p class="text-gray-800 text-theme-sm dark:text-white/90">
                                                    {{ $cs->subject->name }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <p class="text-gray-800 text-theme-sm dark:text-white/90">
                                                    {{ $cs->subject_code }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <p class="text-gray-800 text-theme-sm dark:text-white/90">
                                                    {{ $cs->semester }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                @if ($cs->grades->where('status', 'approved')->count() > 0)
                                                    <span class="inline-flex items-center justify-center gap-1 rounded-full bg-success-500 px-2.5 py-0.5 text-sm font-medium text-white">
                                                            Approved
                                                        </span>
                                                @else
                                                    <span class="inline-flex items-center justify-center gap-1 rounded-full bg-gray-500 px-2.5 py-0.5 text-sm font-medium text-white">
                                                            Not yet Approved
                                                        </span>
                                                @endif
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <a href="{{ route('admin.classrooms.subjects.grades', [$classroomSchoolYear->id, $cs->id]) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                                                    View Grades
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
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
