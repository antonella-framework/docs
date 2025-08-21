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

## Method 2: Composer (Alternative)

If you prefer using Composer directly (Laravel style):

### Create a new plugin project with Composer

```bash
composer create-project --prefer-dist cehojac/antonella-framework-for-wp my-awesome-plugin
cd my-awesome-plugin
```

## Project Structure

After installation, you'll have this structure:

```
my-plugin/
├── assets/                 # 🖼️ Static assets (css, js, images)
├── docker/                 # 🐳 Docker environment
├── languages/              # 🌍 Translations
├── resources/              # 👁️ Views and templates
│   └── views/
├── src/                    # 🎮 Framework source code
│   ├── Admin/              # 🛠️ Admin area hooks
│   ├── Controllers/        # 🎯 MVC Controllers
│   ├── Helpers/            # 🧰 Helper utilities
│   ├── Api.php             # ⚙️ REST API bootstrap
│   ├── Config.php          # ⚙️ Central configuration
│   ├── Desactivate.php     # ⚙️ Deactivation routines
│   ├── Gutenberg.php       # ⚙️ Gutenberg blocks integration
│   ├── helpers.php         # ⚙️ Global helper functions
│   ├── Hooks.php           # ⚙️ WP hooks wiring
│   ├── Init.php            # ⚙️ Core initializer
│   ├── Install.php         # ⚙️ Installation routines
│   ├── Language.php        # ⚙️ i18n helpers
│   ├── PostTypes.php       # ⚙️ Custom post types
│   ├── Request.php         # ⚙️ Request/HTTP utilities
│   ├── Security.php        # ⚙️ Security module
│   ├── Shortcodes.php      # ⚙️ Shortcodes registration
│   ├── Start.php           # ⚙️ App entrypoint
│   ├── Unisntall.php       # ⚙️ Uninstall routines
│   ├── Users.php           # ⚙️ User management
│   └── Widgets.php         # ⚙️ Widgets registration
├── storage/                # 🗄️ Cache/storage
├── vendor/                 # 📦 Composer dependencies
├── antonella               # 🔧 CLI/utility
├── index.php               # 🚀 Front controller (if applicable)
├── docker-compose.yml      # 🐳 Docker services
├── composer.json           # 📋 Composer config
├── readme.md               # 📖 Project readme
├── readme.txt              # 📖 WP readme
└── my-plugin.php           # 🚀 Main plugin file
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
# Start the Docker environment with Antonella CLI (first time may take a few minutes)
php antonella docker

# Access the site
# URL: http://localhost:8080
# Admin: http://localhost:8080/wp-admin
# User: test
# Password: test

# WordPress testing plugins are auto-installed and enabled:
# query-monitor, debug-bar, theme-check, plugin-check, developer
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
