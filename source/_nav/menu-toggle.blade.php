<button
    class="lg:hidden fixed right-4 bottom-6 flex items-center justify-center h-14 w-14 rounded-full text-gray-900 shadow-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
    style="z-index: 70; background-color: #fccc12;"  
    onclick="navMenu.toggle()"
    aria-label="Abrir menú de navegación"
    aria-controls="js-nav-menu"
    aria-expanded="false"
    id="mobile-nav-toggle"
    title="Menú"
>
    <svg id="js-nav-menu-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M3.75 5.25a.75.75 0 0 1 .75-.75h15a.75.75 0 0 1 0 1.5h-15a.75.75 0 0 1-.75-.75zm0 6a.75.75 0 0 1 .75-.75h15a.75.75 0 0 1 0 1.5h-15a.75.75 0 0 1-.75-.75zm0 6a.75.75 0 0 1 .75-.75h15a.75.75 0 0 1 0 1.5h-15a.75.75 0 0 1-.75-.75z" clip-rule="evenodd" />
    </svg>
    <svg id="js-nav-menu-hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="hidden h-6 w-6" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M6.225 4.811a.75.75 0 0 1 1.06 0L12 9.525l4.715-4.714a.75.75 0 1 1 1.06 1.06L13.06 10.586l4.715 4.714a.75.75 0 1 1-1.06 1.061L12 11.647l-4.715 4.714a.75.75 0 1 1-1.06-1.06l4.714-4.715-4.714-4.714a.75.75 0 0 1 0-1.061z" clip-rule="evenodd" />
    </svg>
</button>

@push('scripts')
<script>
    const navMenu = {
        toggle() {
            const menu = document.getElementById('js-nav-menu');
            const backdrop = document.getElementById('nav-backdrop');
            const isOpen = menu.classList.contains('offcanvas-open');
            if (isOpen) {
                this.close();
            } else {
                menu.classList.remove('offcanvas-closed');
                menu.classList.add('offcanvas-open');
                if (backdrop) backdrop.classList.remove('hidden');
                document.getElementById('js-nav-menu-hide').classList.remove('hidden');
                document.getElementById('js-nav-menu-show').classList.add('hidden');
                const btn = document.getElementById('mobile-nav-toggle');
                if (btn) {
                    btn.setAttribute('aria-expanded', 'true');
                    btn.setAttribute('aria-label', 'Cerrar menú de navegación');
                }
            }
        },
        close() {
            const menu = document.getElementById('js-nav-menu');
            const backdrop = document.getElementById('nav-backdrop');
            menu.classList.remove('offcanvas-open');
            menu.classList.add('offcanvas-closed');
            if (backdrop) backdrop.classList.add('hidden');
            document.getElementById('js-nav-menu-hide').classList.add('hidden');
            document.getElementById('js-nav-menu-show').classList.remove('hidden');
            const btn = document.getElementById('mobile-nav-toggle');
            if (btn) {
                btn.setAttribute('aria-expanded', 'false');
                btn.setAttribute('aria-label', 'Abrir menú de navegación');
            }
        }
    }

    // Close when clicking on backdrop
    document.addEventListener('DOMContentLoaded', function() {
        const backdrop = document.getElementById('nav-backdrop');
        if (backdrop) {
            backdrop.addEventListener('click', () => navMenu.close());
        }
    });
</script>
@endpush
