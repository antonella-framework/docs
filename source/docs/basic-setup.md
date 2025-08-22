---
title: Basic Setup
description: Configure your first plugin with Antonella Framework
extends: _layouts.documentation
section: content
---

# Basic Setup

Configure your first plugin with Antonella Framework and understand the core configuration options.

## Configuration Overview

Antonella Framework uses a centralized configuration system through the `Config.php` file. This file contains all the essential settings for your plugin, including custom post types, taxonomies, shortcodes, API endpoints, and more.

### Configuration File Location

```
src/Config.php
```

## Basic Configuration Structure

Here's the basic structure of the `Config.php` file:

```php
<?php

namespace YourPlugin;

class Config
{
    // Persistent plugin options
    public $plugin_options = [];

    // Internationalization and prefix
    public $language_name = 'antonella';
    public $plugin_prefix = 'ch_nella';

    // Request handling
    public $post = [];
    public $get = [];

    // WordPress hooks
    public $add_filter = [];
    public $add_action = [];

    // Shortcodes
    public $shortcodes = [];

    // REST API
    public $api_endpoint_name = 'my-plugin-endpoint';
    public $api_endpoint_version = 1;
    public $api_endpoints_functions = [];

    // Gutenberg blocks
    public $gutenberg_blocks = [];

    // Dashboard
    public $dashboard = [];
    public $files_dashboard = [];

    // Plugin menu
    public $plugin_menu = [];

    // Custom Post Types and Taxonomies
    public $post_types = [];
    public $taxonomies = [];

    // Widgets
    public $widgets = [];
}
```

## Plugin Options (Persisted Settings)

Store key/value options in the WordPress options table via `Config`:

```php
public $plugin_options = [
    'example_data' => 'foo',
];
```

These are saved as WordPress options and can be read/updated in your code.

## Language and Prefix

Define a text domain and a unique plugin prefix:

```php
public $language_name = 'antonella';
public $plugin_prefix = 'ch_nella';
```

## Handling POST and GET Requests

Route specific POST/GET keys to controller methods:

```php
public $post = [
    'submit_antonella_config' => __NAMESPACE__ . '\\Controllers\\ExampleController::process_form',
];

public $get = [
    // 'my_action' => __NAMESPACE__ . '\\Controllers\\ExampleController::handle_get',
];
```

## Hooks: add_action and add_filter

Register WordPress hooks from configuration:

```php
public $add_action = [
    // ['init', __NAMESPACE__.'\\Controllers\\ExampleController::boot', 10, 0],
];

public $add_filter = [
    // ['body_class', [__NAMESPACE__.'\\Controllers\\ExampleController', 'filter_body'], 10, 2],
];
```

## Plugin Menu Configuration

Configure your plugin's admin menu:

```php
'plugin_menu' => [
    'page_title' => 'My Plugin Settings',
    'menu_title' => 'My Plugin',
    'capability' => 'manage_options',
    'menu_slug' => 'my-plugin-settings',
    'icon_url' => 'dashicons-admin-plugins',
    'position' => 30,
    'submenus' => [
        [
            'page_title' => 'General Settings',
            'menu_title' => 'Settings',
            'capability' => 'manage_options',
            'menu_slug' => 'my-plugin-general',
        ],
        [
            'page_title' => 'Advanced Options',
            'menu_title' => 'Advanced',
            'capability' => 'manage_options',
            'menu_slug' => 'my-plugin-advanced',
        ],
    ],
],
```

## Custom Post Types

Define custom post types for your plugin:

```php
'post_types' => [
    'product' => [
        'labels' => [
            'name' => 'Products',
            'singular_name' => 'Product',
            'add_new' => 'Add New Product',
            'add_new_item' => 'Add New Product',
            'edit_item' => 'Edit Product',
            'new_item' => 'New Product',
            'view_item' => 'View Product',
            'search_items' => 'Search Products',
            'not_found' => 'No products found',
            'not_found_in_trash' => 'No products found in trash',
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'menu_icon' => 'dashicons-products',
        'rewrite' => ['slug' => 'products'],
    ],
],
```

## Custom Taxonomies

Create custom taxonomies:

```php
'taxonomies' => [
    'product_category' => [
        'post_types' => ['product'],
        'labels' => [
            'name' => 'Product Categories',
            'singular_name' => 'Product Category',
            'search_items' => 'Search Categories',
            'all_items' => 'All Categories',
            'parent_item' => 'Parent Category',
            'parent_item_colon' => 'Parent Category:',
            'edit_item' => 'Edit Category',
            'update_item' => 'Update Category',
            'add_new_item' => 'Add New Category',
            'new_item_name' => 'New Category Name',
        ],
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'rewrite' => ['slug' => 'product-category'],
    ],
],
```

