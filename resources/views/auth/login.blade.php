<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Solar Access</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-orange-50 via-yellow-50 to-green-50 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center p-4">

<div class="w-full max-w-4xl bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden flex">

    {{-- Panneau gauche --}}
    <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-orange-500 via-yellow-500 to-green-500 p-10 flex-col justify-between text-white">
        <div>
            <a href="{{ route('blog.index') }}" class="flex items-center gap-2 mb-12">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-2xl">☀️</div>
                <div>
                    <div class="text-xl font-extrabold leading-none">EDL</div>
                    <div class="text-xs text-white/80">Énergie Pour le Bénin</div>
                </div>
            </a>
            <h2 class="text-3xl font-extrabold mb-4 leading-tight">
                Bienvenue<br>sur la plateforme
            </h2>
            <p class="text-white/85 leading-relaxed">
                Accédez aux actualités, guides pratiques et innovations
                en solutions énergétiques pour le Bénin.
            </p>
        </div>
        <div class="space-y-3">
            <div class="bg-white/15 backdrop-blur rounded-2xl p-4">
                <div class="text-2xl font-bold">5.5 kWh/m²/jour</div>
                <div class="text-sm text-white/80">Potentiel solaire du Bénin</div>
            </div>
            <div class="bg-white/15 backdrop-blur rounded-2xl p-4">
                <div class="text-2xl font-bold">-80%</div>
                <div class="text-sm text-white/80">Baisse du coût solaire en 10 ans</div>
            </div>
        </div>
    </div>

    {{-- Panneau droit --}}
    <div class="w-full md:w-1/2 p-8 md:p-10 flex flex-col justify-center">

        <div class="md:hidden flex items-center gap-2 mb-8">
            <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center text-xl">☀️</div>
            <div class="text-lg font-extrabold text-orange-600">EDL Bénin</div>
        </div>

        <h1 class="text-2xl font-extrabold text-gray-800 dark:text-white mb-2">Connexion</h1>
        <p class="text-gray-500 dark:text-gray-400 text-sm mb-8">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="text-orange-500 font-semibold hover:underline">S'inscrire</a>
        </p>

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-6">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                    Adresse email
                </label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl px-4 py-3 focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100 transition"
                       placeholder="vous@exemple.com">
            </div>

            <div>
                <div class="flex justify-between items-center mb-1">
                    <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Mot de passe</label>
                    @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-xs text-orange-500 hover:underline">Mot de passe oublié ?</a>
                    @endif
                </div>
                <input type="password" name="password" required
                       class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl px-4 py-3 focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100 transition"
                       placeholder="••••••••">
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="remember" id="remember"
                       class="w-4 h-4 accent-orange-500">
                <label for="remember" class="text-sm text-gray-600 dark:text-gray-400">
                    Se souvenir de moi
                </label>
            </div>

            <button type="submit"
                    class="w-full bg-gradient-to-r from-orange-500 to-yellow-500 hover:from-orange-600 hover:to-yellow-600 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-orange-200 dark:shadow-none text-base">
                🔐 Se connecter
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