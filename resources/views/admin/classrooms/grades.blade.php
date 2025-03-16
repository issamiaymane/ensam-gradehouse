@extends('layouts.app')

@section('title')
    Grades for {{ $classroomSubject->subject->name }}
@endsection

@section('content')
    <main>
        <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
            <div class="space-y-5 sm:space-y-6">
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <!-- Header -->
                    <div class="px-5 py-4 sm:px-6 sm:py-5">
                        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                            Grades for {{ $classroomSubject->subject->name }} ({{ $classroomSubject->classroomSchoolYear->classroom->name }})
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
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Student</p>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Grade</p>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Status</p>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Approval History</p>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @foreach ($classroomSubject->grades as $grade)
                                        <tr>
                                            <td class="px-5 py-4 sm:px-6">
                                                <p class="text-gray-800 text-theme-sm dark:text-white/90">
                                                    {{ $grade->student->user->first_name }} {{ $grade->student->user->last_name }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <p class="text-gray-800 text-theme-sm dark:text-white/90">
                                                    {{ $grade->grade }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <p class="text-gray-800 text-theme-sm dark:text-white/90">
                                                    {{ $grade->status }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                @if ($grade->adminApprovals && $grade->adminApprovals->count() > 0)
                                                    <div class="space-y-2">
                                                        @foreach ($grade->adminApprovals as $approval)
                                                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                                                <span class="font-medium">{{ ucfirst($approval->status) }}</span>
                                                                by {{ $approval->admin->first_name }} {{ $approval->admin->last_name }} on {{ $approval->reviewed_at->format('M d, Y H:i') }}
                                                                <p class="text-xs text-gray-500">{{ $approval->comment }}</p>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <p class="text-sm text-gray-500">No approval history.</p>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Approve Button -->
                        <form action="{{ route('admin.classrooms.subjects.approve', [$classroomSubject->classroomSchoolYear->id, $classroomSubject->id]) }}" method="POST" class="mt-6">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                                Approve All Grades
                            </button>
                        </form>

                        <!-- Reject Button -->
                        <form action="{{ route('admin.classrooms.subjects.reject', [$classroomSubject->classroomSchoolYear->id, $classroomSubject->id]) }}" method="POST" class="mt-3">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-red-500 shadow-theme-xs hover:bg-red-600">
                                Reject All Grades
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
