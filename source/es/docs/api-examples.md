---
title: Ejemplos de API
description: Endpoints y callbacks en Antonella usando la REST API de WordPress y AJAX
extends: _layouts.documentation
section: content
---

# Ejemplos de API

Antonella aprovecha la REST API y AJAX de WordPress. Registra todas las acciones en `config.php` usando referencias estáticas.

## REST API

```php
namespace YourPlugin\Controllers;
use WP_REST_Request;
use WP_REST_Response;

class SampleApiController
{
    public static function register_routes()
    {
        register_rest_route('your-plugin/v1', '/ping', [
            'methods' => 'GET',
            'callback' => [__CLASS__, 'ping'],
            'permission_callback' => '__return_true',
        ]);
    }

    public static function ping(WP_REST_Request $request)
    {
        return new WP_REST_Response(['pong' => true], 200);
    }
}
```

Registro en `config.php`:

```php
use YourPlugin\Controllers\SampleApiController;
add_action('rest_api_init', [SampleApiController::class, 'register_routes']);
```

## AJAX

```php
namespace YourPlugin\Controllers;

class SampleAjaxController
{
    public static function do_something()
    {
        // Verificar nonce y capacidades según tu caso.
        wp_send_json_success(['ok' => true]);
    }
}
```

Registro en `config.php`:

```php
use YourPlugin\Controllers\SampleAjaxController;
add_action('wp_ajax_do_something', [SampleAjaxController::class, 'do_something']);
add_action('wp_ajax_nopriv_do_something', [SampleAjaxController::class, 'do_something']);
```

## Siguientes pasos

- Revisa [Operaciones de Base de Datos](/es/docs/database-operations)
- Revisa [Trabajo con Vistas](/es/docs/working-with-views)
