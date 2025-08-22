---
title: Operaciones de Base de Datos
description: Patrones comunes para consultas y operaciones con la base de datos en Antonella Framework
extends: _layouts.documentation
section: content
---

# Operaciones de Base de Datos

Antonella se integra con WordPress, por lo que puedes utilizar `$wpdb`, funciones de meta (`get_post_meta`, `update_post_meta`), y consultas con `WP_Query`.

## Lectura con WP_Query

```php
$args = [
    'post_type' => 'product',
    'posts_per_page' => 10,
];
$query = new \WP_Query($args);
```

## Uso de $wpdb (consultas directas)

```php
global $wpdb;
$results = $wpdb->get_results(
    $wpdb->prepare('SELECT ID, post_title FROM ' . $wpdb->posts . ' WHERE post_type=%s LIMIT %d', 'product', 10)
);
```

## Guardado de metadatos

```php
update_post_meta($post_id, 'price', floatval($price));
```

## Buenas prácticas

- Sanitiza siempre la entrada del usuario (`sanitize_text_field`, `intval`, etc.).
- Usa `prepare` al construir consultas SQL.
- Registra hooks en `config.php` y usa métodos estáticos cuando sean callbacks.

## Siguientes pasos

- Revisa [Trabajo con Vistas](/es/docs/working-with-views)
- Revisa [Ejemplos de API](/es/docs/api-examples)
