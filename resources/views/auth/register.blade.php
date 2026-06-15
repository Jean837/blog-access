<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription — EDL Bénin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-orange-50 via-yellow-50 to-green-50 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center p-4">

<div class="w-full max-w-4xl bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden flex">

    {{-- Panneau gauche --}}
    <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-green-500 via-yellow-500 to-orange-500 p-10 flex-col justify-between text-white">
        <div>
            <a href="{{ route('blog.index') }}" class="flex items-center gap-2 mb-12">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-2xl">☀️</div>
                <div>
                    <div class="text-xl font-extrabold leading-none">EDL</div>
                    <div class="text-xs text-white/80">Énergie Pour le Bénin</div>
                </div>
            </a>
            <h2 class="text-3xl font-extrabold mb-4 leading-tight">
                Rejoignez<br>la communauté ⚡
            </h2>
            <p class="text-white/85 leading-relaxed">
                Créez votre compte pour commenter les articles, recevoir
                les alertes subventions et suivre les actus énergie au Bénin.
            </p>
        </div>
        <div class="space-y-3">
            <div class="flex items-center gap-3 bg-white/15 backdrop-blur rounded-2xl p-4">
                <span class="text-2xl">📰</span>
                <div>
                    <div class="font-semibold text-sm">Accès aux articles</div>
                    <div class="text-xs text-white/75">Commentez et partagez</div>
                </div>
            </div>
            <div class="flex items-center gap-3 bg-white/15 backdrop-blur rounded-2xl p-4">
                <span class="text-2xl">🔔</span>
                <div>
                    <div class="font-semibold text-sm">Alertes subventions</div>
                    <div class="text-xs text-white/75">Soyez notifié en premier</div>
                </div>
            </div>
            <div class="flex items-center gap-3 bg-white/15 backdrop-blur rounded-2xl p-4">
                <span class="text-2xl">🌍</span>
                <div>
                    <div class="font-semibold text-sm">Communauté béninoise</div>
                    <div class="text-xs text-white/75">Partagez vos expériences</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Panneau droit --}}
    <div class="w-full md:w-1/2 p-8 md:p-10 flex flex-col justify-center">

        <div class="md:hidden flex items-center gap-2 mb-8">
            <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center text-xl">☀️</div>
            <div class="text-lg font-extrabold text-orange-600">EDL Bénin</div>
        </div>

        <h1 class="text-2xl font-extrabold text-gray-800 dark:text-white mb-2">Créer un compte</h1>
        <p class="text-gray-500 dark:text-gray-400 text-sm mb-6">
            Déjà inscrit ?
            <a href="{{ route('login') }}" class="text-orange-500 font-semibold hover:underline">Se connecter</a>
        </p>

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-4">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                    Nom complet
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                       class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl px-4 py-3 focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100 transition"
                       placeholder="Jean Dupont">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                    Adresse email
                </label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl px-4 py-3 focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100 transition"
                       placeholder="vous@exemple.com">
                <p class="text-xs text-gray-400 mt-1">📧 Un code de confirmation sera envoyé</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                    Mot de passe
                </label>
                <input type="password" name="password" required
                       class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl px-4 py-3 focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100 transition"
                       placeholder="Minimum 8 caractères">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                    Confirmer le mot de passe
                </label>
                <input type="password" name="password_confirmation" required
                       class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl px-4 py-3 focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100 transition"
                       placeholder="••••••••">
            </div>

            <button type="submit"
                    class="w-full bg-gradient-to-r from-green-500 to-orange-500 hover:from-green-600 hover:to-orange-600 text-white font-bold py-3 rounded-xl transition shadow-lg text-base mt-2">
                🚀 Créer mon compte
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('blog.index') }}"
               class="text-sm text-gray-400 hover:text-orange-500 transition">
                ← Retour au blog
            </a>
        </div>
    </div>
</div>

</body>
</html>