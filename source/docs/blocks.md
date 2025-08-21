---
title: Gutenberg Blocks
description: How to create and manage Gutenberg blocks with the Antonella Console
extends: _layouts.documentation
section: content
---

# Gutenberg Blocks

Antonella Framework provides a simple way to scaffold Gutenberg blocks, inspired by the official WordPress documentation.

## Requirements

- WordPress with the block editor (Gutenberg)
- Basic JavaScript/JSX knowledge to customize the block
- A correctly installed Antonella project

## Create a block

Choose a name without spaces (use hyphens) and run:

```bash
php antonella block my-block-name
```

This command:

- Adds a reference for your block in `src/Config.php` under the Gutenberg section.
- Creates two files in `assets/`:
  - `assets/css/my-block-name.css` for styles
  - `assets/js/my-block-name.js` with a basic block example

Once WordPress loads, you will see a new block named “my-block-name” (smiley icon) that renders a simple example (e.g., a colored `h3`).

## Generated structure

```
your-plugin/
├── assets/
│   ├── css/
│   │   └── my-block-name.css
│   └── js/
│       └── my-block-name.js
└── src/
    └── Config.php   # Block reference is added here
```

## Customize

- Edit `assets/js/my-block-name.js` to change block logic and UI.
- Add styles in `assets/css/my-block-name.css`.
- Register attributes, controls, and variations per Gutenberg guidelines.

## Tips

- Create as many blocks as you need; run the command with different names.
- Keep a clear naming convention (kebab-case) for file names and the block “slug”.
- Test locally before publishing.

## Related commands

- Create block: `php antonella block BlockName`
- Package plugin: `php antonella makeup`

## Resources

- Official Gutenberg Docs: https://developer.wordpress.org/block-editor/
- Antonella Docs: https://antonellaframework.com/documentacion/
