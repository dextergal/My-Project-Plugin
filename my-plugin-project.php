<?php
/**
 * Plugin Name: Instagram Plugin
 * Description: A simple Instagram feed plugin.
 * Version: 1.0
 * Author: Your Name
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class InstagramPlugin {
    private $access_token;

    public function __construct() {
        // Initialize settings
        $this->access_token = 'IGQVJXcXZA3R1p1UDI2OTlxRFpfdWdrYy1WTU0wRmlhTGVsTDRpcWxLRnJMYWQwQlZAUOURUZAnNIR3ppZA1pjVlRQWGFSTXZAXSzRyZADQ1R3hYcjFOTkFSMWJlV1ZAua1ZAYM215MGxjOGVn'; // Directly setting your token here
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_shortcode('instagram_feed', [$this, 'display_instagram_feed']);
    }

    public function enqueue_scripts() {
        // Enqueue styles and scripts
        wp_enqueue_style('slick-css', plugin_dir_url(__FILE__) . 'js/slick.css');
        wp_enqueue_style('slick-theme-css', plugin_dir_url(__FILE__) . 'js/slick-theme.css');
        wp_enqueue_style('custom-css', plugin_dir_url(__FILE__) . 'css/mycustom.css');
        wp_enqueue_script('slick-js', plugin_dir_url(__FILE__) . 'js/slick.min.js', ['jquery'], null, true);
        wp_enqueue_script('instagram-js', plugin_dir_url(__FILE__) . 'js/instagram.js', ['slick-js'], null, true);
    }

    public function display_instagram_feed() {
        $json_link = "https://api.instagram.com/v1/users/self/media/recent/?access_token={$this->access_token}&count=10"; // Adjust the count as needed

        $response = wp_remote_get($json_link);

        if (is_wp_error($response)) {
            return '<p>Error fetching Instagram feed.</p>';
        }

        $instagram_data = json_decode(wp_remote_retrieve_body($response), true);
        if (isset($instagram_data['data'])) {
            $output = '<div class="instagram-feed">';
            foreach ($instagram_data['data'] as $item) {
                $output .= '<a href="' . esc_url($item['link']) . '" target="_blank">';
                $output .= '<img src="' . esc_url($item['images']['standard_resolution']['url']) . '" alt="' . esc_attr($item['caption']['text']) . '">';
                $output .= '</a>';
            }
            $output .= '</div>';
            return $output;
        }

        return '<p>No Instagram posts found.</p>';
    }
}

new InstagramPlugin();