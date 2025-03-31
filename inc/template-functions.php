<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Team1Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function team1theme_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'team1theme_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function team1theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'team1theme_pingback_header' );

/**
 * Output page-specific CSS
 */
function team1theme_page_specific_css() {
    if (!is_page()) {
        return;
    }
    
    $post_id = get_the_ID();
    $heading_alignment = get_post_meta($post_id, '_team1theme_heading_alignment', true);
    $text_alignment = get_post_meta($post_id, '_team1theme_text_alignment', true);
    
    // Only output CSS if we have page-specific settings
    if ($heading_alignment === 'default' && $text_alignment === 'default') {
        return;
    }
    
    // Get default values from customizer for comparison
    $default_heading_alignment = get_theme_mod('page_heading_alignment', 'left');
    $default_text_alignment = get_theme_mod('page_text_alignment', 'left');
    
    // Generate CSS for page-specific settings
    ?>
    <style type="text/css">
        <?php if ($heading_alignment !== 'default' && $heading_alignment !== $default_heading_alignment) : ?>
        .page-id-<?php echo $post_id; ?> .site-main h1, 
        .page-id-<?php echo $post_id; ?> .site-main h2, 
        .page-id-<?php echo $post_id; ?> .site-main h3, 
        .page-id-<?php echo $post_id; ?> .site-main h4, 
        .page-id-<?php echo $post_id; ?> .site-main h5, 
        .page-id-<?php echo $post_id; ?> .site-main h6 {
            text-align: <?php echo esc_attr($heading_alignment); ?>;
        }
        <?php endif; ?>
        
        <?php if ($text_alignment !== 'default' && $text_alignment !== $default_text_alignment) : ?>
        .page-id-<?php echo $post_id; ?> .site-main p, 
        .page-id-<?php echo $post_id; ?> .site-main ul, 
        .page-id-<?php echo $post_id; ?> .site-main ol {
            text-align: <?php echo esc_attr($text_alignment); ?>;
        }
        <?php endif; ?>
    </style>
    <?php
}
add_action('wp_head', 'team1theme_page_specific_css', 25); // Priority after the customizer CSS
