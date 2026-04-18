<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'AI Diagnosis - Cellcom Service Center' }}</title>

    @php $appLogo = \App\Models\Setting::where('key', 'app_logo')->value('value'); @endphp
    @if ($appLogo)
        <link rel="icon" type="image/x-icon" href="{{ Storage::url($appLogo) }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
    {{ $slot }}

    <!-- Livewire Scripts -->
    @livewireScripts

    <script>
        // Auto scroll to bottom when new message
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('scroll-to-bottom', () => {
                setTimeout(() => {
                    const container = document.getElementById('chat-container');
                    if (container) {
                        container.scrollTo({
                            top: container.scrollHeight,
                            behavior: 'smooth'
                        });
                    }
                }, 100);
            });
        });
    </script>
</body>
</html>
