@extends('layouts.app')

@section('title')
    Manage Majors
@endsection

@section('content')
    <main>
        <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
            <!-- Breadcrumb Start -->
            <div x-data="{ pageName: 'Manage Majors' }">
                <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>
                    <nav>
                        <ol class="flex items-center gap-1.5">
                            <li>
                                <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="index.html">
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
            <!-- Breadcrumb End -->

            <!-- Add Major Form -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Add New Major</h3>
                </div>
                <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                    <form action="" method="POST">
                        @csrf
                        <!-- Major Code Input -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Major Code</label>
                            <input
                                type="text"
                                name="major_code"
                                placeholder="Enter major code"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required
                            />
                        </div>

                        <!-- Major Name Input -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Major Name</label>
                            <input
                                type="text"
                                name="major_name"
                                placeholder="Enter major name"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required
                            />
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button
                                type="submit"
                                class="w-full rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 dark:bg-brand-600 dark:hover:bg-brand-700 dark:focus:ring-brand-600"
                            >
                                Add Major
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Majors Table -->
            <div class="mt-6 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Existing Majors</h3>
                </div>
                <div class="border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                            <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-400">Major Code</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-400">Major Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-400">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-800 dark:bg-gray-900">
                            <!-- Example Row -->
                            <tr>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-white/90">CS101</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-white/90">Computer Science</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-white/90">
                                    <button class="text-brand-500 hover:text-brand-600">Edit</button>
                                    <button class="ml-4 text-red-500 hover:text-red-600">Delete</button>
                                </td>
                            </tr>
                            <!-- Add more rows dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
