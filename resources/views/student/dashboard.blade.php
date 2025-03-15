@extends('layouts.app')

@section('title')
    Student Dashboard
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
                                        We hope your school year is going well so far. Below is a list of your assigned classrooms throughout your journey at ENSAM Rabat.
                                    </p>
                                </div>
                            </div>
                        </div>
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
                                                    Classroom
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Year
                                                </p>
                                            </div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @if($classrooms->isEmpty())
                                        <tr>
                                            <td colspan="2" class="px-5 py-4 sm:px-6 text-center text-gray-500 dark:text-gray-400">
                                                No classrooms assigned yet.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($classrooms as $schoolYear => $yearClassrooms)

                                            <!-- List of classrooms for this school year -->
                                            @foreach($yearClassrooms as $classroom)
                                                <tr>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <div class="flex items-center">
                                                            <a href="{{ route('student.classroom.subjects', $classroom->classroomSchoolYear->id) }}" class="text-gray-800 text-theme-sm dark:text-white/90 hover:text-brand-500">
                                                                {{ $classroom->classroomSchoolYear->classroom->name }}
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <div class="flex items-center">
                                                            <p class="text-gray-800 text-theme-sm dark:text-white/90">
                                                                {{ $classroom->classroomSchoolYear->school_year }}
                                                            </p>
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
