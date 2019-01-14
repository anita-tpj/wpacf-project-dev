<?php
/**
 * Custom meta functions for wetheme
 * Functions like custom excerpt, share link, mail chimp integration etc...
 */

/**
 * Custom Excerpt function for Advanced Custom Fields
 * @param $field - ACF field with content to do excerpt
 */
function get_wetheme_excerpt($field, $count = '', $end = '') {;

    if ( '' != $field ) {
        $field = strip_shortcodes( $field );
        $field = apply_filters('the_content', $field);
        $field = str_replace(']]&gt;', ']]&gt;', $field);
        //$excerpt_length = rand(22, 60); for randoming
        if( $count ) $excerpt_length = $count;
        else $excerpt_length = 60;

        if( $end ) $excerpt_more = apply_filters('excerpt_more', ' ' . $end);
        else $excerpt_more = apply_filters('excerpt_more', ' ' . '...');

        $field = wp_trim_words( $field, $excerpt_length, $excerpt_more );
    }
    return apply_filters('the_excerpt', $field);
}

/**
 * Custom excerpt function for Advanced Custom Fields
 *
 * Echo Custom Excerpt function for Advanced Custom Fields
 * @param $field - ACF field with content to do excerpt
 */
function the_wetheme_excerpt($field, $count = '', $end = '') {
    echo get_wetheme_excerpt($field, $count, $end);
}

/**
 * Get the sharing link
 *
 * Helper function for share links
 *
 * @param  string $network   Default '', network to share to, values to use: twitter, facebook, google, linkedin
 * @param  boolean $icon     Default false, set to true, if you want icon instead of text
 * @param  string $hashtags  Hashatgs (Twitter)
 * @param  string $text      Some networks allow extra text (Twitter)
 * @return string            Returns share link markup
 */
function get_share_link($network = '', $icon = false, $text = '', $hashtags = '') {
    $link = get_permalink();
    if( !$text ) $text = get_the_title();
    if ( $network == 'twitter' ) {
        /**
         * Example usage: share_link('facebook', true); or share_link('twitter', false, 'lol,hi,hashtag', 'Custom Text For Twitter') ...
         */
        $href = 'http://twitter.com/share?text=' . $text . ' - ' . '&url=' . $link . '&hashtags=' . $hashtags;
        if( !$icon ) $print_name = 'Twitter'; else $print_name = '<i class="fa fa-twitter" aria-hidden="true"></i>';

    } elseif ( $network == 'facebook' ) {
        $href = 'http://www.facebook.com/sharer/sharer.php?u=' . $link;
        if( !$icon ) $print_name = 'Facebook'; else $print_name = '<i class="fa fa-facebook" aria-hidden="true"></i>';
    } elseif ( $network == 'google' ) {
        $href = 'https://plus.google.com/share?url=' . $link;
        if( !$icon ) $print_name = 'Google +'; else $print_name = '<i class="fa fa-google-plus" aria-hidden="true"></i>';
    } elseif ( $network == 'linkedin' ) {
        $href = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $link . '&title=' . $text . '&summary=&source=';
        if( !$icon ) $print_name = 'Linkedin'; else $print_name = '<i class="fa fa-linkedin" aria-hidden="true"></i>';
    } else {
        return;
    }

    $output = '<a href="' . $href . '"';
    $output .= ' onclick="javascript:window.open(this.href, \'\',\'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=650,centerscreen=yes\');return false;"';
    $output .= '>';
    $output .= $print_name;
    $output .= '</a>';

    return $output;
}

/**
 * Share link
 *
 * Echo share link
 *
 * @param  string $network   Default '', network to share to, values to use: twitter, facebook, google, linkedin
 * @param  boolean $icon     Default false, set to true, if you want icon instead of text
 * @param  string $hashtags  Hashatgs (Twitter)
 * @param  string $text      Some networks allow extra text (Twitter)
 * @return string            Echo share link markup
 */
function the_share_link($network = '', $icon = '', $text = '', $hashtags = '') {
    echo get_share_link($network, $icon, $text, $hashtags);
}

/**
 * Get first item from array
 * @param $vars {array} - List of variables
 * @return mixed - First available in array
 */
function get_wetheme_first($vars) {
    if ( !$vars )
        return '';

    foreach ( $vars as $var ) :
        if ( $var )
            return $var;
    endforeach;
}

/**
 * Echo first item from array
 * @param $vars {array} - List of variables
 * @return mixed - First available in array
 */
function the_wetheme_first($vars) {
    if ( !$vars )
        return '';

    foreach ( $vars as $var ) :
        if ( $var ) {
            echo $var;
            return;
        }
    endforeach;
}