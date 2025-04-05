<?php
/**
 * Homepage Customizer Settings
 *
 * This file contains all the customizer settings for the homepage.
 *
 * @package Team1Theme
 */

/**
 * Add Homepage Customizer Settings
 */
function team1_theme_homepage_customize_register($wp_customize) {
    // Add a section for homepage settings
    $wp_customize->add_section('homepage_settings', array(
        'title'    => __('Homepage Settings', 'team1theme'),
        'priority' => 30,
    ));
    // Hero Heading
    $wp_customize->add_setting('hero_heading', array(
        'default'           => 'Welcome to Our Website',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('hero_heading', array(
        'label'    => __('Hero Heading', 'team1theme'),
        'section'  => 'homepage_settings',
        'type'     => 'text',
    ));
    // Hero Text
    $wp_customize->add_setting('hero_text', array(
        'default'           => 'This is your custom homepage. Add your content here.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('hero_text', array(
        'label'    => __('Hero Text', 'team1theme'),
        'section'  => 'homepage_settings',
        'type'     => 'textarea',
    ));
    
    // Hero Header Alignment
    $wp_customize->add_setting('hero_header_align', array(
        'default'           => 'center',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('hero_header_align', array(
        'label'    => __('Header Alignment', 'team1theme'),
        'description' => __('Alignment for the hero headline', 'team1theme'),
        'section'  => 'homepage_settings',
        'type'     => 'select',
        'choices'  => array(
            'left'   => __('Left', 'team1theme'),
            'center' => __('Center', 'team1theme'),
            'right'  => __('Right', 'team1theme'),
        ),
        'priority' => 20, // Position it before hero text alignment
    ));
    // Hero Background Color
    $wp_customize->add_setting('hero_bg_color', array(
        'default'           => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hero_bg_color', array(
        'label'    => __('Hero Background Color', 'team1theme'),
        'section'  => 'homepage_settings',
    )));
    // Hero Background Image
    $wp_customize->add_setting('hero_bg_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_bg_image', array(
        'label'    => __('Hero Background Image', 'team1theme'),
        'section'  => 'homepage_settings',
        'priority' => 11, // Position after background color
    )));
    // Hero Background Image Opacity
    $wp_customize->add_setting('hero_bg_opacity', array(
        'default'           => '0.8',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('hero_bg_opacity', array(
        'label'       => __('Background Image Overlay Opacity', 'team1theme'),
        'description' => __('Adjust the darkness of the background image (0 = transparent, 1 = solid color overlay)', 'team1theme'),
        'section'     => 'homepage_settings',
        'type'        => 'range',
        'priority'    => 12,
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 1,
            'step' => 0.1,
        ),
    ));
    
    // Hero Text Color
    $wp_customize->add_setting('hero_text_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hero_text_color', array(
        'label'    => __('Hero Text Color', 'team1theme'),
        'section'  => 'homepage_settings',
    )));
    // Hero Text Alignment
    $wp_customize->add_setting('hero_text_align', array(
        'default'           => 'center',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('hero_text_align', array(
        'label'    => __('Text Alignment', 'team1theme'),
        'section'  => 'homepage_settings',
        'type'     => 'select',
        'choices'  => array(
            'left'   => __('Left', 'team1theme'),
            'center' => __('Center', 'team1theme'),
            'right'  => __('Right', 'team1theme'),
        ),
    ));
    
    // Hero Width
    $wp_customize->add_setting('hero_width', array(
        'default'           => '100',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('hero_width', array(
        'label'       => __('Hero Section Width (%)', 'team1theme'),
        'description' => __('Width of the hero section content (50-100%)', 'team1theme'),
        'section'     => 'homepage_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 50,
            'max'  => 100,
            'step' => 5,
        ),
    ));
    
    // Hero Button Text
    $wp_customize->add_setting('hero_button_text', array(
        'default'           => 'Learn More',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('hero_button_text', array(
        'label'    => __('Hero Button Text', 'team1theme'),
        'section'  => 'homepage_settings',
        'type'     => 'text',
    ));
    
    // Hero Button URL
    $wp_customize->add_setting('hero_button_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('hero_button_url', array(
        'label'    => __('Hero Button URL', 'team1theme'),
        'section'  => 'homepage_settings',
        'type'     => 'url',
    ));
    // Hero Foreground Image
    $wp_customize->add_setting('hero_foreground_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_foreground_image', array(
        'label'       => __('Hero Foreground Image', 'team1theme'),
        'description' => __('This image appears in the hero section as content (not as background)', 'team1theme'),
        'section'     => 'homepage_settings',
        'priority'    => 15,
    )));
    // Hero Image Position
    $wp_customize->add_setting('hero_image_position', array(
        'default'           => 'below',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('hero_image_position', array(
        'label'    => __('Hero Image Position', 'team1theme'),
        'section'  => 'homepage_settings',
        'type'     => 'select',
        'priority' => 16,
        'choices'  => array(
            'above' => __('Above Text', 'team1theme'),
            'below' => __('Below Text', 'team1theme'),
        ),
    ));
    // Hero Image Max Width
    $wp_customize->add_setting('hero_image_max_width', array(
        'default'           => '80',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('hero_image_max_width', array(
        'label'       => __('Hero Image Max Width (%)', 'team1theme'),
        'description' => __('Maximum width of the hero image', 'team1theme'),
        'section'     => 'homepage_settings',
        'type'        => 'range',
        'priority'    => 17,
        'input_attrs' => array(
            'min'  => 20,
            'max'  => 100,
            'step' => 5,
        ),
    ));
    // Add a separator/title for home posts settings
    $wp_customize->add_setting('home_posts_title_separator', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'home_posts_title_separator', array(
        'label'       => __('Home Posts Display Options', 'team1theme'),
        'description' => __('These settings control how posts in the "home" category display on the front page.', 'team1theme'),
        'section'     => 'homepage_settings',
        'type'        => 'hidden',
        'priority'    => 90, // Position at the end of the hero section settings
    )));
    // Enable/Disable links to single posts
    $wp_customize->add_setting('home_posts_enable_links', array(
        'default'           => true,
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('home_posts_enable_links', array(
        'label'       => __('Enable Links to Posts', 'team1theme'),
        'description' => __('When disabled, post titles and thumbnails will not link to single posts', 'team1theme'),
        'section'  => 'homepage_settings',
        'type'     => 'checkbox',
        'priority'    => 91,
    ));
    // Post Width
    $wp_customize->add_setting('home_posts_width', array(
        'default'           => '100',
        'sanitize_callback' => 'absint', 
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('home_posts_width', array(
        'label'       => __('Home Post Width (%)', 'team1theme'),
        'description' => __('Width of each post in the grid (50-100%)', 'team1theme'),
        'section'     => 'homepage_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 50,
            'max'  => 100, 
            'step' => 5,
        ),
        'priority'    => 92,
    ));
    // Post Header/Title Alignment
    $wp_customize->add_setting('home_posts_title_alignment', array(
        'default'           => 'left',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('home_posts_title_alignment', array(
        'label'    => __('Post Title Alignment', 'team1theme'),
        'section'  => 'homepage_settings',
        'type'     => 'select',
        'choices'  => array(
            'left'   => __('Left', 'team1theme'),
            'center' => __('Center', 'team1theme'),
            'right'  => __('Right', 'team1theme'),
        ),
        'priority' => 93,
    ));
    // Post Heading Tag (h3, h4, etc.)
    $wp_customize->add_setting('home_posts_heading_tag', array(
        'default'           => 'h3',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('home_posts_heading_tag', array(
        'label'       => __('Post Heading Size', 'team1theme'),
        'description' => __('Choose the HTML heading tag for post titles', 'team1theme'),
        'section'     => 'homepage_settings',
        'type'        => 'select',
        'choices'     => array(
            'h2' => __('H2 - Large', 'team1theme'),
            'h3' => __('H3 - Medium', 'team1theme'),
            'h4' => __('H4 - Small', 'team1theme'),
            'h5' => __('H5 - Smaller', 'team1theme'),
        ),
        'priority'    => 93,
    ));
    // Show/Hide Post Titles
    $wp_customize->add_setting('home_posts_show_titles', array(
        'default'           => true,
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('home_posts_show_titles', array(
        'label'       => __('Show Post Titles', 'team1theme'),
        'description' => __('Show or hide titles on homepage posts', 'team1theme'),
        'section'     => 'homepage_settings',
        'type'        => 'checkbox',
        'priority'    => 94, // Position before meta controls
    ));
    // Post Text Alignment
    $wp_customize->add_setting('home_posts_text_alignment', array(
        'default'           => 'left',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('home_posts_text_alignment', array(
        'label'    => __('Post Text Alignment', 'team1theme'),
        'section'  => 'homepage_settings',
        'type'     => 'select',
        'choices'  => array(
            'left'    => __('Left', 'team1theme'),
            'center'  => __('Center', 'team1theme'),
            'right'   => __('Right', 'team1theme'),
            'justify' => __('Justify', 'team1theme'),
        ),
        'priority' => 94,
    ));
    // Show/Hide Post Meta on Homepage
    $wp_customize->add_setting('home_posts_show_meta', array(
        'default'           => true,
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('home_posts_show_meta', array(
        'label'       => __('Show Post Meta Information', 'team1theme'),
        'description' => __('Show or hide date, author, etc. on homepage posts', 'team1theme'),
        'section'     => 'homepage_settings',
        'type'        => 'checkbox',
        'priority'    => 95,
    ));

    // Post Content Display Type
    $wp_customize->add_setting('home_posts_content_type', array(
        'default'           => 'excerpt',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('home_posts_content_type', array(
        'label'       => __('Post Content Display', 'team1theme'),
        'description' => __('Choose to display excerpt or full content for homepage posts', 'team1theme'),
        'section'     => 'homepage_settings',
        'type'        => 'select',
        'choices'     => array(
            'excerpt' => __('Excerpt Only', 'team1theme'),
            'content' => __('Full Content', 'team1theme'),
        ),
        'priority'    => 96,
    ));

    // Post Content Headings Alignment
    $wp_customize->add_setting('home_posts_headings_alignment', array(
        'default'           => 'left',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('home_posts_headings_alignment', array(
        'label'       => __('Content Headings Alignment', 'team1theme'),
        'description' => __('Alignment for headings (h1, h2, h3, etc.) inside post content', 'team1theme'),
        'section'     => 'homepage_settings',
        'type'        => 'select',
        'choices'     => array(
            'left'   => __('Left', 'team1theme'),
            'center' => __('Center', 'team1theme'),
            'right'  => __('Right', 'team1theme'),
        ),
        'priority'    => 97,
    ));
}
add_action('customize_register', 'team1_theme_homepage_customize_register');

/**
 * Add CSS for homepage customizer settings
 */
function team1theme_homepage_css() {
    if (is_front_page()) {
        $hero_header_align = get_theme_mod('hero_header_align', 'center');
        
        // Get home posts settings
        $posts_width = get_theme_mod('home_posts_width', '100');
        $title_alignment = get_theme_mod('home_posts_title_alignment', 'left');
        $text_alignment = get_theme_mod('home_posts_text_alignment', 'left');
        $headings_alignment = get_theme_mod('home_posts_headings_alignment', 'left');
        
        ?>
        <style type="text/css">
            .hero-section h1,
            .hero-section .hero-heading,
            .home-hero-heading {
                text-align: <?php echo esc_attr($hero_header_align); ?>;
            }
            
            /* Home Posts Styling */
            .home-post-item {
                width: <?php echo esc_attr($posts_width); ?>%;
                margin-left: auto;
                margin-right: auto;
            }
            .home-post-item .entry-title {
                text-align: <?php echo esc_attr($title_alignment); ?>;
            }
            .home-post-item .post-content {
                text-align: <?php echo esc_attr($text_alignment); ?>;
            }
            .home-post-item .entry-summary,
            .home-post-item .entry-content,
            .home-post-item .entry-meta,
            .home-post-item .entry-summary p,
            .home-post-item .entry-content p {
                text-align: <?php echo esc_attr($text_alignment); ?>;
            }
            .home-post-item .entry-content h1,
            .home-post-item .entry-content h2,
            .home-post-item .entry-content h3,
            .home-post-item .entry-content h4,
            .home-post-item .entry-content h5 {
                text-align: <?php echo esc_attr($headings_alignment); ?>;
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'team1theme_homepage_css', 20);
