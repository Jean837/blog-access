<div class="bg-gradient-to-br from-orange-500 via-yellow-500 to-green-500 rounded-2xl p-8 my-10 text-white shadow-xl">
    <div class="max-w-2xl mx-auto text-center">

        <div class="text-5xl mb-4">⚡</div>
        <h3 class="text-2xl font-extrabold mb-2">
            Vous voulez vous équiper en solaire ?
        </h3>
        <p class="text-white/90 mb-2">
            La plateforme <strong>Access Energy Benin</strong> arrive bientôt.
            Inscrivez-vous pour être notifié en premier et bénéficier des offres de lancement.
        </p>

        {{-- Compteur live --}}
        <div class="flex items-center justify-center gap-2 mb-6">
            <div class="flex -space-x-2">
                @foreach(['🟠','🟡','🟢','🔵','🟣'] as $dot)
                <div class="w-7 h-7 rounded-full bg-white/30 flex items-center justify-center text-xs">
                    {{ $dot }}
                </div>
                @endforeach
            </div>
            <span class="text-white/90 text-sm">
                <span id="waitlist-counter" class="font-extrabold text-xl text-yellow-200">
                    {{ \App\Models\Waitlist::count() }}
                </span>
                personne(s) attendent déjà
            </span>
        </div>

        @if(session('waitlist_success'))
        <div class="bg-white/20 backdrop-blur rounded-xl px-4 py-3 mb-4 text-white font-semibold">
            🎉 Vous êtes sur la liste ! On vous préviendra en premier.
        </div>
        @elseif(session('waitlist_info'))
        <div class="bg-white/20 backdrop-blur rounded-xl px-4 py-3 mb-4 text-white">
            ℹ️ {{ session('waitlist_info') }}
        </div>
        @else
        <form method="POST" action="{{ route('waitlist.store') }}" class="space-y-3">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <input type="text" name="name"
                       class="w-full bg-white/20 backdrop-blur border border-white/30 text-white placeholder-white/70 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white"
                       placeholder="Votre prénom">
                <select name="region"
                        class="w-full bg-white/20 backdrop-blur border border-white/30 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white">
                    <option value="" class="text-gray-800">Votre région</option>
                    <option value="Cotonou" class="text-gray-800">Cotonou</option>
                    <option value="Porto-Novo" class="text-gray-800">Porto-Novo</option>
                    <option value="Parakou" class="text-gray-800">Parakou</option>
                    <option value="Abomey-Calavi" class="text-gray-800">Abomey-Calavi</option>
                    <option value="Bohicon" class="text-gray-800">Bohicon</option>
                    <option value="Natitingou" class="text-gray-800">Natitingou</option>
                    <option value="Lokossa" class="text-gray-800">Lokossa</option>
                    <option value="Ouidah" class="text-gray-800">Ouidah</option>
                    <option value="Autre" class="text-gray-800">Autre région</option>
                </select>
            </div>
            <div class="flex gap-3">
                <input type="email" name="email" required
                       class="flex-1 bg-white/20 backdrop-blur border border-white/30 text-white placeholder-white/70 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white"
                       placeholder="votre@email.com">
                <button type="submit"
                        class="bg-white text-orange-600 font-bold px-6 py-3 rounded-xl hover:bg-yellow-50 transition shadow-lg whitespace-nowrap">
                    Je m'inscris →
                </button>
            </div>
        </form>
        @endif

    </div>
</div>

{{-- Script compteur live --}}
<script>
// Actualise le compteur toutes les 30 secondes
function refreshCounter() {
    fetch('/waitlist/count')
        .then(r => r.json())
        .then(data => {
            const el = document.getElementById('waitlist-counter');
            if (el && data.count !== undefined) {
                el.textContent = data.count;
            }
        })
        .catch(() => {});
}
setInterval(refreshCounter, 30000);
</script>