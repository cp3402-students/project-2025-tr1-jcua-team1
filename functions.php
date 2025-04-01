<?php
/**
 * Team1Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Team1Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function team1theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Team1Theme, use a find and replace
		* to change 'team1theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'team1theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'team1theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'team1theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => false,
		)
	);
}
add_action( 'after_setup_theme', 'team1theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function team1theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'team1theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'team1theme_content_width', 0 );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function team1theme_widgets_init() {
    // Main Sidebar (already exists)
    register_sidebar(
        array(
            'name'          => esc_html__('Main Sidebar', 'team1theme'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here to appear in your main sidebar.', 'team1theme'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
    
    // Blog/Archive Sidebar
    register_sidebar(
        array(
            'name'          => esc_html__('Blog Sidebar', 'team1theme'),
            'id'            => 'sidebar-blog',
            'description'   => esc_html__('Add widgets here to appear on blog and archive pages.', 'team1theme'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
    
    // Single Post Sidebar
    register_sidebar(
        array(
            'name'          => esc_html__('Post Sidebar', 'team1theme'),
            'id'            => 'sidebar-post',
            'description'   => esc_html__('Add widgets here to appear on single post pages.', 'team1theme'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
    
    // Page Sidebar
    register_sidebar(
        array(
            'name'          => esc_html__('Page Sidebar', 'team1theme'),
            'id'            => 'sidebar-page',
            'description'   => esc_html__('Add widgets here to appear on static pages.', 'team1theme'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
    
    // Footer Widgets (3 columns)
    register_sidebar(
        array(
            'name'          => esc_html__('Footer 1', 'team1theme'),
            'id'            => 'footer-1',
            'description'   => esc_html__('Add widgets here to appear in footer column 1.', 'team1theme'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
    
    register_sidebar(
        array(
            'name'          => esc_html__('Footer 2', 'team1theme'),
            'id'            => 'footer-2',
            'description'   => esc_html__('Add widgets here to appear in footer column 2.', 'team1theme'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
    
    register_sidebar(
        array(
            'name'          => esc_html__('Footer 3', 'team1theme'),
            'id'            => 'footer-3',
            'description'   => esc_html__('Add widgets here to appear in footer column 3.', 'team1theme'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
    
    // Optional: Shop sidebar for WooCommerce if applicable
    if (function_exists('is_woocommerce')) {
        register_sidebar(
            array(
                'name'          => esc_html__('Shop Sidebar', 'team1theme'),
                'id'            => 'sidebar-shop',
                'description'   => esc_html__('Add widgets here to appear on shop pages.', 'team1theme'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
    }
}
add_action('widgets_init', 'team1theme_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function team1theme_scripts() {
	wp_enqueue_style( 'team1theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'team1theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'team1theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'team1theme_scripts' );

/**
 * Filter the custom logo to ensure consistent sizing
 */
function team1theme_custom_logo_setup($html) {
    // Get theme logo dimensions
    $custom_logo_args = get_theme_support('custom-logo');
    $logo_height = isset($custom_logo_args[0]['height']) ? $custom_logo_args[0]['height'] : 100;
    
    // Add custom class to the logo image for specific styling
    $html = str_replace('class="custom-logo"', 'class="custom-logo" style="max-height:' . $logo_height . 'px;"', $html);
    
    return $html;
}
add_filter('get_custom_logo', 'team1theme_custom_logo_setup');

/**
 * Set image size for logo uploads
 */
function team1theme_custom_logo_image_size() {
    // Get theme logo dimensions
    $custom_logo_args = get_theme_support('custom-logo');
    $logo_height = isset($custom_logo_args[0]['height']) ? $custom_logo_args[0]['height'] : 100;
    $logo_width = isset($custom_logo_args[0]['width']) ? $custom_logo_args[0]['width'] : 250;
    
    // Add logo size
    add_image_size('team1theme-logo', $logo_width, $logo_height, false);
}
add_action('after_setup_theme', 'team1theme_custom_logo_image_size', 11);

/**
 * Add Homepage Customizer Settings
 */
