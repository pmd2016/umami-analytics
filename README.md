# Umami Analytics for WordPress

[![WordPress Plugin Version](https://img.shields.io/badge/WordPress-6.0%2B-blue.svg)](https://wordpress.org/)
[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-purple.svg)](https://php.net/)
[![License](https://img.shields.io/badge/License-GPL%20v2%2B-green.svg)](https://www.gnu.org/licenses/gpl-2.0.html)
[![Umami](https://img.shields.io/badge/Umami-Compatible-orange.svg)](https://umami.is/)

A simple, privacy-focused WordPress plugin that integrates [Umami Analytics](https://umami.is/) tracking into your WordPress website. Umami is a simple, fast, privacy-focused alternative to Google Analytics.

## ✨ Features

- 🔒 **Privacy-focused** - No cookies, GDPR compliant
- ⚡ **Lightweight** - Minimal impact on site performance  
- 🛠️ **Easy setup** - Simple configuration through WordPress admin
- 🌍 **Translation ready** - Fully internationalized with WordPress standards
- 🔧 **WordPress native** - Uses WordPress Settings API and follows coding standards
- 📊 **Smart tracking** - Excludes admin users, only loads on frontend
- ⚠️ **Setup notifications** - Helpful admin notices when configuration is needed

## 📋 Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- A running Umami Analytics instance

## 🚀 Installation

### Method 1: Manual Installation

1. **Download** the latest release from [GitHub Releases](../../releases)
2. **Extract** the zip file to your `wp-content/plugins/` directory
3. **Activate** the plugin through the 'Plugins' menu in WordPress
4. **Configure** the plugin by going to `Tools > Umami Analytics`

### Method 2: Git Clone

```bash
cd wp-content/plugins/
git clone https://github.com/yourusername/umami-analytics-wordpress.git umami-analytics
```

Then activate the plugin in your WordPress admin.

## ⚙️ Configuration

1. **Access Settings**: Go to `Tools > Umami Analytics` in your WordPress admin
2. **Umami URL**: Enter your Umami instance URL (e.g., `https://analytics.yourdomain.com`)
3. **Website ID**: Enter the Website ID from your Umami dashboard
4. **Enable Tracking**: Make sure the checkbox is checked
5. **Save Settings**: Click "Save Changes"

### Getting Your Website ID

1. Log in to your Umami Analytics dashboard
2. Add your website if you haven't already
3. Copy the Website ID from your website settings
4. Paste it into the plugin settings

## 📸 Screenshots

### Settings Page
The plugin adds a clean settings page under the Tools menu where you can configure your Umami tracking.

### Admin Notice
When the plugin is activated but not configured, you'll see a helpful notice with a direct link to the settings.

## 🌍 Translations

This plugin is translation-ready and includes:

- **English** (default)
- **Dutch (nl_NL)** - Complete translation included

### Contributing Translations

We welcome translation contributions! Here's how to help:

1. **Download** the `languages/umami-analytics.pot` template file
2. **Create** a new translation using [Poedit](https://poedit.net/) or similar tool
3. **Test** your translation thoroughly
4. **Submit** a pull request with your `.po` and `.mo` files

For detailed translation instructions, see our [Translation Guide](TRANSLATIONS.md).

## 🛡️ Privacy & Security

- **No personal data collection** - Umami respects visitor privacy
- **No cookies used** - Compliant with privacy regulations
- **Secure implementation** - All inputs are sanitized and validated
- **Admin-only access** - Settings page requires appropriate permissions

## 🔧 Developer Information

### Hooks & Filters

The plugin provides several hooks for developers:

```php
// Modify tracking code output
apply_filters('umami_analytics_tracking_code', $tracking_code, $options);

// Skip tracking for specific conditions
apply_filters('umami_analytics_should_track', true, $options);

// Modify plugin settings
apply_filters('umami_analytics_settings', $settings);
```

### Plugin Structure

```
umami-analytics/
├── umami-analytics.php     # Main plugin file
├── languages/              # Translation files
│   ├── umami-analytics.pot # Translation template
│   └── *.po, *.mo         # Language files
├── README.md              # This file
└── LICENSE                # GPL v2+ License
```

### WordPress Standards

This plugin follows:
- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- [WordPress Plugin Guidelines](https://developer.wordpress.org/plugins/)
- [WordPress Security Best Practices](https://developer.wordpress.org/plugins/security/)

## 📊 About Umami Analytics

[Umami](https://umami.is/) is a simple, fast, privacy-focused alternative to Google Analytics. It provides essential insights about your website visitors without compromising their privacy.

### Why Choose Umami?

- **Privacy-first** - No cookies, no tracking across sites
- **Lightweight** - Minimal impact on page load times
- **GDPR compliant** - Respects visitor privacy by design
- **Open source** - Transparent and customizable
- **Self-hosted** - You own your data

## 🤝 Contributing

We welcome contributions! Here's how you can help:

### Reporting Issues

1. Check [existing issues](../../issues) first
2. Create a [new issue](../../issues/new) with:
   - Clear description of the problem
   - Steps to reproduce
   - WordPress and PHP versions
   - Plugin version

### Contributing Code

1. **Fork** the repository
2. **Create** a feature branch: `git checkout -b feature/amazing-feature`
3. **Make** your changes following WordPress coding standards
4. **Test** thoroughly
5. **Commit** with clear messages: `git commit -m 'Add amazing feature'`
6. **Push** to your branch: `git push origin feature/amazing-feature`
7. **Create** a Pull Request

### Development Setup

```bash
# Clone the repository
git clone https://github.com/yourusername/umami-analytics-wordpress.git

# Set up a local WordPress development environment
# Copy plugin to wp-content/plugins/umami-analytics/

# Install development dependencies (if any)
composer install --dev
```

## 📝 Changelog

### [1.0.0] - 2025-01-XX
- Initial release
- Basic Umami Analytics integration
- WordPress Settings API implementation
- Translation support
- Admin notifications
- Security improvements

## 📄 License

This plugin is licensed under the [GPL v2 or later](https://www.gnu.org/licenses/gpl-2.0.html).

```
Umami Analytics for WordPress
Copyright (C) 2025

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
```

## 🆘 Support

- **Documentation**: Check this README and inline code comments
- **Issues**: Report bugs via [GitHub Issues](../../issues)
- **WordPress Support**: [WordPress.org Plugin Support](https://wordpress.org/support/plugin/umami-analytics/)
- **Umami Documentation**: [Official Umami Docs](https://umami.is/docs)

## 🙏 Acknowledgments

- [Umami Analytics](https://umami.is/) - For creating an excellent privacy-focused analytics solution
- [WordPress Community](https://wordpress.org/) - For the amazing CMS and development standards
- All contributors who help improve this plugin

---

**Made with ❤️ for WordPress and privacy-conscious website owners**

*If this plugin helps you, please consider ⭐ starring the repository!*