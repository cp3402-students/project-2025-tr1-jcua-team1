<?php
/**
 * Template part for displaying the image carousel on the homepage
 *
 * @package Team1Theme
 */
?>

<section class="image-carousel-section">
    <div class="container">
        <div class="carousel-container">
            <div class="carousel-slider">
                <?php 
                // Get all carousel images
                $carousel_images = array();
                for ($i = 1; $i <= 5; $i++) {
                    $image_url = get_theme_mod('carousel_image_' . $i);
                    $image_caption = get_theme_mod('carousel_caption_' . $i);
                    $image_link = get_theme_mod('carousel_link_' . $i);
                    
                    if ($image_url) {
                        $carousel_images[] = array(
                            'url' => $image_url,
                            'caption' => $image_caption,
                            'link' => $image_link
                        );
                    }
                }
                
                // Display carousel images if they exist
                if (!empty($carousel_images)) : 
                    foreach ($carousel_images as $index => $image) : ?>
                        <div class="carousel-slide" id="slide-<?php echo esc_attr($index + 1); ?>">
                            <?php if (!empty($image['link'])) : ?>
                                <a href="<?php echo esc_url($image['link']); ?>">
                            <?php endif; ?>
                            
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['caption'] ? $image['caption'] : 'Carousel Image ' . ($index + 1)); ?>">
                            
                            <?php if (!empty($image['link'])) : ?>
                                </a>
                            <?php endif; ?>
                            
                            <?php if (!empty($image['caption']) && get_theme_mod('carousel_show_captions', true)) : ?>
                                <div class="carousel-caption">
                                    <p><?php echo esc_html($image['caption']); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="info-notice">
                        <p>Add images to your carousel in the Customizer under Homepage Settings.</p>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php if (!empty($carousel_images) && count($carousel_images) > 1) : ?>
                <div class="carousel-controls">
                    <button class="carousel-prev" aria-label="Previous slide">&lt;</button>
                    <div class="carousel-dots">
                        <?php for ($i = 0; $i < count($carousel_images); $i++) : ?>
                            <button class="carousel-dot <?php echo ($i === 0) ? 'active' : ''; ?>" data-slide="<?php echo esc_attr($i + 1); ?>" aria-label="Go to slide <?php echo esc_attr($i + 1); ?>"></button>
                        <?php endfor; ?>
                    </div>
                    <button class="carousel-next" aria-label="Next slide">&gt;</button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
