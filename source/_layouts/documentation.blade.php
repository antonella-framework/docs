@extends('_layouts.master')

@section('nav-toggle')
    @include('_nav.menu-toggle')
@endsection

@section('body')
<section class="container max-w-8xl mx-auto px-6 md:px-8 py-4">
    <div class="flex flex-col lg:flex-row">
        <nav id="js-nav-menu" class="nav-menu hidden lg:block">
            @php
                $isSpanish = strpos($page->getPath(), '/es/') === 0 || $page->getPath() === '/es';
                $navigationItems = $isSpanish ? $page->navigation_es : $page->navigation;
            @endphp
            @include('_nav.menu', ['items' => $navigationItems])
        </nav>

        <div class="DocSearch-content w-full lg:w-3/5 break-words pb-16 lg:pl-4" v-pre>
            <div class="mb-6 p-4 rounded-lg border border-yellow-300 bg-yellow-50 text-gray-900 dark:bg-gray-800 dark:border-yellow-600 dark:text-gray-100">
                @if ($isSpanish)
                    <strong>Docs técnicas avanzadas:</strong> consulta la <a href="https://deepwiki.com/cehojac/antonella-framework-for-wp" class="underline text-yellow-700 dark:text-yellow-400 hover:text-yellow-800 dark:hover:text-yellow-300" target="_blank" rel="noopener">Deep Wiki</a> para patrones internos, arquitectura, decisiones de diseño y guías para usuarios avanzados.
                @else
                    <strong>Advanced technical docs:</strong> check the <a href="https://deepwiki.com/cehojac/antonella-framework-for-wp" class="underline text-yellow-700 dark:text-yellow-400 hover:text-yellow-800 dark:hover:text-yellow-300" target="_blank" rel="noopener">Deep Wiki</a> for internals, architecture, design decisions, and advanced guides.
                @endif
            </div>
            @yield('content')
        </div>
    </div>
</section>
@endsection
