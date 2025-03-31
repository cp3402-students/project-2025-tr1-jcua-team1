<?php
/**
 * Page template customizer options
 *
 * @package Team1Theme
 */

/**
 * Add page customizer settings
 */
function team1theme_page_customize_register($wp_customize) {
    // Add a section for page template settings
    $wp_customize->add_section('page_settings', array(
        'title'    => __('Page Template Settings', 'team1theme'),
        'priority' => 40,
    ));

    // Layout Options
    $wp_customize->add_setting('page_layout', array(
        'default'           => 'with-sidebar',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('page_layout', array(
        'label'    => __('Default Page Layout', 'team1theme'),
        'section'  => 'page_settings',
        'type'     => 'select',
        'choices'  => array(
            'with-sidebar' => __('With Sidebar', 'team1theme'),
            'full-width'   => __('Full Width', 'team1theme'),
            'narrow'       => __('Narrow Content', 'team1theme'),
        ),
    ));

    // Show/Hide Page Title
    $wp_customize->add_setting('page_show_title', array(
        'default'           => true,
        'sanitize_callback' => 'team1theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('page_show_title', array(
        'label'    => __('Show Page Title', 'team1theme'),
        'section'  => 'page_settings',
        'type'     => 'checkbox',
    ));

    // Page Content Background Color
    $wp_customize->add_setting('page_content_bg', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'page_content_bg', array(
        'label'    => __('Page Content Background', 'team1theme'),
        'section'  => 'page_settings',
    )));

    // Page Content Padding
    $wp_customize->add_setting('page_content_padding', array(
        'default'           => '30',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('page_content_padding', array(
        'label'       => __('Content Padding (px)', 'team1theme'),
        'section'     => 'page_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 100,
            'step' => 5,
        ),
    ));

    // Featured Image Display
    $wp_customize->add_setting('page_featured_image_display', array(
        'default'           => 'banner',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('page_featured_image_display', array(
        'label'    => __('Featured Image Display', 'team1theme'),
        'section'  => 'page_settings',
        'type'     => 'select',
        'choices'  => array(
            'none'       => __('Do Not Display', 'team1theme'),
            'banner'     => __('Full Width Banner', 'team1theme'),
            'above'      => __('Above Content', 'team1theme'),
            'background' => __('Page Background', 'team1theme'),
        ),
    ));
}
add_action('customize_register', 'team1theme_page_customize_register');

/**
 * Sanitize checkbox values
 */
function team1theme_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}

/**
 * Generate custom CSS for page templates
 */
function team1theme_page_customizer_css() {
    ?>
    <style type="text/css">
        .site-main {
            background-color: <?php echo esc_attr(get_theme_mod('page_content_bg', '#ffffff')); ?>;
            padding: <?php echo esc_attr(get_theme_mod('page_content_padding', '30')); ?>px;
        }
        
        <?php if (get_theme_mod('page_layout', 'with-sidebar') === 'full-width') : ?>
        .site-main {
            width: 100%;
            max-width: 100%;
        }
        <?php elseif (get_theme_mod('page_layout', 'with-sidebar') === 'narrow') : ?>
        .site-main {
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        <?php endif; ?>
        
        <?php if (!get_theme_mod('page_show_title', true)) : ?>
        .page .entry-title {
            display: none;
        }
        <?php endif; ?>
    </style>
    <?php
}
add_action('wp_head', 'team1theme_page_customizer_css');