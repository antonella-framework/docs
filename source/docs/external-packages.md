---
title: External Packages
description: How to use external packages (Composer/Packagist) with Antonella Framework
extends: _layouts.documentation
section: content
---

# External Packages

Antonella Framework supports third‑party packages (WordPress‑specific or general PHP). You can find them on [Packagist.org](https://packagist.org/) and install via Composer. Packages are stored in `vendor/`.

> Warning: external packages can increase plugin size and may introduce security risks if untrusted. Use only when necessary and from trusted sources.

## Install a package

Search the package on Packagist (e.g., “eloquent for WordPress”), then require it with Composer:

```bash
# Example (per original guidance)
composer require tareq1988/wp-eloquent:dev-master
```

This updates your `composer.json` and downloads the package into `vendor/`.

## Update dependencies

```bash
composer update
```

## Usage example (Eloquent)

```php
<?php
// Simplified example based on the original guide
$db = WeDevsORM\Eloquent\Database::instance();

var_dump($db->table('users')->find(1));
var_dump($db->select('SELECT * FROM wp_users WHERE id = ?', [1]));
var_dump($db->table('users')->where('user_login', 'john')->first());
```

Note: Adjust namespaces and methods to the actual version of the package you install.

## Best practices

- Prefer tagged releases over `dev-*` branches when possible.
- Check maintenance, issues, and popularity on Packagist/GitHub.
- Avoid unnecessary packages to reduce attack surface and final ZIP size.
- Verify compatibility with `makeup`: some `vendor` subpaths only used for development are excluded from the final package.

## Integrate WordPress plugins as dependencies (WPackagist)

You can integrate WordPress plugins into your plugin using [WPackagist](https://wpackagist.org/).

1) Find the plugin on WPackagist and require it with Composer (exact version):

```bash
composer require wpackagist-plugin/contact-form-7:"6.1.1"
```

2) (Optional based on your setup) Autoload the plugin's main file via `composer.json` to treat it as an addon:

```json
{
  "autoload": {
    "psr-4": {"CH\\": "src/"},
    "files": [
      "src/helpers.php",
      "vendor/contact-form-7/contact-form-7.php"
    ]
  }
}
```

3) Regenerate Composer's autoloader:

```bash
composer dump-autoload
```

Now you can use the plugin as part of your project.

Important notes:
- Depending on your `composer.json`, packages of type `wordpress-plugin` may be installed in different paths. In this project they are mapped to `vendor/{name}/`, so the main file is available at `vendor/{package}/{file}.php`.
- The plugin remains pinned to the installed version. It's your responsibility to bump it in future versions of your plugin.
