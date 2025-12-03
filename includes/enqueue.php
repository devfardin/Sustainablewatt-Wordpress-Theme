<?php
/**
 * Threshold Wellness Assets Enqueue
 */

if (!defined('ABSPATH')) {
    exit;
}

define('SUSTAINABLEWATT_STYLE_URI', get_stylesheet_directory_uri() . '/assets/css/');
define('SUSTAINABLEWATT_SCRIPT_URI', get_stylesheet_directory_uri() . '/assets/js/');


class THRESHOLDWELLNESSASSETS {
    
    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
    }
    
    public function enqueue_styles() {
        // Main CSS with optimization
        wp_enqueue_style(
            'threshold-wellness-main',
            SUSTAINABLEWATT_STYLE_URI . 'main.css',
            [],
            SUSTAINABLEWATT_VERSION,
            'all'
        );
        wp_enqueue_style(
            'threshold-wellness-products',
            SUSTAINABLEWATT_STYLE_URI . 'products.css',
            [],
            SUSTAINABLEWATT_VERSION,
            'all'
        );
        
    }
    
    public function enqueue_scripts() {
        wp_enqueue_script(
            'threshold-wellness-main',
            SUSTAINABLEWATT_SCRIPT_URI . '/assets/js/main.js',
            ['jquery'],
            SUSTAINABLEWATT_SCRIPT_URI,
            true
        );
    }
}