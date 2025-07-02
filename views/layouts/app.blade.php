<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Aplikasi Bantuan Sosial</title>

    {{-- Bootstrap (optional) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Livewire Styles --}}
    @livewireStyles
</head>

<body class="bg-gray-100 text-gray-900">

    <div class="flex h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-blue-800 text-white p-6 space-y-4">
            <h2 class="text-2xl font-bold">Dashboard</h2>
            <ul class="space-y-2">
                <li><a href="/" class="hover:underline">Home</a></li>
                <li><a href="/penerima-bantuan" class="hover:underline">Penerima Bantuan</a></li>
                <li><a href="/assessment" class="hover:underline">Assessment</a></li>
            </ul>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 p-6 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>

    {{-- Livewire Scripts --}}
    @livewireScripts
</body>

</html>