function team1_theme_customize_register( $wp_customize ) {
    // Add a section for homepage settings
    $wp_customize->add_section( 'homepage_settings', array(
        'title'    => __( 'Homepage Settings', 'team1theme' ),
        'priority' => 30,
    ) );

    // Hero Heading
    $wp_customize->add_setting( 'hero_heading', array(
        'default'           => 'Welcome to Our Website',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'hero_heading', array(
        'label'    => __( 'Hero Heading', 'team1theme' ),
        'section'  => 'homepage_settings',
        'type'     => 'text',
    ) );

    // Hero Text
    $wp_customize->add_setting( 'hero_text', array(
        'default'           => 'This is your custom homepage. Add your content here.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'hero_text', array(
        'label'    => __( 'Hero Text', 'team1theme' ),
        'section'  => 'homepage_settings',
        'type'     => 'textarea',
    ) );
    
    // Hero Background Color
    $wp_customize->add_setting( 'hero_bg_color', array(
        'default'           => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_bg_color', array(
        'label'    => __( 'Hero Background Color', 'team1theme' ),
        'section'  => 'homepage_settings',
    ) ) );

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
    $wp_customize->add_setting( 'hero_text_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_text_color', array(
        'label'    => __( 'Hero Text Color', 'team1theme' ),
        'section'  => 'homepage_settings',
    ) ) );
    
    // Hero Text Alignment
    $wp_customize->add_setting( 'hero_text_align', array(
        'default'           => 'center',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'hero_text_align', array(
        'label'    => __( 'Text Alignment', 'team1theme' ),
        'section'  => 'homepage_settings',
        'type'     => 'select',
        'choices'  => array(
            'left'   => __( 'Left', 'team1theme' ),
            'center' => __( 'Center', 'team1theme' ),
            'right'  => __( 'Right', 'team1theme' ),
        ),
    ) );
    
    // Hero Width
    $wp_customize->add_setting( 'hero_width', array(
        'default'           => '100',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'hero_width', array(
        'label'       => __( 'Hero Section Width (%)', 'team1theme' ),
        'description' => __( 'Width of the hero section content (50-100%)', 'team1theme' ),
        'section'     => 'homepage_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 50,
            'max'  => 100,
            'step' => 5,
        ),
    ) );
    
    // Hero Button Text
    $wp_customize->add_setting( 'hero_button_text', array(
        'default'           => 'Learn More',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'hero_button_text', array(
        'label'    => __( 'Hero Button Text', 'team1theme' ),
        'section'  => 'homepage_settings',
        'type'     => 'text',
    ) );
    
    // Hero Button URL
    $wp_customize->add_setting( 'hero_button_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'hero_button_url', array(
        'label'    => __( 'Hero Button URL', 'team1theme' ),
        'section'  => 'homepage_settings',
        'type'     => 'url',
    ) );
}
add_action( 'customize_register', 'team1_theme_customize_register' );

/**
 * Add Footer Customizer Settings
 */
function team1_theme_footer_customize_register( $wp_customize ) {
    // Add a section for footer settings
    $wp_customize->add_section( 'footer_settings', array(
        'title'    => __( 'Footer Settings', 'team1theme' ),
        'priority' => 90,
    ) );

    // Footer Text
    $wp_customize->add_setting( 'footer_text', array(
        'default'           => 'Copyright © ' . date('Y') . ' ' . get_bloginfo('name'),
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'footer_text', array(
        'label'    => __( 'Footer Text', 'team1theme' ),
        'section'  => 'footer_settings',
        'type'     => 'textarea',
    ) );

    // Footer Background Color
    $wp_customize->add_setting( 'footer_bg_color', array(
        'default'           => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bg_color', array(
        'label'    => __( 'Footer Background Color', 'team1theme' ),
        'section'  => 'footer_settings',
    ) ) );

    // Footer Text Color
    $wp_customize->add_setting( 'footer_text_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_color', array(
        'label'    => __( 'Footer Text Color', 'team1theme' ),
        'section'  => 'footer_settings',
    ) ) );
    
    // Footer Height (Padding)
    $wp_customize->add_setting( 'footer_padding', array(
        'default'           => '20',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'footer_padding', array(
        'label'       => __( 'Footer Padding (px)', 'team1theme' ),
        'description' => __( 'Controls the top and bottom padding of the footer', 'team1theme' ),
        'section'     => 'footer_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 100,
            'step' => 5,
        ),
    ) );
    
    // Footer Text Alignment
    $wp_customize->add_setting( 'footer_text_align', array(
        'default'           => 'center',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'footer_text_align', array(
        'label'    => __( 'Footer Text Alignment', 'team1theme' ),
        'section'  => 'footer_settings',
        'type'     => 'select',
        'choices'  => array(
            'left'   => __( 'Left', 'team1theme' ),
            'center' => __( 'Center', 'team1theme' ),
            'right'  => __( 'Right', 'team1theme' ),
        ),
    ) );
}
add_action( 'customize_register', 'team1_theme_footer_customize_register' );

/**
 * Add Header Customizer Settings
 */
