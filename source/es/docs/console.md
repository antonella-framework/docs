---
title: Comandos de Consola Antonella
description: Guía completa de comandos de consola de Antonella Framework para scaffolding y construcción de plugins WordPress
extends: _layouts.documentation
section: content
---

# Comandos de Consola Antonella

Antonella Framework incluye una herramienta de consola poderosa que te ayuda a crear componentes, construir tu plugin y gestionar tu flujo de desarrollo.

## Comenzando

La consola Antonella se accede a través del archivo `antonella` en la raíz de tu proyecto:

```bash
php antonella [comando] [opciones]
```

## Comandos Disponibles

### `makeup` - Construir Plugin
Empaqueta tu plugin en un archivo ZIP distribuible, excluyendo archivos de desarrollo.

```bash
php antonella makeup
```

**Qué hace (según el script de consola):**
- Crea un ZIP con el nombre del directorio del proyecto.
- Excluye archivos y directorios de desarrollo o inseguros.
- Produce un paquete seguro para instalar en cualquier sitio WordPress.

**Ejemplos de exclusiones:**
- Archivos: `.gitignore`, `.gitattributes`, configs de CI, `composer.json`, `composer.lock`, `package-lock.json`, `antonella` (consola), `README*`, `CHANGELOG.md`, `LICENSE`, `.env*`, `docker-compose.yaml`, `docker`.
- Directorios base: `.git/`, `.github/`, `.claude/`, `.vscode/`, `wp-test/`, `docker/`, `node_modules/`, `wordpress/`, `docs/`, `test/`.
- Subrutas de vendor: `vlucas`, `squizlabs`, `phpunit`, `theseer`, `nikic`, `phar-io`, `myclabs`, `symfony/console`, `antonella-framework`.

**Salida:** `nombre-de-tu-plugin.zip`

---

### `make` - Crear Controlador
Genera una nueva clase controlador con código base.

```bash
php antonella make NombreControlador
```

**Ejemplo:**
```bash
php antonella make ControladorUsuario
```

Crea: `app/Controllers/ControladorUsuario.php`

---

### `helper` - Crear Helper
Genera una nueva clase helper para funciones de utilidad.

```bash
php antonella helper NombreHelper
```

**Ejemplo:**
```bash
php antonella helper HelperBaseDatos
```

Crea: `app/Helpers/HelperBaseDatos.php`

---

### `widget` - Crear Widget
Crea una nueva clase widget de WordPress.

```bash
php antonella widget NombreWidget
```

**Ejemplo:**
```bash
php antonella widget WidgetPersonalizado
```

Crea: `app/Widgets/WidgetPersonalizado.php`

---

### `cpt` - Crear Custom Post Type
Genera un custom post type con todos los métodos necesarios.

```bash
php antonella cpt NombrePostType
```

**Ejemplo:**
```bash
php antonella cpt Producto
```

Crea: `app/PostTypes/Producto.php`

---

### `block` - Crear Bloque Gutenberg
Crea un nuevo bloque Gutenberg para el editor de WordPress.

```bash
php antonella block NombreBloque
```

**Ejemplo:**
```bash
php antonella block BloquePersonalizado
```

Crea: Archivos de bloque en el directorio apropiado con componentes JavaScript y PHP.

---

### `namespace` - Actualizar Namespace
Cambia el namespace de tu proyecto plugin.

```bash
php antonella namespace NuevoNamespace
```

Nota: También puedes ejecutar el comando sin argumento para autogenerar un namespace a partir de tu proyecto (por ejemplo, basado en el nombre del directorio).

```bash
php antonella namespace
# Autogenera un namespace (p. ej., MYNAMESPACE)
```

**Ejemplo:**
```bash
php antonella namespace MYNAMESPACE
```

Actualiza todos los archivos PHP con el nuevo namespace.

---

### `docker` - Gestión Docker
Gestiona el entorno Docker para desarrollo.

```bash
php antonella docker [-d]
```

Ejecuta el entorno Docker para desarrollo de WordPress.
Usa `-d` para ejecutarlo en modo detach.

