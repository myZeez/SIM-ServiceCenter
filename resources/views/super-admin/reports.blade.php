<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Monitoring Laporan Bulanan') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="w-full mx-auto">
            <livewire:monthly-report />
        </div>
    </div>
</x-app-layout>

