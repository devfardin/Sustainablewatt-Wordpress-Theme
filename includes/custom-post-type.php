<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
class SUSTAINABLEWATTCUSTOMPOSTTYPES
{
    public function __construct()
    {
        add_filter('enter_title_here', [$this, 'customize_title_placeholder'], 10, 2);
    }
    public function customize_title_placeholder($title, $post)
    {
        if ($post->post_type == 'product') {
            $my_title = "Product Title";
            return $my_title;
        }
        return $title;
    }

}