function team1_theme_header_customize_register( $wp_customize ) {
    // Add a section for header settings
    $wp_customize->add_section( 'header_settings', array(
        'title'    => __( 'Header Settings', 'team1theme' ),
        'priority' => 40, // Adjust as needed
    ) );

    // Header Background Color
    $wp_customize->add_setting( 'header_bg_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color', array(
        'label'    => __( 'Header Background Color', 'team1theme' ),
        'section'  => 'header_settings',
    ) ) );

    // Header Text Color
    $wp_customize->add_setting( 'header_text_color', array(
        'default'           => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_text_color', array(
        'label'    => __( 'Header Text Color', 'team1theme' ),
        'section'  => 'header_settings',
    ) ) );

    // Header Padding (Height)
    $wp_customize->add_setting( 'header_padding', array(
        'default'           => '20',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'header_padding', array(
        'label'       => __( 'Header Padding (px)', 'team1theme' ),
        'description' => __( 'Controls the top and bottom padding of the header', 'team1theme' ),
        'section'     => 'header_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 100,
            'step' => 5,
        ),
    ) );

    // Header Text Alignment
    $wp_customize->add_setting( 'header_text_align', array(
        'default'           => 'left',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'header_text_align', array(
        'label'    => __( 'Header Text Alignment', 'team1theme' ),
        'section'  => 'header_settings',
        'type'     => 'select',
        'choices'  => array(
            'left'   => __( 'Left', 'team1theme' ),
            'center' => __( 'Center', 'team1theme' ),
            'right'  => __( 'Right', 'team1theme' ),
        ),
    ) );

    // Header Link Font Size
    $wp_customize->add_setting( 'header_link_font_size', array(
        'default'           => '16',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'header_link_font_size', array(
        'label'       => __( 'Header Link Font Size (px)', 'team1theme' ),
        'section'     => 'header_settings',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 10,
            'max'  => 30,
            'step' => 1,
        ),
    ) );

    // Header Link Color
    $wp_customize->add_setting( 'header_link_color', array(
        'default'           => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_link_color', array(
        'label'    => __( 'Header Link Color', 'team1theme' ),
        'section'  => 'header_settings',
    ) ) );

    // Navigation Background Color
    $wp_customize->add_setting('nav_bg_color', array(
        'default'           => 'transparent',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nav_bg_color', array(
        'label'    => __('Navigation Background Color', 'team1theme'),
        'section'  => 'header_settings',
    )));

    // Navigation Link Hover Color
    $wp_customize->add_setting('nav_link_hover_color', array(
        'default'           => '#4169e1', // Your primary color
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nav_link_hover_color', array(
        'label'    => __('Navigation Link Hover Color', 'team1theme'),
        'section'  => 'header_settings',
    )));

    // Navigation Link Spacing
    $wp_customize->add_setting('nav_link_spacing', array(
        'default'           => '15',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('nav_link_spacing', array(
        'label'       => __('Navigation Link Spacing (px)', 'team1theme'),
        'section'     => 'header_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 5,
            'max'  => 30,
            'step' => 1,
        ),
    ));
}
add_action( 'customize_register', 'team1_theme_header_customize_register' );

/**
 * Add Blog Post Customizer Settings
 */
