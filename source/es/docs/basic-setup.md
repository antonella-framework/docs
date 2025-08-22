---
title: Configuración Básica
description: Configura tu primer plugin con Antonella Framework
extends: _layouts.documentation
section: content
---

# Configuración Básica

Configura tu primer plugin con Antonella Framework y entiende las opciones clave de configuración.

## Visión General de Configuración

Antonella Framework utiliza un sistema de configuración centralizado a través del archivo `Config.php`. Este archivo contiene los ajustes esenciales de tu plugin, incluyendo menús de administración, custom post types, taxonomías, shortcodes, endpoints de API y más.

### Ubicación del Archivo de Configuración

```
src/Config.php
```

## Estructura Básica de Configuración

Esta es la estructura básica del archivo `Config.php`:

```php
<?php

namespace YourPlugin;

class Config
{
    // Opciones persistentes del plugin
    public $plugin_options = [];

    // Internacionalización y prefijo
    public $language_name = 'antonella';
    public $plugin_prefix = 'ch_nella';

    // Manejo de solicitudes
    public $post = [];
    public $get = [];

    // Hooks de WordPress
    public $add_filter = [];
    public $add_action = [];

    // Shortcodes
    public $shortcodes = [];

    // REST API
    public $api_endpoint_name = 'my-plugin-endpoint';
    public $api_endpoint_version = 1;
    public $api_endpoints_functions = [];

    // Bloques Gutenberg
    public $gutenberg_blocks = [];

    // Dashboard
    public $dashboard = [];
    public $files_dashboard = [];

    // Menú del plugin
    public $plugin_menu = [];

    // Custom Post Types y Taxonomías
    public $post_types = [];
    public $taxonomies = [];

    // Widgets
    public $widgets = [];
}
```

## Opciones del Plugin (Persistentes)

Almacena opciones clave/valor en la tabla de opciones de WordPress mediante `Config`:

```php
public $plugin_options = [
    'example_data' => 'foo',
];
```

## Idioma y Prefijo

Define un dominio de texto y un prefijo único para tu plugin:

```php
public $language_name = 'antonella';
public $plugin_prefix = 'ch_nella';
```

## Manejo de Solicitudes POST y GET

Enruta claves específicas de POST/GET a métodos de controladores:

```php
public $post = [
    'submit_antonella_config' => __NAMESPACE__ . '\\Controllers\\ExampleController::process_form',
];

public $get = [
    // 'mi_accion' => __NAMESPACE__ . '\\Controllers\\ExampleController::handle_get',
];
```

## Hooks: add_action y add_filter

Registra hooks de WordPress desde la configuración:

```php
public $add_action = [
    // ['init', __NAMESPACE__.'\\Controllers\\ExampleController::boot', 10, 0],
];

public $add_filter = [
    // ['body_class', [__NAMESPACE__.'\\Controllers\\ExampleController', 'filter_body'], 10, 2],
];
```

## Configuración del Menú del Plugin

Configura el menú de administración de tu plugin:

```php
'plugin_menu' => [
    'page_title'   => 'Ajustes de Mi Plugin',
    'menu_title'   => 'Mi Plugin',
    'capability'   => 'manage_options',
    'menu_slug'    => 'mi-plugin-ajustes',
    'icon_url'     => 'dashicons-admin-plugins',
    'position'     => 30,
    'submenus' => [
        [
            'page_title' => 'Ajustes Generales',
            'menu_title' => 'Ajustes',
            'capability' => 'manage_options',
            'menu_slug'  => 'mi-plugin-general',
        ],
        [
            'page_title' => 'Opciones Avanzadas',
            'menu_title' => 'Avanzado',
            'capability' => 'manage_options',
            'menu_slug'  => 'mi-plugin-avanzado',
        ],
    ],
],
```

## Custom Post Types

Define custom post types para tu plugin:

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

## Taxonomías Personalizadas

Crea taxonomías personalizadas:

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

Define shortcodes para tu plugin:

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

## Endpoints de API

Configura endpoints de la REST API:

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

## Bloques Gutenberg

Define bloques Gutenberg personalizados:

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

## Controladores por Defecto

Antonella Framework proporciona varios controladores por defecto que puedes extender:

### ExampleController

El `ExampleController` demuestra funcionalidad básica de un controlador:

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
        // Inicializa la lógica de tu controlador aquí
        // El registro de hooks se hace en Config.php (no registrar aquí)
    }
    
    public function handle_init()
    {
        // Maneja la acción init de WordPress
    }
}
```

Registro en Config.php:

```php
public $add_action = [
    ['init', __NAMESPACE__.'\\Controllers\\ExampleController@handle_init', 10, 0],
];
```

## Tablas de Base de Datos

Si tu plugin necesita tablas personalizadas, puedes crearlas durante la activación del plugin:

```php
// En tu archivo principal del plugin o hook de activación
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

## Widgets del Dashboard

Agrega widgets personalizados al Dashboard de WordPress:

```php
public $dashboard = [[
    'slug' => 'antonella_example',
    'name' => 'Antonella Widget',
    'function' => __NAMESPACE__.'\\Admin\\PageAdmin::DashboardExample',
    'callback' => '',
    'args' => '',
]];
```

Opcionalmente, carga archivos para el Dashboard mediante `files_dashboard`.

## Widgets

Registra clases de widgets para tu plugin. Puedes generarlas con la consola:

```bash
php antonella Widget "NAME_OF_WIDGET"
```

Luego registra la clase:

```php
public $widgets = [
    __NAMESPACE__.'\\Widgets\\MyWidget',
];
```

## Próximos Pasos

Una vez que tengas tu configuración básica lista:

1. **[Creación de Controladores](/es/docs/creating-controllers)** - Aprende a crear controladores personalizados
2. **[Trabajo con Vistas](/es/docs/working-with-views)** - Crea plantillas y vistas
3. **[Probar tu Plugin](/es/docs/localhost-testing)** - Usa el entorno Docker para pruebas
4. **[Ejemplos de Controladores](/es/docs/controller-examples)** - Ve ejemplos prácticos

## Mejores Prácticas de Configuración

1. **Mantén orden**: Agrupa configuraciones relacionadas
2. **Usa nombres descriptivos**: Que la configuración se explique por sí sola
3. **Valida la entrada**: Siempre valida y sanitiza valores
4. **Entornos**: Adapta la config según el entorno de despliegue
5. **Seguridad primero**: Considera implicancias de seguridad en tu configuración

¿Necesitas ayuda con la configuración? Revisa nuestra **[guía de solución de problemas](/es/docs/troubleshooting)** o visita nuestro **[repositorio en GitHub](https://github.com/cehojac/antonella-framework-for-wp)**.
