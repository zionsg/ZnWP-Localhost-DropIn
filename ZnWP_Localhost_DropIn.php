<?php
/**
 * Drop-in class
 *
 * Allows WordPress installation to be run on localhost with port, eg. 127.0.0.1:8888.
 *
 * This class (init) must be called in wp-content/db.php else it will not work due to the loading sequence in WordPress.
 *
 * wp_settings.php calls wp_plugin_directory_constants() which calls get_option('siteurl') BEFORE any filters
 * can be added via plugins or the active theme's functions.php.
 *
 * However, many lines before that call, require_wp_db() is called, which loads wp-content/db.php
 * and any filters added in db.php will be applied when wp_plugin_directory_constants() is called.
 *
 * @see wp-admin/includes/plugin.php:_get_dropins()
 * @see http://wpengineer.com/2500/wordpress-dropins/
 * @see http://codex.wordpress.org/Running_a_Development_Copy_of_WordPress
 *
 * @package ZnWP Localhost DropIn
 * @author  Zion Ng <zion@intzone.com>
 * @link    https://github.com/zionsg/ZnWP-Localhost-DropIn for canonical source repository
 */

class ZnWP_Localhost_DropIn
{
    /**
     * Add filters for 'option_home' and 'option_siteurl'
     *
     * @return void
     */
    public static function init()
    {
        $class = __CLASS__; // need to pass in $class as anonymous function has no knowledge of it
        add_filter('option_home', function ($url) use ($class) { return $class::url_filter($url, 'home'); });
        add_filter('option_siteurl', function ($url) use ($class) { return $class::url_filter($url, 'siteurl'); });
    }

    /**
     * Modifies url if on localhost
     *
     * @param  string $url
     * @param  string $option
     * @return string
     */
    public static function url_filter($url, $option) {
        if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
            return $url;
        }

        $parts = parse_url($url);
        $localhost_url = str_replace(
            $parts['host'] . (isset($parts['port']) ? ":{$parts['port']}" : ''),
            "{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}",
            $url
        );

        return $localhost_url;
    }
}
