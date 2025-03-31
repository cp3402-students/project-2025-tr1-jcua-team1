<?php
/**
 * The template for displaying all pages
 *
 * @package Team1Theme
 */

get_header();

// Get page layout setting
$page_layout = get_theme_mod('page_layout', 'with-sidebar');
?>

<main id="primary" class="site-main <?php echo esc_attr($page_layout); ?>">

    <?php
    // Display featured image if set to banner mode
    $featured_image_display = get_theme_mod('page_featured_image_display', 'banner');
    if ($featured_image_display === 'banner' && has_post_thumbnail()) :
    ?>
        <div class="page-featured-image-banner">
            <?php the_post_thumbnail('full'); ?>
        </div>
    <?php endif; ?>

    <?php
    while (have_posts()) :
        the_post();

        // Featured image above content
        if ($featured_image_display === 'above' && has_post_thumbnail()) :
            echo '<div class="page-featured-image-above">';
            the_post_thumbnail('large');
            echo '</div>';
        endif;

        get_template_part('template-parts/content', 'page');

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
// Only include sidebar for the with-sidebar layout
if ($page_layout === 'with-sidebar') {
    get_sidebar();
}
get_footer();
