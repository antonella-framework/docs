---
title: Creating Controllers
description: Learn how to create and use controllers in Antonella Framework following the Config.php-driven flow
extends: _layouts.documentation
section: content
---

# Creating Controllers

Updated guide to create and use controllers in Antonella Framework.

## What is a Controller?

A controller is a PHP class where you define specific functions that you will invoke from `Config.php`. Think of `Config.php` as the plugin’s index. Important: controllers do not register hooks (actions/filters); that registration is centralized in `Config.php`.

## Create your first Controller

### Using Antonella CLI (Recommended)

The easiest way is via the console command:

```bash
php antonella create:controller YourNameController
```

This creates a new file under `src/Controllers/` with the provided name.

### Static Controller template

```php
<?php

namespace CH\Controllers;

use CH\Security;

class YourNameController
{
    /**
     * Example of a static method invoked from Config.php
     */
    public static function example_action()
    {
        // You can use WordPress functions normally
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

### 2. Naming

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

Always validate and sanitize input. If you use the framework’s `Security` helper, you can do:

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

In Antonella, controllers do NOT register `add_action` or `add_filter`. Hook registration, routes, endpoints, and static calls are defined in `Config.php`, which acts as the plugin’s index. From there, you invoke static controller methods.

Notes:
- If you use action hooks or static invocations, define controller methods as `public static`.
- You can use WordPress functions inside the class as usual.
- You can extend other classes if needed.

### Real example (based on `src/Controllers/ExampleController.php`)

This controller demonstrates best practices and the `Security` helper with static methods: `process_form()`, `adminPage()`, `api_endpoint()`, `ajax_handler()`.

Location: `src/Controllers/ExampleController.php` under the `CH\Controllers` namespace.

### How to register it in `Config.php`

In your plugin’s `Config.php`, register hooks and endpoints using the `Config` properties, not direct `add_action` calls. Examples:

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

Important: since methods are invoked statically, define controller functions as `public static`.

## Database Operations

### Using WordPress Database API

```php
public function get_user_data($user_id)
{
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'your_table_name';
    
    $result = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM $table_name WHERE user_id = %d",
            $user_id
        )
    );
    
    return $result;
}

public function save_user_data($user_id, $data)
{
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'your_table_name';
    
    return $wpdb->insert(
        $table_name,
        [
            'user_id' => $user_id,
            'data' => json_encode($data),
            'created_at' => current_time('mysql')
        ],
        ['%d', '%s', '%s']
    );
}
```

## Error Handling

### Proper Error Handling

```php
public function process_payment($order_data)
{
    try {
        // Validate order data
        if (!$this->validate_order($order_data)) {
            throw new Exception('Invalid order data');
        }
        
        // Process payment
        $result = $this->payment_gateway->charge($order_data);
        
        if (!$result->success) {
            throw new Exception('Payment failed: ' . $result->error_message);
        }
        
        return $result;
        
    } catch (Exception $e) {
        // Log error
        error_log('Payment processing error: ' . $e->getMessage());
        
        // Return error response
        return [
            'success' => false,
            'error' => $e->getMessage()
        ];
    }
}
```

## Next Steps

- Learn about [working with views](working-with-views)
- Explore [database operations](database-operations)
- Check out [testing your controllers](localhost-testing)
- See [controller examples](controller-examples)

Need help? Check our [troubleshooting guide](troubleshooting) or visit our [GitHub repository](https://github.com/cehojac/antonella-framework-for-wp).
