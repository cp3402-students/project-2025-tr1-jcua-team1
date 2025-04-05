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
    // First ensure our custom control class is available
    if (class_exists('Team1Theme_Color_Scheme_Control')) {
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
            'sanitize_callback' => 'sanitize_text_field', // Allow CSS variables
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control(new Team1Theme_Color_Scheme_Control($wp_customize, 'hero_bg_color', array(
            'label'    => __('Hero Background Color', 'team1theme'),
            'description' => __('Choose from theme colors or select a custom color', 'team1theme'),
            'section'  => 'homepage_settings',
            'priority' => 10,
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
            'sanitize_callback' => 'sanitize_text_field', // Allow CSS variables
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control(new Team1Theme_Color_Scheme_Control($wp_customize, 'hero_text_color', array(
            'label'    => __('Hero Text Color', 'team1theme'),
            'description' => __('Choose from theme colors or select a custom color', 'team1theme'),
            'section'  => 'homepage_settings',
            'priority' => 13,
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

        // Image Carousel Settings
        // Add a separator/title for carousel settings
        $wp_customize->add_setting('carousel_title_separator', array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'carousel_title_separator', array(
            'label'       => __('Image Carousel Settings', 'team1theme'),
            'description' => __('Configure the image carousel that appears on the homepage.', 'team1theme'),
            'section'     => 'homepage_settings',
            'type'        => 'hidden',
            'priority'    => 200, // Position after all hero settings
        )));
        
        // Enable/Disable Carousel
        $wp_customize->add_setting('carousel_enable', array(
            'default'           => false,
            'sanitize_callback' => 'team1_theme_sanitize_checkbox',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control('carousel_enable', array(
            'label'       => __('Enable Image Carousel', 'team1theme'),
            'description' => __('Show or hide the image carousel on the homepage', 'team1theme'),
            'section'     => 'homepage_settings',
            'type'        => 'checkbox',
            'priority'    => 201,
        ));
        
        // Carousel Width
        $wp_customize->add_setting('carousel_width', array(
            'default'           => '100',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control('carousel_width', array(
            'label'       => __('Carousel Width (%)', 'team1theme'),
            'description' => __('Width of the carousel container (50-100%)', 'team1theme'),
            'section'     => 'homepage_settings',
            'type'        => 'range',
            'input_attrs' => array(
                'min'  => 50,
                'max'  => 100,
                'step' => 5,
            ),
            'priority'    => 204,
        ));
        
        // Show/Hide Captions
        $wp_customize->add_setting('carousel_show_captions', array(
            'default'           => true,
            'sanitize_callback' => 'team1_theme_sanitize_checkbox',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control('carousel_show_captions', array(
            'label'       => __('Show Image Captions', 'team1theme'),
            'description' => __('Show or hide captions on carousel images', 'team1theme'),
            'section'     => 'homepage_settings',
            'type'        => 'checkbox',
            'priority'    => 205,
        ));
        
        // Carousel Speed
        $wp_customize->add_setting('carousel_speed', array(
            'default'           => '5000',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control('carousel_speed', array(
            'label'       => __('Carousel Speed (ms)', 'team1theme'),
            'description' => __('Time between automatic slide transitions in milliseconds (1000 = 1 second)', 'team1theme'),
            'section'     => 'homepage_settings',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 1000,
                'max'  => 10000,
                'step' => 500,
            ),
            'priority'    => 206,
        ));
        
        // Carousel Image Size Normalization
        $wp_customize->add_setting('carousel_image_height', array(
            'default'           => 'auto',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control('carousel_image_height', array(
            'label'       => __('Carousel Image Height', 'team1theme'),
            'description' => __('Choose how to normalize image heights in the carousel', 'team1theme'),
            'section'     => 'homepage_settings',
            'type'        => 'select',
            'choices'     => array(
                'auto'        => __('Auto (Original Heights)', 'team1theme'),
                'fixed'       => __('Fixed Height', 'team1theme'),
                'ratio'       => __('Maintain Aspect Ratio', 'team1theme'),
                'cover'       => __('Cover/Crop Images', 'team1theme'),
            ),
            'priority'    => 207,
        ));
        
        // Carousel Container Height (%) - NEW SETTING
        $wp_customize->add_setting('carousel_container_height', array(
            'default'           => '100',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control('carousel_container_height', array(
            'label'       => __('Carousel Container Height (%)', 'team1theme'),
            'description' => __('Adjust the overall height of the carousel container (50-150%)', 'team1theme'),
            'section'     => 'homepage_settings',
            'type'        => 'range',
            'input_attrs' => array(
                'min'  => 50,
                'max'  => 150,
                'step' => 5,
            ),
            'priority'    => 207.5, // Between image height choice and fixed height
        ));
        
        // Fixed Image Height (px)
        $wp_customize->add_setting('carousel_fixed_height', array(
            'default'           => '400',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control('carousel_fixed_height', array(
            'label'       => __('Fixed Image Height (px)', 'team1theme'),
            'description' => __('Set the exact height for all carousel images (when Fixed Height is selected)', 'team1theme'),
            'section'     => 'homepage_settings',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 100,
                'max'  => 800,
                'step' => 10,
            ),
            'priority'    => 208,
        ));
        
        // Aspect Ratio
        $wp_customize->add_setting('carousel_aspect_ratio', array(
            'default'           => '16:9',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control('carousel_aspect_ratio', array(
            'label'       => __('Image Aspect Ratio', 'team1theme'),
            'description' => __('Choose aspect ratio for carousel images (when Maintain Aspect Ratio is selected)', 'team1theme'),
            'section'     => 'homepage_settings',
            'type'        => 'select',
            'choices'     => array(
                '16:9' => __('16:9 (Widescreen)', 'team1theme'),
                '4:3'  => __('4:3 (Standard)', 'team1theme'),
                '1:1'  => __('1:1 (Square)', 'team1theme'),
                '3:2'  => __('3:2 (Classic Photo)', 'team1theme'),
                '2:1'  => __('2:1 (Panorama)', 'team1theme'),
            ),
            'priority'    => 209,
        ));
        
        // Carousel Images (up to 5)
        for ($i = 1; $i <= 5; $i++) {
            // Image
            $wp_customize->add_setting('carousel_image_' . $i, array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
                'transport'         => 'refresh',
            ));
            
            $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'carousel_image_' . $i, array(
                'label'       => sprintf(__('Carousel Image %d', 'team1theme'), $i),
                'description' => __('Select an image for the carousel', 'team1theme'),
                'section'     => 'homepage_settings',
                'priority'    => 210 + (($i - 1) * 3),
            )));
            
            // Caption
            $wp_customize->add_setting('carousel_caption_' . $i, array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'refresh',
            ));
            
            $wp_customize->add_control('carousel_caption_' . $i, array(
                'label'       => sprintf(__('Image %d Caption', 'team1theme'), $i),
                'description' => __('Optional caption for this image', 'team1theme'),
                'section'     => 'homepage_settings',
                'type'        => 'text',
                'priority'    => 210 + (($i - 1) * 3) + 1,
            ));
            
            // Link
            $wp_customize->add_setting('carousel_link_' . $i, array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
                'transport'         => 'refresh',
            ));
            
            $wp_customize->add_control('carousel_link_' . $i, array(
                'label'       => sprintf(__('Image %d Link', 'team1theme'), $i),
                'description' => __('Optional URL to link this image to', 'team1theme'),
                'section'     => 'homepage_settings',
                'type'        => 'url',
                'priority'    => 210 + (($i - 1) * 3) + 2,
            ));
        }
        
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
            'priority'    => 300, // Position after carousel settings
        )));

    } else {
        // If custom control class is not available, fall back to standard color controls
        // Rest of your standard customizer code here...
    }

    // Enable/Disable links to single posts
}
add_action('customize_register', 'team1_theme_homepage_customize_register');

/**
 * Sanitize checkbox values
 */
function team1_theme_sanitize_checkbox($checked) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Add CSS for homepage customizer settings
 */
function team1theme_homepage_css() {
    if (is_front_page()) {
        $hero_header_align = get_theme_mod('hero_header_align', 'center');
        
        // Get carousel settings
        $carousel_enabled = get_theme_mod('carousel_enable', false);
        $carousel_speed = get_theme_mod('carousel_speed', '5000');
        $carousel_img_height = get_theme_mod('carousel_image_height', 'auto');
        $carousel_fixed_height = get_theme_mod('carousel_fixed_height', '400');
        $carousel_aspect_ratio = get_theme_mod('carousel_aspect_ratio', '16:9');
        $carousel_container_height = get_theme_mod('carousel_container_height', '100');
        $carousel_width = get_theme_mod('carousel_width', '100');
        
        // Get aspect ratio values for CSS
        $aspect_ratio_css = '16 / 9'; // Default
        if ($carousel_aspect_ratio === '4:3') {
            $aspect_ratio_css = '4 / 3';
        } elseif ($carousel_aspect_ratio === '1:1') {
            $aspect_ratio_css = '1 / 1';
        } elseif ($carousel_aspect_ratio === '3:2') {
            $aspect_ratio_css = '3 / 2';
        } elseif ($carousel_aspect_ratio === '2:1') {
            $aspect_ratio_css = '2 / 1';
        }
        
        // Get home posts settings
        $posts_width = get_theme_mod('home_posts_width', '100');
        $title_alignment = get_theme_mod('home_posts_title_alignment', 'left');
        $text_alignment = get_theme_mod('home_posts_text_alignment', 'left');
        $headings_alignment = get_theme_mod('home_posts_headings_alignment', 'left');
        
        // Process and handle CSS variables for colors
        $hero_bg_color = get_theme_mod('hero_bg_color', '#f8f9fa');
        $hero_text_color = get_theme_mod('hero_text_color', '#333333');
        
        // Handle both hex colors and CSS variables
        // By not processing CSS variables with esc_attr, we allow them to work as intended
        ?>
        <style type="text/css">
            .hero-section h1,
            .hero-section .hero-heading,
            .home-hero-heading {
                text-align: <?php echo esc_attr($hero_header_align); ?>;
            }
            
            /* Apply hero background color properly - handle CSS variables */
            .hero-section {
                background-color: <?php echo $hero_bg_color; ?>;
                color: <?php echo $hero_text_color; ?>;
            }
            
            /* Carousel Styling */
            .image-carousel-section {
                padding: 40px 0;
            }
            
            /* Container for the whole carousel section - improved centering */
            .image-carousel-section .container {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
            
            .carousel-container {
                position: relative;
                overflow: hidden;
                width: <?php echo esc_attr($carousel_width); ?>%;
                height: <?php echo esc_attr($carousel_container_height); ?>%;
                margin: 0 auto;
                max-width: 100%;
            }
            
            .carousel-slider {
                display: flex;
                transition: transform 0.5s ease-in-out;
                height: 100%; /* Use full height of container */
            }
            
            .carousel-slide {
                flex: 0 0 100%;
                position: relative;
                margin: 0;
                padding: 0;
                min-width: 100%;
                overflow: hidden;
            }
            
            <?php if ($carousel_img_height === 'fixed') : ?>
            .carousel-slide {
                height: <?php echo esc_attr($carousel_fixed_height); ?>px;
            }
            
            .carousel-slide img {
                width: 100%;
                height: <?php echo esc_attr($carousel_fixed_height); ?>px;
                object-fit: cover;
                object-position: center;
                display: block;
                margin: 0 auto;
            }
            <?php elseif ($carousel_img_height === 'cover') : ?>
            .carousel-slide {
                width: 100%;
                position: relative;
                aspect-ratio: <?php echo esc_attr($aspect_ratio_css); ?>;
                overflow: hidden;
            }
            
            .carousel-slide img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center;
                display: block;
                margin: 0 auto;
            }
            <?php else : /* Auto height */ ?>
            .carousel-slide img {
                max-width: 100%;
                max-height: 100%; /* Respect container height */
                width: auto;
                height: auto;
                display: block;
                margin: 0 auto;
            }
            <?php endif; ?>
            
            .carousel-caption {
                background-color: rgba(0, 0, 0, 0.5);
                color: white;
                padding: 10px;
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                text-align: center;
            }
            
            /* Controls section - ensure proper centering */
            .carousel-controls {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 15px;
                width: 100%;
            }
            
            .carousel-prev,
            .carousel-next {
                background-color: #333;
                color: white;
                border: none;
                padding: 8px 15px;
                margin: 0 10px;
                cursor: pointer;
                border-radius: 3px;
            }
            
            .carousel-dots {
                display: flex;
                justify-content: center;
                margin: 0 10px;
            }
            
            .carousel-dot {
                width: 10px;
                height: 10px;
                background-color: #bbb;
                border-radius: 50%;
                margin: 0 5px;
                border: none;
                padding: 0;
                cursor: pointer;
            }
            
            .carousel-dot.active {
                background-color: #333;
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
        
        <?php if ($carousel_enabled) : ?>
        <script type="text/javascript">
        (function() {
            document.addEventListener('DOMContentLoaded', function() {
                const slider = document.querySelector('.carousel-slider');
                const slides = document.querySelectorAll('.carousel-slide');
                const dots = document.querySelectorAll('.carousel-dot');
                const prevBtn = document.querySelector('.carousel-prev');
                const nextBtn = document.querySelector('.carousel-next');
                
                if (!slider || slides.length === 0) return;
                
                let currentSlide = 0;
                let interval = null;
                const slideCount = slides.length;
                const slideInterval = <?php echo esc_js($carousel_speed); ?>;
                
                // Set initial position
                updateSlider();
                
                // Auto-advance slides
                startAutoSlide();
                
                // Add event listeners
                if (prevBtn) {
                    prevBtn.addEventListener('click', function() {
                        stopAutoSlide();
                        navigateSlide(-1);
                        startAutoSlide();
                    });
                }
                
                if (nextBtn) {
                    nextBtn.addEventListener('click', function() {
                        stopAutoSlide();
                        navigateSlide(1);
                        startAutoSlide();
                    });
                }
                
                // Add event listeners to dots if they exist
                dots.forEach(function(dot, index) {
                    dot.addEventListener('click', function() {
                        stopAutoSlide();
                        goToSlide(index);
                        startAutoSlide();
                    });
                });
                
                function startAutoSlide() {
                    if (slideCount > 1) {
                        interval = setInterval(function() {
                            navigateSlide(1);
                        }, slideInterval);
                    }
                }
                
                function stopAutoSlide() {
                    clearInterval(interval);
                }
                
                function navigateSlide(direction) {
                    currentSlide = (currentSlide + direction + slideCount) % slideCount;
                    updateSlider();
                }
                
                function goToSlide(index) {
                    currentSlide = index;
                    updateSlider();
                }
                
                function updateSlider() {
                    // Update slider position
                    slider.style.transform = `translateX(-${currentSlide * 100}%)`;
                    
                    // Update active dot
                    dots.forEach(function(dot, index) {
                        if (index === currentSlide) {
                            dot.classList.add('active');
                        } else {
                            dot.classList.remove('active');
                        }
                    });
                }
            });
        })();
        </script>
        <?php endif; ?>
        <?php
    }
}
add_action('wp_head', 'team1theme_homepage_css', 20);
