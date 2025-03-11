@extends('layouts.app')

@section('title')
    Manage Classrooms
@endsection


@section('content')
    <main>
        <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
            <!-- Breadcrumb Start -->
            <div x-data="{ pageName: 'Manage Classrooms' }">
                <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>
                    <nav>
                        <ol class="flex items-center gap-1.5">
                            <li>
                                <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{url('admin/dashboard')}}">
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

            <!-- Add Classroom Form -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Add New classroom</h3>
                </div>
                <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                    @include('layouts.messages')
                    <form action="{{ route('classroom.store') }}" method="POST">
                        {{ csrf_field() }}

                        <!-- Major Input -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Major</label>
                            <select
                                name="major_id"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required
                            >
                                @foreach($majors as $major)
                                    <option value="{{ $major->id }}">{{ $major->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Level Year Input -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Level Year</label>
                            <select
                                name="level_year"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required
                            >
                                <option value="first">First Year</option>
                                <option value="second">Second Year</option>
                                <option value="third">Third Year</option>
                            </select>
                        </div>

                        <!-- School Year Input -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">School Year</label>
                            <select
                                name="school_year"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required
                            >
                                <option value="2024/2025">2024/2025</option>
                                <option value="2025/2026">2024/2025</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button
                                type="submit"
                                class="w-full rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 dark:bg-brand-600 dark:hover:bg-brand-700 dark:focus:ring-brand-600"
                            >
                                Add Classroom
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Classrooms Table -->
            <div class="mt-6 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Existing Classrooms</h3>
                </div>
                <div class="border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                            <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-700 dark:text-gray-400">Major</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-700 dark:text-gray-400">Level year</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-700 dark:text-gray-400">School year</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-700 dark:text-gray-400">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-800 dark:bg-gray-900">
                            <!-- Loop through Classrooms and display each one -->
                            @foreach($classrooms as $classroom)
                                <tr>
                                    <!-- Display the major name -->
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-white/90">
                                        <!-- Check if a major exists for the classroom, otherwise show a default message -->
                                        {{ $classroom->major ? $classroom->major->name : 'No major assigned' }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-white/90">{{ $classroom->level_year }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-white/90">{{ $classroom->school_year }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-white/90">
                                        <div class="flex items-center gap-2">
                                            <!-- Edit Button -->
                                            <a href="" class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                                                Edit
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('classroom.delete', $classroom->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this classroom?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-inset ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03]">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
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
    </main>
@endsection
