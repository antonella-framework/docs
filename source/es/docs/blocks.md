---
title: Bloques de Gutenberg
description: Cómo crear y gestionar bloques de Gutenberg con la consola de Antonella Framework
extends: _layouts.documentation
section: content
---

# Bloques de Gutenberg

Antonella Framework ofrece una manera sencilla de crear bloques de Gutenberg basándose en la documentación oficial de WordPress.

## Requisitos

- WordPress activo con el editor de bloques (Gutenberg)
- Conocimientos básicos de JavaScript/JSX para personalizar el bloque
- Proyecto Antonella instalado correctamente

## Crear un bloque

Asigna un nombre sin espacios (usa guiones si es necesario) y ejecuta:

```bash
php antonella block nombre-de-mi-bloque
```

Este comando:

- Agrega la referencia del bloque en `src/Config.php` dentro de la sección de Gutenberg.
- Crea dos archivos en `assets/`:
  - `assets/css/nombre-de-mi-bloque.css` para estilos.
  - `assets/js/nombre-de-mi-bloque.js` con un ejemplo básico del bloque.

Al cargar WordPress, verás un nuevo bloque llamado "nombre-de-mi-bloque" (ícono de carita) que renderiza un ejemplo (p. ej., un `h3` con colores).

## Estructura generada

```
tu-plugin/
├── assets/
│   ├── css/
│   │   └── nombre-de-mi-bloque.css
│   └── js/
│       └── nombre-de-mi-bloque.js
└── src/
    └── Config.php   # Se añade la referencia del bloque en la configuración
```

## Personalización

- Edita `assets/js/nombre-de-mi-bloque.js` para cambiar la lógica y la UI del bloque.
- Añade estilos en `assets/css/nombre-de-mi-bloque.css`.
- Registra atributos, controles y variaciones según la guía de Gutenberg.

## Consejos

- Crea tantos bloques como necesites; repite el comando con nombres distintos.
- Mantén una convención clara de nombres (kebab-case) para los archivos y el "slug" del bloque.
- Prueba el bloque en un entorno local antes de publicar.

## Comandos relacionados

- Crear bloque: `php antonella block NombreBloque`
- Empaquetar plugin: `php antonella makeup`

## Recursos

- Documentación oficial de Gutenberg: https://developer.wordpress.org/block-editor/
- Página de documentación de Antonella: https://antonellaframework.com/documentacion/
