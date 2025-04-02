<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Team1Theme
 */

// Determine which sidebar to display based on context
$sidebar_id = 'sidebar-1'; // Default sidebar

// For blog/archive pages
if (is_home() || is_archive()) {
    $sidebar_id = 'sidebar-blog';
} 
// For single posts
elseif (is_single()) {
    $sidebar_id = 'sidebar-post';
}
// For pages
elseif (is_page()) {
    $sidebar_id = 'sidebar-page';
}
// For WooCommerce if applicable
elseif (function_exists('is_woocommerce') && is_woocommerce()) {
    $sidebar_id = 'sidebar-shop';
}

// If the selected sidebar isn't active, fall back to the primary sidebar
if (!is_active_sidebar($sidebar_id) && is_active_sidebar('sidebar-1')) {
    $sidebar_id = 'sidebar-1';
}

// If no sidebars are active, exit
if (!is_active_sidebar($sidebar_id)) {
    return;
}
?>

<aside id="secondary" class="widget-area <?php echo esc_attr($sidebar_id); ?>">
    <?php dynamic_sidebar($sidebar_id); ?>
</aside><!-- #secondary -->
