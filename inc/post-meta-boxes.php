<?php
/**
 * Custom meta boxes for blog posts
 *
 * @package Team1Theme
 */

/**
 * Register meta box for post layout settings
 */
function team1theme_add_post_meta_boxes() {
    add_meta_box(
        'team1theme_post_settings',
        __('Post Style Settings', 'team1theme'),
        'team1theme_post_settings_callback',
        'post',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'team1theme_add_post_meta_boxes');

/**
 * Meta box display callback
 */
function team1theme_post_settings_callback($post) {
    wp_nonce_field('team1theme_post_settings_nonce', 'post_settings_nonce');
    
    // Get saved values
    $post_layout = get_post_meta($post->ID, '_team1theme_post_layout', true);
    $featured_image_display = get_post_meta($post->ID, '_team1theme_featured_image_display', true);
    $show_post_meta = get_post_meta($post->ID, '_team1theme_show_post_meta', true);
    $heading_align = get_post_meta($post->ID, '_team1theme_heading_align', true);
    $text_align = get_post_meta($post->ID, '_team1theme_text_align', true);
    
    // Set defaults if empty
    if (empty($post_layout)) {
        $post_layout = 'default'; // Use default from customizer
    }
    
    if (empty($featured_image_display)) {
        $featured_image_display = 'default'; // Use default from customizer
    }
    
    if ($show_post_meta === '') {
        $show_post_meta = 'default'; // Use default from customizer
    }
    
    if (empty($heading_align)) {
        $heading_align = 'default'; // Use default from customizer
    }
    
    if (empty($text_align)) {
        $text_align = 'default'; // Use default from customizer
    }
    ?>
    <p>
        <label for="post_layout"><?php _e('Post Layout:', 'team1theme'); ?></label>
        <select name="post_layout" id="post_layout">
            <option value="default" <?php selected($post_layout, 'default'); ?>><?php _e('Theme Default', 'team1theme'); ?></option>
            <option value="with-sidebar" <?php selected($post_layout, 'with-sidebar'); ?>><?php _e('With Sidebar', 'team1theme'); ?></option>
            <option value="full-width" <?php selected($post_layout, 'full-width'); ?>><?php _e('Full Width', 'team1theme'); ?></option>
            <option value="narrow" <?php selected($post_layout, 'narrow'); ?>><?php _e('Narrow Content', 'team1theme'); ?></option>
        </select>
    </p>
    <p>
        <label for="featured_image_display"><?php _e('Featured Image Display:', 'team1theme'); ?></label>
        <select name="featured_image_display" id="featured_image_display">
            <option value="default" <?php selected($featured_image_display, 'default'); ?>><?php _e('Theme Default', 'team1theme'); ?></option>
            <option value="none" <?php selected($featured_image_display, 'none'); ?>><?php _e('Do Not Display', 'team1theme'); ?></option>
            <option value="banner" <?php selected($featured_image_display, 'banner'); ?>><?php _e('Full Width Banner', 'team1theme'); ?></option>
            <option value="above" <?php selected($featured_image_display, 'above'); ?>><?php _e('Above Content', 'team1theme'); ?></option>
            <option value="background" <?php selected($featured_image_display, 'background'); ?>><?php _e('Post Background', 'team1theme'); ?></option>
        </select>
    </p>
    <p>
        <label for="show_post_meta"><?php _e('Show Post Meta Information:', 'team1theme'); ?></label>
        <select name="show_post_meta" id="show_post_meta">
            <option value="default" <?php selected($show_post_meta, 'default'); ?>><?php _e('Theme Default', 'team1theme'); ?></option>
            <option value="yes" <?php selected($show_post_meta, 'yes'); ?>><?php _e('Yes', 'team1theme'); ?></option>
            <option value="no" <?php selected($show_post_meta, 'no'); ?>><?php _e('No', 'team1theme'); ?></option>
        </select>
    </p>
    
    <hr style="margin: 15px 0;">
    <p><strong><?php _e('Text Alignment:', 'team1theme'); ?></strong></p>
    
    <p>
        <label for="heading_align"><?php _e('Heading Alignment:', 'team1theme'); ?></label>
        <select name="heading_align" id="heading_align">
            <option value="default" <?php selected($heading_align, 'default'); ?>><?php _e('Theme Default', 'team1theme'); ?></option>
            <option value="left" <?php selected($heading_align, 'left'); ?>><?php _e('Left', 'team1theme'); ?></option>
            <option value="center" <?php selected($heading_align, 'center'); ?>><?php _e('Center', 'team1theme'); ?></option>
            <option value="right" <?php selected($heading_align, 'right'); ?>><?php _e('Right', 'team1theme'); ?></option>
        </select>
    </p>
    <p>
        <label for="text_align"><?php _e('Content Text Alignment:', 'team1theme'); ?></label>
        <select name="text_align" id="text_align">
            <option value="default" <?php selected($text_align, 'default'); ?>><?php _e('Theme Default', 'team1theme'); ?></option>
            <option value="left" <?php selected($text_align, 'left'); ?>><?php _e('Left', 'team1theme'); ?></option>
            <option value="center" <?php selected($text_align, 'center'); ?>><?php _e('Center', 'team1theme'); ?></option>
            <option value="right" <?php selected($text_align, 'right'); ?>><?php _e('Right', 'team1theme'); ?></option>
            <option value="justify" <?php selected($text_align, 'justify'); ?>><?php _e('Justify', 'team1theme'); ?></option>
        </select>
    </p>
    
    <p class="description"><?php _e('Note: Color settings can be adjusted globally from the Theme Customizer.', 'team1theme'); ?></p>
    <?php
}

/**
 * Save meta box content
 */
function team1theme_save_post_meta($post_id) {
    // Check if our nonce is set
    if (!isset($_POST['post_settings_nonce'])) {
        return;
    }
    
    // Verify that the nonce is valid
    if (!wp_verify_nonce($_POST['post_settings_nonce'], 'team1theme_post_settings_nonce')) {
        return;
    }
    
    // If this is an autosave, we don't want to do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check the user's permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save post layout
    if (isset($_POST['post_layout'])) {
        update_post_meta($post_id, '_team1theme_post_layout', sanitize_text_field($_POST['post_layout']));
    }
    
    // Save featured image display
    if (isset($_POST['featured_image_display'])) {
        update_post_meta($post_id, '_team1theme_featured_image_display', sanitize_text_field($_POST['featured_image_display']));
    }
    
    // Save show post meta setting
    if (isset($_POST['show_post_meta'])) {
        update_post_meta($post_id, '_team1theme_show_post_meta', sanitize_text_field($_POST['show_post_meta']));
    }
    
    // Save heading alignment
    if (isset($_POST['heading_align'])) {
        update_post_meta($post_id, '_team1theme_heading_align', sanitize_text_field($_POST['heading_align']));
    }
    
    // Save text alignment
    if (isset($_POST['text_align'])) {
        update_post_meta($post_id, '_team1theme_text_align', sanitize_text_field($_POST['text_align']));
    }
}
add_action('save_post', 'team1theme_save_post_meta');