<?php

/**
 * @package wp_pay_it_ath
 * @version 1.0.0
 */
/*
Plugin Name: Pay it for ATH Movil
Plugin URI: https://bohiques.com
Description: Plugin para implementar pagos con ATH Movil
Version: 1.0.0
Author URI: https://wa.me/19104468990
*/


require __DIR__ . '/vendor/autoload.php';

register_activation_hook(__FILE__, ['PayitAth', 'active']);
register_deactivation_hook(__FILE__, ['PayitAth', 'deactive']);
// register_uninstall_hook(__FILE__, array('WP_Subsk', 'uninstall') );

add_action('init', ['PayitAth', 'init']);
