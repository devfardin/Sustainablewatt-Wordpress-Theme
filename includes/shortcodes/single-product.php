<?php
/**
 * Sustainablewatt Solutions Single Product Shortcode
 */

if (!defined('ABSPATH')) {
    exit;
}

class SustainablewattSingleProductShortcode
{

    public function __construct()
    {
        add_shortcode('sustainablewatt_single_product', [$this, 'render_single_product']);
    }

    public function render_single_product($atts)
    {
        ob_start();
        $atts = shortcode_atts([
            'id' => get_the_ID(),
        ], $atts, 'sustainablewatt_single_product');

        $product = get_post($atts['id']);
        if (!$product)
            return '';

        $gallery_images = get_post_meta($product->ID, 'product_gallery', true);
        $gallery_images = is_array($gallery_images) ? $gallery_images : [];
        $featured_image = get_post_thumbnail_id($product->ID);
        $all_images = array_merge([$featured_image], $gallery_images);
        $all_images = array_filter($all_images);
        ?>

        <!-- Breadcrumb -->
        <div class="product-breadcrumb">
            <div class="container">
                <span> <a href="/"> Home ></a> <a href="/products">Products ></a>
                    <?php echo esc_html($product->post_title); ?></span>
            </div>
        </div>

        <!-- Product Details -->
        <div class="product-details">
            <div class="container">
                <div class="product-row">

                    <!-- Product Images -->
                    <div class="product-images">
                        <div class="main-image">
                            <?php if ($all_images): ?>
                                <img id="main-product-image"
                                    src="<?php echo wp_get_attachment_image_url($all_images[0], 'large'); ?>"
                                    alt="<?php echo esc_attr($product->post_title); ?>">
                            <?php endif; ?>
                        </div>

                        <?php if (count($all_images) > 1): ?>
                            <div class="gallery-thumbnails">
                                <?php foreach ($all_images as $index => $image_id): ?>
                                    <button class="gallery-thumb <?php echo $index === 0 ? 'active' : ''; ?>"
                                        onclick="changeMainImage('<?php echo wp_get_attachment_image_url($image_id, 'large'); ?>', this)">
                                        <img src="<?php echo wp_get_attachment_image_url($image_id, 'medium_large'); ?>"
                                            alt="Gallery <?php echo $index + 1; ?>">
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Product Info -->
                    <div class="product-info">
                        <h1><?php echo esc_html($product->post_title); ?></h1>

                        <!-- Help Section -->
                        <div class="help-section">
                            <?php $purchase_link = get_post_meta($product->ID, 'purchase_link', true); ?>
                            <?php if (!empty($purchase_link)): ?>
                                <h3>Ready to Purchase?</h3>
                                <p>Please contact us for a tailored quotation</p>
                                <div>
                                    <a href="<?php echo esc_url($purchase_link); ?>" target="_blank" class="buy-btn">Contact Us </a>
                                </div>
                            <?php else: ?>
                                <h3>Ready to Purchase?</h3>
                                <p> Please contact us for a tailored quotation </p>
                                <div>
                                    <a href="/contact" class="contact-btn">Contact Us</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Description -->
        <div class="product-description-section">
            <div class="container">
                <div class="delivery-info">

                    <h2>Product Description</h2>
                    <div class="product-description">
                        <?php
                        $product_description = get_post_meta($product->ID, 'product_description', true);
                        echo wpautop($product_description ? $product_description : $product->post_content);
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delivery Section -->
        <div class="delivery-section">
            <div class="container">
                <div class="delivery-info">
                    <h3>Delivery Information</h3>
                    <?php
                    $delivery_info = get_post_meta($product->ID, 'delivery_information', true);
                    echo wpautop($delivery_info ? $delivery_info : 'Fast and reliable delivery options available for all our sustainable energy products.');
                    ?>
                </div>
            </div>
        </div>

        <script>
            function changeMainImage(imageSrc, button) {
                document.getElementById('main-product-image').src = imageSrc;
                document.querySelectorAll('.gallery-thumb').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
            }
        </script>

        <?php
        return ob_get_clean();
    }
}

new SustainablewattSingleProductShortcode();