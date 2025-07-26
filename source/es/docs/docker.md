---
title: Entorno de Desarrollo con Docker
description: Configura un entorno de desarrollo WordPress usando Docker para probar Antonella Framework
extends: _layouts.documentation
section: content
---

# Entorno de Desarrollo con Docker

Antonella Framework incluye configuración Docker para configurar rápidamente un entorno de desarrollo WordPress para probar tus plugins y temas.

## Prerrequisitos

Antes de comenzar, asegúrate de tener instalado:

- [Docker Desktop](https://www.docker.com/products/docker-desktop)
- [Docker Compose](https://docs.docker.com/compose/install/) (generalmente incluido con Docker Desktop)

## Inicio Rápido

1. **Navega al directorio de tu proyecto:**
   ```bash
   cd tu-proyecto-antonella
   ```

2. **Inicia el entorno Docker:**
   ```bash
   docker-compose up -d
   ```

3. **Accede a tu sitio WordPress:**
   - **Frontend:** [http://localhost:8080](http://localhost:8080)
   - **Panel de Admin:** [http://localhost:8080/wp-admin](http://localhost:8080/wp-admin)

## Credenciales por Defecto

El entorno Docker viene con credenciales preconfiguradas:

- **Usuario:** `admin`
- **Contraseña:** `admin`
- **Base de datos:** `wordpress`
- **Usuario BD:** `wordpress`
- **Contraseña BD:** `wordpress`

## Configuración Docker

La configuración Docker incluye:

### Servicios

- **WordPress:** Instalación de WordPress más reciente
- **MySQL:** Servidor de base de datos para WordPress
- **phpMyAdmin:** Interfaz de gestión de base de datos (opcional)

### Volúmenes

- `./wordpress:/var/www/html` - Archivos de WordPress
- `./tu-plugin:/var/www/html/wp-content/plugins/tu-plugin` - Desarrollo de tu plugin

## Comandos Útiles

### Iniciar el entorno
```bash
docker-compose up -d
```

### Detener el entorno
```bash
docker-compose down
```

### Ver logs
```bash
docker-compose logs -f
```

### Acceder al contenedor WordPress
```bash
docker-compose exec wordpress bash
```

### Resetear el entorno
```bash
docker-compose down -v
docker-compose up -d
```

## Flujo de Desarrollo

1. **Iniciar entorno Docker**
2. **Desarrollar tu plugin** en el directorio del proyecto
3. **Probar cambios** en la instancia WordPress en `localhost:8080`
4. **Usar comandos de consola Antonella** para scaffolding y construcción

## Solución de Problemas

### Conflictos de Puerto
Si el puerto 8080 ya está en uso, modifica el archivo `docker-compose.yml`:

```yaml
ports:
  - "8081:80"  # Cambia 8080 a 8081 o cualquier puerto disponible
```

### Problemas de Permisos
En Linux/Mac, podrías necesitar arreglar permisos de archivos:

```bash
sudo chown -R $USER:$USER wordpress/
```

### Problemas de Conexión a Base de Datos
Si WordPress no puede conectar a la base de datos, espera unos minutos para que MySQL se inicialice completamente, luego reinicia:

```bash
docker-compose restart
```

## Integración con Consola Antonella

El entorno Docker funciona perfectamente con los comandos de consola Antonella:

```bash
# Construye tu plugin mientras Docker está ejecutándose
php antonella makeup

# Crea nuevos controladores, widgets, etc.
php antonella make:controller MiControlador
```

## Próximos Pasos

- [Aprende sobre Comandos de Consola Antonella](/es/docs/console)
- [Crea tu primer Controlador](/es/docs/controllers)
- [Construye Custom Post Types](/es/docs/custom-post-types)
