<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Product_Attributes extends \Elementor\Core\DynamicTags\Tag {

    public function get_name() {
        return 'woocommerce-product-attributes-tag';
    }

    public function get_title() {
        return esc_html__( 'Product Attributes', 'elementor-pro' );
    }

    public function get_group() {
        return [ \ElementorPro\Modules\Woocommerce\Module::WOOCOMMERCE_GROUP ];
    }

    public function get_categories() {
        return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ];
    }

    protected function register_controls() {
	    $product_id = get_queried_object_id();

	    $product = wc_get_product( $product_id );
	    if ( ! $product ) return;

	    $attributes = $product->get_attributes();
	    if ( ! $attributes ) return;

        $options = [];

	    foreach ( $attributes as $attribute ) {
	    	$slug = $attribute['name'];
            $options[$slug] = wc_attribute_label( $attribute['name'] );
        }

        $this->add_control(
            'attributes',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => esc_html__( 'Attribute', 'elementor-pro' ),
                'options' => $options,
            ]
        );
    }

    public function render() {
	    $settings = $this->get_settings();

	    $product_id = get_queried_object_id();

	    $product = wc_get_product( $product_id );
	    if ( ! $product ) return;

	    echo $product->get_attribute( $settings['attributes'] );
    }

}