## Shortcodes

Define shortcodes for your plugin:

```php
'shortcodes' => [
    'my_shortcode' => [
        'callback' => 'MyPlugin\\Controllers\\ShortcodeController@handle_my_shortcode',
        'description' => 'Display custom content',
        'attributes' => [
            'id' => 'Content ID',
            'type' => 'Content type',
            'limit' => 'Number of items to show',
        ],
    ],
    'product_list' => [
        'callback' => 'MyPlugin\\Controllers\\ProductController@product_list_shortcode',
        'description' => 'Display a list of products',
        'attributes' => [
            'category' => 'Product category slug',
            'limit' => 'Number of products to show',
            'orderby' => 'Order by field',
        ],
    ],
],
```

## API Endpoints

Configure REST API endpoints:

```php
'api_endpoints' => [
    'products' => [
        'namespace' => 'my-plugin/v1',
        'route' => '/products',
        'methods' => ['GET', 'POST'],
        'callback' => 'MyPlugin\\Controllers\\ApiController@handle_products',
        'permission_callback' => 'MyPlugin\\Controllers\\ApiController@check_permissions',
    ],
    'product' => [
        'namespace' => 'my-plugin/v1',
        'route' => '/products/(?P<id>\\d+)',
        'methods' => ['GET', 'PUT', 'DELETE'],
        'callback' => 'MyPlugin\\Controllers\\ApiController@handle_product',
        'permission_callback' => 'MyPlugin\\Controllers\\ApiController@check_permissions',
    ],
],
```

## Gutenberg Blocks

Define custom Gutenberg blocks:

```php
'gutenberg_blocks' => [
    'my-custom-block' => [
        'title' => 'My Custom Block',
        'description' => 'A custom block for my plugin',
        'category' => 'widgets',
        'icon' => 'admin-plugins',
        'keywords' => ['custom', 'plugin', 'block'],
        'supports' => [
            'html' => false,
            'align' => true,
        ],
        'attributes' => [
            'content' => [
                'type' => 'string',
                'default' => '',
            ],
            'alignment' => [
                'type' => 'string',
                'default' => 'left',
            ],
        ],
        'render_callback' => 'MyPlugin\\Controllers\\BlockController@render_custom_block',
    ],
],
```

## Default Controllers

Antonella Framework provides several default controllers that you can extend:

### ExampleController

The `ExampleController` demonstrates basic controller functionality:

```php
<?php

namespace YourPlugin\Controllers;

use YourPlugin\Core\Controller;

class ExampleController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    public function init()
    {
        // Initialize your controller logic here
        // Hook registration is done in Config.php (do not register hooks here)
    }
    
    public function handle_init()
    {
        // Handle WordPress init action
    }
}
```

Config registration (in Config.php):

```php
public $add_action = [
    ['init', __NAMESPACE__.'\\Controllers\\ExampleController@handle_init', 10, 0],
];
```

## Database Tables

If your plugin needs custom database tables, you can create them during plugin activation:

```php
// In your main plugin file or activation hook
register_activation_hook(__FILE__, 'create_plugin_tables');

function create_plugin_tables()
{
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'my_plugin_data';
    
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        user_id bigint(20) NOT NULL,
        data longtext NOT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
```

## Dashboard Widgets

Add custom widgets to the WordPress Dashboard:

```php
public $dashboard = [[
    'slug' => 'antonella_example',
    'name' => 'Antonella Widget',
    'function' => __NAMESPACE__.'\\Admin\\PageAdmin::DashboardExample',
    'callback' => '',
    'args' => '',
]];
```

Optionally load files for dashboard usage via `files_dashboard`.

## Widgets

Register widget classes for your plugin. You can scaffold with the console:

```bash
php antonella Widget "NAME_OF_WIDGET"
```

Then register the class:

```php
public $widgets = [
    __NAMESPACE__.'\\Widgets\\MyWidget',
];
```

## Next Steps

Once you have your basic configuration set up:

1. **[Creating Controllers](creating-controllers)** - Learn to create custom controllers
2. **[Working with Views](working-with-views)** - Create templates and views
3. **[Testing Your Plugin](localhost-testing)** - Use the Docker environment for testing
4. **[Controller Examples](controller-examples)** - See practical examples

## Configuration Best Practices

1. **Keep it organized**: Group related configurations together
2. **Use descriptive names**: Make your configuration self-documenting
3. **Validate input**: Always validate and sanitize configuration values
4. **Environment-specific**: Use different configs for different environments
5. **Security first**: Always consider security implications of your configuration

Need help with configuration? Check our [troubleshooting guide](troubleshooting) or visit our [GitHub repository](https://github.com/cehojac/antonella-framework-for-wp).
