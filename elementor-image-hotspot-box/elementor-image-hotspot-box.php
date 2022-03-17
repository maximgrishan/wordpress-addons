<?php
/**
 * Plugin Name: Elementor Image Hotspot Box
 * Description: Elementor Image Hotspot Box for Elementor
 * Version:     1.0.0
 * Text Domain: elementor-image-hotspot-box
 */
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'elementor/widgets/widgets_registered', function() {

	require_once( __DIR__ . '/widget.php' );

	Plugin::instance()->widgets_manager->register( new Elementor_Image_Hotspot_Box() );
	
});