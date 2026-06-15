{{-- Barre de progression de lecture (en haut de page) --}}
<div id="progress-bar"
     class="fixed top-0 left-0 h-1 bg-gradient-to-r from-blue-500 to-purple-500 z-50 transition-all duration-150"
     style="width: 0%"></div>

{{-- Bouton retour en haut --}}
<button id="back-to-top"
        onclick="window.scrollTo({top:0, behavior:'smooth'})"
        class="fixed bottom-8 right-8 bg-blue-600 text-white w-12 h-12 rounded-full shadow-lg
               flex items-center justify-center text-xl
               opacity-0 translate-y-4 transition-all duration-300 hover:bg-blue-700 z-50">
    ↑
</button>

<script>
    const progressBar  = document.getElementById('progress-bar');
    const backToTopBtn = document.getElementById('back-to-top');

    window.addEventListener('scroll', () => {
        const scrollTop  = window.scrollY;
        const docHeight  = document.documentElement.scrollHeight - window.innerHeight;
        const progress   = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;

        progressBar.style.width = progress + '%';

        if (scrollTop > 300) {
            backToTopBtn.classList.remove('opacity-0', 'translate-y-4');
            backToTopBtn.classList.add('opacity-100', 'translate-y-0');
        } else {
            backToTopBtn.classList.add('opacity-0', 'translate-y-4');
            backToTopBtn.classList.remove('opacity-100', 'translate-y-0');
        }
    });
</script>