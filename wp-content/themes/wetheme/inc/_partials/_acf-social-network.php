<?php
/**
 * Social network function
 * Echo social networks from custom fields in Theme General Settings / Social Network
 * @param bool $icon - default true, should it be icon or a text
 * @param string $wrapper_class - class name for wrapper if there is any
 */
function wetheme_social_network( $icon = true, $wrapper_class = '' ) {
    // Open wrapper div if there is any
    if( $wrapper_class ) echo '<div class="' . $wrapper_class . '">';

    if( have_rows('socials', 'options') ): ?>
        <ul class="social">
            <?php
            while( have_rows('socials', 'options') ): the_row();
                $social = get_sub_field('social');
                $link = get_sub_field('link');
                $tumb = get_sub_field('tumb');
                $vim = get_sub_field('vim');
                $face = get_sub_field('face');
                $twit = get_sub_field('twit');
                $goo = get_sub_field('goo');
                $you = get_sub_field('you');
                $insta = get_sub_field('insta');
                $pint = get_sub_field('pint');
                $skype = get_sub_field('skype');
                $xing = get_sub_field('xing'); ?>

                <?php
                if ($social == 'Linkedin'): ?>
                    <li>
                        <a href="<?php echo $link; ?>" target="_blank">
                            <?php
                            if ($icon) echo '<i class="fab fa-linkedin-in" aria-hidden="true"></i>';
                            else echo $social; ?>
                        </a>
                    </li>
                    <?php
                endif;
                if ($social == 'Tumblr'): ?>
                    <li>
                        <a href="<?php echo $tumb; ?>" target="_blank">
                            <?php
                            if ($icon) echo '<i class="fab fa-tumblr" aria-hidden="true"></i>';
                            else echo $social; ?>
                        </a>
                    </li>
                    <?php
                endif;
                if ($social == 'Vimeo'): ?>
                    <li>
                        <a href="<?php echo $vim; ?>" target="_blank">
                            <?php
                            if ($icon) echo '<i class="fab fa-vimeo-v" aria-hidden="true"></i>';
                            else echo $social; ?>
                        </a>
                    </li>
                    <?php
                endif;
                if ($social == 'Facebook'): ?>
                    <li>
                        <a href="<?php echo $face; ?>" target="_blank">
                            <?php
                            if ($icon) echo '<i class="fab fa-facebook-f" aria-hidden="true"></i>';
                            else echo $social; ?>
                        </a>
                    </li>
                    <?php
                endif;
                if ($social == 'Twitter'): ?>
                    <li>
                        <a href="<?php echo $twit; ?>" target="_blank">
                            <?php
                            if ($icon) echo '<i class="fab fa-twitter" aria-hidden="true"></i>';
                            else echo $social; ?>
                        </a>
                    </li>
                    <?php
                endif;
                if ($social == 'Google +'): ?>
                    <li>
                        <a href="<?php echo $goo; ?>" target="_blank">
                            <?php
                            if ($icon) echo '<i class="fab fa-google-plus-g" aria-hidden="true"></i>';
                            else echo $social; ?>
                        </a>
                    </li>
                    <?php
                endif;
                if ($social == 'Youtube'): ?>
                    <li>
                        <a href="<?php echo $you; ?>" target="_blank">
                            <?php
                            if ($icon) echo '<i class="fab fa-youtube" aria-hidden="true"></i>';
                            else echo $social; ?>
                        </a>
                    </li>
                    <?php
                endif;
                if ($social == 'Instagram'): ?>
                    <li>
                        <a href="<?php echo $insta; ?>" target="_blank">
                            <?php
                            if ($icon) echo '<i class="fab fa-instagram" aria-hidden="true"></i>';
                            else echo $social; ?>
                        </a>
                    </li>
                    <?php
                endif;
                if ($social == 'Pinterest'): ?>
                    <li>
                        <a href="<?php echo $pint; ?>" target="_blank">
                            <?php
                            if ($icon) echo '<i class="fab fa-pinterest-p" aria-hidden="true"></i>';
                            else echo $social; ?>
                        </a>
                    </li>
                    <?php
                endif;
                if ($social == 'Skype'): ?>
                    <li>
                        <a href="<?php echo $skype; ?>" target="_blank">
                            <?php
                            if ($icon) echo '<i class="fab fa-skype" aria-hidden="true"></i>';
                            else echo $social; ?>
                        </a>
                    </li>
                    <?php
                endif;
                if ($social == 'Xing'): ?>
                    <li>
                        <a href="<?php echo $xing; ?>" target="_blank">
                            <?php
                            if ($icon) echo '<i class="fab fa-xing" aria-hidden="true"></i>';
                            else echo $social; ?>
                        </a>
                    </li>
                    <?php
                endif; ?>
                <?php
            endwhile; ?>

        </ul>
        <?php
    endif;
    // Close wrapper div if there is any
    if( $wrapper_class ) echo '</div>';
}