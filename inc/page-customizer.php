<?php
/**
 * Page Customizer Settings
 *
 * This file contains all the customizer settings for page templates.
 *
 * @package Team1Theme
 */

/**
 * Add Page Customizer Settings
 */
function team1theme_page_customize_register($wp_customize) {
    // First ensure our custom color scheme control class is available
    if (class_exists('Team1Theme_Color_Scheme_Control')) {
        // Add a section for page settings
        $wp_customize->add_section('page_settings', array(
            'title'    => __('Page Settings', 'team1theme'),
            'priority' => 35, 
        ));
        
        // Page Layout Options
        $wp_customize->add_setting('page_layout', array(
            'default'           => 'with-sidebar',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control('page_layout', array(
            'label'    => __('Page Layout', 'team1theme'),
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
            'sanitize_callback' => 'sanitize_text_field', // Allow CSS variables
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control(new Team1Theme_Color_Scheme_Control($wp_customize, 'page_content_bg', array(
            'label'       => __('Page Content Background', 'team1theme'),
            'description' => __('Choose from theme colors or select a custom color', 'team1theme'),
            'section'     => 'page_settings',
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
        
        // Page Text Color
        $wp_customize->add_setting('page_text_color', array(
            'default'           => '#333333',
            'sanitize_callback' => 'sanitize_text_field', // Allow CSS variables
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control(new Team1Theme_Color_Scheme_Control($wp_customize, 'page_text_color', array(
            'label'       => __('Page Text Color', 'team1theme'),
            'description' => __('Choose from theme colors or select a custom color', 'team1theme'),
            'section'     => 'page_settings',
        )));

        // Page Heading Color
        $wp_customize->add_setting('page_heading_color', array(
            'default'           => '#333333',
            'sanitize_callback' => 'sanitize_text_field', // Allow CSS variables
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control(new Team1Theme_Color_Scheme_Control($wp_customize, 'page_heading_color', array(
            'label'       => __('Page Heading Color', 'team1theme'),
            'description' => __('Choose from theme colors or select a custom color', 'team1theme'),
            'section'     => 'page_settings',
        )));

        // Page Link Color
        $wp_customize->add_setting('page_link_color', array(
            'default'           => '#4169e1',
            'sanitize_callback' => 'sanitize_text_field', // Allow CSS variables
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control(new Team1Theme_Color_Scheme_Control($wp_customize, 'page_link_color', array(
            'label'       => __('Page Link Color', 'team1theme'),
            'description' => __('Choose from theme colors or select a custom color', 'team1theme'),
            'section'     => 'page_settings',
        )));

        // Page Heading Alignment
        $wp_customize->add_setting('page_heading_alignment', array(
            'default'           => 'left',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control('page_heading_alignment', array(
            'label'    => __('Heading Alignment', 'team1theme'),
            'section'  => 'page_settings',
            'type'     => 'select',
            'choices'  => array(
                'left'   => __('Left', 'team1theme'),
                'center' => __('Center', 'team1theme'),
                'right'  => __('Right', 'team1theme'),
            ),
        ));

        // Page Text Alignment
        $wp_customize->add_setting('page_text_alignment', array(
            'default'           => 'left',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control('page_text_alignment', array(
            'label'    => __('Default Body Text Alignment', 'team1theme'),
            'section'  => 'page_settings',
            'type'     => 'select',
            'choices'  => array(
                'left'   => __('Left', 'team1theme'),
                'center' => __('Center', 'team1theme'),
                'right'  => __('Right', 'team1theme'),
                'justify' => __('Justify', 'team1theme'),
            ),
        ));
    } else {
        // Fallback to standard WP color controls if class doesn't exist
        // Page content background color
        $wp_customize->add_setting('page_content_bg', array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'page_content_bg', array(
            'label'    => __('Page Content Background', 'team1theme'),
            'section'  => 'page_settings',
        )));
        
        // Other standard controls would go here...
    }
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
    if (!is_singular('page')) {
        return;
    }
    
    // Get page-specific settings from customizer
    $page_bg = get_theme_mod('page_content_bg', '#ffffff');
    $page_padding = get_theme_mod('page_content_padding', '30');
    $page_text_color = get_theme_mod('page_text_color', '#333333');
    $page_heading_color = get_theme_mod('page_heading_color', '#333333');
    $page_link_color = get_theme_mod('page_link_color', '#4169e1');
    
    // Handle both hex colors and CSS variables for background color
    ?>
    <style type="text/css">
        .site-main {
            background-color: <?php echo $page_bg; ?>;
            padding: <?php echo esc_attr(get_theme_mod('page_content_padding', '30')); ?>px;
            color: <?php echo $page_text_color; ?>;
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
        
        /* Heading styles */
        .site-main h1, 
        .site-main h2, 
        .site-main h3, 
        .site-main h4, 
        .site-main h5, 
        .site-main h6 {
            text-align: <?php echo esc_attr(get_theme_mod('page_heading_alignment', 'left')); ?>;
            color: <?php echo $page_heading_color; ?>;
        }
        
        /* Link styles */
        .site-main a {
            color: <?php echo $page_link_color; ?>;
        }
        
        /* Body text alignment */
        .site-main p, 
        .site-main ul, 
        .site-main ol {
            text-align: <?php echo esc_attr(get_theme_mod('page_text_alignment', 'left')); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'team1theme_page_customizer_css');