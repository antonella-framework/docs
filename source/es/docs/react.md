---
title: Integración con React
description: Integración nativa de ReactJS para plugins de Antonella Framework (v1.9.3+)
extends: _layouts.documentation
section: content
---

# Integración con React

A partir de la **versión 1.9.3**, Antonella Framework incorpora integración nativa con ReactJS. Configura Vite, React y un renderizador PHP ligero (inspirado en la arquitectura del adaptador de Inertia.js para WordPress) para que puedas renderizar componentes React desde tus controladores, shortcodes y páginas de administración sin salir del flujo de trabajo de Antonella.

## Requisitos

- Node.js y npm instalados localmente
- Un proyecto Antonella correctamente instalado
- Conocimientos básicos de React/JSX

## Instalar React

Ejecuta el comando `add react` desde la raíz de tu proyecto:

```bash
php antonella add react
```

Este comando:

- Crea o actualiza `package.json` con `react`, `react-dom`, `@vitejs/plugin-react` y `vite`.
- Crea `vite.config.js` configurado para construir en `assets/dist` con soporte de manifest.
- Crea la estructura de directorios `resources/js/`:
  - `resources/js/app.jsx` — el punto de entrada que descubre y monta componentes automáticamente.
  - `resources/js/Pages/` — donde viven tus componentes React.
  - `resources/js/Pages/ExampleComponent.jsx` y `Card.jsx` — componentes de ejemplo.
  - `resources/js/Pages/HelloWorld.jsx` — un componente de demostración completo (contador, reloj en vivo, props compartidas).
- Crea `Config/React.php` con la configuración de tu app (`app_key`, `container_id`, `app_env`, `vite_server`, `build_path`, `entry_point`, aislamiento de estilos, etc.).
- Crea el renderizador PHP en `src/Core/React.php`.
- Crea funciones helper globales en `src/Helpers/react.php` (`react()`, `react_share()`, `react_lazy()`).
- Crea `src/Controllers/ExampleReactController.php` con ejemplos de página de administración y shortcode.
- Registra una entrada de menú de administración de ejemplo ("Hello World with React") y un shortcode `[hello_world]` en `src/Config.php`.

Si React ya está instalado, el comando pide confirmación antes de sobrescribir los archivos existentes.

Después de la instalación:

```bash
npm install
npm run dev     # desarrollo, con Vite HMR
npm run build   # build de producción (genera assets/dist con un manifest.json)
```

## Eliminar React

```bash
php antonella remove react
```

Tras confirmar, esto elimina `Config/React.php`, `src/Core/React.php`, `src/Helpers/react.php`, `resources/js/`, `vite.config.js`, `package.json`, `package-lock.json`, `assets/dist/` y `node_modules/`. **No** modifica `src/Config.php` ni tus controladores — elimina manualmente la entrada de menú/shortcode de React si lo necesitas.

## Generar componentes

Usa el comando `react` para crear un nuevo componente en `resources/js/Pages/`:

```bash
php antonella react NombreComponente
```

Se admiten subcarpetas:

```bash
php antonella react Texts/TextInput
# crea resources/js/Pages/Texts/TextInput.jsx
```

Esto requiere que React esté instalado (debe existir `src/Core/React.php`).

## Controladores con React

Puedes crear un controlador conectado a React en un solo paso usando el flag `--react` en `make`:

```bash
# deriva el nombre del componente a partir del controlador (UserController -> User)
php antonella make UserController --react

# nombre de componente explícito
php antonella make UserController --react=UserDashboard
```

Esto genera un controlador que renderiza el componente mediante `React::render()`:

```php
namespace MYNAMESPACE\Controllers;

use MYNAMESPACE\Core\React;

class UserController
{
    public static function index()
    {
        echo React::render('UserDashboard', [
            // Agrega tus props aquí
        ]);
    }
}
```

Si React aún no está instalado, el controlador se crea igualmente con la plantilla estándar, y Antonella te recuerda ejecutar `php antonella add react`.

## Renderizar componentes manualmente

En cualquier parte de tu código PHP (controladores, shortcodes, páginas de administración) puedes renderizar un componente:

```php
use MYNAMESPACE\Core\React;

echo React::render('NombreComponente', [
    'title' => 'Hola',
], [
    'style_isolation' => true,
    'style_isolation_mode' => 'reset',
]);
```

