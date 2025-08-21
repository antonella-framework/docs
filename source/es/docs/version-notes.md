---
title: Notas de Versión
description: Notas de lanzamiento y changelog para todas las versiones de Antonella Framework
extends: _layouts.documentation
section: content
---

# Notas de Versión

Esta página contiene las notas de lanzamiento y changelog para todas las versiones de Antonella Framework.

## Versión 1.9 (Actual)

**Fecha de Lanzamiento:** 2024

### Nuevas Características
- ✅ **Sitio de Documentación Completo** - Nueva documentación basada en Jigsaw con soporte multiidioma
- ✅ **Comandos de Consola Mejorados** - Mejorado `php antonella makeup` y comandos adicionales
- ✅ **Integración Docker** - Entorno de desarrollo Docker optimizado
- ✅ **Funcionalidad de Búsqueda** - Búsqueda integrada en la documentación
- ✅ **Gestión de Versiones** - Soporte para múltiples versiones de documentación

### Mejoras
- 🔧 **Mejor Experiencia de Desarrollador** - Scaffolding mejorado y estructura de proyecto
- 🔧 **Soporte Multiidioma Mejorado** - Documentación en inglés y español
- 🔧 **UI/UX Moderno** - Interfaz de documentación profesional con modo oscuro

---

## Versión 1.8

### Compatibilidad con PHP8
- ✅ Compatibilidad completa con PHP 8.x
- 🔧 Código base actualizado para soportar características modernas de PHP

### Integración con Docker
- ✅ Soporte nativo de Docker para desarrollo
- 🔧 Configuración fácil con `php antonella docker`
- 🔧 Desarrollo en tiempo real en `http://localhost:8080`
- 🔧 Comando de consola: `php antonella docker`

### Endpoints API
- ✅ Creación fácil de API REST
- 🔧 Configuración simple a través de arrays en `Config.php`
- 🔧 Sistema de enrutamiento integrado

### Cambios Importantes
- ❌ **Eliminado NELLA_URL** - Ya no está disponible en esta versión

---

## Versión 1.7

### Bloques Gutenberg
- ✅ **Creación de Bloques** - Nuevo comando `php antonella block`
- 🔧 Scaffolding fácil de bloques Gutenberg
- 🔧 Integración moderna con el editor de WordPress

### Soporte de Idiomas
- ✅ **Archivos POT** - Generación de archivos de idioma por defecto
- 🔧 Mejoras en internacionalización
- 🔧 Mejor flujo de trabajo de traducción

### Mejoras en Requests
- 🔧 **Manejo mejorado de POST/GET** - Mejor procesamiento de requests
- 🔧 **Mejoras en helpers** - Más funciones de utilidad
- 🔧 **Ajustes en PostType** - Creación mejorada de custom post types

---

## Versión 1.6

### Testing en Vivo
- ✅ **Entorno de testing en tiempo real**
- 🔧 Flujo de trabajo de desarrollo mejorado
- 🔧 Mejores capacidades de debugging

### Helpers
- 🔧 **Sistema de helpers mejorado**
- 🔧 Más funciones de utilidad
- 🔧 Mejor organización de código

---

## Versión 1.5

### Sistema de Plantillas Blade
- ✅ **Integración con Laravel Blade** - Soporte completo de plantillas Blade
- 🔧 Sistema de plantillas moderno
- 🔧 Mejor organización de vistas

### Mejoras en Consola
- ✅ **Nuevos comandos de consola**
- 🔧 Manejo automatizado de namespace
- 🔧 Sistema de ayuda: `php antonella help`

### Cambios en Instalación
- 🔧 **Nuevo método de instalación:**
```bash
composer create-project --prefer-dist cehojac/antonella-framework-for-wp:dev-master mi-plugin-genial
```

### Nuevas Características
- ✅ **Creación de widgets** - `php antonella widget`
- ✅ **Creación automática de carpetas** - Directorios de vistas y caché
- ✅ **Canal de YouTube** - [Recursos de aprendizaje](http://tipeos.com/anto)

---

## Versión 1.2

### Sistema de Widgets
- ✅ **Creación de widgets por consola** - `php antonella widget`
- 🔧 Mejoras de rendimiento
- 🔧 Optimizaciones del sistema

---

## Versión 1.1

### Custom Post Types
- 🔧 **Creación mejorada de CPT** - Mejor sistema de configuración
- 🔧 **Corrección de errores** - Problemas corregidos de la versión 1.0
- 🔧 **Funcionalidad mejorada** - Manejo más confiable de post types

---

## Versión 1.0 (Lanzamiento Inicial)

### Características Principales
- ✅ **Autoloading PSR-4** - Estándares modernos de PHP
- ✅ **Sistema Config.php** - Configuración centralizada
- ✅ **Paquetes de terceros** - Integración con Composer
- ✅ **Manejo de requests** - Clases POST y GET
- ✅ **Custom Post Types** - Creación fácil de CPT
- ✅ **Integración con dashboard** - Contenido del panel de admin
- ✅ **Gestión de usuarios** - Sistema de clases de usuario
- ✅ **Instalar/Desinstalar** - Gestión del ciclo de vida del plugin

### Comunidad
- 🤝 **Código abierto** - Desarrollo dirigido por la comunidad
- 🤝 **Feedback bienvenido** - [Sistema de soporte](https://antonellaframework.com/soporte/)
- 🤝 **Amigable para desarrolladores** - Hecho por desarrolladores, para desarrolladores

---

## Guías de Migración

### Actualizar a 1.9
- Actualiza las referencias de tu documentación
- Usa los nuevos comandos de consola
- Aprovecha la integración mejorada con Docker

### Actualizar a 1.8
- Elimina cualquier referencia a `NELLA_URL`
- Actualiza a PHP 8 si no lo has hecho
- Configura endpoints API si es necesario

### Actualizar a 1.7
- Actualiza archivos de idioma para usar formato POT
- Migra cualquier bloque personalizado al nuevo sistema
- Prueba el manejo de requests POST/GET

### Actualizar a 1.5
- Migra plantillas al sistema Blade
- Actualiza el método de instalación
- Usa los nuevos comandos de consola

## Soporte

Para soporte específico de versiones y preguntas:
- 📧 [Contactar Soporte](https://antonellaframework.com/soporte/)
- 📚 [Documentación](https://antonellaframework.com/documentacion/)
- 🎥 [Canal de YouTube](http://tipeos.com/anto)
