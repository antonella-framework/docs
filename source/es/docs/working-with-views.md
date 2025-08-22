---
title: Trabajo con Vistas
description: Cómo renderizar vistas y pasar datos en Antonella Framework
extends: _layouts.documentation
section: content
---

# Trabajo con Vistas

En Antonella Framework puedes organizar tus plantillas dentro de `views/` y reutilizarlas desde tus controladores. Recuerda que los hooks se registran en `config.php` y los métodos de los controladores deben ser públicos (generalmente estáticos cuando se usan como callbacks).

## Estructura sugerida

- `views/`
  - `partials/`
  - `pages/`

## Render básico desde un controlador

```php
<?php
namespace YourPlugin\Controllers;

class ViewExampleController
{
    public static function render_example_page()
    {
        $data = [
            'title' => 'Mi Página de Ejemplo',
            'items' => ['Uno', 'Dos', 'Tres'],
        ];

        // Si usas una función interna para ubicar y cargar plantillas, hazlo aquí.
        // Este ejemplo asume una función helper ficticia `load_view($path, $data)`.
        // Reemplázala por tu mecanismo real de carga de vistas.
        return load_view('pages/example', $data);
    }
}
```

Registro en `config.php`:

```php
use YourPlugin\Controllers\ViewExampleController;
add_shortcode('view_example', [ViewExampleController::class, 'render_example_page']);
```

## Pasar datos a vistas

- Sanitiza siempre los datos al imprimirlos.
- Usa funciones de internacionalización si corresponde (`__`, `_e`).

## Siguientes pasos

- Revisa [Operaciones de Base de Datos](/es/docs/database-operations)
- Revisa [Ejemplos de API](/es/docs/api-examples)
