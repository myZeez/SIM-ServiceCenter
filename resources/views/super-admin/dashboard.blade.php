<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                    {{ __('Super Admin Dashboard') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Monitoring & Kontrol Sistem</p>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="w-full mx-auto">
            <livewire:super-admin.dashboard />
        </div>
    </div>
</x-app-layout>

