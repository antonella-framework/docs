---
title: Introducción a Antonella Framework
description: Comenzando con Antonella Framework v1.9 para el desarrollo de plugins de WordPress
extends: _layouts.documentation
section: content
---

# Introducción a Antonella Framework v1.9

¡Bienvenido a **Antonella Framework v1.9**! 🎉

[![Versión](https://img.shields.io/badge/version-v1.9-blue.svg)](https://github.com/cehojac/antonella-framework-for-wp)
[![PHP](https://img.shields.io/badge/PHP-8.0%2B-777BB4.svg)](https://php.net/)
[![WordPress](https://img.shields.io/badge/WordPress-5.0%2B-21759B.svg)](https://wordpress.org/)
[![Licencia](https://img.shields.io/badge/license-GPL--2.0-green.svg)](https://github.com/cehojac/antonella-framework-for-wp/blob/main/LICENSE)

## ¿Qué es Antonella Framework?

Antonella Framework es un **entorno de desarrollo PHP** específicamente diseñado para crear plugins de WordPress. Basado en el estándar **PSR-4** y siguiendo el patrón **MVC (Modelo-Vista-Controlador)**, este framework te permite desarrollar plugins de manera más eficiente, organizada y mantenible.

### Características Clave

- 🏗️ **Arquitectura MVC**: Organización clara del código siguiendo patrones establecidos
- 📋 **Compatible con PSR-4**: Autocarga automática de clases
- ⚡ **Desarrollo Rápido**: Reduce el tiempo de desarrollo hasta un 50%
- 🔓 **Código Abierto**: Licencia GPL, libre para usar y modificar
- 👥 **Trabajo en Equipo**: Código más legible y reutilizable
- 🌐 **Específico para WordPress**: Diseñado pensando en la comunidad WordPress

### ¿Por qué usar Antonella Framework?

1. **Productividad Mejorada**: Estructura predefinida que acelera el desarrollo
2. **Código más Limpio**: Separación clara de responsabilidades
3. **Mantenimiento Fácil**: Código organizado y bien documentado
4. **Escalabilidad**: Arquitectura que crece con tu proyecto
5. **Comunidad Activa**: Soporte continuo y mejoras constantes

## Requisitos del Sistema

Antes de comenzar, asegúrate de tener:

- **PHP 8.0** o superior
- **WordPress 5.0** o superior
- **Composer** (para gestión de dependencias)
- Conocimientos básicos de PHP y WordPress

## Instalación Rápida

```bash
# Usando el instalador oficial (Recomendado)
composer global require cehojac/antonella-installer
antonella new mi-plugin

# O instalación manual
git clone https://github.com/cehojac/antonella-framework-for-wp.git
```

## Tu Primer Plugin

Una vez instalado, tendrás una estructura como esta:

```
mi-plugin/
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
└── mi-plugin.php
```

## Estructura del Framework

Antonella Framework sigue una estructura clara y organizada:

### Directorios Principales

- **`src/Controllers/`** - 🎮 Controladores que manejan la lógica de negocio
- **`src/Admin/`** - 🛠️ Funciones del administrador de WordPress
- **`src/helpers/`** - 🔧 Utilidades y funciones auxiliares
- **`resources/`** - 👁️ Vistas y plantillas
- **`Assets/`** - 🖼️ Archivos estáticos (CSS, JS, imágenes)
- **`languages/`** - 🌍 Archivos de internacionalización


## Próximos Pasos

1. **[Instalación Completa](/es/docs/installation)** - Guía detallada de instalación
2. **[Configuración Básica](/es/docs/basic-setup)** - Configura tu primer plugin
3. **[Creando Controladores](/es/docs/creating-controllers)** - Aprende a crear controladores
4. **[Ejemplos Prácticos](/es/docs/controller-examples)** - Ver ejemplos reales

## Soporte y Comunidad

- 📖 **Documentación**: [antonellaframework.com/docs](https://antonellaframework.com/docs)
- 🐛 **Reportar Errores**: [GitHub Issues](https://github.com/cehojac/antonella-framework-for-wp/issues)
- 💬 **Comunidad**: [GitHub Discussions](https://github.com/cehojac/antonella-framework-for-wp/discussions)
- 🌐 **Sitio Web**: [antonellaframework.com](https://antonellaframework.com)

¡Comienza tu viaje con Antonella Framework y lleva tus plugins de WordPress al siguiente nivel! 🚀
