<?php
/**
 * Custom meta boxes for page template
 *
 * @package Team1Theme
 */

/**
 * Register meta box for page layout settings
 */
function team1theme_add_page_meta_boxes() {
    add_meta_box(
        'team1theme_page_settings',
        __('Page Settings', 'team1theme'),
        'team1theme_page_settings_callback',
        'page',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'team1theme_add_page_meta_boxes');

/**
 * Meta box display callback
 */
function team1theme_page_settings_callback($post) {
    wp_nonce_field('team1theme_page_settings_nonce', 'page_settings_nonce');
    
    // Get saved values
    $page_layout = get_post_meta($post->ID, '_team1theme_page_layout', true);
    $show_title = get_post_meta($post->ID, '_team1theme_show_title', true);
    $heading_alignment = get_post_meta($post->ID, '_team1theme_heading_alignment', true);
    $text_alignment = get_post_meta($post->ID, '_team1theme_text_alignment', true);
    
    if (empty($page_layout)) {
        $page_layout = 'default'; // Use default from customizer
    }
    
    if ($show_title === '') {
        $show_title = 'default'; // Use default from customizer
    }
    
    if (empty($heading_alignment)) {
        $heading_alignment = 'default'; // Use default from customizer
    }
    
    if (empty($text_alignment)) {
        $text_alignment = 'default'; // Use default from customizer
    }
    ?>
    <p>
        <label for="page_layout"><?php _e('Page Layout:', 'team1theme'); ?></label>
        <select name="page_layout" id="page_layout">
            <option value="default" <?php selected($page_layout, 'default'); ?>><?php _e('Theme Default', 'team1theme'); ?></option>
            <option value="with-sidebar" <?php selected($page_layout, 'with-sidebar'); ?>><?php _e('With Sidebar', 'team1theme'); ?></option>
            <option value="full-width" <?php selected($page_layout, 'full-width'); ?>><?php _e('Full Width', 'team1theme'); ?></option>
            <option value="narrow" <?php selected($page_layout, 'narrow'); ?>><?php _e('Narrow Content', 'team1theme'); ?></option>
        </select>
    </p>
    <p>
        <label for="show_title"><?php _e('Show Page Title:', 'team1theme'); ?></label>
        <select name="show_title" id="show_title">
            <option value="default" <?php selected($show_title, 'default'); ?>><?php _e('Theme Default', 'team1theme'); ?></option>
            <option value="yes" <?php selected($show_title, 'yes'); ?>><?php _e('Yes', 'team1theme'); ?></option>
            <option value="no" <?php selected($show_title, 'no'); ?>><?php _e('No', 'team1theme'); ?></option>
        </select>
    </p>
    <p>
        <label for="heading_alignment"><?php _e('Heading Alignment:', 'team1theme'); ?></label>
        <select name="heading_alignment" id="heading_alignment">
            <option value="default" <?php selected($heading_alignment, 'default'); ?>><?php _e('Theme Default', 'team1theme'); ?></option>
            <option value="left" <?php selected($heading_alignment, 'left'); ?>><?php _e('Left', 'team1theme'); ?></option>
            <option value="center" <?php selected($heading_alignment, 'center'); ?>><?php _e('Center', 'team1theme'); ?></option>
            <option value="right" <?php selected($heading_alignment, 'right'); ?>><?php _e('Right', 'team1theme'); ?></option>
        </select>
    </p>
    <p>
        <label for="text_alignment"><?php _e('Body Text Alignment:', 'team1theme'); ?></label>
        <select name="text_alignment" id="text_alignment">
            <option value="default" <?php selected($text_alignment, 'default'); ?>><?php _e('Theme Default', 'team1theme'); ?></option>
            <option value="left" <?php selected($text_alignment, 'left'); ?>><?php _e('Left', 'team1theme'); ?></option>
            <option value="center" <?php selected($text_alignment, 'center'); ?>><?php _e('Center', 'team1theme'); ?></option>
            <option value="right" <?php selected($text_alignment, 'right'); ?>><?php _e('Right', 'team1theme'); ?></option>
            <option value="justify" <?php selected($text_alignment, 'justify'); ?>><?php _e('Justify', 'team1theme'); ?></option>
        </select>
    </p>
    <?php
}

/**
 * Save meta box content
 */
function team1theme_save_page_meta($post_id) {
    // Check if our nonce is set
    if (!isset($_POST['page_settings_nonce'])) {
        return;
    }
    
    // Verify that the nonce is valid
    if (!wp_verify_nonce($_POST['page_settings_nonce'], 'team1theme_page_settings_nonce')) {
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
    
    // Save page layout
    if (isset($_POST['page_layout'])) {
        update_post_meta($post_id, '_team1theme_page_layout', sanitize_text_field($_POST['page_layout']));
    }
    
    // Save show title setting
    if (isset($_POST['show_title'])) {
        update_post_meta($post_id, '_team1theme_show_title', sanitize_text_field($_POST['show_title']));
    }
    
    // Save heading alignment
    if (isset($_POST['heading_alignment'])) {
        update_post_meta($post_id, '_team1theme_heading_alignment', sanitize_text_field($_POST['heading_alignment']));
    }
    
    // Save text alignment
    if (isset($_POST['text_alignment'])) {
        update_post_meta($post_id, '_team1theme_text_alignment', sanitize_text_field($_POST['text_alignment']));
    }
}
add_action('save_post', 'team1theme_save_page_meta');