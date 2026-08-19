---
title: React Integration
description: Native ReactJS integration for Antonella Framework plugins (v1.9.3+)
extends: _layouts.documentation
section: content
---

# React Integration

Starting with **version 1.9.3**, Antonella Framework ships with native ReactJS integration. It wires up Vite, React and a lightweight PHP renderer (inspired by the Inertia.js WordPress adapter architecture) so you can render React components from your controllers, shortcodes and admin pages without leaving the Antonella workflow.

## Requirements

- Node.js and npm installed locally
- A correctly installed Antonella project
- Basic React/JSX knowledge

## Installing React

Run the `add react` command from your project root:

```bash
php antonella add react
```

This command:

- Creates or updates `package.json` with `react`, `react-dom`, `@vitejs/plugin-react` and `vite`.
- Creates `vite.config.js` configured to build to `assets/dist` with manifest support.
- Creates the `resources/js/` directory structure:
  - `resources/js/app.jsx` — the entry point that auto-discovers and mounts components.
  - `resources/js/Pages/` — where your React components live.
  - `resources/js/Pages/ExampleComponent.jsx` and `Card.jsx` — example components.
  - `resources/js/Pages/HelloWorld.jsx` — a full demo component (counter, live clock, shared props).
- Creates `Config/React.php` with your app configuration (`app_key`, `container_id`, `app_env`, `vite_server`, `build_path`, `entry_point`, style isolation, etc.).
- Creates the PHP renderer at `src/Core/React.php`.
- Creates global helper functions at `src/Helpers/react.php` (`react()`, `react_share()`, `react_lazy()`).
- Creates `src/Controllers/ExampleReactController.php` demonstrating an admin page and a shortcode.
- Registers an example admin menu entry ("Hello World with React") and a `[hello_world]` shortcode in `src/Config.php`.

If React is already installed, the command asks for confirmation before overwriting existing files.

After installation:

```bash
npm install
npm run dev     # development, with Vite HMR
npm run build   # production build (outputs to assets/dist with a manifest.json)
```

## Removing React

```bash
php antonella remove react
```

After confirmation, this removes `Config/React.php`, `src/Core/React.php`, `src/Helpers/react.php`, `resources/js/`, `vite.config.js`, `package.json`, `package-lock.json`, `assets/dist/` and `node_modules/`. It does **not** modify `src/Config.php` or your controllers — remove the React menu entry/shortcode manually if needed.

## Generating components

Use the `react` command to scaffold a new component in `resources/js/Pages/`:

```bash
php antonella react ComponentName
```

Subfolders are supported:

```bash
php antonella react Texts/TextInput
# creates resources/js/Pages/Texts/TextInput.jsx
```

This requires React to be installed (`src/Core/React.php` must exist).

## Controllers with React

You can scaffold a controller wired to React in one step using the `--react` flag on `make`:

```bash
# derives the component name from the controller name (UserController -> User)
php antonella make UserController --react

# explicit component name
php antonella make UserController --react=UserDashboard
```

This generates a controller that renders the component via `React::render()`:

```php
namespace MYNAMESPACE\Controllers;

use MYNAMESPACE\Core\React;

class UserController
{
    public static function index()
    {
        echo React::render('UserDashboard', [
            // Add your props here
        ]);
    }
}
```

If React isn't installed yet, the controller is still created with the standard template, and Antonella reminds you to run `php antonella add react`.

## Rendering components manually

Anywhere in your PHP code (controllers, shortcodes, admin pages) you can render a component:

```php
use MYNAMESPACE\Core\React;

echo React::render('ComponentName', [
    'title' => 'Hello',
], [
    'style_isolation' => true,
    'style_isolation_mode' => 'reset',
]);
```

Or with the global helper (after `src/Helpers/react.php` is autoloaded):

```php
echo react('ComponentName', ['title' => 'Hello']);
```

- Use `echo` when the render happens inside a callback WordPress expects to print directly (e.g. an admin page callback).
- `return` the value instead when used as a shortcode callback.

### Sharing data with every component

```php
React::share([
    'user' => ['name' => wp_get_current_user()->display_name],
    'site' => ['name' => get_bloginfo('name')],
]);
```

Define a `public static function boot()` in your controller to run this once before rendering — `React::render()` automatically boots the calling controller class the first time it renders.

### Lazy props

```php
React::share('stats', React::lazy(function () {
    return expensive_calculation();
}));
```

## Configuration (`Config/React.php`)

| Key | Description |
|---|---|
| `app_key` | Unique key namespacing scripts/containers for this plugin. |
| `container_id` | Base DOM container id (auto-suffixed per render). |
| `app_env` | `develop` (Vite dev server + HMR) or `production` (built assets). |
| `vite_server` | Vite dev server URL (default `http://localhost:3000`). |
| `build_path` | Build output directory, default `assets/dist`. |
| `entry_point` | React entry file, default `resources/js/app.jsx`. |
| `load_in_admin` / `load_in_frontend` | Whether to enqueue React assets in wp-admin / the public site. |
| `version` | Optional cache-busting version string. |
| `style_isolation` | Injects a scoped CSS reset around the React container. Disabled by default so it doesn't conflict with Tailwind/MUI. |
| `style_isolation_mode` | `reset` (aggressive, full reset with base typography) or `normalize` (lighter, box-sizing + margin/padding only). |

`style_isolation` and `style_isolation_mode` can also be overridden per render via the third argument of `React::render()`.

### Disabling theme styles on full React pages

For pages that are entirely rendered by React, you may want to dequeue the active theme's stylesheet:

```php
class UserController
{
    protected static bool $disableThemeStyles = true;
    // ...
}
```

`React::render()` reads this property from the calling controller and dequeues styles registered under the active theme's stylesheet/template directory URI.

## Production builds and packaging

`php antonella makeup` automatically detects React (`src/Core/React.php`), temporarily switches `Config/React.php` to `app_env => 'production'` while it builds the ZIP, and restores it to `develop` afterwards — so your local dev workflow is unaffected. Make sure you run `npm run build` before packaging so `assets/dist/.vite/manifest.json` exists; otherwise the plugin shows an admin notice when it can't find the manifest.

## Generated structure

```
your-plugin/
├── Config/
│   └── React.php            # React configuration
├── resources/
│   └── js/
│       ├── app.jsx           # Entry point (auto-mounts components)
│       └── Pages/
│           ├── ExampleComponent.jsx
│           ├── Card.jsx
│           └── HelloWorld.jsx
├── src/
│   ├── Core/
│   │   └── React.php         # React::render() PHP renderer
│   ├── Helpers/
│   │   └── react.php         # react(), react_share(), react_lazy()
│   └── Controllers/
│       └── ExampleReactController.php
├── assets/
│   └── dist/                 # Production build output (after npm run build)
├── package.json
└── vite.config.js
```

## Related commands

- Install React: `php antonella add react`
- Remove React: `php antonella remove react`
- Create a component: `php antonella react ComponentName`
- Create a controller + component: `php antonella make ControllerName --react`
- Package plugin (auto-switches React to production): `php antonella makeup`

## Resources

- Vite docs: https://vite.dev
- React docs: https://react.dev
- Antonella Docs: https://antonellaframework.com/documentacion/
