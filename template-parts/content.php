<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Team1Theme
 */

// Check if the helper function exists before using it
$show_post_meta = function_exists('team1theme_should_show_post_meta') ? 
    team1theme_should_show_post_meta() : true;

// Get featured image display option with a safe default
$featured_image_display = get_theme_mod('post_featured_image_display', 'above');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title">', '</h1>');
        else :
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;

        if ('post' === get_post_type() && $show_post_meta) :
        ?>
            <div class="entry-meta">
                <?php
                team1theme_posted_on();
                team1theme_posted_by();
                ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <?php 
    // Show featured image if set to above or if we're not on a singular post
    if (($featured_image_display === 'above' && is_singular()) || (!is_singular() && has_post_thumbnail())) : 
        team1theme_post_thumbnail(); 
    endif; 
    ?>

    <div class="entry-content">
        <?php
        the_content(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'team1theme'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            )
        );

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'team1theme'),
                'after'  => '</div>',
            )
        );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php if ($show_post_meta) : team1theme_entry_footer(); endif; ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
