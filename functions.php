<?php
/**
 * Threshold Wellness Theme Functions
 */

// Security Constants
define('SUSTAINABLEWATT_VERSION', '1.0.0');
define('SUSTAINABLEWATT_THEME_DIR', __DIR__ . '/includes/');
define('SUSTAINABLEWATT_THEME_SHORTCODE_DIR', __DIR__ . '/includes/shortcodes/');

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class ThresholdWellnessFunctions
{
    public function __construct()
    {
        $this->load_dependencies();
        $this->init();
    }

    public function load_dependencies()
    {
        require_once(SUSTAINABLEWATT_THEME_DIR . 'enqueue.php');
        require_once(SUSTAINABLEWATT_THEME_DIR . 'custom-post-type.php');
        require_once(SUSTAINABLEWATT_THEME_SHORTCODE_DIR . 'products.php');
    }

    public function init()
    {
        new THRESHOLDWELLNESSASSETS();
        new SUSTAINABLEWATTCUSTOMPOSTTYPES();
        new SustainablewattProductsShortcode();
    }
}

new ThresholdWellnessFunctions();