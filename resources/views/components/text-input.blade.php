@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-white dark:text-gray-600 focus:border-blue-300 dark:focus:border-blue-300 focus:ring-blue-300 dark:focus:ring-light-blue rounded-md shadow-sm']) }}>
