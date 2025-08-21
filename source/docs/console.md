---
title: Antonella Console Commands
description: Complete guide to Antonella Framework console commands for scaffolding and building WordPress plugins
extends: _layouts.documentation
section: content
---

# Antonella Console Commands

Antonella Framework includes a powerful console tool that helps you scaffold components, build your plugin, and manage your development workflow.

## Getting Started

The Antonella console is accessed through the `antonella` file in your project root:

```bash
php antonella [command] [options]
```

## Available Commands

### `makeup` - Build Plugin
Packages your plugin into a distributable ZIP file, excluding development files.

```bash
php antonella makeup
```

**What it does (per console script):**
- Creates a ZIP named after your project directory.
- Excludes development and unsafe files.
- Produces a package safe to install on any WordPress site.

**Excluded examples:**
- Files: `.gitignore`, `.gitattributes`, CI configs, `composer.json`, `composer.lock`, `package-lock.json`, `antonella` (console), `README*`, `CHANGELOG.md`, `LICENSE`, `.env*`, `docker-compose.yaml`, `docker`.
- Base directories: `.git/`, `.github/`, `.claude/`, `.vscode/`, `wp-test/`, `docker/`, `node_modules/`, `wordpress/`, `docs/`, `test/`.
- Vendor subpaths: `vlucas`, `squizlabs`, `phpunit`, `theseer`, `nikic`, `phar-io`, `myclabs`, `symfony/console`, `antonella-framework`.

**Output:** `your-plugin-name.zip`

---

### `make` - Create Controller
Generates a new controller class with boilerplate code.

```bash
php antonella make ControllerName
```

**Example:**
```bash
php antonella make UserController
```

Creates: `app/Controllers/UserController.php`

---

### `helper` - Create Helper
Generates a new helper class for utility functions.

```bash
php antonella helper HelperName
```

**Example:**
```bash
php antonella helper DatabaseHelper
```

Creates: `app/Helpers/DatabaseHelper.php`

---

### `widget` - Create Widget
Scaffolds a new WordPress widget class.

```bash
php antonella widget WidgetName
```

**Example:**
```bash
php antonella widget CustomWidget
```

Creates: `app/Widgets/CustomWidget.php`

---

### `cpt` - Create Custom Post Type
Generates a custom post type with all necessary methods.

```bash
php antonella cpt PostTypeName
```

**Example:**
```bash
php antonella cpt Product
```

Creates: `app/PostTypes/Product.php`

---

### `block` - Create Gutenberg Block
Scaffolds a new Gutenberg block for the WordPress editor.

```bash
php antonella block BlockName
```

**Example:**
```bash
php antonella block CustomBlock
```

Creates: Block files in the appropriate directory with JavaScript and PHP components.

---

### `namespace` - Update Namespace
Changes the namespace of your plugin project.

```bash
php antonella namespace NewNamespace
```

Note: You can also run the command without an argument to auto-generate a namespace from your project (e.g., based on your directory name).

```bash
php antonella namespace
# Auto-generates a namespace (e.g., MYNAMESPACE)
```

**Example:**
```bash
php antonella namespace MYNAMESPACE
```

Updates all PHP files with the new namespace.

---

### `docker` - Docker Management
Manages Docker environment for development.

```bash
php antonella docker [-d]
```

Runs the Docker environment for WordPress development.
Use `-d` to run in detached mode.

---

### `serve` - Development Server
Starts a development server for testing.

```bash
php antonella serve
```

Launches a local development environment.

---

### `test` - Run Tests
Executes the plugin test suite.

```bash
php antonella test
```

Runs PHPUnit tests if configured.

---

### `add` - Add Components
Adds new components or features to your plugin.

```bash
php antonella add [component]
```

---

### `remove` - Remove Components
Removes components from your plugin.

```bash
php antonella remove [component]
```

---

### `updateproject` - Update Project
Updates project files and structure.

```bash
php antonella updateproject
```

Renames the main plugin file to match your project directory.

---

### `help` - Show Help
Displays available commands and usage information.

```bash
php antonella help
```

## Common Workflows

### 1. Starting a New Plugin

```bash
# Set up your namespace
php antonella namespace MYNAMESPACE

# Create your first controller
php antonella make HomeController

# Create a custom post type
php antonella cpt Product

# Create a helper for utilities
php antonella helper StringHelper
```

### 2. Development with Docker

```bash
# Start Docker environment
php antonella docker

# Develop your components
php antonella make UserController
php antonella widget UserWidget

# Test your changes at localhost:8080
```

### 3. Building for Production

```bash
# Run tests (if available)
php antonella test

# Build the plugin package
php antonella makeup

# Your plugin.zip is ready for distribution
```

## Package Contents (ZIP)

The `makeup` command creates `your-plugin-name.zip` with the same structure as a fresh installation, minus excluded dev/config files:

```
your-plugin/
├── assets/
├── languages/
├── resources/
│   └── views/
├── src/
│   ├── Admin/
│   ├── Controllers/
│   ├── Helpers/
│   ├── Api.php
│   ├── Config.php
│   ├── Desactivate.php
│   ├── Gutenberg.php
│   ├── helpers.php
│   ├── Hooks.php
│   ├── Init.php
│   ├── Install.php
│   ├── Language.php
│   ├── PostTypes.php
│   ├── Request.php
│   ├── Security.php
│   ├── Shortcodes.php
│   ├── Start.php
│   ├── Unisntall.php
│   ├── Users.php
│   └── Widgets.php
├── storage/
├── vendor/
├── index.php
└── your-plugin.php
```

Notes:
- Excludes: `.git/`, `.github/`, `.claude/`, `.vscode/`, `node_modules/`, `docker/` and `docker-compose*`, `wordpress/`, `docs/`, test tooling, `.env*`, CI configs, and similar.
- Composer config files (`composer.json`, `composer.lock`) and the local console `antonella` are excluded from the ZIP.

## Error Handling

If you encounter an error, Antonella will display:

```
Antonella no understand you. please read the manual in https://antonellaframework.com
```

This means:
- The command doesn't exist
- Incorrect syntax was used
- Missing required parameters

## Tips and Best Practices

### 1. **Use Descriptive Names**
```bash
# Good
php antonella make ProductController
php antonella cpt Event

# Avoid
php antonella make Ctrl
php antonella cpt Thing
```

### 2. **Follow WordPress Conventions**
- Use PascalCase for class names
- Use descriptive post type names
- Follow WordPress coding standards

### 3. **Test Before Building**
```bash
# Always test in Docker environment
php antonella docker

# Then build for production
php antonella makeup
```

### 4. **Keep Your Namespace Updated**
```bash
# Update namespace when changing project structure
php antonella namespace MYNAMESPACE
```

## Integration with IDE

Most IDEs will recognize the generated files and provide:
- **Autocompletion** for Antonella classes
- **Syntax highlighting** for PHP files
- **Code navigation** between components

## Next Steps

- [Learn about Controllers](/docs/controllers)
- [Create Custom Post Types](/docs/custom-post-types)
- [Build Gutenberg Blocks](/docs/blocks)
- [Set up Docker Environment](/docs/docker)
