<?php
/**
 * Template part for displaying posts in a category archive
 *
 * @package Team1Theme
 */

$show_excerpts = get_theme_mod('archive_show_excerpts', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('category-archive-item'); ?>>
    <header class="entry-header">
        <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>

        <?php if ('post' === get_post_type()) : ?>
            <div class="entry-meta">
                <?php
                team1theme_posted_on();
                team1theme_posted_by();
                ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <?php if (has_post_thumbnail()) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium'); ?>
            </a>
        </div>
    <?php endif; ?>

    <?php if ($show_excerpts) : ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
            <p><a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e('Read More', 'team1theme'); ?></a></p>
        </div><!-- .entry-summary -->
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->