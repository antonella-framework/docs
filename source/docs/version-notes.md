---
title: Version Notes
description: Release notes and changelog for all versions of Antonella Framework
extends: _layouts.documentation
section: content
---

# Version Notes

This page contains the release notes and changelog for all versions of Antonella Framework.

## Version 1.9 (Current)

**Release Date:** 2024

### New Features
- ✅ **Complete Documentation Site** - New Jigsaw-based documentation with multilingual support
- ✅ **Enhanced Console Commands** - Improved `php antonella makeup` and additional commands
- ✅ **Docker Integration** - Streamlined Docker development environment
- ✅ **Search Functionality** - Built-in documentation search
- ✅ **Version Management** - Support for multiple documentation versions

### Improvements
- 🔧 **Better Developer Experience** - Improved scaffolding and project structure
- 🔧 **Enhanced Multilingual Support** - English and Spanish documentation
- 🔧 **Modern UI/UX** - Professional documentation interface with dark mode

---

## Version 1.8

### PHP8 Compatibility
- ✅ Full compatibility with PHP 8.x
- 🔧 Updated codebase to support modern PHP features

### Docker Integration
- ✅ Native Docker support for development
- 🔧 Easy setup with `docker-compose up`
- 🔧 Real-time development at `http://localhost:8080`
- 🔧 Console command: `php antonella docker`

### API Endpoints
- ✅ Easy REST API creation
- 🔧 Simple configuration through `Config.php` arrays
- 🔧 Built-in routing system

### Breaking Changes
- ❌ **Removed NELLA_URL** - No longer available in this version

---

## Version 1.7

### Gutenberg Blocks
- ✅ **Block Creation** - New command `php antonella block`
- 🔧 Easy Gutenberg block scaffolding
- 🔧 Modern WordPress editor integration

### Language Support
- ✅ **POT Files** - Default language file generation
- 🔧 Internationalization improvements
- 🔧 Better translation workflow

### Request Improvements
- 🔧 **Enhanced POST/GET handling** - Better request processing
- 🔧 **Helper improvements** - More utility functions
- 🔧 **PostType adjustments** - Improved custom post type creation

---

## Version 1.6

### Live Testing
- ✅ **Real-time testing environment**
- 🔧 Improved development workflow
- 🔧 Better debugging capabilities

### Helpers
- 🔧 **Enhanced helper system**
- 🔧 More utility functions
- 🔧 Better code organization

---

## Version 1.5

### Blade Templating
- ✅ **Laravel Blade Integration** - Full Blade templating support
- 🔧 Modern templating system
- 🔧 Better view organization

### Console Improvements
- ✅ **New console commands**
- 🔧 Automated namespace handling
- 🔧 Help system: `php antonella help`

### Installation Changes
- 🔧 **New installation method:**
```bash
composer create-project --prefer-dist cehojac/antonella-framework-for-wp:dev-master my-awesome-plugin
```

### New Features
- ✅ **Widget creation** - `php antonella widget`
- ✅ **Automatic folder creation** - Views and cache directories
- ✅ **YouTube channel** - [Learning resources](http://tipeos.com/anto)

---

## Version 1.2

### Widget System
- ✅ **Console widget creation** - `php antonella widget`
- 🔧 Performance improvements
- 🔧 System optimizations

---

## Version 1.1

### Custom Post Types
- 🔧 **Improved CPT creation** - Better configuration system
- 🔧 **Bug fixes** - Fixed issues from version 1.0
- 🔧 **Enhanced functionality** - More reliable post type handling

---

## Version 1.0 (Initial Release)

### Core Features
- ✅ **PSR-4 autoloading** - Modern PHP standards
- ✅ **Config.php system** - Centralized configuration
- ✅ **Third-party packages** - Composer integration
- ✅ **Request handling** - POST and GET classes
- ✅ **Custom Post Types** - Easy CPT creation
- ✅ **Dashboard integration** - Admin panel content
- ✅ **User management** - User class system
- ✅ **Install/Uninstall** - Plugin lifecycle management

### Community
- 🤝 **Open source** - Community-driven development
- 🤝 **Feedback welcome** - [Support system](https://antonellaframework.com/soporte/)
- 🤝 **Developer-friendly** - Built by developers, for developers

---

## Migration Guides

### Upgrading to 1.9
- Update your documentation references
- Use new console commands
- Take advantage of improved Docker integration

### Upgrading to 1.8
- Remove any references to `NELLA_URL`
- Update to PHP 8 if not already done
- Configure API endpoints if needed

### Upgrading to 1.7
- Update language files to use POT format
- Migrate any custom blocks to new system
- Test POST/GET request handling

### Upgrading to 1.5
- Migrate templates to Blade system
- Update installation method
- Use new console commands

## Support

For version-specific support and questions:
- 📧 [Contact Support](https://antonellaframework.com/soporte/)
- 📚 [Documentation](https://antonellaframework.com/documentacion/)
- 🎥 [YouTube Channel](http://tipeos.com/anto)
