---
title: Estrategias de Pruebas en Localhost
description: Cómo probar Antonella en tu entorno local con WordPress
extends: _layouts.documentation
section: content
---

# Estrategias de Pruebas en Localhost

Consejos para probar tu plugin/tema con Antonella localmente.

## Requisitos

- PHP y Composer instalados.
- WordPress local (LocalWP, XAMPP, Docker, etc.).

## Flujo sugerido

1. Instala dependencias (`composer install`, `npm install` si aplica).
2. Activa el plugin/tema en tu WordPress local.
3. Registra hooks en `config.php` usando `[Clase::class, 'metodo']`.
4. Habilita WP_DEBUG en `wp-config.php` durante el desarrollo.

## Consejos

- Usa `error_log()` y `WP_CLI` para depurar.
- Prueba AJAX con la consola del navegador y verifica `admin-ajax.php`.
- Para REST, utiliza herramientas como Postman o curl.

## Siguientes pasos

- Revisa [Ejemplos de API](/es/docs/api-examples)
- Revisa [Trabajo con Vistas](/es/docs/working-with-views)
