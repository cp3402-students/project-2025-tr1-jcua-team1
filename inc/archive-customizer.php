<?php
/**
 * Archive customization settings and functions
 *
 * @package Team1Theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Archive Page Customizer Settings
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function team1theme_archive_customize_register( $wp_customize ) {
    // Add a section for archive settings
    $wp_customize->add_section( 'team1theme_archive_settings', array(
        'title'    => __( 'Archive Settings', 'team1theme' ),
        'priority' => 50,
    ));

    // Archive Layout
    $wp_customize->add_setting( 'archive_layout', array(
        'default'           => 'standard',
        'sanitize_callback' => 'team1theme_sanitize_select',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control( 'archive_layout', array(
        'label'    => __( 'Archive Layout', 'team1theme' ),
        'section'  => 'team1theme_archive_settings',
        'type'     => 'select',
        'choices'  => array(
            'standard'   => __( 'Standard List', 'team1theme' ),
            'grid'       => __( 'Grid Layout', 'team1theme' ),
            'full-width' => __( 'Full Width (No Sidebar)', 'team1theme' ),
        ),
    ));

    // Pagination Type
    $wp_customize->add_setting( 'archive_pagination', array(
        'default'           => 'default',
        'sanitize_callback' => 'team1theme_sanitize_select',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control( 'archive_pagination', array(
        'label'    => __( 'Pagination Style', 'team1theme' ),
        'section'  => 'team1theme_archive_settings',
        'type'     => 'select',
        'choices'  => array(
            'default'  => __( 'Simple Next/Previous', 'team1theme' ),
            'numbered' => __( 'Numbered Pagination', 'team1theme' ),
        ),
    ));

    // Show Post Excerpts
    $wp_customize->add_setting( 'archive_show_excerpts', array(
        'default'           => true,
        'sanitize_callback' => 'team1theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control( 'archive_show_excerpts', array(
        'label'    => __( 'Show Post Excerpts', 'team1theme' ),
        'section'  => 'team1theme_archive_settings',
        'type'     => 'checkbox',
    ));
}
add_action( 'customize_register', 'team1theme_archive_customize_register' );

/**
 * Sanitize select field
 *
 * @param string $input Selected option.
 * @param object $setting Setting object.
 * @return string Sanitized value.
 */
function team1theme_sanitize_select( $input, $setting ) {
    // Get list of choices from the control
    $choices = $setting->manager->get_control( $setting->id )->choices;
    
    // Return input if valid or return default if not
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Sanitize checkbox values
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
if ( ! function_exists( 'team1theme_sanitize_checkbox' ) ) {
    function team1theme_sanitize_checkbox( $checked ) {
        return ( ( isset( $checked ) && true == $checked ) ? true : false );
    }
}

/**
 * Generate CSS for archive layouts
 */
function team1theme_archive_styles() {
    // Only apply on archive pages
    if ( ! is_archive() && ! is_home() ) {
        return;
    }
    
    $archive_layout = get_theme_mod( 'archive_layout', 'standard' );
    
    ?>
    <style type="text/css">
        /* Standard archive layout styles */
        .archive-type-category .page-header {
            border-left: 5px solid #4285f4;
            padding-left: 15px;
        }
        
        .archive-type-tag .page-header {
            border-left: 5px solid #34a853;
            padding-left: 15px;
        }
        
        .archive-type-date .page-header {
            border-left: 5px solid #fbbc05;
            padding-left: 15px;
        }
        
        .archive-type-author .page-header {
            border-left: 5px solid #ea4335;
            padding-left: 15px;
        }
        
        /* Grid layout styles */
        <?php if ( $archive_layout === 'grid' ) : ?>
        .archive-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 30px;
        }
        
        @media (max-width: 768px) {
            .archive-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 576px) {
            .archive-grid {
                grid-template-columns: 1fr;
            }
        }
        <?php endif; ?>
        
        /* Pagination styles */
        .pagination-container {
            margin: 30px 0;
            text-align: center;
        }
        
        .pagination-container .page-numbers {
            padding: 5px 10px;
            margin: 0 5px;
            border: 1px solid #ddd;
            display: inline-block;
        }
        
        .pagination-container .page-numbers.current {
            background-color: #f8f9fa;
            font-weight: bold;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'team1theme_archive_styles', 20 );