---
title: Instalación
description: Aprende cómo instalar Antonella Framework y crear tu primer plugin
extends: _layouts.documentation
section: content
---

# Instalación

Aprende cómo instalar Antonella Framework y crear tu primer plugin.

📌 **Versión Actual: Antonella Framework v1.9**

## Requisitos Mínimos

Antes de instalar Antonella Framework, asegúrate de cumplir con los siguientes requisitos:

- **PHP 8.0** o superior
- **WordPress 5.0** o superior  
- **Composer** instalado globalmente
- **Docker** instalado globalmente

### Verificar Requisitos

```bash
# Verificar versión de PHP
php --version

# Verificar que Composer esté instalado
composer --version

# Verificar versión de WordPress (desde wp-admin)
# Ve a Escritorio > Actualizaciones
```

## Método 1: Instalador Oficial (Recomendado)

La forma más rápida y fácil de comenzar con Antonella Framework:

### Paso 1: Instalar el instalador global

```bash
composer global require cehojac/antonella-installer
```

### Paso 2: Crear un nuevo plugin

```bash
# Crear plugin en el directorio actual
antonella new mi-plugin

# O especificar una ruta personalizada
antonella new /ruta/a/wordpress/wp-content/plugins/mi-plugin
```

### Paso 3: Configurar el plugin

```bash
cd mi-plugin

# Instalar dependencias
composer install

# Configurar namespace (opcional)
php antonella namespace MiPlugin
```

## Método 2: Composer (Alternativa)

Si prefieres usar Composer directamente (estilo Laravel):

### Crear un nuevo proyecto de plugin con Composer

```bash
composer create-project --prefer-dist cehojac/antonella-framework-for-wp my-awesome-plugin
cd my-awesome-plugin
```

## Estructura del Proyecto

Después de la instalación, tendrás esta estructura:

```
mi-plugin/
├── assets/                 # 🖼️ Recursos estáticos (css, js, imágenes)
├── docker/                 # 🐳 Entorno Docker
├── languages/              # 🌍 Archivos de traducción
├── resources/              # 👁️ Vistas y plantillas
│   └── views/
├── src/                    # 🎮 Código fuente del framework
│   ├── Admin/              # 🛠️ Hooks del área de administración
│   ├── Controllers/        # 🎯 Controladores MVC
│   ├── Helpers/            # 🧰 Utilidades y helpers
│   ├── Api.php             # ⚙️ Bootstrap de la API REST
│   ├── Config.php          # ⚙️ Configuración central
│   ├── Desactivate.php     # ⚙️ Rutinas de desactivación
│   ├── Gutenberg.php       # ⚙️ Integración con Gutenberg
│   ├── helpers.php         # ⚙️ Funciones helper globales
│   ├── Hooks.php           # ⚙️ Registro de hooks de WP
│   ├── Init.php            # ⚙️ Inicializador principal
│   ├── Install.php         # ⚙️ Rutinas de instalación
│   ├── Language.php        # ⚙️ Utilidades i18n
│   ├── PostTypes.php       # ⚙️ Tipos de contenido personalizados
│   ├── Request.php         # ⚙️ Utilidades de petición/HTTP
│   ├── Security.php        # ⚙️ Módulo de seguridad
│   ├── Shortcodes.php      # ⚙️ Registro de shortcodes
│   ├── Start.php           # ⚙️ Punto de entrada
│   ├── Unisntall.php       # ⚙️ Rutinas de desinstalación
│   ├── Users.php           # ⚙️ Gestión de usuarios
│   └── Widgets.php         # ⚙️ Registro de widgets
├── storage/                # 🗄️ Almacenamiento/Caché
├── vendor/                 # 📦 Dependencias de Composer
├── antonella               # 🔧 CLI/utilidad
├── index.php               # 🚀 Front controller (si aplica)
├── docker-compose.yml      # 🐳 Servicios Docker
├── composer.json           # 📋 Configuración de Composer
├── readme.md               # 📖 README del proyecto
├── readme.txt              # 📖 README para WordPress
└── mi-plugin.php           # 🚀 Archivo principal del plugin
```

## Entorno de Pruebas y Desarrollo

Antonella Framework incluye un entorno Docker completo para pruebas y desarrollo local.

### ¿Para qué sirve el entorno Docker?

- **Probar plugins** en WordPress real sin configuración manual
- **Validar código** con herramientas profesionales como Plugin Check
- **Desarrollo local** sin afectar tu instalación principal
- **Depuración avanzada** con Query Monitor y Debug Bar
- **Pruebas completas** antes de publicar tu plugin

### Herramientas Incluidas

- **Plugin Check**: Valida tu plugin contra estándares de WordPress
- **Query Monitor**: Análisis avanzado de consultas y rendimiento  
- **Debug Bar**: Información de depuración en tiempo real
- **Theme Check**: Verificación de estándares de código
- **Developer**: Herramientas adicionales de desarrollo

### Usar el entorno de pruebas

```bash
# Iniciar el entorno Docker con la CLI de Antonella (la primera vez puede tardar unos minutos)
php antonella docker

# Acceder al sitio
# URL: http://localhost:8080
# Admin: http://localhost:8080/wp-admin
# Usuario: test
# Contraseña: test

# Los plugins de testeo de WordPress se instalan y habilitan automáticamente:
# query-monitor, debug-bar, theme-check, plugin-check, developer
```

## Verificar Instalación

### 1. Verificar archivos

```bash
# Verificar que Composer instaló las dependencias
ls vendor/

# Verificar estructura del framework
ls src/
```

### 2. Activar el plugin

1. Ve a **wp-admin > Plugins**
2. Busca tu plugin en la lista
3. Haz clic en **Activar**

### 3. Verificar funcionalidad

Si todo está correcto, deberías ver:
- El plugin aparece en la lista de plugins activos
- No hay errores en el log de WordPress
- Las funcionalidades del plugin funcionan correctamente

## Solución de Problemas

### Error: "Autoloader de Composer no encontrado"

```bash
# Ve al directorio del plugin
cd mi-plugin

# Instalar dependencias
composer install
```

### Error: "Clase no encontrada"

Verifica que:
- El autoloader de Composer se carga correctamente
- Los namespaces están configurados correctamente
- Las clases siguen el estándar PSR-4

### Errores de permisos

```bash
# En sistemas Unix/Linux/Mac
chmod -R 755 mi-plugin/
chown -R www-data:www-data mi-plugin/
```

### El plugin no aparece en wp-admin

- Verifica que el archivo principal tenga el header correcto
- Asegúrate de que no haya errores de PHP
- Revisa el log de errores de WordPress

## Siguientes Pasos

Una vez instalado correctamente:

1. **[Configuración Básica](basic-setup)** - Configura tu plugin
2. **[Crear tu primer controlador](creating-controllers)** - Aprende la estructura MVC
3. **[Entorno de pruebas](localhost-testing)** - Usa Docker para pruebas
4. **[Ejemplos prácticos](controller-examples)** - Ve código real

## Soporte

¿Necesitas ayuda? Consulta:

- **[Guía de solución de problemas](troubleshooting)**
- **[GitHub Issues](https://github.com/cehojac/antonella-framework-for-wp/issues)**
- **[Documentación oficial](https://antonellaframework.com)**

¡Felicidades! Ya tienes Antonella Framework instalado y listo para desarrollar plugins increíbles. 🎉