---

### `serve` - Servidor de Desarrollo
Inicia un servidor de desarrollo para testing.

```bash
php antonella serve
```

Lanza un entorno de desarrollo local.

---

### `test` - Ejecutar Tests
Ejecuta la suite de tests del plugin.

```bash
php antonella test
```

Ejecuta tests PHPUnit si están configurados.

---

### `add` - Agregar Componentes
Agrega nuevos componentes o características a tu plugin.

```bash
php antonella add [componente]
```

---

### `remove` - Eliminar Componentes
Elimina componentes de tu plugin.

```bash
php antonella remove [componente]
```

---

### `updateproject` - Actualizar Proyecto
Actualiza archivos y estructura del proyecto.

```bash
php antonella updateproject
```

Renombra el archivo principal del plugin para coincidir con tu directorio de proyecto.

---

### `help` - Mostrar Ayuda
Muestra comandos disponibles e información de uso.

```bash
php antonella help
```

## Flujos de Trabajo Comunes

### 1. Iniciando un Nuevo Plugin

```bash
# Configura tu namespace
php antonella namespace MYNAMESPACE

# Crea tu primer controlador
php antonella make ControladorInicio

# Crea un custom post type
php antonella cpt Producto

# Crea un helper para utilidades
php antonella helper HelperCadenas
```

### 2. Desarrollo con Docker

```bash
# Iniciar entorno Docker
php antonella docker

# Desarrollar tus componentes
php antonella make ControladorUsuario
php antonella widget WidgetUsuario

# Probar cambios en localhost:8080
```

### 3. Construcción para Producción

```bash
# Ejecutar tests (si están disponibles)
php antonella test

# Construir el paquete del plugin
php antonella makeup

# Tu plugin.zip está listo para distribución
```

## Contenido del Paquete (ZIP)

El comando `makeup` crea `nombre-de-tu-plugin.zip` con la misma estructura base de instalación, menos los archivos/directorios excluidos por `antonella`:

```
tu-plugin/
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
├── vendor/              # Dependencias de producción de Composer
├── index.php            # Si aplica
└── tu-plugin.php        # Archivo principal del plugin
```

Notas:
- El ZIP omite artefactos de desarrollo como `.git/`, `node_modules/`, `docker/`, configs de CI, `.env*`, etc.
- Se excluyen algunas subrutas de `vendor` usadas para desarrollo/testing para mantener el paquete liviano y seguro.

## Manejo de Errores

Si encuentras un error, Antonella mostrará:

```
Antonella no understand you. please read the manual in https://antonellaframework.com
```

Esto significa:
- El comando no existe
- Se usó sintaxis incorrecta
- Faltan parámetros requeridos

## Tips y Mejores Prácticas

### 1. **Usa Nombres Descriptivos**
```bash
# Bien
php antonella make ControladorProducto
php antonella cpt Evento

# Evita
php antonella make Ctrl
php antonella cpt Cosa
```

### 2. **Sigue Convenciones WordPress**
- Usa PascalCase para nombres de clase
- Usa nombres descriptivos para post types
- Sigue estándares de codificación WordPress

### 3. **Prueba Antes de Construir**
```bash
# Siempre prueba en entorno Docker
php antonella docker

# Luego construye para producción
php antonella makeup
```

### 4. **Mantén tu Namespace Actualizado**
```bash
# Actualiza namespace al cambiar estructura del proyecto
php antonella namespace MYNAMESPACE
```

## Integración con IDE

La mayoría de IDEs reconocerán los archivos generados y proporcionarán:
- **Autocompletado** para clases Antonella
- **Resaltado de sintaxis** para archivos PHP
- **Navegación de código** entre componentes

## Próximos Pasos

- [Aprende sobre Controladores](/es/docs/controllers)
- [Crea Custom Post Types](/es/docs/custom-post-types)
- [Construye Bloques Gutenberg](/es/docs/blocks)
- [Configura Entorno Docker](/es/docs/docker)
