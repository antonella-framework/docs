---
title: Creating Controllers
description: Learn how to create and use controllers in Antonella Framework
extends: _layouts.documentation
section: content
---

# Creating Controllers

Learn how to create and use controllers in Antonella Framework.

## What are Controllers?

Controllers are the core components of your plugin that handle business logic, user interactions, and data processing. In Antonella Framework, controllers follow the MVC (Model-View-Controller) pattern.

## Creating Your First Controller

### Using Antonella Console (Recommended)

The easiest way to create a controller is using the Antonella Console:

```bash
php antonella create:controller YourControllerName
```

This will create a new controller file in the `src/Controllers/` directory.

### Manual Creation

You can also create controllers manually:

1. Create a new PHP file in `src/Controllers/`
2. Follow the naming convention: `YourControllerName.php`
3. Use the proper namespace and extend the base controller

### Controller Template

```php
<?php

namespace YourNamespace\Controllers;

use YourNamespace\Core\Controller;

class YourControllerName extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // Initialize your controller
        $this->init();
    }
    
    /**
     * Initialize the controller
     */
    public function init()
    {
        // Add WordPress hooks
        add_action('init', [$this, 'handle_init']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }
    
    /**
     * Handle WordPress init action
     */
    public function handle_init()
    {
        // Your initialization code here
    }
    
    /**
     * Enqueue scripts and styles
     */
    public function enqueue_scripts()
    {
        // Enqueue your CSS and JS files
        wp_enqueue_style('your-style', plugin_dir_url(__FILE__) . '../assets/style.css');
        wp_enqueue_script('your-script', plugin_dir_url(__FILE__) . '../assets/script.js');
    }
}
```

## Controller Best Practices

### 1. Single Responsibility

Each controller should have a single, well-defined responsibility:

```php
// Good: Specific purpose
class UserRegistrationController extends Controller
{
    // Handle only user registration logic
}

// Bad: Too many responsibilities
class UserController extends Controller
{
    // Handles registration, login, profile, settings, etc.
}
```

### 2. Proper Naming

Use descriptive names that clearly indicate the controller's purpose:

```php
// Good examples
class ProductCatalogController extends Controller {}
class PaymentProcessingController extends Controller {}
class EmailNotificationController extends Controller {}

// Bad examples
class MainController extends Controller {}
class HelperController extends Controller {}
class UtilsController extends Controller {}
```

### 3. Security First

Always validate and sanitize input data:

```php
public function save_user_data()
{
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'save_user_data')) {
        return false;
    }
    
    // Sanitize input
    $user_name = sanitize_text_field($_POST['user_name']);
    $user_email = sanitize_email($_POST['user_email']);
    
    // Validate data
    if (empty($user_name) || !is_email($user_email)) {
        return false;
    }
    
    // Process data
    return $this->save_to_database($user_name, $user_email);
}
```

## Working with WordPress Hooks

### Adding Actions

```php
public function init()
{
    add_action('wp_head', [$this, 'add_meta_tags']);
    add_action('wp_footer', [$this, 'add_tracking_code']);
    add_action('save_post', [$this, 'handle_post_save']);
}
```

### Adding Filters

```php
public function init()
{
    add_filter('the_content', [$this, 'modify_content']);
    add_filter('wp_title', [$this, 'modify_title']);
}

public function modify_content($content)
{
    // Modify the content
    return $content . '<p>Added by your plugin</p>';
}
```

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
