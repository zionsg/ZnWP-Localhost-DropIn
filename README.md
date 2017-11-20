## ZnWP Localhost Drop-In

This WordPress drop-in allows WordPress installations to be run on localhost with port, eg. 127.0.0.1:8888.

What seems to be a simple case of adding filters for `option_home` and `option_siteurl` will not work as
`wp_settings.php` calls `wp_plugin_directory_constants()` which calls `get_option('siteurl')` BEFORE any filters
can be added via plugins or the active theme's functions.php.
  
### Installation
Steps
  - Copy the PHP files to the `wp-content` directory
  - That's it! WordPress automatically searches for `db.php` so there is no activation to worry about
