<?php
/**
 * Team1Theme Theme Customizer
 *
 * @package Team1Theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function team1theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'team1theme_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'team1theme_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'team1theme_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function team1theme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function team1theme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function team1theme_customize_preview_js() {
	wp_enqueue_script( 'team1theme-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'team1theme_customize_preview_js' );

/**
 * Add logo size controls to the customizer
 */
function team1theme_logo_customize_register($wp_customize) {
    // Header Section
    $wp_customize->add_section('team1theme_logo_options', array(
        'title'       => __('Logo Options', 'team1theme'),
        'priority'    => 30,
        'description' => __('Adjust your logo and header sizing', 'team1theme'),
    ));
    
    // Header Height Setting
    $wp_customize->add_setting('team1theme_header_height', array(
        'default'           => 100,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    
    // Header Height Control
    $wp_customize->add_control('team1theme_header_height', array(
        'label'       => __('Header Height (px)', 'team1theme'),
        'section'     => 'team1theme_logo_options',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 50,
            'max'  => 250,
            'step' => 10,
        ),
    ));
}
add_action('customize_register', 'team1theme_logo_customize_register');

/**
 * Apply customizer header height to CSS
 */
function team1theme_logo_customize_css() {
    $header_height = get_theme_mod('team1theme_header_height', 100);
    
    $css = "
        .site-header {
            min-height: {$header_height}px;
        }
        .site-branding {
            min-height: {$header_height}px;
        }
        .custom-logo {
            max-height: {$header_height}px;
        }
    ";
    
    wp_add_inline_style('team1theme-style', $css);
}
add_action('wp_enqueue_scripts', 'team1theme_logo_customize_css', 20);

/**
 * Add 404 page customization options
 */
function team1theme_404_customize_register($wp_customize) {
    // Add 404 Page Section
    $wp_customize->add_section('team1theme_404_options', array(
        'title'       => __('404 Page Options', 'team1theme'),
        'priority'    => 40,
        'description' => __('Customize your 404 error page', 'team1theme'),
    ));
    
    // 404 title
    $wp_customize->add_setting('team1theme_404_title', array(
        'default'           => __('Oops! That page can\'t be found.', 'team1theme'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('team1theme_404_title', array(
        'label'    => __('404 Page Title', 'team1theme'),
        'section'  => 'team1theme_404_options',
        'type'     => 'text',
    ));
    
    // 404 message
    $wp_customize->add_setting('team1theme_404_message', array(
        'default'           => __('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'team1theme'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('team1theme_404_message', array(
        'label'    => __('404 Page Message', 'team1theme'),
        'section'  => 'team1theme_404_options',
        'type'     => 'textarea',
    ));
    
    // Show search form
    $wp_customize->add_setting('team1theme_404_show_search', array(
        'default'           => true,
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('team1theme_404_show_search', array(
        'label'    => __('Show Search Form', 'team1theme'),
        'section'  => 'team1theme_404_options',
        'type'     => 'checkbox',
    ));
    
    // Show widgets
    $wp_customize->add_setting('team1theme_404_show_widgets', array(
        'default'           => true,
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('team1theme_404_show_widgets', array(
        'label'    => __('Show Helpful Widgets', 'team1theme'),
        'section'  => 'team1theme_404_options',
        'type'     => 'checkbox',
    ));
}
add_action('customize_register', 'team1theme_404_customize_register');
