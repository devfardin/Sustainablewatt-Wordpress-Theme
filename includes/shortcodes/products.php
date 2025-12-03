<?php
/**
 * Sustainablewatt Solutions Products Shortcode
 */

if (!defined('ABSPATH')) {
    exit;
}

class SustainablewattProductsShortcode
{

    public function __construct()
    {
        add_shortcode('sustainablewatt_products', [$this, 'render_products']);
    }

    public function render_products($atts)
    {
        ob_start();
        $atts = shortcode_atts([
            'count' => 5,
        ], $atts, 'sustainablewatt_products');

        $args = [
            'post_type' => 'product',
            'posts_per_page' => intval($atts['count']),
        ];

        $query = new WP_Query($args); ?>
        <div class="sustainablewatt-products__wrapper">
            <?php if ($query->have_posts()) { ?>
                <div class="sustainablewatt-products__grid">
                    <?php while ($query->have_posts()) {
                        $query->the_post(); ?>
                        <div class="sustainablewatt-product__item">
                            <?php if (has_post_thumbnail()) { ?>
                                <div class="product-thumbnail">
                                    <?php the_post_thumbnail('large'); ?>
                                </div>
                            <?php } ?>
                            <div class="product-info">
                                <h3><?php the_title(); ?></h3>
                                <?php
                                if (!empty(get_post_meta(get_the_ID(), 'purchase_link', true))) {
                                    $purchase_link = get_post_meta(get_the_ID(), 'purchase_link', true);
                                    echo '<a href="' . esc_url($purchase_link) . '" class="product-button" target="_blank" rel="noopener noreferrer">Buy Now</a>';
                                } else { ?>
                                    <a class="product-button read-more" href="<?php echo esc_attr(get_the_permalink()); ?>">Read More</a>
                                <?php } ?>

                            </div>
                        </div>
                    <?php }
                    wp_reset_postdata(); ?>
                </div>
            <?php } else { ?>
                <p><?php _e('No products found.'); ?></p>
            <?php } ?>
        </div>
        <?php return ob_get_clean();
    }
}

new SustainablewattProductsShortcode();