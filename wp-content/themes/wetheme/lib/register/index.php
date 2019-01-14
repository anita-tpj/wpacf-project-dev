<?php
/**
 * Include all register functions in one file
 *
 * @package wetheme
 */

/**
 * Include menus register function
 */
include( get_template_directory() . '/lib/register/_register-menus.php' );

/**
 * Include widgets(sidebar) register function
 */
include( get_template_directory() . '/lib/register/_register-widgets.php' );

/**
 * Include Custom Post Types register function
 */
include( get_template_directory() . '/lib/register/_register-cpts.php' );

/**
 * Include taxonomies register function
 */
include( get_template_directory() . '/lib/register/_register-taxonomies.php' );