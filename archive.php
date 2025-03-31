<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Team1Theme
 */

get_header();

// Get archive layout from theme mod
$archive_layout = get_theme_mod('archive_layout', 'standard');

// Determine archive type
$archive_type = '';
if (is_category()) {
    $archive_type = 'category';
} elseif (is_tag()) {
    $archive_type = 'tag';
} elseif (is_date()) {
    $archive_type = 'date';
} elseif (is_author()) {
    $archive_type = 'author';
}

// Add archive type class to main element
$archive_classes = array('site-main');
if (!empty($archive_type)) {
    $archive_classes[] = 'archive-type-' . $archive_type;
}
if (!empty($archive_layout)) {
    $archive_classes[] = 'archive-layout-' . $archive_layout;
}
?>

<main id="primary" class="<?php echo esc_attr(implode(' ', $archive_classes)); ?>">

    <?php if (have_posts()) : ?>

        <header class="page-header">
            <?php
            // Custom titles/descriptions based on archive type
            if (is_category()) {
                // Category specific header content
                the_archive_title('<h1 class="page-title category-title">', '</h1>');
                the_archive_description('<div class="archive-description category-description">', '</div>');
            } elseif (is_tag()) {
                // Tag specific header content
                the_archive_title('<h1 class="page-title tag-title">', '</h1>');
                the_archive_description('<div class="archive-description tag-description">', '</div>');
            } elseif (is_author()) {
                // Author specific header content
                the_archive_title('<h1 class="page-title author-title">', '</h1>');
                echo '<div class="archive-description author-description">';
                echo get_avatar(get_the_author_meta('ID'), 120);
                echo '<p>' . get_the_author_meta('description') . '</p>';
                echo '</div>';
            } else {
                // Default archive header
                the_archive_title('<h1 class="page-title">', '</h1>');
                the_archive_description('<div class="archive-description">', '</div>');
            }
            ?>
        </header><!-- .page-header -->

        <?php if ($archive_layout == 'grid') : ?>
            <div class="archive-grid">
        <?php endif; ?>

        <?php
        /* Start the Loop */
        while (have_posts()) :
            the_post();

            /*
             * Include the Post-Type-specific template for the content.
             * You can create specific templates for different archive types by adding:
             * - template-parts/content-category.php for categories
             * - template-parts/content-tag.php for tags
             * - template-parts/content-date.php for date archives
             */
            if (file_exists(get_template_directory() . '/template-parts/content-' . $archive_type . '.php')) {
                get_template_part('template-parts/content', $archive_type);
            } else {
                get_template_part('template-parts/content', get_post_type());
            }

        endwhile;

        if ($archive_layout == 'grid') : ?>
            </div><!-- .archive-grid -->
        <?php endif;

        // Customized post navigation based on archive settings
        $nav_type = get_theme_mod('archive_pagination', 'default');
        if ($nav_type == 'numbered') {
            echo '<div class="pagination-container">';
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('&laquo; Previous', 'team1theme'),
                'next_text' => __('Next &raquo;', 'team1theme'),
            ));
            echo '</div>';
        } else {
            the_posts_navigation(array(
                'prev_text' => __('&larr; Older Posts', 'team1theme'),
                'next_text' => __('Newer Posts &rarr;', 'team1theme'),
            ));
        }

    else :

        get_template_part('template-parts/content', 'none');

    endif;
    ?>

</main><!-- #main -->

<?php
// Only include sidebar if we're not using a full-width layout
if ($archive_layout !== 'full-width') {
    get_sidebar();
}
get_footer();
