---
title: Installation
description: Learn how to install Antonella Framework and create your first plugin
extends: _layouts.documentation
section: content
---

# Installation

Learn how to install Antonella Framework and create your first plugin.

📌 **Current Version: Antonella Framework v1.9**

## Minimum Requirements

Before installing Antonella Framework, make sure you meet the following requirements:

- **PHP 8.0** or higher
- **WordPress 5.0** or higher  
- **Composer** installed globally
- **Web server** (Apache, Nginx, etc.)
- **MySQL database** 5.7+ or MariaDB 10.2+

### Verify Requirements

```bash
# Check PHP version
php --version

# Check that Composer is installed
composer --version

# Check WordPress version (from wp-admin)
# Go to Dashboard > Updates
```

## Method 1: Official Installer (Recommended)

The fastest and easiest way to get started with Antonella Framework:

### Step 1: Install the global installer

```bash
composer global require cehojac/antonella-installer
```

### Step 2: Create a new plugin

```bash
# Create plugin in current directory
antonella new my-plugin

# Or specify a custom path
antonella new /path/to/wordpress/wp-content/plugins/my-plugin
```

### Step 3: Configure the plugin

```bash
cd my-plugin

# Install dependencies
composer install

# Configure namespace (optional)
php antonella namespace MyPlugin
```

## Method 2: Manual Installation

If you prefer more control over the installation process:

### Step 1: Create plugin structure

```bash
# Create plugin directory
mkdir my-plugin
cd my-plugin

# Create composer.json file
composer init
```

### Step 2: Install Antonella Framework

```bash
composer require cehojac/antonella-framework
```

### Step 3: Create basic structure

```bash
# Create necessary directories
mkdir src
mkdir src/Controllers
mkdir src/Admin
mkdir src/helpers
mkdir resources
mkdir resources/views
mkdir Assets
mkdir Assets/css
mkdir Assets/js
mkdir Assets/images
```

### Step 4: Create main plugin file

Create `my-plugin.php` in the root:

```php
<?php
/**
 * Plugin Name: My Plugin
 * Description: My first plugin with Antonella Framework
 * Version: 1.0.0
 * Author: Your Name
 * License: GPL v2 or later
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('MY_PLUGIN_VERSION', '1.0.0');
define('MY_PLUGIN_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MY_PLUGIN_PLUGIN_URL', plugin_dir_url(__FILE__));

// Load Composer autoloader
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
} else {
    add_action('admin_notices', function() {
        echo '<div class="notice notice-error"><p>Error: Composer autoloader not found. Run <code>composer install</code> in the plugin directory.</p></div>';
    });
    return;
}

// Initialize the plugin
function my_plugin_init() {
    try {
        // Here you'll initialize your plugin with Antonella Framework
        // new MyPlugin\Core\Plugin();
    } catch (Exception $e) {
        add_action('admin_notices', function() use ($e) {
            echo '<div class="notice notice-error"><p>Error initializing plugin: ' . esc_html($e->getMessage()) . '</p></div>';
        });
    }
}
add_action('plugins_loaded', 'my_plugin_init');
```

## Project Structure

After installation, you'll have this structure:

```
my-plugin/
├── src/                     # 🎮 Framework source code
│   ├── Controllers/         # Controllers
│   ├── Admin/              # wp-admin functions
│   ├── helpers/            # Utilities and helpers
│   ├── Config.php          # Central configuration
│   ├── Security.php        # Security
│   └── Api.php            # REST API
├── resources/              # 👁️ Views and templates
│   ├── views/
│   └── templates/
├── Assets/                 # 🖼️ Static files
│   ├── css/
│   ├── js/
│   └── images/
├── languages/              # 🌍 Language files
├── vendor/                 # 📦 Composer dependencies
├── my-plugin.php          # 🚀 Main plugin file
└── composer.json          # 📋 Composer configuration
```

## Testing and Development Environment

Antonella Framework includes a complete Docker environment for testing and local development.

### What is the Docker environment for?

- **Test plugins** in real WordPress without manual configuration
- **Validate code** with professional tools like Plugin Check
- **Local development** without affecting your main installation
- **Advanced debugging** with Query Monitor and Debug Bar
- **Complete testing** before publishing your plugin

### Included Tools

- **Plugin Check**: Validates your plugin against WordPress standards
- **Query Monitor**: Advanced query and performance analysis  
- **Debug Bar**: Real-time debugging information
- **Theme Check**: Code standards verification
- **Developer**: Additional development tools

### Using the testing environment

```bash
# Start the environment (first time may take a few minutes)
docker-compose up -d

# Access the site
# URL: http://localhost:8080
# Admin: http://localhost:8080/wp-admin
# User: test
# Password: test

# Stop the environment
docker-compose down
```

## Verify Installation

### 1. Check files

```bash
# Verify that Composer installed dependencies
ls vendor/

# Verify framework structure
ls src/
```

### 2. Activate the plugin

1. Go to **wp-admin > Plugins**
2. Find your plugin in the list
3. Click **Activate**

### 3. Verify functionality

If everything is correct, you should see:
- The plugin appears in the active plugins list
- No errors in the WordPress log
- Plugin functionalities work correctly

## Troubleshooting

### Error: "Composer autoloader not found"

```bash
# Go to plugin directory
cd my-plugin

# Install dependencies
composer install
```

### Error: "Class not found"

Verify that:
- The Composer autoloader is loaded correctly
- Namespaces are configured correctly
- Classes follow the PSR-4 standard

### Permission errors

```bash
# On Unix/Linux/Mac systems
chmod -R 755 my-plugin/
chown -R www-data:www-data my-plugin/
```

### Plugin doesn't appear in wp-admin

- Verify that the main file has the correct header
- Make sure there are no PHP errors
- Check the WordPress error log

## Next Steps

Once successfully installed:

1. **[Basic Setup](basic-setup)** - Configure your plugin
2. **[Create your first controller](creating-controllers)** - Learn the MVC structure
3. **[Testing environment](localhost-testing)** - Use Docker for testing
4. **[Practical examples](controller-examples)** - See real code

## Support

Need help? Check:

- **[Troubleshooting guide](troubleshooting)**
- **[GitHub Issues](https://github.com/cehojac/antonella-framework-for-wp/issues)**
- **[Official documentation](https://antonellaframework.com)**

Congratulations! You now have Antonella Framework installed and ready to develop amazing plugins. 🎉
