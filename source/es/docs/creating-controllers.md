---
title: Creación de Controladores
description: Aprende a crear y utilizar controladores en Antonella Framework siguiendo el nuevo flujo basado en config.php
extends: _layouts.documentation
section: content
---

# Creación de Controladores

Guía actualizada para crear y usar controladores en Antonella Framework.

## ¿Qué es un Controlador?

Un controlador es una clase PHP donde defines funciones específicas que utilizarás desde `config.php`. Piensa en `config.php` como el índice de funciones del plugin. Importante: en los controladores no se registran hooks (actions/filters); ese registro se hace en `config.php`.

## Crear tu primer Controlador

### Usando la consola de Antonella (Recomendado)

La forma más sencilla es con el comando de la consola:

```bash
php antonella create:controller YourNameController
```

Esto crea un archivo nuevo en `src/Controllers/` con el nombre indicado.

### Plantilla de Controlador (estático)

```php
<?php

namespace CH\Controllers;

use CH\Security;

class YourNameController
{
    /**
     * Ejemplo de método estático llamado desde config.php
     */
    public static function example_action()
    {
        // Puedes usar funciones de WordPress sin problema
        // Ej.: update_option('your_key', 'value');
    }
}
```

## Reglas clave y buenas prácticas

### 1. Responsabilidad única

Cada controlador debe encargarse de una responsabilidad específica:

```php
// Bien: propósito específico
class UserRegistrationController
{
    // Solo lógica de registro de usuarios
}

// Mal: demasiadas responsabilidades
class UserController
{
    // Registro, login, perfil, ajustes, etc.
}
```

### 2. Nomenclatura correcta

Usa nombres descriptivos y en PascalCase que indiquen el propósito:

```php
// Buenos ejemplos
class ProductCatalogController {}
class PaymentProcessingController {}
class EmailNotificationController {}

// Malos ejemplos
class MainController {}
class HelperController {}
class UtilsController {}
```

### 3. Seguridad primero

Valida y sanitiza siempre la entrada. Si usas el helper `Security` del framework, puedes hacer:

```php
public static function process_form()
{
    \CH\Security::check_user_capability('manage_options');
    \CH\Security::verify_nonce('antonella_nonce', 'antonella_config_action');
    $site_name = \CH\Security::sanitize_input($_POST['antonella_site_name'] ?? '', 'text');
    // ...
}
```

## Registro desde config.php (sin hooks en el controlador)

En Antonella, los controladores NO registran `add_action` ni `add_filter`. El registro de hooks, rutas, endpoints o llamadas estáticas se hace en `config.php`, que actúa como índice del plugin. Desde ahí se invocan métodos estáticos del controlador.

Notas:
- Si usas hooks del tipo action o llamadas estáticas, define los métodos del controlador como `public static`.
- Puedes usar funciones de WordPress dentro de la clase sin problema.
- Puedes extender otras clases si lo necesitas.

### Ejemplo real (basado en `src/Controllers/ExampleController.php`)

Este controlador muestra buenas prácticas y uso del helper `Security` con métodos estáticos: `process_form()`, `adminPage()`, `api_endpoint()`, `ajax_handler()`.

Ubicación: `src/Controllers/ExampleController.php` en el namespace `CH\Controllers`.

### Cómo registrarlo en el `config.php` del plugin

En el archivo `Config.php` de tu plugin, registra hooks y endpoints usando las propiedades del `Config`, no llamadas directas a `add_action`. Ejemplos:

```php
<?php

namespace CH;

class Config
{
    // ...

    // Hooks de WordPress
    public $add_action = [
        // Procesar formulario (admin-post)
        ['admin_post_antonella_config', __NAMESPACE__.'\\Controllers\\ExampleController::process_form', 10, 0],

        // AJAX (usuarios logueados)
        ['wp_ajax_example_action', __NAMESPACE__.'\\Controllers\\ExampleController::ajax_handler', 10, 0],
    ];

    // REST API
    public $api_endpoints = [
        'example' => [
            'namespace' => 'antonella/v1',
            'route' => '/example',
            'methods' => ['GET'],
            'callback' => 'CH\\Controllers\\ExampleController@api_endpoint',
            'permission_callback' => '__return_true',
        ],
    ];
}
```

Importante: los métodos usados como callbacks deben ser `public static`. El registro centralizado se hace en `Config.php`.

## Siguientes pasos

- Introducción: es/docs/introduction
- Instalación: es/docs/installation
- Configuración básica: es/docs/basic-setup
- Consola Antonella: es/docs/console
- Sistema Blade: es/docs/blade
- Paquetes externos: es/docs/external-packages
- Entorno Docker: es/docs/docker
- Notas de versión: es/docs/version-notes
