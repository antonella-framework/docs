---
title: Paquetes Externos
description: Cómo usar paquetes externos (Composer/Packagist) con Antonella Framework
extends: _layouts.documentation
section: content
---

# Paquetes Externos

Antonella Framework acepta paquetes de terceros (hechos para WordPress o no). Puedes encontrarlos en [Packagist.org](https://packagist.org/) e instalarlos vía Composer. Los paquetes se almacenan en `vendor/`.

> Advertencia: el uso de paquetes externos puede aumentar el tamaño del plugin y, si el paquete no es seguro, introducir vulnerabilidades. Úsalos solo si son necesarios y de fuentes confiables.

## Instalar un paquete

1) Busca el paquete en Packagist (por ejemplo: "eloquent for WordPress").
2) Añádelo a tu proyecto con Composer.

```bash
# Ejemplo (según la documentación original)
composer require tareq1988/wp-eloquent:dev-master
```

Esto añadirá la dependencia a tu `composer.json` y descargará el paquete en `vendor/`.

## Actualizar dependencias

```bash
composer update
```

## Ejemplo de uso (Eloquent)

```php
<?php
// Ejemplo simplificado basado en la guía original
$db = WeDevsORM\Eloquent\Database::instance();

var_dump($db->table('users')->find(1));
var_dump($db->select('SELECT * FROM wp_users WHERE id = ?', [1]));
var_dump($db->table('users')->where('user_login', 'john')->first());
```

Nota: Adapta namespaces y métodos a la versión real del paquete que instales.

## Buenas prácticas

- Preferir versiones etiquetadas en lugar de ramas `dev-*` cuando sea posible.
- Revisar issues, mantenimiento y popularidad del paquete en Packagist/GitHub.
- Evitar paquetes innecesarios para reducir superficie de ataque y tamaño final del ZIP.
- Verifica compatibilidad con `makeup`: algunos subdirectorios de `vendor` usados solo para desarrollo se excluyen del paquete final.

## Integrar plugins de WordPress como dependencias (WPackagist)

Puedes integrar plugins de WordPress dentro de tu plugin usando [WPackagist](https://wpackagist.org/).

1) Buscar el plugin en WPackagist y requerirlo con Composer (versión exacta):

```bash
composer require wpackagist-plugin/contact-form-7:"6.1.1"
```

2) (Opcional según tu configuración) Autocargar el archivo principal del plugin en `composer.json` para tratarlo como "addon" de tu plugin. Ejemplo:

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

3) Regenerar el autoloader de Composer:

```bash
composer dump-autoload
```

Con esto, el plugin quedará disponible como un complemento del tuyo.

Notas importantes:
- Dependiendo de tu `composer.json`, los plugins de tipo `wordpress-plugin` pueden instalarse en rutas distintas. En este proyecto se mapean a `vendor/{name}/`, por lo que el archivo principal queda disponible en `vendor/{paquete}/{archivo}.php`.
- La versión queda fija a la que especifiques. Tú decides cuándo actualizar en versiones futuras de tu plugin.