O con el helper global (una vez que `src/Helpers/react.php` esté cargado):

```php
echo react('NombreComponente', ['title' => 'Hola']);
```

- Usa `echo` cuando el render ocurra dentro de un callback que WordPress espera que imprima directamente (por ejemplo, el callback de una página de administración).
- Usa `return` en lugar de `echo` cuando se use como callback de un shortcode.

### Compartir datos con todos los componentes

```php
React::share([
    'user' => ['name' => wp_get_current_user()->display_name],
    'site' => ['name' => get_bloginfo('name')],
]);
```

Define un método `public static function boot()` en tu controlador para ejecutar esto una sola vez antes de renderizar — `React::render()` inicializa automáticamente la clase controladora que lo invoca la primera vez que renderiza.

### Props diferidas (lazy)

```php
React::share('stats', React::lazy(function () {
    return calculo_costoso();
}));
```

## Configuración (`Config/React.php`)

| Clave | Descripción |
|---|---|
| `app_key` | Clave única que aísla scripts/contenedores para este plugin. |
| `container_id` | Id base del contenedor en el DOM (se le añade un sufijo por cada render). |
| `app_env` | `develop` (servidor de desarrollo de Vite + HMR) o `production` (assets compilados). |
| `vite_server` | URL del servidor de desarrollo de Vite (por defecto `http://localhost:3000`). |
| `build_path` | Directorio de salida del build, por defecto `assets/dist`. |
| `entry_point` | Archivo de entrada de React, por defecto `resources/js/app.jsx`. |
| `load_in_admin` / `load_in_frontend` | Si se deben encolar los assets de React en wp-admin / en el sitio público. |
| `version` | Cadena de versión opcional para invalidar caché. |
| `style_isolation` | Inyecta un reset de CSS aislado alrededor del contenedor de React. Deshabilitado por defecto para no entrar en conflicto con Tailwind/MUI. |
| `style_isolation_mode` | `reset` (agresivo, reset completo con tipografía base) o `normalize` (más ligero, solo box-sizing + margin/padding). |

`style_isolation` y `style_isolation_mode` también pueden sobrescribirse por render mediante el tercer argumento de `React::render()`.

### Deshabilitar los estilos del tema en páginas React completas

Para páginas renderizadas completamente por React, puede que quieras desactivar la hoja de estilos del tema activo:

```php
class UserController
{
    protected static bool $disableThemeStyles = true;
    // ...
}
```

`React::render()` lee esta propiedad del controlador que lo invoca y desactiva los estilos registrados bajo la URI del directorio de la hoja de estilos/plantilla del tema activo.

## Builds de producción y empaquetado

`php antonella makeup` detecta automáticamente React (`src/Core/React.php`), cambia temporalmente `Config/React.php` a `app_env => 'production'` mientras construye el ZIP, y lo restaura a `develop` al terminar — así tu flujo de desarrollo local no se ve afectado. Asegúrate de ejecutar `npm run build` antes de empaquetar para que exista `assets/dist/.vite/manifest.json`; de lo contrario, el plugin mostrará un aviso en el admin al no encontrar el manifest.

## Estructura generada

```
tu-plugin/
├── Config/
│   └── React.php            # Configuración de React
├── resources/
│   └── js/
│       ├── app.jsx           # Punto de entrada (monta componentes automáticamente)
│       └── Pages/
│           ├── ExampleComponent.jsx
│           ├── Card.jsx
│           └── HelloWorld.jsx
├── src/
│   ├── Core/
│   │   └── React.php         # Renderizador PHP React::render()
│   ├── Helpers/
│   │   └── react.php         # react(), react_share(), react_lazy()
│   └── Controllers/
│       └── ExampleReactController.php
├── assets/
│   └── dist/                 # Salida del build de producción (tras npm run build)
├── package.json
└── vite.config.js
```

## Comandos relacionados

- Instalar React: `php antonella add react`
- Eliminar React: `php antonella remove react`
- Crear un componente: `php antonella react NombreComponente`
- Crear un controlador + componente: `php antonella make NombreControlador --react`
- Empaquetar el plugin (cambia React a producción automáticamente): `php antonella makeup`

## Recursos

- Documentación de Vite: https://vite.dev
- Documentación de React: https://react.dev
- Documentación de Antonella: https://antonellaframework.com/documentacion/
