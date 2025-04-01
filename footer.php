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
        <div class="site-info">
            <?php echo wp_kses_post(get_theme_mod('footer_text', 'Copyright © ' . date('Y') . ' ' . get_bloginfo('name'))); ?>
            
            <div class="ai-attribution">
                <?php echo wp_kses_post(get_theme_mod('ai_attribution_text', 'Original idea, code generated with AI assistance.')); ?>
            </div>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>