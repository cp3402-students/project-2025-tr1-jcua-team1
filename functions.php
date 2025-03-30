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
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function team1theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'team1theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'team1theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'team1theme_widgets_init' );

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

