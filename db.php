<?php
/**
 * Modified WordPress Drop-In
 *
 * This file must be placed in the wp-content directory.
 * wp-content/db.php is a standard WordPress file.
 *
 * This drop-in is not used for its original purpose (own database class) but to add actions and filters
 * which would otherwise fail when added in a plugin or a theme's functions.php due to the loading sequence
 * in WordPress.
 *
 * Browser cache might need to be cleared to enable drop-in to work.
 *
 * @package ZnWP Localhost DropIn
 * @author  Zion Ng <zion@intzone.com>
 * @link    https://github.com/zionsg/ZnWP-Localhost-DropIn for canonical source repository
 */

require_once 'ZnWP_Localhost_DropIn.php'; // PSR-1 states that files should not both declare classes and run code
ZnWP_Localhost_DropIn::init();
