<?php 

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
} 

class BLOG {
    public function __construct() {
        add_shortcode('sustainablewatt_blog', array($this, 'render_blog_shortcode'));
    }

    public function render_blog_shortcode($atts) {
        ob_start();

        $query = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 6,
        ));

        if ($query->have_posts()) {
            echo '<div class="sustainablewatt-blog-grid">';
            while ($query->have_posts()) {
                $query->the_post();
                $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                $placeholder_image = 'https://via.placeholder.com/400x250/f0f0f0/999999?text=No+Image';
                ?>
                <div class="blog-card">
                    <div class="blog-image">
                        <img src="<?php echo $featured_image ? $featured_image : $placeholder_image; ?>" alt="<?php the_title_attribute(); ?>">
                    </div>
                    <div class="blog-content">
                        <h3 class="blog-title"><?php the_title(); ?></h3>
                        <p class="blog-description"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                        <a href="<?php the_permalink(); ?>" class="read-more-btn">Read More</a>
                    </div>
                </div>
                <?php
            }
            echo '</div>';
            wp_reset_postdata();
        } else {
            echo '<p class="no-posts">No posts found.</p>';
        }

        return ob_get_clean();
    }
}