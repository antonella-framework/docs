---
title: Localhost Testing
description: Complete guide for testing Antonella Framework plugins in a local environment
extends: _layouts.documentation
section: content
---

# Localhost Testing

Complete guide for testing Antonella Framework plugins in a local environment using Docker.

## What is the Testing Environment?

Antonella Framework includes a complete **Docker environment** specifically designed for testing and local development. This environment allows you to test your plugins in a real WordPress installation without manual configuration.

### Purpose of the Docker Environment

- **Test plugins** in real WordPress without affecting your main installation
- **Validate code** with professional tools like Plugin Check
- **Local development** without complex manual configuration
- **Advanced debugging** with Query Monitor and Debug Bar
- **Complete testing** before publishing your plugin

> ⚠️ **Important**: Docker is NOT an installation method for Antonella Framework. It's a testing and development tool.

## Included Tools

The testing environment comes with professional WordPress development tools:

### Plugin Check
- **Purpose**: Validates your plugin against WordPress standards
- **Usage**: Analyzes code quality, security, and best practices
- **Access**: wp-admin > Tools > Plugin Check

### Query Monitor
- **Purpose**: Advanced query and performance analysis
- **Features**: Database queries, hooks, HTTP requests, PHP errors
- **Access**: Admin bar > Query Monitor

### Debug Bar
- **Purpose**: Real-time debugging information
- **Features**: PHP errors, database queries, cache info
- **Access**: Admin bar > Debug

### Theme Check
- **Purpose**: Code standards verification
- **Usage**: Validates themes and plugin templates
- **Access**: wp-admin > Appearance > Theme Check

### Developer Tools
- **Purpose**: Additional development utilities
- **Features**: Regenerate thumbnails, user switching, etc.

## System Requirements

Before using the testing environment:

- **Docker Desktop** installed and running
- **Docker Compose** (included with Docker Desktop)
- **Minimum 4GB RAM** available for Docker
- **Port 8080** available on your system

### Installing Docker

