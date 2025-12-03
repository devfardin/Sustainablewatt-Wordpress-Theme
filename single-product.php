<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * The site's entry point.
 *
 * Loads the relevant template part,
 * the loop is executed (when needed) by the relevant template part.
 *
 * @package HelloElementor
 */

get_header();
?>
<div class="sustainablewatt-product-body">
    <div id="content">
        <?php
         echo \Elementor\Plugin::instance()->frontend-> get_builder_content_for_display(290);
        ?>
    </div>
</div>
<?php get_footer();