function team1_theme_blog_customize_register($wp_customize) {
    // Add a section for blog post settings
    $wp_customize->add_section('blog_post_settings', array(
        'title'    => __('Blog Post Settings', 'team1theme'),
        'priority' => 45,
    ));

    // Post Layout Options
    $wp_customize->add_setting('post_layout', array(
        'default'           => 'with-sidebar',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('post_layout', array(
        'label'    => __('Default Post Layout', 'team1theme'),
        'section'  => 'blog_post_settings',
        'type'     => 'select',
        'choices'  => array(
            'with-sidebar' => __('With Sidebar', 'team1theme'),
            'full-width'   => __('Full Width', 'team1theme'),
            'narrow'       => __('Narrow Content', 'team1theme'),
        ),
    ));

    // Featured Image Display
    $wp_customize->add_setting('post_featured_image_display', array(
        'default'           => 'above',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('post_featured_image_display', array(
        'label'    => __('Featured Image Display', 'team1theme'),
        'section'  => 'blog_post_settings',
        'type'     => 'select',
        'choices'  => array(
            'none'       => __('Do Not Display', 'team1theme'),
            'banner'     => __('Full Width Banner', 'team1theme'),
            'above'      => __('Above Content', 'team1theme'),
            'background' => __('Page Background', 'team1theme'),
        ),
    ));

    // Post Content Background Color
    $wp_customize->add_setting('post_content_bg', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'post_content_bg', array(
        'label'    => __('Post Content Background', 'team1theme'),
        'section'  => 'blog_post_settings',
    )));

    // Post Content Padding
    $wp_customize->add_setting('post_content_padding', array(
        'default'           => '30',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('post_content_padding', array(
        'label'       => __('Content Padding (px)', 'team1theme'),
        'section'     => 'blog_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 100,
            'step' => 5,
        ),
    ));

    // Show/Hide Post Meta (date, author, categories, etc.)
    $wp_customize->add_setting('show_post_meta', array(
        'default'           => true,
        'sanitize_callback' => 'team1theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('show_post_meta', array(
        'label'    => __('Show Post Meta Information', 'team1theme'),
        'section'  => 'blog_post_settings',
        'type'     => 'checkbox',
    ));

    // Heading Alignment
    $wp_customize->add_setting('post_heading_alignment', array(
        'default'           => 'left',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('post_heading_alignment', array(
        'label'    => __('Heading Alignment', 'team1theme'),
        'section'  => 'blog_post_settings',
        'type'     => 'select',
        'choices'  => array(
            'left'   => __('Left', 'team1theme'),
            'center' => __('Center', 'team1theme'),
            'right'  => __('Right', 'team1theme'),
        ),
    ));

    // Text Alignment
    $wp_customize->add_setting('post_text_alignment', array(
        'default'           => 'left',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('post_text_alignment', array(
        'label'    => __('Text Alignment', 'team1theme'),
        'section'  => 'blog_post_settings',
        'type'     => 'select',
        'choices'  => array(
            'left'    => __('Left', 'team1theme'),
            'center'  => __('Center', 'team1theme'),
            'right'   => __('Right', 'team1theme'),
            'justify' => __('Justify', 'team1theme'),
        ),
    ));
}
add_action('customize_register', 'team1_theme_blog_customize_register');

/**
 * Generate custom CSS for blog post templates
 */
function team1theme_post_customizer_css() {
    if (!is_singular('post')) {
        return;
    }
    
    // Get post background and padding from customizer
    $post_bg = get_theme_mod('post_content_bg', '#ffffff');
    $post_padding = get_theme_mod('post_content_padding', '30');

    // Get heading and text alignment from customizer
    $heading_alignment = get_theme_mod('post_heading_alignment', 'left');
    $text_alignment = get_theme_mod('post_text_alignment', 'left');
    
    // Get post-specific layout
    $post_id = get_the_ID();
    $post_layout = get_post_meta($post_id, '_team1theme_post_layout', true);
    if ($post_layout === 'default' || empty($post_layout)) {
        $post_layout = get_theme_mod('post_layout', 'with-sidebar');
    }
    
    // Get featured image setting
    $featured_image_display = get_post_meta($post_id, '_team1theme_featured_image_display', true);
    if ($featured_image_display === 'default' || empty($featured_image_display)) {
        $featured_image_display = get_theme_mod('post_featured_image_display', 'above');
    }

    // Get heading and text alignment from post meta, if set
    $post_heading_alignment = get_post_meta($post_id, '_team1theme_heading_alignment', true);
    if ($post_heading_alignment === 'default' || empty($post_heading_alignment)) {
        $post_heading_alignment = $heading_alignment;
    }

    $post_text_alignment = get_post_meta($post_id, '_team1theme_text_alignment', true);
    if ($post_text_alignment === 'default' || empty($post_text_alignment)) {
        $post_text_alignment = $text_alignment;
    }
    ?>
    <style type="text/css">
        /* Base styling for single posts */
        .single-post .site-main {
            background-color: <?php echo esc_attr($post_bg); ?>;
            padding: <?php echo esc_attr($post_padding); ?>px;
        }

        /* Heading Alignment */
        .single-post .entry-title {
            text-align: <?php echo esc_attr($post_heading_alignment); ?>;
        }

        /* Text Alignment - Increased specificity and added !important to override theme defaults */
        .single-post #primary .entry-content,
        .single-post #primary .entry-content p {
            text-align: <?php echo esc_attr($post_text_alignment); ?> !important;
        }
        
        /* Layout: Full Width */
        .single-post .post-layout-full-width {
            width: 100%;
            max-width: 100%;
        }
        
        /* Layout: Narrow */
        .single-post .post-layout-narrow {
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Featured Image: Banner */
        .single-post .post-featured-banner {
            margin: -<?php echo esc_attr($post_padding); ?>px -<?php echo esc_attr($post_padding); ?>px <?php echo esc_attr($post_padding); ?>px;
            max-width: none;
        }
        
        .single-post .post-featured-banner img {
            width: 100%;
            height: auto;
            display: block;
        }
        
        /* Featured Image: Background */
        .single-post .featured-image-background {
            position: relative;
        }
        
        .single-post .featured-image-background:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'full')); ?>');
            background-size: cover;
            background-position: center;
            opacity: 0.15;
            z-index: -1;
        }
    </style>
    <?php
}
add_action('wp_head', 'team1theme_post_customizer_css', 25);

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Page template customization options.
 */
require get_template_directory() . '/inc/page-customizer.php';

/**
 * Page-specific meta boxes for overriding theme defaults.
 */
require get_template_directory() . '/inc/page-meta-boxes.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Add simple blog post meta box settings
 */
require get_template_directory() . '/inc/post-meta-boxes.php';

/**
 * Archive customization options.
 */
require get_template_directory() . '/inc/archive-customizer.php';

