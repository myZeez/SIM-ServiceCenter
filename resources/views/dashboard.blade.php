<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="page-header-title">Dashboard</p>
            <p class="page-header-subtitle">Selamat datang, {{ Auth::user()->name }}</p>
        </div>
    </x-slot>

    <div class="space-y-6">
        <livewire:dashboard.statistics />
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <livewire:dashboard.service-form />
            <livewire:dashboard.today-services />
        </div>
    </div>
</x-app-layout>
