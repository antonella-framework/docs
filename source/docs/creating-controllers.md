---
title: Creating Controllers
description: Learn how to create and use controllers in Antonella Framework following the new config.php-based flow
extends: _layouts.documentation
section: content
---

# Creating Controllers

Updated guide to create and use controllers in Antonella Framework.

## What is a Controller?

A controller is a PHP class where you define specific functions that you will call from `config.php`. Think of `config.php` as the index of functions of the plugin. Important: controllers do not register hooks (actions/filters); that registration is done in `config.php`.

## Create your first Controller

### Using the Antonella console (Recommended)

The easiest way is with the console command:

```bash
php antonella create:controller YourNameController
```

This creates a new file in `src/Controllers/` with the given name.

### Controller template (static)

```php
<?php

namespace CH\Controllers;

use CH\Security;

class YourNameController
{
    /**
     * Example of static method called from config.php
     */
    public static function example_action()
    {
        // You can use WordPress functions without issues
        // e.g.: update_option('your_key', 'value');
    }
}
```

## Key rules and best practices

### 1. Single responsibility

Each controller should handle a specific responsibility:

```php
// Good: specific purpose
class UserRegistrationController
{
    // Only user registration logic
}

// Bad: too many responsibilities
class UserController
{
    // Registration, login, profile, settings, etc.
}
```

### 2. Proper naming

Use descriptive PascalCase names that indicate the purpose:

```php
// Good examples
class ProductCatalogController {}
class PaymentProcessingController {}
class EmailNotificationController {}

// Bad examples
class MainController {}
class HelperController {}
class UtilsController {}
```

### 3. Security first

Always validate and sanitize input. If you use the framework `Security` helper, you can do:

```php
public static function process_form()
{
    \CH\Security::check_user_capability('manage_options');
    \CH\Security::verify_nonce('antonella_nonce', 'antonella_config_action');
    $site_name = \CH\Security::sanitize_input($_POST['antonella_site_name'] ?? '', 'text');
    // ...
}
```

## Registration from config.php (no hooks in the controller)

In Antonella, controllers do NOT register `add_action` or `add_filter`. The registration of hooks, routes, endpoints, or static calls is done in `config.php`, which acts as the plugin index. From there, static methods of the controller are invoked.

Notes:
- If you use action-type hooks or static calls, define the controller methods as `public static`.
- You can use WordPress functions inside the class without problems.
- You can extend other classes if needed.

### Real example (based on `src/Controllers/ExampleController.php`)

This controller shows best practices and usage of the `Security` helper with static methods: `process_form()`, `adminPage()`, `api_endpoint()`, `ajax_handler()`.

Location: `src/Controllers/ExampleController.php` in the `CH\Controllers` namespace.

### How to register it in the plugin `config.php`

In your plugin `Config.php`, register hooks and endpoints using `Config` properties, not direct `add_action` calls. Examples:

```php
<?php

namespace CH;

class Config
{
    // ...

    // WordPress hooks
    public $add_action = [
        // Process form (admin-post)
        ['admin_post_antonella_config', __NAMESPACE__.'\\Controllers\\ExampleController::process_form', 10, 0],

        // AJAX (logged-in users)
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

Important: methods used as callbacks must be `public static`. Centralized registration is done in `Config.php`.

## Next steps

- Introduction: docs/introduction
- Installation: docs/installation
- Basic setup: docs/basic-setup
- Antonella Console: docs/console
- Blade System: docs/blade
- External Packages: docs/external-packages
- Docker Environment: docs/docker
- Version Notes: docs/version-notes
