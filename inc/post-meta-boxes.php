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
    $show_post_meta = get_post_meta($post->ID, '_team1theme_show_post_meta', true);
    
    // Set defaults if empty
    if ($show_post_meta === '') {
        $show_post_meta = 'default'; // Use default from customizer
    }

    // Get saved heading alignment value
    $heading_alignment = get_post_meta($post->ID, '_team1theme_heading_alignment', true);

    // Set default heading alignment if empty
    if ($heading_alignment === '') {
        $heading_alignment = 'default';
    }

    // Get saved text alignment value
    $text_alignment = get_post_meta($post->ID, '_team1theme_text_alignment', true);

    // Set default text alignment if empty
    if ($text_alignment === '') {
        $text_alignment = 'default';
    }
    ?>
    <p>
        <label for="show_post_meta"><?php _e('Show Post Meta Information:', 'team1theme'); ?></label>
        <select name="show_post_meta" id="show_post_meta">
            <option value="default" <?php selected($show_post_meta, 'default'); ?>><?php _e('Theme Default', 'team1theme'); ?></option>
            <option value="yes" <?php selected($show_post_meta, 'yes'); ?>><?php _e('Yes', 'team1theme'); ?></option>
            <option value="no" <?php selected($show_post_meta, 'no'); ?>><?php _e('No', 'team1theme'); ?></option>
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
        <label for="text_alignment"><?php _e('Text Alignment:', 'team1theme'); ?></label>
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
    
    // Save show post meta setting
    if (isset($_POST['show_post_meta'])) {
        update_post_meta($post_id, '_team1theme_show_post_meta', sanitize_text_field($_POST['show_post_meta']));
    }

    // Save heading alignment setting
    if (isset($_POST['heading_alignment'])) {
        update_post_meta($post_id, '_team1theme_heading_alignment', sanitize_text_field($_POST['heading_alignment']));
    }

    // Save text alignment setting
    if (isset($_POST['text_alignment'])) {
        update_post_meta($post_id, '_team1theme_text_alignment', sanitize_text_field($_POST['text_alignment']));
    }
}
add_action('save_post', 'team1theme_save_post_meta');

/**
 * Helper function to determine if post meta should be shown
 */
function team1theme_should_show_post_meta($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $show_post_meta = get_post_meta($post_id, '_team1theme_show_post_meta', true);
    
    if ($show_post_meta === 'yes') {
        return true;
    } else if ($show_post_meta === 'no') {
        return false;
    } else {
        // Use the theme default
        return get_theme_mod('show_post_meta', true);
    }
}