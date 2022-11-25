<?php
/**
 * Plugin Name: Elementor Woocommerce Dynamic Tag
 * Description: Add dynamic tag that returns an Woocommerce data.
 * Version: 1.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function register_woocommerce_dynamic_tag( $dynamic_tags_manager ) {

	if ( class_exists( 'woocommerce' ) ) {
		// Check Woocommerce plugin exists
		require_once( __DIR__ . '/dynamic-tags/woocommerce-dynamic-tag.php' );
		$dynamic_tags_manager->register( new \Product_Attributes );
	}

	if ( class_exists('acf') ) {
		// Check ACF plugin exists
		require_once( __DIR__ . '/dynamic-tags/woocommerce-product-acf-dynamic-tag.php' );
		$dynamic_tags_manager->register( new \Product_ACF );
	}

}

add_action( 'elementor/dynamic_tags/register', 'register_woocommerce_dynamic_tag' );