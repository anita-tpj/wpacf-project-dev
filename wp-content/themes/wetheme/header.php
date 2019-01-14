<?php
/**
 * @package wetheme
 */
global $globalSite;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="icon" href="<?php echo get_template_directory_uri() . '/src/images/favicon.ico'; ?>" type="image/x-icon" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <div class="m-overlay"></div>
    <header id="masthead" class="site-header" role="banner">
        <div class="wrapper">
            <a href="<?php _e( home_url( '/' ) ); ?>" id="brand" class="site-logo">
                <img src="<?php echo $globalSite['theme_url'] . '/src/images/_dep/logo-placeholder.png'; ?>" alt="">
            </a>
            <button id="menu-button" class="site-menu-button v1">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav id="site-navigation" class="site-navigation" role="navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
            </nav>
        </div>
    </header>