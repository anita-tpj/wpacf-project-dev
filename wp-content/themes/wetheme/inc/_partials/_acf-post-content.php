<?php
/**
 * Post content
 * Custom functionality for post content
 * @package WordPress
 * @param string $wrapper_class - class name for wrapper if there is any
 */
function flex_post_content( $wrapper_class = '' ) {
	// Open wrapper div if there is any
	if( $wrapper_class ) echo '<div class="' . $wrapper_class . '">';

		$content = get_field('tcontent');
        echo $content;

        if( have_rows('content') ):
            $g_counter = 0;
            while ( have_rows('content') ) : the_row(); ?>
                <?php
                if( get_row_layout() == 'f_tb' ): ?>
                    <div class="text-content add-content">
                        <?php
                        the_sub_field('tb'); ?>
                    </div>
                <?php
                elseif( get_row_layout() == 'f_ib' ):
                    $title = get_sub_field('ib_title');
                    $image = get_sub_field('ib');
                    $link = get_sub_field('ib_link');
                    $link_type = get_sub_field('ib_link_type');
                    $link_i = get_sub_field('link_i');
                    $link_e = get_sub_field('link_e');
                    $description = get_sub_field('ib_desc'); ?>

                    <div class="single-image-wrapper add-content">
                        <?php
                        if( $title ) : ?>
                            <div class="si-title small-title">
                                <h4><?php echo $title; ?></h4>
                            </div>
                            <?php
                        endif; ?>
                        <div class="image-wrap">
                            <?php
                            if( $link ) :
                                if( $link_type == 'Internal' ): ?>
                                    <a href="<?php echo $link_i; ?>">
                                        <img src="<?php echo $image; ?>" alt="Image Failed to load :(">
                                    </a>
                                    <?php
                                elseif( $link_type == 'External'): ?>
                                    <a href="<?php echo $link_e; ?>" target="_blank">
                                        <img src="<?php echo $image; ?>" alt="Image Failed to load :(">
                                    </a>
                                    <?php
                                endif;
                            else : ?>
                                 <a href="<?php echo $image; ?>" data-fancybox>
                                    <img src="<?php echo $image; ?>" alt="Image Failed to load :(">
                                    <div class="loop"></div>
                                </a>
                                <?php
                            endif; ?>
                        </div>
                        <?php
                        if( $description ): ?>
                            <div class="si-description">
                                <p><?php echo $description; ?></p>
                            </div>
                            <?php
                        endif; ?>
                    </div>
                <?php
                elseif( get_row_layout() == 'f_gb' ):
                    $g_counter = $g_counter + 1;
                    $title = get_sub_field('gb_title');
                    $gallery = get_sub_field('gb'); ?>

                    <div class="gallery-wrapper add-content">
                        <?php
                        if( $title ): ?>
                            <div class="g-title small-title">
                                <h4><?php echo $title; ?></h4>
                            </div>
                            <?php
                        endif; ?>
                        <div class="gallery-wrap">
                            <div class="images">
                                <?php foreach( $gallery as $image ): ?>
                                    <div class="image">
                                         <a data-fancybox="<?php echo $g_counter; ?>]" href="<?php echo $image['url']; ?>">
                                            <img src="<?php echo $image['url']; ?>" alt="Gallery Image" />
                                            <div class="loop"></div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                endif;
            endwhile;
        endif;
	// Close wrapper div if there is any
	if( $wrapper_class ) echo '</div>';
}