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
            'posts_per_page' => 5,
        ));

        if ($query->have_posts()) {
            echo '<div class="sustainablewatt-blog">';
            while ($query->have_posts()) {
                $query->the_post();
                ?>
                <div class="sustainablewatt-blog-post">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="sustainablewatt-blog-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
                <?php
            }
            echo '</div>';
            wp_reset_postdata();
        } else {
            echo '<p>No posts found.</p>';
        }

        return ob_get_clean();
    }
}