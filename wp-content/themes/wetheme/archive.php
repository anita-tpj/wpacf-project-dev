<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wetheme
 */

get_header(); ?>
    <div id="content" class="site-content">
        <?php
        headerPage(); ?>
        <main id="main" class="page-main site-main" role="main">
		<?php
		if ( have_posts() ) : ?>
			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<?php
			while ( have_posts() ) : the_post();
				if ( post_type_exists( get_post_type() ) ) {
					get_template_part( 'template-parts/post/content', get_post_type() );
				}
				else {
					get_template_part( 'template-parts/post/content' );
				}
				/**
				 * Get the comments list and form
				 * @link https://developer.wordpress.org/reference/functions/comments_template/
				 */
				comments_template( '', true );
			endwhile;
			the_posts_navigation();
		else :
			get_template_part( 'template-parts/post/content', 'none' );
		endif; ?>
		</main>
    </div>
<?php
// get_sidebar();
get_footer();
