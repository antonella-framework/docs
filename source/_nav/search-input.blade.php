<div class="relative">
    <input 
        type="text" 
        id="search-input" 
        placeholder="Search documentation..." 
        class="w-full px-4 py-2.5 pl-11 pr-4 text-sm font-medium text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 hover:border-gray-300 dark:hover:border-gray-500 transition-all duration-200 min-w-[280px]"
        autocomplete="off"
    >
    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
    </svg>
    
    <!-- Search Results Dropdown -->
    <div id="search-results" class="absolute top-full left-0 right-0 mt-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg shadow-xl hidden z-50 max-h-96 overflow-y-auto backdrop-blur-sm">
        <div id="search-results-content"></div>
        <div id="search-no-results" class="px-4 py-4 text-sm text-gray-500 dark:text-gray-400 text-center hidden">
            No results found
        </div>
    </div>
</div>

@push('scripts')
<script>
// Local search implementation
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');
    const searchResultsContent = document.getElementById('search-results-content');
    const searchNoResults = document.getElementById('search-no-results');
    
    // Search data - will be populated with documentation content
    const searchData = [
        {
            title: 'Introduction',
            url: '/docs/introduction',
            content: 'Getting started with Antonella Framework WordPress development powerful framework'
        },
        {
            title: 'Installation',
            url: '/docs/installation',
            content: 'How to install Antonella Framework composer require setup configuration'
        },
        {
            title: 'Basic Setup',
            url: '/docs/basic-setup',
            content: 'Basic configuration and setup for your first Antonella project'
        },
        {
            title: 'Antonella Console',
            url: '/docs/console',
            content: 'Console commands makeup make helper widget cpt block docker serve test namespace'
        },
        {
            title: 'Docker Environment',
            url: '/docs/docker',
            content: 'Docker development environment WordPress testing localhost setup containers'
        },
        {
            title: 'Creating Controllers',
            url: '/docs/creating-controllers',
            content: 'How to create and use controllers in Antonella Framework MVC pattern'
        },
        {
            title: 'Working with Views',
            url: '/docs/working-with-views',
            content: 'Templates views rendering Blade templating system'
        },
        {
            title: 'Database Operations',
            url: '/docs/database-operations',
            content: 'Database queries ORM models WordPress database integration'
        },
        // Spanish content
        {
            title: 'Introducción',
            url: '/es/docs/introduction',
            content: 'Comenzando con Antonella Framework desarrollo WordPress framework potente'
        },
        {
            title: 'Consola Antonella',
            url: '/es/docs/console',
            content: 'Comandos de consola makeup make helper widget cpt block docker serve test namespace'
        },
        {
            title: 'Entorno Docker',
            url: '/es/docs/docker',
            content: 'Entorno de desarrollo Docker WordPress pruebas localhost configuración contenedores'
        }
    ];
    
    let searchTimeout;
    
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const query = this.value.trim();
        
        if (query.length < 2) {
            hideResults();
            return;
        }
        
        searchTimeout = setTimeout(() => {
            performSearch(query);
        }, 300);
    });
    
    searchInput.addEventListener('focus', function() {
        if (this.value.trim().length >= 2) {
            performSearch(this.value.trim());
        }
    });
    
    // Hide results when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            hideResults();
        }
    });
    
    function performSearch(query) {
        const results = searchData.filter(item => {
            const searchText = (item.title + ' ' + item.content).toLowerCase();
            return searchText.includes(query.toLowerCase());
        });
        
        displayResults(results, query);
    }
    
    function displayResults(results, query) {
        searchResultsContent.innerHTML = '';
        
        if (results.length === 0) {
            searchNoResults.classList.remove('hidden');
            searchResultsContent.classList.add('hidden');
        } else {
            searchNoResults.classList.add('hidden');
            searchResultsContent.classList.remove('hidden');
            
            results.slice(0, 8).forEach(result => {
                const resultElement = createResultElement(result, query);
                searchResultsContent.appendChild(resultElement);
            });
        }
        
        searchResults.classList.remove('hidden');
    }
    
    function createResultElement(result, query) {
        const div = document.createElement('div');
        div.className = 'px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer border-b border-gray-100 dark:border-gray-700 last:border-b-0';
        
        const title = highlightText(result.title, query);
        const content = truncateText(result.content, 100);
        const highlightedContent = highlightText(content, query);
        
        div.innerHTML = `
            <div class="font-medium text-gray-900 dark:text-gray-100 mb-1">${title}</div>
            <div class="text-sm text-gray-600 dark:text-gray-400">${highlightedContent}</div>
        `;
        
        div.addEventListener('click', function() {
            window.location.href = result.url;
        });
        
        return div;
    }
    
    function highlightText(text, query) {
        const regex = new RegExp(`(${escapeRegex(query)})`, 'gi');
        return text.replace(regex, '<mark class="bg-yellow-200 dark:bg-yellow-600 px-1 rounded">$1</mark>');
    }
    
    function truncateText(text, maxLength) {
        if (text.length <= maxLength) return text;
        return text.substr(0, maxLength) + '...';
    }
    
    function escapeRegex(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }
    
    function hideResults() {
        searchResults.classList.add('hidden');
    }
    
    // Keyboard navigation
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideResults();
            this.blur();
        }
    });
});
</script>
@endpush
