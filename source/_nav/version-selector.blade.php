<!-- Version Selector -->
<div class="relative ml-4">
    <button 
        onclick="toggleVersionDropdown()" 
        class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-yellow-600 dark:hover:text-yellow-400 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
        type="button"
        title="Select version"
    >
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
        </svg>
        <span class="text-gray-900 dark:text-white">v1.9</span>
        <svg class="w-4 h-4 ml-1 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    
    <div id="version-dropdown" class="absolute right-0 mt-2 w-72 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-600 hidden z-50 overflow-hidden backdrop-blur-sm">
        <a href="/" class="flex items-start gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-yellow-50 dark:hover:bg-gray-700 hover:text-yellow-600 dark:hover:text-yellow-400 transition-colors duration-150 text-sm border-b border-gray-100 dark:border-gray-700">
            <div class="flex items-center gap-2 min-w-0">
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                    Latest
                </span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="font-semibold">v1.9 (Latest)</div>
                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Latest stable version with full feature set</div>
            </div>
        </a>
        <a href="https://antonellaframework.com/documentacion/" class="flex items-start gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-yellow-50 dark:hover:bg-gray-700 hover:text-yellow-600 dark:hover:text-yellow-400 transition-colors duration-150 text-sm border-b border-gray-100 dark:border-gray-700">
            <div class="flex items-center gap-2 min-w-0">
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                    Stable
                </span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="font-semibold">v1.8</div>
                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">PHP8 compatibility, Docker integration, API endpoints</div>
            </div>
        </a>
        <a href="https://antonellaframework.com/documentacion/1-7" class="flex items-start gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-yellow-50 dark:hover:bg-gray-700 hover:text-yellow-600 dark:hover:text-yellow-400 transition-colors duration-150 text-sm border-b border-gray-100 dark:border-gray-700">
            <div class="flex items-center gap-2 min-w-0">
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                    Stable
                </span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="font-semibold">v1.7</div>
                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Gutenberg blocks, language files, request improvements</div>
            </div>
        </a>
        <a href="https://antonellaframework.com/documentacion/1-6" class="flex items-start gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-yellow-50 dark:hover:bg-gray-700 hover:text-yellow-600 dark:hover:text-yellow-400 transition-colors duration-150 text-sm border-b border-gray-100 dark:border-gray-700">
            <div class="flex items-center gap-2 min-w-0">
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                    Stable
                </span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="font-semibold">v1.6</div>
                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Live testing and helpers improvements</div>
            </div>
        </a>
        <a href="https://antonellaframework.com/documentacion/1-5" class="flex items-start gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-yellow-50 dark:hover:bg-gray-700 hover:text-yellow-600 dark:hover:text-yellow-400 transition-colors duration-150 text-sm">
            <div class="flex items-center gap-2 min-w-0">
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                    Stable
                </span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="font-semibold">v1.5</div>
                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Blade templating system integration</div>
            </div>
        </a>
    </div>
</div>

@push('scripts')
<script>
// Version selector implementation
function toggleVersionDropdown() {
    console.log('Version dropdown clicked');
    const dropdown = document.getElementById('version-dropdown');
    if (dropdown) {
        dropdown.classList.toggle('hidden');
        console.log('Version dropdown toggled. Hidden:', dropdown.classList.contains('hidden'));
    } else {
        console.error('Version dropdown not found');
    }
}

// Close dropdown when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('version-dropdown');
        const button = event.target.closest('button[onclick="toggleVersionDropdown()"]');
        
        if (dropdown && !button && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
});
</script>
@endpush
