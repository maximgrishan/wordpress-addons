<?php
/**
 * Plugin Name: Elementor Woocommerce Dynamic Tag
 * Description: Add dynamic tag that returns an Woocommerce data.
 * Version: 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function register_woocommerce_dynamic_tag( $dynamic_tags_manager ) {

	require_once( __DIR__ . '/dynamic-tags/woocommerce-dynamic-tag.php' );
	$dynamic_tags_manager->register( new \Product_Attributes );

}

add_action( 'elementor/dynamic_tags/register', 'register_woocommerce_dynamic_tag' );