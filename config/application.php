<?php
/**
 * Your base production configuration goes in this file. Environment-specific
 * overrides go in their respective config/environments/{{WP_ENV}}.php file.
 *
 * A good default policy is to deviate from the production config as little as
 * possible. Try to define as much of your configuration in this file as you
 * can.
 */

use Roots\WPConfig\Config;
use function Env\env;

/** @var string Directory containing all of the site's files */
$root_dir = dirname(__DIR__);

/** @var string Document Root */
$webroot_dir = $root_dir . '/application';

/**
 * Use Dotenv to set required environment variables and load .env file in root
 */
$dotenv = new Dotenv\Dotenv($root_dir);
if (file_exists($root_dir . '/.env')) {
    $dotenv->load();
    $dotenv->required(['DB_NAME', 'DB_USER', 'DB_PASSWORD', 'WP_HOME', 'WP_SITEURL']);
}

/**
 * Set HTTP_HOST to localhost for wpcli
 */
if (defined('WP_CLI') && WP_CLI) {
    $_SERVER['HTTP_HOST'] = 'localhost';
}

/**
 * Set up our global environment constant and load its config first
 * Default: production
 */
define('WP_ENV', env('WP_ENV') ?: 'production');

/**
 * URLs
 */
Config::define('WP_HOME', env('WP_HOME'));
Config::define('WP_SITEURL', env('WP_SITEURL'));

/**
 * Custom Content Directory
 */
Config::define('CONTENT_DIR', '/content');
Config::define('WP_CONTENT_DIR', $webroot_dir . Config::get('CONTENT_DIR'));
Config::define('WP_CONTENT_URL', Config::get('WP_HOME') . Config::get('CONTENT_DIR'));

/**
 * DB settings
 */
Config::define('DB_NAME', env('DB_NAME'));
Config::define('DB_USER', env('DB_USER'));
Config::define('DB_PASSWORD', env('DB_PASSWORD'));
Config::define('DB_HOST', env('DB_HOST') ?: 'localhost');
Config::define('DB_CHARSET', 'utf8mb4');
Config::define('DB_COLLATE', '');
$table_prefix = env('DB_PREFIX') ?: 'wp_';

/**
 * Authentication Unique Keys and Salts
 */
Config::define('AUTH_KEY', env('AUTH_KEY'));
Config::define('SECURE_AUTH_KEY', env('SECURE_AUTH_KEY'));
Config::define('LOGGED_IN_KEY', env('LOGGED_IN_KEY'));
Config::define('NONCE_KEY', env('NONCE_KEY'));
Config::define('AUTH_SALT', env('AUTH_SALT'));
Config::define('SECURE_AUTH_SALT', env('SECURE_AUTH_SALT'));
Config::define('LOGGED_IN_SALT', env('LOGGED_IN_SALT'));
Config::define('NONCE_SALT', env('NONCE_SALT'));

/**
 * Custom Settings
 */
Config::define('AUTOMATIC_UPDATER_DISABLED', env('AUTOMATIC_UPDATER_DISABLED') ?: true);
Config::define('DISABLE_WP_CRON', env('DISABLE_WP_CRON') ?: false);
// Disable the plugin and theme file editor in the admin
Config::define('DISALLOW_FILE_EDIT', true);
// Disable plugin and theme updates and installation from the admin
Config::define('DISALLOW_FILE_MODS', env('DISALLOW_FILE_MODS') ?: true);

/**
 * WP Mail SMTP Plugin
 */

Config::define('WPMS_SMTP_HOST', env('WPMS_SMTP_HOST'));
Config::define('WPMS_SMTP_PORT', env('WPMS_SMTP_PORT'));
Config::define('WPMS_SSL', env('WPMS_SSL') ?: '' ); // Possible values '', 'ssl', 'tls' - note TLS is not STARTTLS.
Config::define('WPMS_SMTP_AUTH', env('WPMS_SMTP_AUTH') ?: true);
Config::define('WPMS_SMTP_USER', env('WPMS_SMTP_USER')); // SMTP authentication username, only used if WPMS_SMTP_AUTH is true.
Config::define('WPMS_SMTP_PASS', env('WPMS_SMTP_PASS')); // SMTP authentication password, only used if WPMS_SMTP_AUTH is true.
Config::define('WPMS_SMTP_AUTOTLS', env('WPMS_SMTP_AUTOTLS') ?: true);

/**
 * Multisite
 */
Config::define('MULTISITE', true);
Config::define('SUBDOMAIN_INSTALL', true);
Config::define('DOMAIN_CURRENT_SITE', env('DOMAIN_CURRENT_SITE'));
Config::define('PATH_CURRENT_SITE', env('PATH_CURRENT_SITE') ?: '/');
Config::define('SITE_ID_CURRENT_SITE', env('SITE_ID_CURRENT_SITE') ?: 1);
Config::define('BLOG_ID_CURRENT_SITE', env('BLOG_ID_CURRENT_SITE') ?: 1);
Config::define('COOKIE_DOMAIN', $_SERVER['HTTP_HOST']);

/**
 * Debugging Settings
 */
Config::define('WP_DEBUG_DISPLAY', false);
Config::define('WP_DEBUG_LOG', env('WP_DEBUG_LOG') ?? false);
Config::define('SCRIPT_DEBUG', false);
ini_set('display_errors', '0');

/**
 * Allow WordPress to detect HTTPS when used behind a reverse proxy or a load balancer
 * See https://codex.wordpress.org/Function_Reference/is_ssl#Notes
 */
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

$env_config = __DIR__ . '/environments/' . WP_ENV . '.php';

if (file_exists($env_config)) {
    require_once $env_config;
}

Config::apply();

/**
 * Bootstrap WordPress
 */
if (!defined('ABSPATH')) {
    define('ABSPATH', $webroot_dir . '/wp/');
}
