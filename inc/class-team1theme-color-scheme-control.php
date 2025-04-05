<?php
/**
 * Custom Color Scheme Control for Theme Customizer
 *
 * @package Team1Theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Custom control for color schemes - allows selecting theme colors or custom colors
 */
class Team1Theme_Color_Scheme_Control extends WP_Customize_Control {
    public $type = 'color_scheme';
    
    /**
     * Render the control's content.
     */
    public function render_content() {
        ?>
        <label>
            <?php if (!empty($this->label)) : ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php endif; ?>
            
            <?php if (!empty($this->description)) : ?>
                <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php endif; ?>
            
            <div class="color-scheme-options">
                <!-- Theme Color Scheme Options -->
                <p><strong><?php esc_html_e('Theme Colors:', 'team1theme'); ?></strong></p>
                <div class="theme-color-options">
                    <input type="radio" id="<?php echo esc_attr($this->id); ?>_primary" name="<?php echo esc_attr($this->id); ?>" value="var(--color-primary)" data-customize-setting-link="<?php echo esc_attr($this->id); ?>" <?php checked($this->value(), 'var(--color-primary)'); ?>>
                    <label for="<?php echo esc_attr($this->id); ?>_primary">
                        <span class="color-swatch" style="background-color:<?php echo esc_attr(get_theme_mod('color_primary', '#4169e1')); ?>"></span>
                        <?php esc_html_e('Primary', 'team1theme'); ?>
                    </label>
                    
                    <input type="radio" id="<?php echo esc_attr($this->id); ?>_secondary" name="<?php echo esc_attr($this->id); ?>" value="var(--color-secondary)" data-customize-setting-link="<?php echo esc_attr($this->id); ?>" <?php checked($this->value(), 'var(--color-secondary)'); ?>>
                    <label for="<?php echo esc_attr($this->id); ?>_secondary">
                        <span class="color-swatch" style="background-color:<?php echo esc_attr(get_theme_mod('color_secondary', '#800080')); ?>"></span>
                        <?php esc_html_e('Secondary', 'team1theme'); ?>
                    </label>
                    
                    <input type="radio" id="<?php echo esc_attr($this->id); ?>_accent" name="<?php echo esc_attr($this->id); ?>" value="var(--color-accent)" data-customize-setting-link="<?php echo esc_attr($this->id); ?>" <?php checked($this->value(), 'var(--color-accent)'); ?>>
                    <label for="<?php echo esc_attr($this->id); ?>_accent">
                        <span class="color-swatch" style="background-color:<?php echo esc_attr(get_theme_mod('color_accent', '#ff6b6b')); ?>"></span>
                        <?php esc_html_e('Accent', 'team1theme'); ?>
                    </label>
                    
                    <input type="radio" id="<?php echo esc_attr($this->id); ?>_background" name="<?php echo esc_attr($this->id); ?>" value="var(--color-background)" data-customize-setting-link="<?php echo esc_attr($this->id); ?>" <?php checked($this->value(), 'var(--color-background)'); ?>>
                    <label for="<?php echo esc_attr($this->id); ?>_background">
                        <span class="color-swatch" style="background-color:<?php echo esc_attr(get_theme_mod('color_background', '#ffffff')); ?>"></span>
                        <?php esc_html_e('Background', 'team1theme'); ?>
                    </label>
                    
                    <input type="radio" id="<?php echo esc_attr($this->id); ?>_text" name="<?php echo esc_attr($this->id); ?>" value="var(--color-text)" data-customize-setting-link="<?php echo esc_attr($this->id); ?>" <?php checked($this->value(), 'var(--color-text)'); ?>>
                    <label for="<?php echo esc_attr($this->id); ?>_text">
                        <span class="color-swatch" style="background-color:<?php echo esc_attr(get_theme_mod('color_text', '#333333')); ?>"></span>
                        <?php esc_html_e('Text', 'team1theme'); ?>
                    </label>
                </div>
                
                <!-- Custom Color Option -->
                <p><strong><?php esc_html_e('Custom Color:', 'team1theme'); ?></strong></p>
                <div class="custom-color-option">
                    <input type="radio" id="<?php echo esc_attr($this->id); ?>_custom" name="<?php echo esc_attr($this->id); ?>" value="custom" data-customize-setting-link="<?php echo esc_attr($this->id); ?>" <?php checked($this->value() !== 'var(--color-primary)' && $this->value() !== 'var(--color-secondary)' && $this->value() !== 'var(--color-accent)' && $this->value() !== 'var(--color-background)' && $this->value() !== 'var(--color-text)'); ?>>
                    <label for="<?php echo esc_attr($this->id); ?>_custom">
                        <input type="color" class="custom-color-picker" id="<?php echo esc_attr($this->id); ?>_custom_color" value="<?php echo esc_attr($this->value() !== 'var(--color-primary)' && $this->value() !== 'var(--color-secondary)' && $this->value() !== 'var(--color-accent)' && $this->value() !== 'var(--color-background)' && $this->value() !== 'var(--color-text)' ? $this->value() : '#000000'); ?>">
                        <?php esc_html_e('Custom Color', 'team1theme'); ?>
                    </label>
                </div>
            </div>
        </label>
        
        <style type="text/css">
            .color-scheme-options {
                margin-top: 10px;
            }
            .theme-color-options,
            .custom-color-option {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-bottom: 15px;
            }
            .color-swatch {
                display: inline-block;
                width: 20px;
                height: 20px;
                border-radius: 3px;
                border: 1px solid #ccc;
                vertical-align: middle;
                margin-right: 5px;
            }
            input[type="radio"] {
                display: none;
            }
            input[type="radio"] + label {
                cursor: pointer;
                padding: 5px 10px;
                border: 1px solid #ddd;
                border-radius: 3px;
                display: flex;
                align-items: center;
                background: #f9f9f9;
            }
            input[type="radio"]:checked + label {
                background-color: #e0e0e0;
                box-shadow: inset 0 0 5px rgba(0,0,0,0.1);
            }
            .custom-color-picker {
                border: none;
                padding: 0;
                width: 20px;
                height: 20px;
                margin-right: 5px;
                cursor: pointer;
            }
        </style>
        
        <script>
            jQuery(document).ready(function($) {
                $('#<?php echo esc_attr($this->id); ?>_custom_color').on('change', function() {
                    $('#<?php echo esc_attr($this->id); ?>_custom').prop('checked', true).trigger('change');
                    wp.customize('<?php echo esc_attr($this->id); ?>').set($(this).val());
                });
            });
        </script>
        <?php
    }
}