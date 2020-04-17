<?php
/*
 * Plugin Name: Fawry Pay
 * Plugin URI: https://github.com/fr3on/fawry-pay
 * Description: Fawry Pay for your Order with any Credit or Debit Card or through Fawry Machines
 * Author: Fr3on
 * Author URI: https://github.com/fr3on
 * Version: 1.0.0
 */

defined('ABSPATH') or die('No scripting kidding');

/**
 * Check if WooCommerce is active
 * */
if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	exit;
}


defined('FAWRY_PLUGIN_PATH') or define('FAWRY_PLUGIN_PATH', plugin_dir_path(__FILE__));
defined('FAWRY_PLUGIN_URI') or define('FAWRY_PLUGIN_URI', plugin_dir_url(__FILE__));

/**
 * Load plugin textdomain.
 */
function fawry_pay_load_textdomain()
{
	load_plugin_textdomain('fawry_textdomain', false, dirname(plugin_basename(__FILE__)) . '/languages');
}

add_action('init', 'fawry_load_textdomain');

/*
 * This action hook registers our PHP class as a WooCommerce payment gateway
 */
function fawry_pay_add_class($gateways)
{
	$gateways[] = 'WC_Fawry_Pay';
	return $gateways;
}
add_filter('woocommerce_payment_gateways', 'fawry_pay_add_class');

require_once plugin_dir_path(__FILE__) . '/inc/redefine-pluggable-functions.php';

/*
 * Load `WC_Fawry_Pay` class on 'plugins_loaded' hook.
 */
add_action('plugins_loaded', 'fawry_pay_init_class');

function fawry_pay_init_class()
{
	require_once plugin_dir_path(__FILE__) . '/inc/class-wc-fawry-pay.php';
}
