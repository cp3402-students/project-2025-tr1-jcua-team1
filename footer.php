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

	<footer id="colophon" class="site-footer" style="background-color: <?php echo esc_attr(get_theme_mod('footer_bg_color', '#f8f9fa')); ?>; color: <?php echo esc_attr(get_theme_mod('footer_text_color', '#333333')); ?>;">
		<div class="site-info">
			<?php echo wp_kses_post(get_theme_mod('footer_text', 'Copyright © ' . date('Y') . ' ' . get_bloginfo('name'))); ?>
			
			<?php if (get_theme_mod('show_wordpress_credit', true)) : ?>
				<span class="sep"> | </span>
				<a href="<?php echo esc_url(__('https://wordpress.org/', 'team1theme')); ?>">
					<?php printf(esc_html__('Proudly powered by %s', 'team1theme'), 'WordPress'); ?>
				</a>
			<?php endif; ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
