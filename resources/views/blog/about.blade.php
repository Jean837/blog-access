@extends('blog.layout')
@section('title', 'À propos de la plateforme EDL')

@section('content')

{{-- Hero --}}
<section class="bg-gradient-to-br from-orange-600 via-yellow-500 to-green-600 text-white py-20">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <div class="text-6xl mb-6">☀️</div>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight">
            La plateforme Access Energy Benin
        </h1>
        <p class="text-xl text-white/90 max-w-2xl mx-auto leading-relaxed">
            Une marketplace digitale de mise en relation entre fournisseurs de solutions
            énergétiques et populations béninoises en quête d'accès fiable à l'électricité.
        </p>
    </div>
</section>

{{-- Problème --}}
<section class="max-w-4xl mx-auto px-4 py-16">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-extrabold text-gray-800 dark:text-white mb-4">
            Le problème qu'on résout
        </h2>
        <p class="text-gray-500 dark:text-gray-400 max-w-2xl mx-auto">
            Le Bénin fait face à une crise énergétique structurelle qui pèse lourd sur les ménages et les entreprises.
        </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-800 rounded-2xl p-6 text-center">
            <div class="text-4xl mb-3">⚡</div>
            <div class="text-2xl font-extrabold text-red-600 mb-2">Délestages fréquents</div>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                La SBEE coupe régulièrement le courant, paralysant activités et quotidien.
            </p>
        </div>
        <div class="bg-orange-50 dark:bg-orange-900/20 border border-orange-100 dark:border-orange-800 rounded-2xl p-6 text-center">
            <div class="text-4xl mb-3">🌿</div>
            <div class="text-2xl font-extrabold text-orange-600 mb-2">&lt;40% électrifiés</div>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Moins de 40% des zones rurales ont accès à l'électricité au Bénin.
            </p>
        </div>
        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-100 dark:border-yellow-800 rounded-2xl p-6 text-center">
            <div class="text-4xl mb-3">💸</div>
            <div class="text-2xl font-extrabold text-yellow-600 mb-2">80 000 FCFA/mois</div>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Le coût mensuel moyen d'un groupe électrogène pour un ménage béninois.
            </p>
        </div>
    </div>
</section>

{{-- Solution --}}
<section class="bg-gray-50 dark:bg-gray-800 py-16">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-800 dark:text-white mb-4">
                Notre solution
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach([
                ['☀️', 'Catalogue géolocalisé', 'Trouvez des fournisseurs de solutions solaires près de chez vous, filtrés par région et budget.'],
                ['💰', 'Simulateur PAYG', 'Calculez vos mensualités et payez votre kit solaire par tranches via Flooz ou MTN Money.'],
                ['🔧', 'Techniciens certifiés', 'Réservez un installateur certifié près de vous avec suivi en temps réel.'],
                ['⭐', 'Avis & notation', 'Consultez les avis d\'autres utilisateurs béninois avant de choisir.'],
                ['📊', 'Calculateur de besoins', 'Estimez la puissance solaire dont vous avez besoin selon vos équipements.'],
                ['🔔', 'Alertes subventions', 'Soyez notifié des programmes d\'aide disponibles dans votre région.'],
            ] as [$icon, $titre, $desc])
            <div class="bg-white dark:bg-gray-700 rounded-2xl p-6 flex gap-4 shadow-sm hover:shadow-md transition">
                <div class="text-3xl flex-shrink-0">{{ $icon }}</div>
                <div>
                    <h3 class="font-bold text-gray-800 dark:text-white mb-1">{{ $titre }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Timeline --}}
<section class="max-w-4xl mx-auto px-4 py-16">
    <h2 class="text-3xl font-extrabold text-gray-800 dark:text-white mb-12 text-center">
        🗓️ Feuille de route
    </h2>
    <div class="space-y-6">
        @foreach([
            ['✅', 'Phase 1 — Blog EDL', 'Avril 2026', 'Lancement du blog pour créer la communauté et partager les actualités énergie au Bénin.', 'green'],
            ['🔄', 'Phase 2 — Catalogue & PAYG', 'Juillet 2026', 'Lancement du catalogue de fournisseurs et du simulateur de paiement échelonné.', 'orange'],
            ['⏳', 'Phase 3 — Marketplace complète', 'Fin 2026', 'Géolocalisation techniciens, marketplace équipements, système d\'avis complet.', 'gray'],
            ['🔮', 'Phase 4 — Application mobile', '2027', 'Application Android native pour toucher les zones à faible connectivité.', 'gray'],
        ] as [$icon, $titre, $date, $desc, $color])
        <div class="flex gap-4">
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-{{ $color }}-100 dark:bg-{{ $color }}-900/30
                            flex items-center justify-center text-lg flex-shrink-0">
                    {{ $icon }}
                </div>
                <div class="w-0.5 bg-gray-200 dark:bg-gray-700 flex-1 mt-2"></div>
            </div>
            <div class="pb-8">
                <div class="flex items-center gap-3 mb-1">
                    <h3 class="font-bold text-gray-800 dark:text-white">{{ $titre }}</h3>
                    <span class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-500 px-2 py-0.5 rounded-full">
                        {{ $date }}
                    </span>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $desc }}</p>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- CTA liste d'attente --}}
<div class="max-w-4xl mx-auto px-4 pb-16">
    @include('partials.waitlist-cta')
</div>

@endsection