<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Team1Theme
 */

get_header();

// Get post-specific layout if set, otherwise use default from customizer
$post_layout = get_post_meta(get_the_ID(), '_team1theme_post_layout', true);
if ($post_layout === 'default' || empty($post_layout)) {
    $post_layout = get_theme_mod('post_layout', 'with-sidebar');
}

// Get featured image display setting
$featured_image_display = get_post_meta(get_the_ID(), '_team1theme_featured_image_display', true);
if ($featured_image_display === 'default' || empty($featured_image_display)) {
    $featured_image_display = get_theme_mod('post_featured_image_display', 'above');
}

// Get post meta visibility setting
$show_post_meta = get_post_meta(get_the_ID(), '_team1theme_show_post_meta', true);
if ($show_post_meta === 'default' || empty($show_post_meta)) {
    $show_post_meta = get_theme_mod('show_post_meta', true);
}
$show_post_meta = ($show_post_meta === 'yes' || $show_post_meta === true) ? true : false;

// Add classes based on layout and featured image settings
$post_classes = 'site-main';
$post_classes .= ' post-layout-' . $post_layout;
$post_classes .= ' featured-image-' . $featured_image_display;
?>

<main id="primary" class="<?php echo esc_attr($post_classes); ?>">

    <?php
    // Display featured image as banner if selected
    if ($featured_image_display === 'banner' && has_post_thumbnail()) :
    ?>
        <div class="post-featured-banner">
            <?php the_post_thumbnail('full'); ?>
        </div>
    <?php endif; ?>

    <?php
    while (have_posts()) :
        the_post();

        // Pass our custom settings to the template part
        set_query_var('show_post_meta', $show_post_meta);
        set_query_var('featured_image_display', $featured_image_display);
        get_template_part('template-parts/content', get_post_type());

        the_post_navigation(
            array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'team1theme') . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'team1theme') . '</span> <span class="nav-title">%title</span>',
            )
        );

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
// Only include sidebar for the with-sidebar layout
if ($post_layout === 'with-sidebar') {
    get_sidebar();
}
get_footer();
