<?php
/**
 * Include all flexible content / partials related functions used in project
 * You should include here functions that also can be used in shortcodes
 */

/**
 * Custom post content markup from ACF Field
 */
include( get_template_directory() . '/inc/_partials/_acf-post-content.php' );

/**
 * Custom social network markup
 */
include( get_template_directory() . '/inc/_partials/_acf-social-network.php' );

/**
 * Custom page header markup
 */
include( get_template_directory() . '/inc/_partials/_acf-page-header.php' );
