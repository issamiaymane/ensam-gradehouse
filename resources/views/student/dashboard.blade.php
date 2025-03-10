@extends('layouts.app')

@section('title')
    Student Dashboard
@endsection

@section('content')
    <main>
        <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">

            <div class="space-y-5 sm:space-y-6">
                <div
                    class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]"
                >
                    <div class="px-5 py-4 sm:px-6 sm:py-5">
                        <h3
                            class="text-base font-medium text-gray-800 dark:text-white/90"
                        >
                            Grades
                        </h3>
                    </div>

                    <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6 max-w-6xl mx-auto">
                        <!-- Upper Section -->
                        <div class="flex flex-col md:flex-row items-center md:justify-between space-y-8 md:space-y-0 md:space-x-12">
                            <!-- Image -->
                            <div class="flex-shrink-0">
                                <img src="{{url('../images/logo/ensam-logo.png')}}" alt="School Image" class="w-48 h-auto rounded-lg shadow-lg">
                            </div>

                            <!-- Text -->
                            <div class="space-y-4 mx-auto w-fit text-center">
                                <!-- Full Name -->
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</p>
                                    <p class="text-lg font-semibold text-gray-800 dark:text-white/90">{{Auth::user()->name}}</p>
                                </div>

                                <!-- Apogee Code -->
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Apogee Code</p>
                                    <p class="text-lg font-semibold text-gray-800 dark:text-white/90">22020240</p>
                                </div>

                                <!-- Class -->
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Class</p>
                                    <p class="text-lg font-semibold text-gray-800 dark:text-white/90">2API</p>
                                </div>
                            </div>
                        </div>

                        <!-- Lower Section -->
                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] mt-6">
                            <div class="max-w-full overflow-x-auto">
                                <table class="min-w-full">
                                    <!-- En-tête du tableau -->
                                    <thead>
                                    <tr class="border-b border-gray-100 dark:border-gray-800">
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Module Element Name
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    CC Grade
                                                </p>
                                            </div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <!-- Corps du tableau -->
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    <tr>
                                        <td class="px-5 py-4 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="text-gray-800 text-theme-sm dark:text-white/90">
                                                    Analysis 3
                                                </p>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="text-gray-800 text-theme-sm dark:text-white/90">
                                                    11.00
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-5 py-4 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="text-gray-800 text-theme-sm dark:text-white/90">
                                                    Computer Science 3
                                                </p>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="text-gray-800 text-theme-sm dark:text-white/90">
                                                    N/A
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <p class="p-4 text-sm font-semibold text-gray-800 dark:text-white/90">
                            ***If N/A is displayed next to a grade in your CC results, it means that
                            the grade for that item is not yet available because the administration
                            has not yet submitted the grade.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>




@endsection
