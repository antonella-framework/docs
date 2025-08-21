---
title: Sistema de Plantillas Blade
description: Cómo usar Blade en Antonella Framework para crear vistas reutilizables
extends: _layouts.documentation
section: content
---

# Sistema de Plantillas Blade

Blade es un motor de plantillas simple pero poderoso. Las vistas `.blade.php` se compilan a PHP y se cachean hasta que cambian, ofreciendo alto rendimiento. Normalmente se almacenan en `resources/views/`.

## Estructura recomendada

```
tu-plugin/
└── resources/
    └── views/
        ├── layout.blade.php
        ├── home.blade.php
        └── partials/
            └── header.blade.php
```

## Extender layouts

```blade
{{-- resources/views/home.blade.php --}}
@extends('layout')

@section('title', 'Inicio')

@section('content')
  <h1>{{ $title }}</h1>
  @include('partials.header')
@endsection
```

```blade
{{-- resources/views/layout.blade.php --}}
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('title', 'Mi Plugin')</title>
  </head>
  <body>
    <main>
      @yield('content')
    </main>
  </body>
</html>
```

## Secciones y valores por defecto

```blade
@section('sidebar')
  Barra lateral por defecto
@show
```

## Incluir sub-vistas

```blade
@include('partials.header', ['user' => $user])
```

## Mostrar datos en la vista

```blade
<p>{{ $user->name }}</p>
<p>{!! $htmlSeguro !!}</p>
```

## Condicionales y bucles

```blade
@if($posts->isEmpty())
  <p>No hay posts.</p>
@elseif($posts->count() < 5)
  <p>Pocos posts.</p>
@else
  <p>Muchos posts.</p>
@endif

@foreach($posts as $post)
  <h2>{{ $post->title }}</h2>
@endforeach
```

## Comentarios y PHP puro

```blade
{{-- Comentario Blade (no se renderiza) --}}
@php($year = date('Y'))
<p>&copy; {{ $year }}</p>
```

## Buenas prácticas

- Mantén la lógica en controladores/clases; usa Blade solo para presentación.
- Divide en parciales (`partials/`) para reutilización.
- Escapa salidas con `{{ }}`; usa `{!! !!}` solo cuando el HTML sea seguro.

## Recursos

- Documentación oficial de Blade (Laravel): https://laravel.com/docs/blade
- Página de documentación de Antonella: https://antonellaframework.com/documentacion/
