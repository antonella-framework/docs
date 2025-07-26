<!DOCTYPE html>
<html lang="en" class="transition-colors duration-300">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="{{ $page->description ?? $page->siteDescription }}">

        <meta property="og:site_name" content="{{ $page->siteName }}"/>
        <meta property="og:title" content="{{ $page->title ?  $page->title . ' | ' : '' }}{{ $page->siteName }}"/>
        <meta property="og:description" content="{{ $page->description ?? $page->siteDescription }}"/>
        <meta property="og:url" content="{{ $page->getUrl() }}"/>
        <meta property="og:image" content="/assets/img/antonella-logo.png"/>
        <meta property="og:type" content="website"/>

        <meta name="twitter:image:alt" content="{{ $page->siteName }}">
        <meta name="twitter:card" content="summary_large_image">

        @if ($page->docsearchApiKey && $page->docsearchIndexName)
            <meta name="generator" content="tighten_jigsaw_doc">
        @endif

        <title>{{ $page->siteName }}{{ $page->title ? ' | ' . $page->title : '' }}</title>

        <link rel="home" href="{{ $page->baseUrl }}">
        <link rel="icon" href="/assets/img/antonella-logo.png">
        <link rel="apple-touch-icon" href="/assets/img/antonella-logo.png">
        <link rel="shortcut icon" href="/assets/img/antonella-logo.png">

        @stack('meta')

        @if ($page->production)
            <!-- Insert analytics code here -->
        @endif

        <script>
            // Theme toggle functionality - Load before page renders
            (function() {
                const theme = localStorage.getItem('theme') || 'light';
                document.documentElement.classList.toggle('dark', theme === 'dark');
            })();
        </script>

        <style>
            /* Base transition for smooth theme changes */
            .theme-transition {
                transition: background-color 0.3s ease, color 0.3s ease;
            }

            /* LIGHT THEME (Default) */
            body {
                background-color: #ffffff !important;
                color: #1a202c !important;
            }

            .header-theme {
                background-color: #ffffff !important;
                border-bottom: 1px solid #e2e8f0 !important;
                box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            }

            .footer-theme {
                background-color: #f8fafc !important;
                color: #4a5568 !important;
                border-top: 1px solid #e2e8f0;
            }

            .main-theme {
                background-color: #ffffff;
                color: #1a202c;
            }

            /* Site title */
            h1 {
                color: #1a202c !important;
            }

            /* DARK THEME */
            .dark body {
                background-color: #0f172a !important;
                color: #f1f5f9 !important;
            }

            .dark .header-theme {
                background-color: #0f172a !important;
                border-bottom: 1px solid #475569 !important;
                box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.4), 0 1px 3px 0 rgba(0, 0, 0, 0.6);
            }

            .dark .footer-theme {
                background-color: #1e293b !important;
                color: #cbd5e1 !important;
                border-top: 1px solid #475569;
            }

            .dark .main-theme {
                background-color: #0f172a;
                color: #f1f5f9;
            }

            .dark h1 {
                color: #f1f5f9 !important;
            }

            /* Theme toggle button styles */
            .theme-toggle {
                position: relative;
                width: 60px;
                height: 30px;
                background: #e2e8f0;
                border-radius: 15px;
                border: 2px solid #cbd5e0;
                cursor: pointer;
                transition: all 0.3s ease;
                outline: none;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .theme-toggle:hover {
                border-color: #fccc12;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            }

            .theme-toggle:focus {
                border-color: #fccc12;
                box-shadow: 0 0 0 3px rgba(252, 204, 18, 0.3), 0 2px 8px rgba(0, 0, 0, 0.15);
            }

            .theme-toggle-slider {
                position: absolute;
                top: 2px;
                left: 2px;
                width: 22px;
                height: 22px;
                background: #fccc12;
                border-radius: 50%;
                transition: transform 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            }

            /* Dark theme toggle */
            .dark .theme-toggle {
                background: #334155;
                border-color: #475569;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            }

            .dark .theme-toggle-slider {
                transform: translateX(28px);
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
            }

            /* Navigation theming */
            nav a {
                color: #4a5568 !important;
                transition: color 0.3s ease;
            }

            nav a:hover {
                color: #1a202c !important;
            }

            nav a.active {
                color: #fccc12 !important;
                font-weight: 600;
            }

            /* Dark theme navigation */
            .dark nav a {
                color: #cbd5e1 !important;
            }

            .dark nav a:hover {
                color: #f1f5f9 !important;
            }

            .dark nav a.active {
                color: #fccc12 !important;
            }

            /* Footer links */
            footer a {
                color: #fccc12 !important;
                transition: color 0.3s ease;
            }

            footer a:hover {
                color: #d4a017 !important;
            }

            /* Dark theme footer links */
            .dark footer a {
                color: #fccc12 !important;
            }

            .dark footer a:hover {
                color: #d4a017 !important;
            }

            /* Homepage specific theming */
            .homepage-bg {
                background-color: #ffffff;
            }

            .homepage-text {
                color: #1a202c !important;
            }

            .homepage-text-secondary {
                color: #4a5568 !important;
            }

            .btn-secondary {
                background-color: #e2e8f0;
                color: #1a202c;
                border: 1px solid #cbd5e0;
            }

            .btn-secondary:hover {
                background-color: #cbd5e0;
                color: #1a202c;
            }

            .btn-outline {
                background-color: transparent;
                color: #4a5568;
                border: 1px solid #cbd5e0;
            }

            .btn-outline:hover {
                background-color: #f8fafc;
                color: #1a202c;
            }

            .feature-icon-bg {
                background-color: rgba(252, 204, 18, 0.1);
                border: 1px solid rgba(252, 204, 18, 0.3);
            }

            .stat-card {
                background-color: #f8fafc;
                border: 1px solid #e2e8f0;
            }

            .stat-card:hover {
                border-color: rgba(252, 204, 18, 0.5);
            }

            /* Dark theme homepage */
            .dark .homepage-bg {
                background-color: #0f172a;
            }

            .dark .homepage-text {
                color: #f1f5f9 !important;
            }

            .dark .homepage-text-secondary {
                color: #cbd5e1 !important;
            }

            .dark .btn-secondary {
                background-color: #334155;
                color: #f1f5f9;
                border: 1px solid #475569;
            }

            .dark .btn-secondary:hover {
                background-color: #475569;
                color: #f1f5f9;
            }

            .dark .btn-outline {
                background-color: transparent;
                color: #cbd5e1;
                border: 1px solid #475569;
            }

            .dark .btn-outline:hover {
                background-color: #1e293b;
                color: #f1f5f9;
            }

            .dark .feature-icon-bg {
                background-color: rgba(252, 204, 18, 0.1);
                border: 1px solid rgba(252, 204, 18, 0.3);
            }

            .dark .stat-card {
                background-color: #1e293b;
                border: 1px solid #475569;
            }

            .dark .stat-card:hover {
                border-color: rgba(252, 204, 18, 0.5);
            }

            /* Language selector styles */
            .language-selector {
                display: flex;
                align-items: center;
                gap: 6px;
                padding: 6px 12px;
                background-color: #f8fafc;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                cursor: pointer;
                transition: all 0.3s ease;
                outline: none;
                font-size: 14px;
                font-weight: 500;
            }

            .language-selector:hover {
                background-color: #e2e8f0;
                border-color: #fccc12;
            }

            .language-selector:focus {
                border-color: #fccc12;
                box-shadow: 0 0 0 3px rgba(252, 204, 18, 0.2);
            }

            .language-flag {
                font-size: 16px;
                line-height: 1;
            }

            .language-name {
                color: #4a5568;
                font-weight: 600;
                min-width: 20px;
            }

            .language-arrow {
                width: 16px;
                height: 16px;
                color: #6b7280;
                transition: transform 0.3s ease;
            }

            .language-selector.open .language-arrow {
                transform: rotate(180deg);
            }

            .language-dropdown {
                position: absolute;
                top: 100%;
                right: 0;
                margin-top: 4px;
                background-color: #ffffff;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                z-index: 9999 !important;
                min-width: 140px;
                overflow: hidden;
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
                transition: all 0.2s ease;
            }

            .language-dropdown.hidden {
                opacity: 0;
                visibility: hidden;
                transform: translateY(-10px);
                pointer-events: none;
            }

            /* DocSearch Custom Styles */
            .DocSearch {
                --docsearch-primary-color: #fccc12 !important;
                --docsearch-text-color: #1a202c !important;
                --docsearch-spacing: 12px !important;
                --docsearch-icon-stroke-width: 1.4 !important;
                --docsearch-highlight-color: #fccc12 !important;
                --docsearch-muted-color: #6b7280 !important;
                --docsearch-container-background: rgba(0, 0, 0, 0.8) !important;
                --docsearch-logo-color: #fccc12 !important;
            }

            .dark .DocSearch {
                --docsearch-text-color: #f1f5f9 !important;
                --docsearch-searchbox-background: #1e293b !important;
                --docsearch-searchbox-focus-background: #334155 !important;
                --docsearch-hit-color: #f1f5f9 !important;
                --docsearch-hit-active-color: #0f172a !important;
                --docsearch-hit-background: #334155 !important;
                --docsearch-hit-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06) !important;
                --docsearch-key-gradient: linear-gradient(-225deg, #475569, #64748b) !important;
                --docsearch-footer-background: #1e293b !important;
                --docsearch-footer-shadow: 0 -1px 0 0 #475569, 0 -3px 6px 0 rgba(0, 0, 0, 0.12) !important;
                --docsearch-modal-background: #0f172a !important;
                --docsearch-modal-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
            }

            /* DocSearch Button Styling */
            .DocSearch-Button {
                background: white !important;
                border: 1px solid #e2e8f0 !important;
                border-radius: 8px !important;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
                height: 40px !important;
                margin: 0 !important;
                padding: 0 12px !important;
                transition: all 0.2s ease !important;
                width: 240px !important;
            }

            .DocSearch-Button:hover {
                background: #f9fafb !important;
                border-color: #fccc12 !important;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
            }

            .dark .DocSearch-Button {
                background: #1e293b !important;
                border-color: #475569 !important;
                color: #f1f5f9 !important;
            }

            .dark .DocSearch-Button:hover {
                background: #334155 !important;
                border-color: #fccc12 !important;
            }

            .DocSearch-Button-Placeholder {
                color: #6b7280 !important;
                font-size: 14px !important;
            }

            .dark .DocSearch-Button-Placeholder {
                color: #9ca3af !important;
            }

            .language-option {
                display: flex;
                align-items: center;
                gap: 8px;
                padding: 8px 12px;
                color: #374151;
                text-decoration: none;
                transition: background-color 0.2s ease;
                font-size: 14px;
            }

            .language-option:hover {
                background-color: #f9fafb;
                color: #1f2937;
            }

            .language-option.active {
                background-color: rgba(252, 204, 18, 0.1);
                color: #1f2937;
                font-weight: 600;
            }

            /* Dark theme language selector */
            .dark .language-selector {
                background-color: #334155;
                border-color: #475569;
                color: #f1f5f9;
            }

            .dark .language-selector:hover {
                background-color: #475569;
                border-color: #fccc12;
            }

            .dark .language-name {
                color: #f1f5f9;
            }

            .dark .language-arrow {
                color: #cbd5e1;
            }

            .dark .language-dropdown {
                background-color: #1e293b;
                border-color: #475569;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3), 0 2px 4px -1px rgba(0, 0, 0, 0.2);
                z-index: 9999 !important;
            }

            .dark .language-option {
                color: #d1d5db;
            }

            .dark .language-option:hover {
                background-color: #374151;
                color: #f9fafb;
            }

            .dark .language-option.active {
                background-color: rgba(252, 204, 18, 0.1);
                color: #f9fafb;
            }
        </style>

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,300i,400,400i,700,700i,800,800i" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/prismjs/themes/prism.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/@docsearch/css@3" rel="stylesheet" />

        @viteRefresh()
        <link rel="stylesheet" href="{{ vite('source/_assets/css/main.css') }}">
        <script defer type="module" src="{{ vite('source/_assets/js/main.js') }}"></script>

        @if ($page->docsearchApiKey && $page->docsearchIndexName)
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.css" />
        @endif
    </head>

    <body class="flex flex-col justify-between min-h-screen leading-normal font-sans theme-transition">
        <header class="flex items-center shadow-sm h-24 mb-8 py-4 header-theme" role="banner">
            <div class="container flex items-center max-w-8xl mx-auto px-4 lg:px-8">
                <div class="flex items-center">
                    <a href="/" title="{{ $page->siteName }} home" class="inline-flex items-center">
                        <img class="h-8 md:h-10 mr-3" src="/assets/img/antonella-logo.png" alt="{{ $page->siteName }} logo" />

                        <h1 class="text-lg md:text-2xl text-blue-900 font-semibold hover:text-blue-600 my-0 pr-4">{{ $page->siteName }}</h1>
                    </a>
                </div>

                <div class="flex flex-1 justify-end items-center text-right md:pl-10">
                    <!-- DocSearch Widget -->
                    @if ($page->docsearch['enabled'])
                        <div class="mr-4">
                            <div id="docsearch"></div>
                        </div>
                    @endif
                    
                    @include('_nav.version-selector')
                    
                    <!-- Language Selector -->
                    <div class="relative ml-4">
                        <button 
                            onclick="toggleLanguageDropdown()" 
                            class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-yellow-600 dark:hover:text-yellow-400 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
                            type="button"
                            title="Change language"
                        >
                            <span id="current-lang-flag" class="text-base">🇺🇸</span>
                            <span id="current-lang-name" class="text-gray-900 dark:text-white font-medium">EN</span>
                            <svg class="w-4 h-4 ml-1 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div id="lang-dropdown" class="absolute right-0 mt-2 w-40 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-600 hidden z-50 overflow-hidden backdrop-blur-sm">
                            <a href="/" class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-yellow-50 dark:hover:bg-gray-700 hover:text-yellow-600 dark:hover:text-yellow-400 transition-colors duration-150 text-sm">
                                <span class="text-lg">🇺🇸</span>
                                <span class="font-medium">English</span>
                            </a>
                            <a href="/es/" class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-yellow-50 dark:hover:bg-gray-700 hover:text-yellow-600 dark:hover:text-yellow-400 transition-colors duration-150 text-sm border-t border-gray-100 dark:border-gray-700">
                                <span class="text-lg">🇪🇸</span>
                                <span class="font-medium">Español</span>
                            </a>
                        </div>
                    </div>

                    <!-- Theme Toggle Button -->
                    <button 
                        id="theme-toggle" 
                        class="theme-toggle ml-4" 
                        aria-label="Toggle dark mode"
                        title="Toggle light/dark theme"
                    >
                        <div class="theme-toggle-slider">
                            <span class="theme-icon">🌙</span>
                        </div>
                    </button>
                </div>
            </div>

            @yield('nav-toggle')
        </header>

        <main role="main" class="w-full flex-auto main-theme">
            @yield('body')
        </main>

        <footer class="text-center text-sm mt-12 py-4 footer-theme" role="contentinfo">
            <ul class="flex flex-col md:flex-row justify-center">
                <li class="md:mr-2">
                    &copy; <a href="https://tighten.co" title="Tighten website">Tighten</a> {{ date('Y') }}.
                </li>

                <li>
                    Built with <a href="http://jigsaw.tighten.co" title="Jigsaw by Tighten">Jigsaw</a>

            <li>
                Built with <a href="http://jigsaw.tighten.co" title="Jigsaw by Tighten">Jigsaw</a>
                and <a href="https://tailwindcss.com" title="Tailwind CSS, a utility-first CSS framework">Tailwind CSS</a>.
            </li>
        </ul>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/prismjs/components/prism-core.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs/plugins/autoloader/prism-autoloader.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@docsearch/js@3"></script>

    <script>
        // Theme toggle implementation
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('theme-toggle');
            const themeIcon = document.querySelector('.theme-icon');
            const html = document.documentElement;

            if (!themeToggle || !themeIcon) return;

            // Initialize theme
            function initTheme() {
                const savedTheme = localStorage.getItem('theme') || 'light';
                setTheme(savedTheme);
            }

            // Set theme
            function setTheme(theme) {
                html.classList.toggle('dark', theme === 'dark');
                localStorage.setItem('theme', theme);
                themeIcon.textContent = theme === 'dark' ? '☀️' : '🌙';
                
                // Update meta theme-color for mobile browsers
                let metaThemeColor = document.querySelector('meta[name="theme-color"]');
                if (!metaThemeColor) {
                    metaThemeColor = document.createElement('meta');
                    metaThemeColor.name = 'theme-color';
                    document.head.appendChild(metaThemeColor);
                }
                metaThemeColor.setAttribute('content', theme === 'dark' ? '#111827' : '#ffffff');
            }

            // Toggle theme
            function toggleTheme() {
                const currentTheme = html.classList.contains('dark') ? 'dark' : 'light';
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                setTheme(newTheme);
            }

            // Event listeners
            themeToggle.addEventListener('click', toggleTheme);

            // Keyboard accessibility
            themeToggle.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    toggleTheme();
                }
            });

            // Initialize
            initTheme();
        });

        // Simple Language Selector
        function toggleLanguageDropdown() {
            console.log('Language dropdown clicked');
            const dropdown = document.getElementById('lang-dropdown');
            if (dropdown) {
                dropdown.classList.toggle('hidden');
                console.log('Dropdown toggled. Hidden:', dropdown.classList.contains('hidden'));
            } else {
                console.error('Dropdown not found');
            }
        }

        // Initialize language display on page load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Initializing language selector');
            
            const currentPath = window.location.pathname;
            const flagElement = document.getElementById('current-lang-flag');
            const nameElement = document.getElementById('current-lang-name');
            
            console.log('Current path:', currentPath);
            
            if (currentPath.startsWith('/es/') || currentPath === '/es') {
                console.log('Spanish page detected');
                if (flagElement) flagElement.textContent = '🇪🇸';
                if (nameElement) nameElement.textContent = 'ES';
            } else {
                console.log('English page detected');
                if (flagElement) flagElement.textContent = '🇺🇸';
                if (nameElement) nameElement.textContent = 'EN';
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('lang-dropdown');
            const button = event.target.closest('button[onclick="toggleLanguageDropdown()"]');
            
            if (dropdown && !button && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Initialize DocSearch
        @if ($page->docsearch['enabled'])
        docsearch({
            appId: '{{ $page->docsearch['appId'] }}',
            apiKey: '{{ $page->docsearch['apiKey'] }}',
            indexName: '{{ $page->docsearch['indexName'] }}',
            container: '#docsearch',
            placeholder: '{{ $page->docsearch['placeholder'] }}',
            debug: {{ $page->docsearch['debug'] ? 'true' : 'false' }},
            searchParameters: {
                facetFilters: ['language:{{ $page->currentLang ?? 'en' }}']
            },
            transformItems(items) {
                return items.map((item) => {
                    // Ensure URLs are properly formatted
                    const url = new URL(item.url);
                    item.url = url.pathname + url.hash;
                    return item;
                });
            }
        });
        @endif
    </script>

    @stack('scripts')
</body>
</html>
