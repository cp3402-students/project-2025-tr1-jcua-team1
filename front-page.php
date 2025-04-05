<?php
/**
 * The front page template file
 *
 * This is the template that displays the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Team1Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="hero-section" 
        <?php if (get_theme_mod('hero_bg_image')) : ?>
            style="background-image: linear-gradient(rgba(0, 0, 0, <?php echo esc_attr(get_theme_mod('hero_bg_opacity', '0.8')); ?>), rgba(0, 0, 0, <?php echo esc_attr(get_theme_mod('hero_bg_opacity', '0.8')); ?>)), url('<?php echo esc_url(get_theme_mod('hero_bg_image')); ?>'); 
                   background-size: cover; 
                   background-position: center;"
        <?php else : ?>
            style="background-color: <?php echo esc_attr(get_theme_mod('hero_bg_color', '#f8f9fa')); ?>;"
        <?php endif; ?>>
        <div class="container" style="max-width: <?php echo esc_attr(get_theme_mod('hero_width', '100')); ?>%; text-align: <?php echo esc_attr(get_theme_mod('hero_text_align', 'center')); ?>; color: <?php echo esc_attr(get_theme_mod('hero_text_color', '#333333')); ?>;">
            
            <?php 
            $hero_position = get_theme_mod('hero_image_position', 'below');
            $has_hero_image = get_theme_mod('hero_foreground_image');
            
            // If image position is above, show it first
            if ($has_hero_image && $hero_position === 'above') : ?>
                <div class="hero-image">
                    <img src="<?php echo esc_url(get_theme_mod('hero_foreground_image')); ?>" alt="<?php echo esc_attr(get_theme_mod('hero_heading', 'Hero Image')); ?>" style="max-width: <?php echo esc_attr(get_theme_mod('hero_image_max_width', '80')); ?>%;">
                </div>
            <?php endif; ?>
            
            <div class="hero-text-content">
                <h1><?php echo esc_html(get_theme_mod('hero_heading', 'Welcome to Our Website')); ?></h1>
                <p><?php echo esc_html(get_theme_mod('hero_text', 'This is your custom homepage. Add your content here.')); ?></p>
                
                <?php if (get_theme_mod('hero_button_text')) : ?>
                    <a href="<?php echo esc_url(get_theme_mod('hero_button_url', '#')); ?>" class="hero-button">
                        <?php echo esc_html(get_theme_mod('hero_button_text', 'Learn More')); ?>
                    </a>
                <?php endif; ?>
            </div>
            
            <?php if ($has_hero_image && $hero_position === 'below') : ?>
                <div class="hero-image">
                    <img src="<?php echo esc_url(get_theme_mod('hero_foreground_image')); ?>" alt="<?php echo esc_attr(get_theme_mod('hero_heading', 'Hero Image')); ?>" style="max-width: <?php echo esc_attr(get_theme_mod('hero_image_max_width', '80')); ?>%;">
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="home-category-posts">
        <div class="container">
            <?php
            // Custom query to get posts from 'home' category
            $home_posts = new WP_Query( array(
                'category_name' => 'home',
                'posts_per_page' => 6, // Adjust number as needed
            ) );

            // Get customizer settings
            $enable_links = get_theme_mod('home_posts_enable_links', true);
            $content_type = get_theme_mod('home_posts_content_type', 'excerpt');
            $show_titles = get_theme_mod('home_posts_show_titles', true);
            $heading_tag = get_theme_mod('home_posts_heading_tag', 'h3');

            if ( !$home_posts->have_posts() ) : ?>
                <div class="info-notice">
                    <p>This is where posts from the 'home' category will show.</p>
                </div>
            <?php else : ?>
                <div class="home-posts-grid">
                    <?php while ( $home_posts->have_posts() ) : $home_posts->the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('home-post-item'); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-thumbnail">
                                    <?php if ($enable_links) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( 'medium' ); ?>
                                        </a>
                                    <?php else : ?>
                                        <?php the_post_thumbnail( 'medium' ); ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content">
                                <?php if ($show_titles) : ?>
                                    <<?php echo esc_attr($heading_tag); ?> class="entry-title">
                                        <?php if ($enable_links) : ?>
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        <?php else : ?>
                                            <?php the_title(); ?>
                                        <?php endif; ?>
                                    </<?php echo esc_attr($heading_tag); ?>>
                                <?php endif; ?>
                                
                                <?php if (get_theme_mod('home_posts_show_meta', true)) : ?>
                                <div class="entry-meta">
                                    <?php echo get_the_date(); ?>
                                </div>
                                <?php endif; ?>
                                <div class="entry-content">
                                    <?php if ($content_type === 'excerpt') : ?>
                                        <?php the_excerpt(); ?>
                                    <?php else : ?>
                                        <?php the_content(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                <?php
                // Restore original post data
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </section>

    <section class="features-section">
        <div class="container">
            <!-- Add your homepage sections here -->
        </div>
    </section>
</main><!-- #main -->

<?php
get_footer();
?>