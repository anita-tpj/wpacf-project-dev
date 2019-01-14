<?php
/**
 * wetheme functions and definitions
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package wetheme
 */

if( !class_exists('acf') ) {

    add_action( 'admin_notices', function() {
        echo '<div class="error"><p>Advanced Custom Fields plugin is not activated. Make sure you activate plugin at <a href="' . esc_url( admin_url( 'plugins.php' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
    } );
}

/**
 * Include after_theme setup functions
 * This is main file for including functions and all other theme related files
 */
include ( get_template_directory() . '/lib/theme/_wetheme-setup.php');

/**
 * Include wetheme register functions
 * @link ./lib/register/index.php
 */
include( get_template_directory() . '/lib/register/index.php' );

/**
 * Include acf setup functions
 * Note: this should be only setup for backend, any functions for template usage
 * should be created inside wetheme/inc/_partials
 * @link ./lib/acf/index.php
 */
include( get_template_directory() . '/lib/acf/index.php' );