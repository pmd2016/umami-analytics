<?php
/**
 * Plugin Name: Umami Analytics
 * Plugin URI: https://umami.is/
 * Description: Integrate Umami Analytics tracking code into your WordPress site with easy configuration.
 * Version: 1.0.0
 * Author: Michiel Doetjes
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: umami-analytics
 * Domain Path: /languages
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Main Umami Analytics Plugin Class
 */
class UmamiAnalytics {
    
    /**
     * Plugin version
     */
    const VERSION = '1.0.1';
    
    /**
     * Option name for storing settings
     */
    const OPTION_NAME = 'umami_analytics_settings';
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('init', array($this, 'init'));
    }
    
    /**
     * Initialize the plugin
     */
    public function init() {
        // Load text domain for translations first
        add_action('plugins_loaded', array($this, 'load_textdomain'));
        
        // Add hooks
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'admin_init'));
        add_action('wp_head', array($this, 'add_tracking_code'));
        add_action('admin_notices', array($this, 'admin_notices'));
    }
    
    /**
     * Load plugin text domain for translations
     */
    public function load_textdomain() {
        load_plugin_textdomain(
            'umami-analytics',
            false,
            dirname(plugin_basename(__FILE__)) . '/languages/'
        );
    }
    
    /**
     * Add admin menu item under Tools
     */
    public function add_admin_menu() {
        add_management_page(
            __('Umami Analytics Settings', 'umami-analytics'),
            __('Umami Analytics', 'umami-analytics'),
            'manage_options',
            'umami-analytics',
            array($this, 'settings_page')
        );
    }
    
    /**
     * Initialize admin settings
     */
    public function admin_init() {
        register_setting(
            'umami_analytics_settings_group',
            self::OPTION_NAME,
            array($this, 'sanitize_settings')
        );
        
        add_settings_section(
            'umami_analytics_main_section',
            __('Umami Analytics Configuration', 'umami-analytics'),
            array($this, 'section_callback'),
            'umami-analytics'
        );
        
        add_settings_field(
            'umami_url',
            __('Umami URL', 'umami-analytics'),
            array($this, 'umami_url_callback'),
            'umami-analytics',
            'umami_analytics_main_section'
        );
        
        add_settings_field(
            'website_id',
            __('Website ID', 'umami-analytics'),
            array($this, 'website_id_callback'),
            'umami-analytics',
            'umami_analytics_main_section'
        );
        
        add_settings_field(
            'enable_tracking',
            __('Enable Tracking', 'umami-analytics'),
            array($this, 'enable_tracking_callback'),
            'umami-analytics',
            'umami_analytics_main_section'
        );
    }
    
    /**
     * Sanitize settings input
     */
    public function sanitize_settings($input) {
        $sanitized = array();
        
        if (isset($input['umami_url'])) {
            $sanitized['umami_url'] = esc_url_raw(trim($input['umami_url']));
        }
        
        if (isset($input['website_id'])) {
            $sanitized['website_id'] = sanitize_text_field(trim($input['website_id']));
        }
        
        $sanitized['enable_tracking'] = isset($input['enable_tracking']) ? 1 : 0;
        
        return $sanitized;
    }
    
    /**
     * Settings section callback
     */
    public function section_callback() {
        echo '<p>' . __('Configure your Umami Analytics tracking settings below.', 'umami-analytics') . '</p>';
    }
    
    /**
     * Umami URL field callback
     */
    public function umami_url_callback() {
        $options = get_option(self::OPTION_NAME, array());
        $value = isset($options['umami_url']) ? $options['umami_url'] : '';
        
        echo '<input type="url" id="umami_url" name="' . self::OPTION_NAME . '[umami_url]" value="' . esc_attr($value) . '" class="regular-text" placeholder="https://analytics.yourdomain.com" />';
        echo '<p class="description">' . __('Enter your Umami instance URL (e.g., https://analytics.yourdomain.com)', 'umami-analytics') . '</p>';
    }
    
    /**
     * Website ID field callback
     */
    public function website_id_callback() {
        $options = get_option(self::OPTION_NAME, array());
        $value = isset($options['website_id']) ? $options['website_id'] : '';
        
        echo '<input type="text" id="website_id" name="' . self::OPTION_NAME . '[website_id]" value="' . esc_attr($value) . '" class="regular-text" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx" />';
        echo '<p class="description">' . __('Enter your Website ID from the Umami dashboard', 'umami-analytics') . '</p>';
    }
    
    /**
     * Enable tracking field callback
     */
    public function enable_tracking_callback() {
        $options = get_option(self::OPTION_NAME, array());
        $checked = isset($options['enable_tracking']) ? $options['enable_tracking'] : 1;
        
        echo '<input type="checkbox" id="enable_tracking" name="' . self::OPTION_NAME . '[enable_tracking]" value="1" ' . checked(1, $checked, false) . ' />';
        echo '<label for="enable_tracking">' . __('Enable Umami tracking on your website', 'umami-analytics') . '</label>';
    }
    
    /**
     * Settings page HTML
     */
    public function settings_page() {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.', 'umami-analytics'));
        }
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            
            <?php settings_errors(); ?>
            
            <form method="post" action="options.php">
                <?php
                settings_fields('umami_analytics_settings_group');
                do_settings_sections('umami-analytics');
                submit_button();
                ?>
            </form>
            
            <div class="card" style="max-width: 600px; margin-top: 20px;">
                <h2><?php _e('How to set up Umami Analytics', 'umami-analytics'); ?></h2>
                <ol>
                    <li><?php _e('Log in to your Umami Analytics dashboard', 'umami-analytics'); ?></li>
                    <li><?php _e('Add your website to get the Website ID', 'umami-analytics'); ?></li>
                    <li><?php _e('Enter your Umami instance URL and Website ID above', 'umami-analytics'); ?></li>
                    <li><?php _e('Make sure "Enable Tracking" is checked', 'umami-analytics'); ?></li>
                    <li><?php _e('Save the settings', 'umami-analytics'); ?></li>
                </ol>
                <p>
                    <strong><?php _e('Need help?', 'umami-analytics'); ?></strong> 
                    <a href="https://umami.is/docs" target="_blank"><?php _e('Visit Umami Documentation', 'umami-analytics'); ?></a>
                </p>
            </div>
        </div>
        <?php
    }
    
    /**
     * Add tracking code to wp_head
     */
    public function add_tracking_code() {
        // Don't add tracking code in admin area
        if (is_admin()) {
            return;
        }
        
        $options = get_option(self::OPTION_NAME, array());
        
        // Check if tracking is enabled and required fields are set
        if (empty($options['enable_tracking']) || 
            empty($options['umami_url']) || 
            empty($options['website_id'])) {
            return;
        }
        
        // Don't track administrators (optional - you can remove this if you want to track admins)
        if (current_user_can('manage_options')) {
            return;
        }
        
        $umami_url = esc_url($options['umami_url']);
        $website_id = esc_attr($options['website_id']);
        
        // Remove trailing slash from URL if present
        $umami_url = rtrim($umami_url, '/');
        
        echo "\n<!-- Umami Analytics -->\n";
        echo '<script defer src="' . $umami_url . '/script.js" data-website-id="' . $website_id . '"></script>' . "\n";
        echo "<!-- End Umami Analytics -->\n\n";
    }
    
    /**
     * Display admin notices
     */
    public function admin_notices() {
        // Only show on admin pages, not on the settings page itself
        if (!is_admin() || 
            (isset($_GET['page']) && $_GET['page'] === 'umami-analytics')) {
            return;
        }
        
        $options = get_option(self::OPTION_NAME, array());
        
        // Check if settings are not configured
        if (empty($options['umami_url']) || empty($options['website_id'])) {
            $settings_url = admin_url('tools.php?page=umami-analytics');
            
            echo '<div class="notice notice-warning is-dismissible">';
            echo '<p><strong>' . __('Umami Analytics', 'umami-analytics') . ':</strong> ';
            echo sprintf(
                __('Your analytics tracking is not configured yet. <a href="%s">Configure it now</a> to start tracking your website visitors.', 'umami-analytics'),
                esc_url($settings_url)
            );
            echo '</p>';
            echo '</div>';
        }
    }
    
    /**
     * Get plugin settings
     */
    public function get_settings() {
        return get_option(self::OPTION_NAME, array());
    }
    
    /**
     * Check if tracking is properly configured
     */
    public function is_configured() {
        $options = $this->get_settings();
        return !empty($options['umami_url']) && !empty($options['website_id']) && !empty($options['enable_tracking']);
    }
}

/**
 * Plugin activation hook
 */
function umami_analytics_activate() {
    // Set default options
    $default_options = array(
        'umami_url' => '',
        'website_id' => '',
        'enable_tracking' => 1
    );
    
    add_option(UmamiAnalytics::OPTION_NAME, $default_options);
}
register_activation_hook(__FILE__, 'umami_analytics_activate');

/**
 * Plugin deactivation hook
 */
function umami_analytics_deactivate() {
    // Clean up if needed
}
register_deactivation_hook(__FILE__, 'umami_analytics_deactivate');

/**
 * Plugin uninstall hook
 */
function umami_analytics_uninstall() {
    // Remove options
    delete_option(UmamiAnalytics::OPTION_NAME);
}
register_uninstall_hook(__FILE__, 'umami_analytics_uninstall');

// Initialize the plugin
new UmamiAnalytics();