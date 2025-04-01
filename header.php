<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Team1Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'team1theme' ); ?></a>

	<header id="masthead" class="site-header" style="
		background-color: <?php echo get_theme_mod( 'header_bg_color', '#ffffff' ); ?>;
		padding-top: <?php echo get_theme_mod( 'header_padding', '20' ); ?>px;
		padding-bottom: <?php echo get_theme_mod( 'header_padding', '20' ); ?>px;
		text-align: <?php echo get_theme_mod( 'header_text_align', 'left' ); ?>;
	">
		<div class="site-branding">
			<?php
			if (has_custom_logo()) {
				the_custom_logo();
			} else {
				// Add a placeholder with same height as the logo would have
				?>
				<div class="logo-placeholder">
					<?php if (is_front_page() && is_home()) : ?>
						<h1 class="site-title" style="color: <?php echo get_theme_mod( 'header_text_color', '#000000' ); ?>;"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
					<?php else : ?>
						<p class="site-title" style="color: <?php echo get_theme_mod( 'header_text_color', '#000000' ); ?>;"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
					<?php endif; ?>
				</div>
			<?php }

			$team1theme_description = get_bloginfo( 'description', 'display' );
			if ( $team1theme_description || is_customize_preview() ) :
				?>
				<p class="site-description" style="color: <?php echo get_theme_mod( 'header_text_color', '#000000' ); ?>;"><?php echo $team1theme_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'team1theme' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'navbar-nav',
					'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				)
			);
			?>
		</nav><!-- #site-navigation -->
		<style>
			#site-navigation {
				background-color: <?php echo get_theme_mod('nav_bg_color', 'transparent'); ?>;
			}
			
			#site-navigation ul li a {
				font-size: <?php echo get_theme_mod('header_link_font_size', '16'); ?>px;
				color: <?php echo get_theme_mod('header_link_color', '#000000'); ?>;
				padding: 5px <?php echo get_theme_mod('nav_link_spacing', '15'); ?>px;
			}
			
			#site-navigation ul li a:hover {
				color: <?php echo get_theme_mod('nav_link_hover_color', '#4169e1'); ?>;
			}
		</style>
	</header><!-- #masthead -->
