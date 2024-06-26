<?php
/**
 * Plugin Name: WooCommerce Share Buttons
 * Plugin URI:  http://faithcoder.com
 * Description: Adds custom share buttons below the product summary on WooCommerce product pages.
 * Version:     1.0.0
 * Author:      M Arif
 * Author URI:  http://faithcoder.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: woocommerce-share-buttons
 */

// Prevent direct access to the file
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

define('WSB_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Include necessary files
include_once WSB_PLUGIN_DIR . 'includes/wsb-settings.php';
include_once WSB_PLUGIN_DIR . 'includes/wsb-social-controllers.php';
include_once WSB_PLUGIN_DIR . 'includes/wsb-render-html.php';

// Enqueue CSS and FontAwesome
add_action('wp_enqueue_scripts', 'wsb_enqueue_assets');
function wsb_enqueue_assets() {
    wp_enqueue_style('wsb-style', plugins_url('assets/wsb-style.css', __FILE__));
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
}

// Enqueue admin scripts and styles
add_action('admin_enqueue_scripts', 'wsb_enqueue_admin_assets');
function wsb_enqueue_admin_assets($hook_suffix) {
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_script('wsb-color-picker-script', plugins_url('/assets/color-picker-script.js', __FILE__), array('wp-color-picker'), false, true);
}

// Add share buttons below product summary
add_action('woocommerce_single_product_summary', 'custom_woocommerce_share_buttons', 45);

