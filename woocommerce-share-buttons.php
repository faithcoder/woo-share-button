<?php
/**
 * Plugin Name: WooCommerce Social Share
 * Plugin URI:  http://faithcoder.com
 * Description: Adds custom share buttons below the product meta on WooCommerce product pages.
 * Version:     1.0.0
 * Author:      M Arif
 * Author URI:  https://github.com/faithcoder
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: woocommerce-share-buttons
 */

// Prevent direct access to the file
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

define('WSB_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Include necessary files
include_once WSB_PLUGIN_DIR . 'includes/wsb-settings.php';
include_once WSB_PLUGIN_DIR . 'includes/wsb-social-controllers.php';
include_once WSB_PLUGIN_DIR . 'includes/wsb-render-html.php';

// Enqueue CSS and FontAwesome
add_action('wp_enqueue_scripts', 'wsb_enqueue_assets');
function wsb_enqueue_assets() {
    wp_enqueue_style('wsb-style', plugins_url('assets/css/wsb-style.css', __FILE__));
    wp_enqueue_style('fontawesome', plugins_url('assets/css/fontawesome.css', __FILE__));
}

// Enqueue admin scripts and styles
add_action('admin_enqueue_scripts', 'wsb_enqueue_admin_assets');
function wsb_enqueue_admin_assets($hook_suffix) {
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_script('wsb-color-picker-script', plugins_url('/assets/js/color-picker-script.js', __FILE__), array('wp-color-picker'), false, true);

    wp_enqueue_style('wsb-admin-style', plugin_dir_url(__FILE__) . 'assets/css/admin-style.css');
    wp_enqueue_script('wsb-admin-script', plugin_dir_url(__FILE__) . 'assets/js/admin-script.js', ['jquery'], null, true);
}

add_action('woocommerce_share', 'wsb_woocommerce_share_buttons', 45);