#### Windows
1. Download Docker Desktop from [docker.com](https://www.docker.com/products/docker-desktop)
2. Run the installer and follow instructions
3. Restart your computer if required
4. Verify installation: `docker --version`

#### macOS
1. Download Docker Desktop for Mac
2. Drag to Applications folder
3. Launch Docker Desktop
4. Verify installation: `docker --version`

#### Linux (Ubuntu/Debian)
```bash
# Update package index
sudo apt update

# Install Docker
sudo apt install docker.io docker-compose

# Add user to docker group
sudo usermod -aG docker $USER

# Restart session
newgrp docker

# Verify installation
docker --version
```

## Setting Up the Testing Environment

### Step 1: Navigate to Your Plugin Directory

```bash
cd /path/to/your/plugin
```

### Step 2: Start the Environment

```bash
# Start the testing environment (first time may take a few minutes)
php antonella docker
```

### Step 3: Access the Site

Once the containers are running:

- **Frontend**: http://localhost:8080
- **Admin Panel**: http://localhost:8080/wp-admin
- **Username**: `test`
- **Password**: `test`

## Testing Workflow

### 1. Plugin Development Cycle

```bash
# 1. Make changes to your plugin code
# Edit files in src/, resources/, etc.

# 2. Restart containers to apply changes
php antonella docker

# 3. Test in browser
# Visit http://localhost:8080

# 4. Check for errors
# Use Query Monitor and Debug Bar

# 5. Validate with Plugin Check
# wp-admin > Tools > Plugin Check
```

### 2. Database Testing

```bash
# Access MySQL directly
docker-compose exec db mysql -u wordpress -pwordpress wordpress

# Backup database
docker-compose exec db mysqldump -u wordpress -pwordpress wordpress > backup.sql

# Restore database
docker-compose exec -T db mysql -u wordpress -pwordpress wordpress < backup.sql
```

### 3. File System Access

```bash
# Access WordPress container
docker-compose exec wordpress bash

# Navigate to plugins directory
cd /var/www/html/wp-content/plugins

# View your plugin files
ls -la your-plugin/
```

## Debugging Techniques

### Using Query Monitor

1. Activate Query Monitor from wp-admin > Plugins
2. Visit any page on your site
3. Click "Query Monitor" in the admin bar
4. Review:
   - Database queries
   - PHP errors
   - Slow queries
   - Hook execution

### Using Debug Bar

1. Activate Debug Bar from wp-admin > Plugins
2. Visit any page on your site
3. Click "Debug" in the admin bar
4. Check:
   - PHP errors and warnings
   - Database queries
   - Memory usage
   - Cache information

### WordPress Debug Mode

The environment automatically enables debug mode. Check logs:

```bash
# View WordPress debug log
docker-compose exec wordpress tail -f /var/www/html/wp-content/debug.log

# View PHP error log
docker-compose exec wordpress tail -f /var/log/apache2/error.log
```

## Testing Different Scenarios

### Testing Plugin Activation/Deactivation

```bash
# Test activation hooks
wp-admin > Plugins > Activate your plugin

# Test deactivation hooks
wp-admin > Plugins > Deactivate your plugin

# Check for errors in debug log
docker-compose exec wordpress tail -f /var/www/html/wp-content/debug.log
```

### Testing with Different WordPress Versions

Modify `docker-compose.yml` to test different WordPress versions:

```yaml
services:
  wordpress:
    image: wordpress:6.3-apache  # Change version here
    # ... rest of configuration
```

### Testing Multisite

Enable multisite for testing:

```bash
# Access WordPress container
docker-compose exec wordpress bash

# Add to wp-config.php
echo "define('WP_ALLOW_MULTISITE', true);" >> wp-config.php
```

## Performance Testing

### Using Query Monitor for Performance

1. Enable Query Monitor
2. Visit your plugin's pages
3. Check the "Queries" tab for:
   - Slow queries (>0.05s)
   - Duplicate queries
   - Queries by component

### Memory Usage Testing

```bash
# Check memory usage
docker-compose exec wordpress php -r "echo 'Memory: ' . memory_get_usage(true) / 1024 / 1024 . ' MB\n';"

# Monitor container resources
docker stats
```

## Common Testing Scenarios

### 1. Form Submission Testing

```php
// Test AJAX forms
public function test_ajax_form()
{
    // Simulate AJAX request
    $_POST['action'] = 'your_ajax_action';
    $_POST['nonce'] = wp_create_nonce('your_nonce');
    $_POST['data'] = 'test_data';
    
    // Call your AJAX handler
    do_action('wp_ajax_your_ajax_action');
}
```

### 2. Database Operation Testing

```php
// Test database operations
public function test_database_operations()
{
    global $wpdb;
    
    // Test insert
    $result = $wpdb->insert(
        $wpdb->prefix . 'your_table',
        ['column1' => 'value1'],
        ['%s']
    );
    
    // Verify insert
    $this->assertTrue($result !== false);
}
```

### 3. Hook Testing

```php
// Test WordPress hooks
public function test_hooks()
{
    // Test action hook
    do_action('your_custom_action', 'test_data');
    
    // Test filter hook
    $result = apply_filters('your_custom_filter', 'initial_value');
    $this->assertEquals('expected_value', $result);
}
```

## Troubleshooting

### Port 8080 Already in Use

```bash
# Check what's using port 8080
netstat -tulpn | grep 8080

# Use different port in docker-compose.yml
ports:
  - "8081:80"  # Change to 8081 or any available port
```

### Container Won't Start

```bash
# Relaunch environment
php antonella docker
```

### Database Connection Issues

```bash
# Relaunch environment
php antonella docker
```

### Plugin Not Loading

1. Check file permissions
2. Verify plugin structure
3. Check PHP syntax errors
4. Review debug logs

## Best Practices

### 1. Regular Testing

- Test after every significant change
- Use Plugin Check before committing code
- Test activation/deactivation regularly

### 2. Clean Environment

```bash
# Regularly relaunch the environment when needed
php antonella docker
```

### 3. Version Control

- Don't commit Docker volumes
- Add `.dockerignore` file
- Keep `docker-compose.yml` in version control

### 4. Documentation

- Document your testing procedures
- Keep notes of common issues
- Share testing results with your team

## Refreshing the Environment

When you're done or want to refresh, simply rerun:

```bash
php antonella docker
```

## Next Steps

- Learn about [unit testing](unit-testing)
- Explore [controller examples](controller-examples)
- Check [API examples](api-examples)
- Review [troubleshooting guide](troubleshooting)

The Docker testing environment is an essential tool for developing reliable WordPress plugins with Antonella Framework. Use it regularly to ensure your code works correctly in a real WordPress environment! 🐳
