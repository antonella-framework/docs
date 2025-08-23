<?php

use Illuminate\Support\Str;

return [
    'baseUrl' => '',
    'production' => false,
    'siteName' => 'Antonella Framework v1.9',
    'siteDescription' => 'A powerful WordPress framework for developers - Documentation',

    // Multilingual configuration
    'languages' => [
        'en' => [
            'name' => 'English',
            'flag' => '🇺🇸',
            'url' => '/',
            'siteName' => 'Antonella Framework v1.9',
            'siteDescription' => 'A powerful WordPress framework for developers - Documentation',
        ],
        'es' => [
            'name' => 'Español',
            'flag' => '🇪🇸',
            'url' => '/es/',
            'siteName' => 'Antonella Framework v1.9',
            'siteDescription' => 'Un potente framework de WordPress para desarrolladores - Documentación',
        ]
    ],
    'currentLang' => 'en', // Will be overridden dynamically

    // Version configuration
    'versions' => [
        '1.9' => [
            'name' => 'v1.9 (Latest)',
            'url' => '/',
            'status' => 'current',
            'description' => 'Latest stable version with full feature set'
        ],
        '1.8' => [
            'name' => 'v1.8',
            'url' => 'https://legacy.antonellaframework.com/documentacion/',
            'status' => 'stable',
            'description' => 'PHP8 compatibility, Docker integration, API endpoints'
        ],
        '1.7' => [
            'name' => 'v1.7',
            'url' => 'https://legacy.antonellaframework.com/documentacion/1-7',
            'status' => 'stable',
            'description' => 'Gutenberg blocks, language files, request improvements'
        ],
        '1.6' => [
            'name' => 'v1.6',
            'url' => 'https://legacy.antonellaframework.com/documentacion/1-6',
            'status' => 'stable',
            'description' => 'Live testing and helpers improvements'
        ],
        '1.5' => [
            'name' => 'v1.5',
            'url' => 'https://legacy.antonellaframework.com/documentacion/1-5',
            'status' => 'stable',
            'description' => 'Blade templating system integration'
        ]
    ],
    'currentVersion' => '1.9', // Default version

    // Local Search enabled
    'docsearchAppId' => 'local',
    'docsearchApiKey' => 'local-search-enabled',
    'docsearchIndexName' => 'antonella-docs',

    // navigation menu (English by default, Spanish will be loaded conditionally)
    'navigation' => require_once('navigation.php'),
    'navigation_es' => require_once('navigation.es.php'),

    // helpers
    'isActive' => function ($page, $path) {
        return Str::endsWith(trimPath($page->getPath()), trimPath($path));
    },
    'isActiveParent' => function ($page, $menuItem) {
        if (is_object($menuItem) && $menuItem->children) {
            return $menuItem->children->contains(function ($child) use ($page) {
                return trimPath($page->getPath()) == trimPath($child);
            });
        }
    },
    'url' => function ($page, $path) {
        return Str::startsWith($path, 'http') ? $path : '/' . trimPath($path);
    },

    // Algolia DocSearch configuration - DISABLED (using local search)
    'docsearch' => [
        'enabled' => false, // Disabled to use local search instead
        'appId' => env('DOCSEARCH_APP_ID'),
        'apiKey' => env('DOCSEARCH_KEY'),
        'indexName' => env('DOCSEARCH_INDEX'),
        'placeholder' => 'Search documentation...',
        'debug' => false,
    ],

    // Build settings
    'build' => [
        'destination' => env('BUILD_DEST', 'build_local'),
        'pretty' => true,
        'safe' => true
    ],
    'cleanup_paths' => [
        env('BUILD_DEST', 'build_local'),
        'build_local',
        'build_production',
        'cache'
    ]
];
