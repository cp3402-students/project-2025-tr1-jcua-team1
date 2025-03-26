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
    <section class="hero-section">
        <div class="container">
            <h1>Welcome to Our Website</h1>
            <p>This is your custom homepage. Add your content here.</p>
        </div>
    </section>

    <section class="home-category-posts">
        <div class="container">
            <h2>Latest Updates</h2>
            
            <?php
            // Custom query to get posts from 'home' category
            $home_posts = new WP_Query( array(
                'category_name' => 'home',
                'posts_per_page' => 6, // Adjust number as needed
            ) );

            if ( !$home_posts->have_posts() ) : ?>
                <div class="info-notice" style="background: #e5f5fa; border-left: 4px solid #00a0d2; padding: 10px; margin-bottom: 20px;">
                    <p>This is where posts from the 'home' category will show.</p>
                </div>
            <?php else : ?>
                <div class="home-posts-grid">
                    <?php while ( $home_posts->have_posts() ) : $home_posts->the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('home-post-item'); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'medium' ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content">
                                <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="entry-meta">
                                    <?php echo get_the_date(); ?>
                                </div>
                                <div class="entry-summary">
                                    <?php the_excerpt(); ?>
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