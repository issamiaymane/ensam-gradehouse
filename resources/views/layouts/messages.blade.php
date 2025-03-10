
@php
    $alerts = [
        'success' => 'bg-green-500 dark:bg-green-700 text-white dark:text-gray-200',
        'error' => 'bg-red-500 dark:bg-red-700 text-white dark:text-gray-200',
        'payment error' => 'bg-red-500 dark:bg-red-700 text-white dark:text-gray-200',
        'warning' => 'bg-yellow-500 dark:bg-yellow-600 text-white dark:text-gray-200',
        'info' => 'bg-blue-500 dark:bg-blue-700 text-white dark:text-gray-200',
        'secondary' => 'bg-gray-500 dark:bg-gray-700 text-white dark:text-gray-300',
        'primary' => 'bg-indigo-500 dark:bg-indigo-700 text-white dark:text-gray-200',
        'light' => 'bg-gray-200 text-gray-800 dark:bg-gray-800 dark:text-gray-300',
    ];
@endphp

@foreach ($alerts as $key => $color)
    @if(session($key))
        <div x-data="{ show: true }" x-show="show" x-transition
             class="{{ $color }} px-4 py-3 rounded-lg shadow-md flex items-center justify-between mb-3">
            <span>{{ session($key) }}</span>
            <button @click="show = false" class="text-white dark:text-gray-300 font-bold text-lg">&times;</button>
        </div>
    @endif
@endforeach


