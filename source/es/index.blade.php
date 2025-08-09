@extends('_layouts.master')

@section('body')
<div class="min-h-screen homepage-bg homepage-text">
    <section class="container max-w-6xl mx-auto px-6 py-10 md:py-12">
        <div class="flex flex-col-reverse mb-10 lg:flex-row lg:mb-24">
            <div class="mt-8">
                <h1 id="intro-antonella-framework" class="text-5xl font-bold homepage-text mb-4">{{ $page->siteName }}</h1>

                <h2 id="intro-tagline" class="font-light mt-4 text-2xl homepage-text-secondary">{{ $page->siteDescription }}</h2>

                <p class="text-lg homepage-text-secondary mt-6 leading-relaxed">
                    Un potente entorno de desarrollo PHP para crear plugins de WordPress. <br class="hidden sm:block">
                    Basado en el estándar PSR-4 y siguiendo el patrón MVC para un desarrollo eficiente, organizado y mantenible.
                </p>

                <div class="flex flex-col sm:flex-row my-10 space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="/es/docs/introduction" title="Comenzar con Antonella Framework" 
                       class="bg-yellow-500 hover:bg-yellow-400 font-semibold text-black hover:text-black rounded-lg py-3 px-8 text-center transition-all duration-200 shadow-lg hover:shadow-yellow-500/25">
                        Comenzar
                    </a>
                    <a href="/es/docs/installation" title="Guía de Instalación" 
                       class="btn-secondary font-semibold rounded-lg py-3 px-8 text-center transition-colors duration-200">
                        Instalación
                    </a>
                    <a href="https://github.com/cehojac/antonella-framework-for-wp" title="Ver en GitHub" 
                       class="btn-outline font-semibold rounded-lg py-3 px-8 text-center transition-colors duration-200">
                        GitHub
                    </a>
                </div>

                <div class="flex items-center space-x-4 text-sm">
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-500/20 text-yellow-400 font-medium border border-yellow-500/30">
                        v1.9
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-500/20 text-blue-400 font-medium border border-blue-500/30">
                        PHP 8.0+
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-500/20 text-green-400 font-medium border border-green-500/30">
                        WordPress 5.0+
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-500/20 text-gray-400 font-medium border border-gray-500/30">
                        GPL-2.0
                    </span>
                </div>
            </div>

            <div class="flex justify-center lg:justify-end">
                <div class="w-64 h-64 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-2xl flex items-center justify-center shadow-2xl shadow-yellow-500/25 p-8">
                    <img src="/assets/img/antonella-logo.png" alt="Logo de Antonella Framework" class="w-full h-full object-contain">
                </div>
            </div>
        </div>

        <hr class="block my-12 border-gray-700">

        <div class="grid md:grid-cols-3 gap-8 mb-16">
            <div class="text-center">
                <div class="w-16 h-16 feature-icon-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold homepage-text mb-2">Arquitectura MVC</h3>
                <p class="homepage-text-secondary">Organización clara del código siguiendo patrones establecidos con Controladores, Vistas y Modelos para plugins de WordPress mantenibles.</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-blue-500/20 rounded-full flex items-center justify-center mx-auto mb-4 border border-blue-500/30">
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold homepage-text mb-2">Desarrollo Rápido</h3>
                <p class="homepage-text-secondary">Reduce el tiempo de desarrollo hasta un 50% con estructura predefinida, autocarga y potentes herramientas de desarrollo.</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-4 border border-green-500/30">
                    <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold homepage-text mb-2">Compatible con PSR-4</h3>
                <p class="homepage-text-secondary">Autocarga automática de clases siguiendo estándares PHP para código limpio, profesional e interoperable.</p>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg p-8 mb-16 border border-gray-700">
            <h2 class="text-3xl font-bold text-white mb-6 text-center">Inicio Rápido</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-xl font-semibold text-yellow-400 mb-4">1. Instalar vía Composer</h3>
                    <div class="bg-black rounded-lg p-4 text-green-400 font-mono text-sm border border-gray-700">
                        <div class="mb-2 text-gray-500"># Instalar el instalador global</div>
                        <div class="mb-2">composer global require cehojac/antonella-installer</div>
                        <div class="mb-2 text-gray-500"># Crear un nuevo plugin</div>
                        <div>antonella new mi-plugin</div>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-yellow-400 mb-4">2. Estructura de tu Plugin</h3>
                    <div class="bg-black rounded-lg p-4 text-gray-300 font-mono text-sm border border-gray-700">
                        <div class="text-yellow-400">mi-plugin/</div>
                        <div class="ml-4">├── <span class="text-blue-400">src/Controllers/</span></div>
                        <div class="ml-4">├── <span class="text-blue-400">src/Admin/</span></div>
                        <div class="ml-4">├── <span class="text-green-400">resources/views/</span></div>
                        <div class="ml-4">├── <span class="text-purple-400">Assets/</span></div>
                        <div class="ml-4">└── <span class="text-gray-400">mi-plugin.php</span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold homepage-text mb-6">¿Por qué elegir Antonella Framework?</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="stat-card rounded-lg shadow-lg p-6 transition-colors duration-200">
                    <div class="text-2xl font-bold homepage-text mb-2">90%</div>
                    <div class="text-sm homepage-text-secondary">Desarrollo más Rápido</div>
                </div>
                <div class="stat-card rounded-lg shadow-lg p-6 transition-colors duration-200">
                    <div class="text-2xl font-bold homepage-text mb-2">100%</div>
                    <div class="text-sm homepage-text-secondary">Compatible con WordPress</div>
                </div>
                <div class="stat-card rounded-lg shadow-lg p-6 transition-colors duration-200">
                    <div class="text-2xl font-bold homepage-text mb-2">50+</div>
                    <div class="text-sm homepage-text-secondary">Características Integradas</div>
                </div>
                <div class="stat-card rounded-lg shadow-lg p-6 transition-colors duration-200">
                    <div class="text-2xl font-bold homepage-text mb-2">24/7</div>
                    <div class="text-sm homepage-text-secondary">Soporte de la Comunidad</div>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-lg p-8 text-center text-black shadow-2xl shadow-yellow-500/25">
            <h2 class="text-3xl font-bold mb-4">¿Listo para crear increíbles plugins de WordPress?</h2>
            <p class="text-lg mb-6 opacity-90">Únete a la comunidad de desarrolladores que usan Antonella Framework para crear plugins profesionales de WordPress.</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="/es/docs/introduction" class="bg-black text-white font-semibold py-3 px-8 rounded-lg hover:bg-gray-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Comenzar a Construir Ahora
                </a>
                <a href="/es/docs/controller-examples" class="bg-white text-black font-semibold py-3 px-8 rounded-lg hover:bg-gray-100 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Ver Ejemplos
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
