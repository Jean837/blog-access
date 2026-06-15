<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accès refusé — EDL Bénin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-orange-50 to-yellow-50 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center p-4">
    <div class="text-center max-w-md">
        <div class="text-8xl mb-6">🚫</div>
        <h1 class="text-4xl font-extrabold text-gray-800 dark:text-white mb-4">Accès refusé</h1>
        <p class="text-gray-500 dark:text-gray-400 mb-8 leading-relaxed">
            Vous n'avez pas les droits nécessaires pour accéder à cette page.
            Seuls les administrateurs peuvent y accéder.
        </p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('blog.index') }}"
               class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-full font-semibold transition">
                🏠 Retour au blog
            </a>
            @guest
            <a href="{{ route('login') }}"
               class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 px-6 py-3 rounded-full font-semibold hover:border-orange-400 transition">
                🔐 Se connecter
            </a>
            @endguest
        </div>
    </div>
</body>
</html>