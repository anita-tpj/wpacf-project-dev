<?php
/**
 * Import all custom ACF and other functionality functions used in project
 * These will be imported even if there is none of shortcodes.
 * If there are shortcodes in use, they will properly be included before shortcodes
 */
include ( get_template_directory() . '/inc/_partials/index.php' );

/**
 * Custom Shortcodes function
 *
 * @link https://codex.wordpress.org/Shortcode_API
 *
 * @param ACF field $field - field with content to do excerpt
 */

/**
 * Enable shortcodes in text widgets
 */
add_filter('widget_text','do_shortcode');

/**
 * @example of shortcode creation with name 'example'
 * Usage: [example] - Will do example_function()
 */
add_shortcode( 'example', function () {
    return example_function();
} );