<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Team1Theme
 */

?>

    <footer id="colophon" class="site-footer" style="
        background-color: <?php echo esc_attr(get_theme_mod('footer_bg_color', '#f8f9fa')); ?>; 
        color: <?php echo esc_attr(get_theme_mod('footer_text_color', '#333333')); ?>;
        padding-top: <?php echo esc_attr(get_theme_mod('footer_padding', '20')); ?>px;
        padding-bottom: <?php echo esc_attr(get_theme_mod('footer_padding', '20')); ?>px;
        text-align: <?php echo esc_attr(get_theme_mod('footer_text_align', 'center')); ?>;
    ">
        <div class="site-footer-widgets">
            <div class="container">
                <div class="footer-widget-row">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <div class="footer-widget-column">
                            <?php dynamic_sidebar('footer-1'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <div class="footer-widget-column">
                            <?php dynamic_sidebar('footer-2'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <div class="footer-widget-column">
                            <?php dynamic_sidebar('footer-3'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="site-info" style="<?php 
            echo get_theme_mod('footer_text_bold', false) ? 'font-weight: bold;' : ''; 
            echo get_theme_mod('footer_text_italic', false) ? 'font-style: italic;' : ''; 
        ?>">
            <?php echo wp_kses_post(get_theme_mod('footer_text', 'Copyright © ' . date('Y') . ' ' . get_bloginfo('name'))); ?>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>