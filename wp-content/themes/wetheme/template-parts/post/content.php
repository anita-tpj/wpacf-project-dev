<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wetheme
 */

?>
<div class="g-container">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <?php
            the_title( '<h2 class="entry-title">', '</h2>' );

            if( has_post_thumbnail() ):
                the_post_thumbnail('medium');
            else:
                // echo '<img src="' . get_template_directory_uri() . '/src/img/logo.png" alt="Featured Image">';
                echo '<img src="http://placehold.it/600x400" alt="Featured Image">';
            endif;

            if ( 'post' === get_post_type() ) : ?>
                <div class="entry-meta">
                    <?php wetheme_posted_on() ; ?>
                </div><!-- .entry-meta -->
            <?php
            endif; ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php
            flex_post_content();
            //Or excerpt
            //            $content = get_field('tcontent');
            //            the_wetheme_excerpt($content); ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <?php wetheme_entry_footer(); ?>
        </footer><!-- .entry-footer -->
    </article><!-- #post-## -->
</div>