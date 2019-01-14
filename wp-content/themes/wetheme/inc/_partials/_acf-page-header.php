<?php
/**
 * Header for pages
 * Custom header image functionality
 * @package WordPress
 */

/**
 * @return mixed|string in case there is a image array in field, returns random image from it, otherwise returns random.jpg from images
 *
 */
function randomHeaderImage() {

    $images = array();

    if( have_rows('imgs', 'options') ):
        while( have_rows('imgs', 'options')): the_row();
            $image = get_sub_field('img');

            array_push($images, $image);
        endwhile;
        $random_counter = rand(0, count($images)-1);

    endif;
    if( !empty($images) ) return $images[$random_counter];
    else return get_template_directory_uri() . '/src/images/random.jpg';
}

/**
 * Custom header for home page
 * Change name of images that show up by default if nothing is selected (from random.jpg)
 */
function headerHomePage() {
    $header_image = get_field('header_image');
    $header_title = get_field('header_title');
    $image = get_wetheme_first([$header_image, get_the_post_thumbnail_url(), randomHeaderImage()]);
    $title = get_wetheme_first([$header_title, get_the_title(), get_the_archive_title()]); ?>

    <section class="section header-section header-overlay" style="background-image: url(<?php echo $image; ?>);">
        <div class="g-container">
            <div class="header-title">
                <h1 class="title">
                    <?php
                    echo $title; ?>
                </h1>
            </div>
        </div>
    </section>
    <?php
}

/**
 * Custom header for all other pages
 * Change name of images that show up by default if nothing is selected (from random.jpg)
 */
function headerPage() {
    $header_image = get_field('header_image');
    $header_title = get_field('header_title');
    $image = get_wetheme_first([$header_image, get_the_post_thumbnail_url(), randomHeaderImage()]);
    $title = get_wetheme_first([$header_title, get_the_title(), get_the_archive_title()]); ?>

    <section class="section header-section header-overlay" style="background-image: url(<?php echo $image; ?>);">
        <div class="wrapper">
            <div class="header-title">
                <h1 class="title">
                    <?php
                    echo $title; ?>
                </h1>
            </div>
        </div>
    </section>
    <?php
}
