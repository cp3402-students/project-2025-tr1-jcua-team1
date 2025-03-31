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
    ?>
    <p>
        <label for="show_post_meta"><?php _e('Show Post Meta Information:', 'team1theme'); ?></label>
        <select name="show_post_meta" id="show_post_meta">
            <option value="default" <?php selected($show_post_meta, 'default'); ?>><?php _e('Theme Default', 'team1theme'); ?></option>
            <option value="yes" <?php selected($show_post_meta, 'yes'); ?>><?php _e('Yes', 'team1theme'); ?></option>
            <option value="no" <?php selected($show_post_meta, 'no'); ?>><?php _e('No', 'team1theme'); ?></option>
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