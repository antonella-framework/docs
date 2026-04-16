@php $level = $level ?? 0 @endphp

<ul class="my-0">
    @foreach ($items as $label => $item)
        @include('_nav.menu-item')
    @endforeach
</ul>

@if ($level === 0)
<div class="mt-6 px-4">
    <a href="https://github.com/cehojac/antonella-framework-for-wp"
       target="_blank"
       rel="noopener noreferrer"
       class="github-nav-btn flex items-center gap-2 w-full px-4 py-3 rounded-lg font-semibold text-sm transition-all duration-200"
       style="background: linear-gradient(135deg, #fccc12 0%, #f59e0b 100%); color: #1a202c !important; box-shadow: 0 2px 8px rgba(252,204,18,0.35); text-decoration: none !important;"
       onmouseover="this.style.boxShadow='0 4px 16px rgba(252,204,18,0.55)'; this.style.transform='translateY(-1px)'; this.style.color='#1a202c';"
       onmouseout="this.style.boxShadow='0 2px 8px rgba(252,204,18,0.35)'; this.style.transform='translateY(0)'; this.style.color='#1a202c';"
    >
        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/>
        </svg>
        <span>GitHub Repository</span>
        <svg class="w-3 h-3 ml-auto flex-shrink-0 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
        </svg>
    </a>
</div>
@endif
