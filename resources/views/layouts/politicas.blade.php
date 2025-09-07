

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Políticas | TalentCheck</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col bg-gray-50">
        <div class="flex justify-center items-center py-8">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo-app.png') }}" alt="App Logo" class="block h-14 w-auto" style="max-height:56px;" />
            </a>
        </div>
        <main class="flex-1">
            <div class="max-w-4xl mx-auto py-8 px-4">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
