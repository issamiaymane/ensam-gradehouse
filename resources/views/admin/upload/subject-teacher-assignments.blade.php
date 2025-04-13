@extends('layouts.app')

@section('title', 'Subject-Teacher Assignments')

@section('content')
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Subject-Teacher Assignments</h2>
                <nav>
                    <ol class="flex items-center gap-1.5">
                        <li>
                            <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{ url('admin/dashboard') }}">
                                Home
                                <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                        <li class="text-sm text-gray-800 dark:text-white/90">Subject-Teacher Assignments</li>
                    </ol>
                </nav>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Manage Assignments</h3>
                </div>

                <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                    @include('layouts.messages')

                    <form action="{{ route('admin.subjectTeacherAssignments.store') }}" method="POST">
                        @csrf

                        <!-- Classroom Selection -->
                        <div class="mb-6">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Classroom-School Year</label>
                            <select name="classroom_school_year_id" id="classroom-selector"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                    required>
                                @foreach($classroomSchoolYears as $csy)
                                    <option value="{{ $csy->id }}" {{ $selectedClassroomId == $csy->id ? 'selected' : '' }}>
                                        {{ $csy->classroom->name }} - {{ $csy->school_year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Assignment Matrix -->
                        @if($subjects->isEmpty())
                            <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                                No subjects found for this classroom. Please add subjects first.
                            </div>
                        @else
                            <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <!-- Table header remains the same -->
                                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                                    @foreach($subjects as $subject)
                                        <tr>
                                            <!-- Table rows remain the same -->
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                        <!-- Assignment Matrix -->
                        <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Subject</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Teacher</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                                @foreach($subjects as $subject)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-white/90">
                                            {{ $subject->name }}
                                            <input type="hidden" name="subjects[{{ $subject->id }}][subject_id]" value="{{ $subject->id }}">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <select name="subjects[{{ $subject->id }}][teacher_id]"
                                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-9 w-full rounded-lg border border-gray-300 bg-transparent px-3 py-1 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                <option value="">-- No Teacher --</option>
                                                @foreach($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}" {{ ($existingAssignments[$subject->id]['teacher_id'] ?? '') == $teacher->id ? 'selected' : '' }}>
                                                        {{ $teacher->user->first_name }} {{ $teacher->user->last_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button type="submit"
                                    class="w-full rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 dark:bg-brand-600 dark:hover:bg-brand-700 dark:focus:ring-brand-600">
                                Save All Assignments
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Auto-refresh when classroom changes
        document.getElementById('classroom-selector').addEventListener('change', function() {
            window.location.href = "{{ route('admin.subjectTeacherAssignments.index') }}?classroom_school_year_id=" + this.value;
        });
    </script>
@endsection
