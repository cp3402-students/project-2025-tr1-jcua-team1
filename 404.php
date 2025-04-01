<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Team1Theme
 */

get_header();
?>

    <main id="primary" class="site-main">

        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php echo esc_html( get_theme_mod( 'team1theme_404_title', __( 'Oops! That page can&rsquo;t be found.', 'team1theme' ) ) ); ?></h1>
            </header><!-- .page-header -->

            <div class="page-content">
                <p><?php echo esc_html( get_theme_mod( 'team1theme_404_message', __( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'team1theme' ) ) ); ?></p>

                <?php if ( get_theme_mod( 'team1theme_404_show_search', true ) ) : ?>
                    <?php get_search_form(); ?>
                <?php endif; ?>

                <?php if ( get_theme_mod( 'team1theme_404_show_widgets', true ) ) : ?>
                    <?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

                    <div class="widget widget_categories">
                        <h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'team1theme' ); ?></h2>
                        <ul>
                            <?php
                            wp_list_categories(
                                array(
                                    'orderby'    => 'count',
                                    'order'      => 'DESC',
                                    'show_count' => 1,
                                    'title_li'   => '',
                                    'number'     => 10,
                                )
                            );
                            ?>
                        </ul>
                    </div><!-- .widget -->

                    <?php
                    /* translators: %1$s: smiley */
                    $team1theme_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'team1theme' ), convert_smilies( ':)' ) ) . '</p>';
                    the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$team1theme_archive_content" );

                    the_widget( 'WP_Widget_Tag_Cloud' );
                    ?>
                <?php endif; ?>
            </div><!-- .page-content -->
        </section><!-- .error-404 -->

    </main><!-- #main -->

<?php
get_footer();
