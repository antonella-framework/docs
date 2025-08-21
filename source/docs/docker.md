---
title: Docker Development Environment
description: Set up a WordPress development environment using Docker for testing Antonella Framework
extends: _layouts.documentation
section: content
---

# Docker Development Environment

Antonella Framework includes Docker configuration to quickly set up a WordPress development environment for testing your plugins and themes.

## Prerequisites

Before starting, make sure you have installed:

- [Docker Desktop](https://www.docker.com/products/docker-desktop)
- [Docker Compose](https://docs.docker.com/compose/install/) (usually included with Docker Desktop)

## Quick Start

1. **Navigate to your project directory:**
   ```bash
   cd your-antonella-project
   ```

2. **Start the Docker environment:**
   ```bash
   php antonella docker  # add -d to run detached if preferred
   ```

3. **Access your WordPress site:**
   - **Frontend:** [http://localhost:8080](http://localhost:8080)
   - **Admin Panel:** [http://localhost:8080/wp-admin](http://localhost:8080/wp-admin)

## Default Credentials

The Docker environment comes with pre-configured credentials:

- **Username:** `admin`
- **Password:** `admin`
- **Database:** `wordpress`
- **DB User:** `wordpress`
- **DB Password:** `wordpress`

## Docker Configuration

The Docker setup includes:

### Services

- **WordPress:** Latest WordPress installation
- **MySQL:** Database server for WordPress
- **phpMyAdmin:** Database management interface (optional)

### Volumes

- `./wordpress:/var/www/html` - WordPress files
- `./your-plugin:/var/www/html/wp-content/plugins/your-plugin` - Your plugin development

## Useful Commands

### Start or refresh the environment
```bash
php antonella docker
```

### Access WordPress container
```bash
docker-compose exec wordpress bash
```

### Reset the environment
```bash
php antonella docker
```

## Development Workflow

1. **Start Docker environment**
2. **Develop your plugin** in the project directory
3. **Test changes** in the WordPress instance at `localhost:8080`
4. **Use Antonella console commands** for scaffolding and building

## Troubleshooting

### Port Conflicts
If port 8080 is already in use, modify the `docker-compose.yml` file:

```yaml
ports:
  - "8081:80"  # Change 8080 to 8081 or any available port
```

### Permission Issues
On Linux/Mac, you might need to fix file permissions:

```bash
sudo chown -R $USER:$USER wordpress/
```

### Database Connection Issues
If WordPress can't connect to the database, wait a few minutes for MySQL to fully initialize, then restart:

```bash
php antonella docker
```

## Integration with Antonella Console

The Docker environment works seamlessly with Antonella console commands:

```bash
# Build your plugin while Docker is running
php antonella makeup

# Create new controllers, widgets, etc.
php antonella make:controller MyController
```

## Next Steps

- [Learn about Antonella Console Commands](/docs/console)
- [Create your first Controller](/docs/controllers)
- [Build Custom Post Types](/docs/custom-post-types)
