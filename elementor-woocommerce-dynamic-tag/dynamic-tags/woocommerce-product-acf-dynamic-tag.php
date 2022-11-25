<?php

use \ElementorPro\Modules\DynamicTags\ACF\Module as ACF;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Product_ACF extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'woocommerce-product-acf-tag';
	}

	public function get_title() {
		return esc_html__( 'Product ACF', 'elementor-pro' );
	}

	public function get_group() {
		return [ \ElementorPro\Modules\Woocommerce\Module::WOOCOMMERCE_GROUP ];
	}

	public function get_categories() {
		return [
			\Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY,
			\Elementor\Modules\DynamicTags\Module::URL_CATEGORY,
		];
	}

	protected function register_controls() {
		$this->add_control(
			'key',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => esc_html__( 'ACF', 'elementor-pro' ),
				'groups' => ACF::get_control_options( self::get_supported_fields() ),
			]
		);
	}

	public function render() {
		$product_id = get_queried_object_id();

		$key = $this->get_settings('key');
		list( $field, $meta_key ) = explode(':', $key);

		$value = get_field( $meta_key, $product_id );

		echo wp_kses_post( $value );
	}

	public function get_supported_fields() {
		return [
			'text',
			'textarea',
			'number',
			'email',
			'password',
			'wysiwyg',
			'select',
			'checkbox',
			'radio',
			'true_false',
			'image',
			'file',
			'page_link',
			'post_object',
			'relationship',
			'taxonomy',
			'url',

			// Pro
			'oembed',
			'google_map',
			'date_picker',
			'time_picker',
			'date_time_picker',
			'color_picker',
		];
	}

}