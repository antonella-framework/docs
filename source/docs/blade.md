---
title: Blade Templating System
description: How to use Blade in Antonella Framework to build reusable views
extends: _layouts.documentation
section: content
---

# Blade Templating System

Blade is a simple yet powerful templating engine. `.blade.php` views are compiled to PHP and cached until they change, providing high performance. Views typically live in `resources/views/`.

## Recommended structure

```
your-plugin/
└── resources/
    └── views/
        ├── layout.blade.php
        ├── home.blade.php
        └── partials/
            └── header.blade.php
```

## Extending layouts

```blade
{{-- resources/views/home.blade.php --}}
@extends('layout')

@section('title', 'Home')

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
    <title>@yield('title', 'My Plugin')</title>
  </head>
  <body>
    <main>
      @yield('content')
    </main>
  </body>
</html>
```

## Sections and defaults

```blade
@section('sidebar')
  Default sidebar
@show
```

## Including partials

```blade
@include('partials.header', ['user' => $user])
```

## Rendering data

```blade
<p>{{ $user->name }}</p>
<p>{!! $safeHtml !!}</p>
```

## Conditionals and loops

```blade
@if($posts->isEmpty())
  <p>No posts.</p>
@elseif($posts->count() < 5)
  <p>Few posts.</p>
@else
  <p>Many posts.</p>
@endif

@foreach($posts as $post)
  <h2>{{ $post->title }}</h2>
@endforeach
```

## Comments and raw PHP

```blade
{{-- Blade comment (not rendered) --}}
@php($year = date('Y'))
<p>&copy; {{ $year }}</p>
```

## Best practices

- Keep logic in controllers/classes; use Blade for presentation.
- Split into partials (`partials/`) for reuse.
- Escape output with `{{ }}`; use `{!! !!}` only for trusted HTML.

## Resources

- Blade official docs (Laravel): https://laravel.com/docs/blade
- Antonella documentation: https://antonellaframework.com/documentacion/
