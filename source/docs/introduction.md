---
title: Introduction to Antonella Framework
description: Getting started with Antonella Framework v1.9 for WordPress plugin development
extends: _layouts.documentation
section: content
---

# Introduction to Antonella Framework v1.9

Welcome to **Antonella Framework v1.9**! 🎉

[![Version](https://img.shields.io/badge/version-v1.9-blue.svg)](https://github.com/cehojac/antonella-framework-for-wp)
[![PHP](https://img.shields.io/badge/PHP-8.0%2B-777BB4.svg)](https://php.net/)
[![WordPress](https://img.shields.io/badge/WordPress-5.0%2B-21759B.svg)](https://wordpress.org/)
[![License](https://img.shields.io/badge/license-GPL--2.0-green.svg)](https://github.com/cehojac/antonella-framework-for-wp/blob/main/LICENSE)

## What is Antonella Framework?

Antonella Framework is a **PHP development environment** specifically designed for creating WordPress plugins. Based on the **PSR-4** standard and following the **MVC (Model-View-Controller)** pattern, this framework allows you to develop plugins more efficiently, organized, and maintainable.

### Key Features

- 🏗️ **MVC Architecture**: Clear code organization following established patterns
- 📋 **PSR-4 Compatible**: Automatic class autoloading
- ⚡ **Rapid Development**: Reduces development time by up to 50%
- 🔓 **Open Source**: GPL license, free to use and modify
- 👥 **Team Work**: More readable and reusable code
- 🌐 **WordPress Specific**: Designed with the WordPress community in mind

### Why Use Antonella Framework?

1. **Improved Productivity**: Predefined structure that accelerates development
2. **Cleaner Code**: Clear separation of responsibilities
3. **Easy Maintenance**: Organized and well-documented code
4. **Scalability**: Architecture that grows with your project
5. **Active Community**: Continuous support and constant improvements

## System Requirements

Before starting, make sure you have:

- **PHP 8.0** or higher
- **WordPress 5.0** or higher
- **Composer** (for dependency management)
- Basic knowledge of PHP and WordPress

## Quick Installation

```bash
# Using the official installer (Recommended)
composer global require cehojac/antonella-installer
antonella new my-plugin

# Or manual installation
git clone https://github.com/cehojac/antonella-framework-for-wp.git
```

## Your First Plugin

Once installed, you'll have a structure like this:

```
my-plugin/
├── assets/
├── docker/
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
├── antonella
├── index.php
├── docker-compose.yml
├── composer.json
├── readme.md
├── readme.txt
└── my-plugin.php
```

## Framework Structure

The Antonella Framework follows a clear and organized structure:

### Core Directories

- **`src/Controllers/`** - 🎮 Controllers that handle business logic
- **`src/Admin/`** - 🛠️ WordPress admin functions
- **`src/helpers/`** - 🔧 Utilities and helper functions
- **`resources/`** - 👁️ Views and templates
- **`Assets/`** - 🖼️ Static files (CSS, JS, images)
- **`languages/`** - 🌍 Internationalization files

### Core Files

- **`Config.php`** - ⚙️ Central configuration
- **`Security.php`** - 🔒 Security functions
- **`Api.php`** - 🌐 REST API endpoints

## Next Steps

1. **[Complete Installation](/docs/installation)** - Detailed installation guide
2. **[Basic Setup](/docs/basic-setup)** - Configure your first plugin
3. **[Creating Controllers](/docs/creating-controllers)** - Learn to create controllers
4. **[Practical Examples](/docs/controller-examples)** - See real examples


```

## Support and Community

- 📖 **Documentation**: [antonellaframework.com/docs](https://antonellaframework.com/docs)
- 🐛 **Report Bugs**: [GitHub Issues](https://github.com/cehojac/antonella-framework-for-wp/issues)
- 💬 **Community**: [GitHub Discussions](https://github.com/cehojac/antonella-framework-for-wp/discussions)
- 🌐 **Website**: [antonellaframework.com](https://antonellaframework.com)

Start your journey with Antonella Framework and take your WordPress plugins to the next level! 🚀
