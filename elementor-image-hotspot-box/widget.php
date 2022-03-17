<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Elementor_Image_Hotspot_Box extends Widget_Base {
    /**
     * Widget Image Hotspot Box.
     */
    public function get_style_depends() {
        wp_register_style( 'image-hotspot-box-style', plugins_url( 'assets/css/main.css', __FILE__ ) );
        wp_register_style( 'image-hotspot-box-fancybox-style', plugins_url( 'assets/css/jquery.fancybox.min.css', __FILE__ ) );

        return [
            'image-hotspot-box-style',
            'image-hotspot-box-fancybox-style',
        ];
    }

    public function get_script_depends() {
        wp_register_script( 'image-hotspot-box-fancybox-script', plugins_url( 'assets/js/jquery.fancybox.min.js', __FILE__ ) );

        return [
            'image-hotspot-box-fancybox-script',
        ];
    }

    public function get_name() {
		return 'elementor-image-hotspot-box';
	}

	public function get_title() {
		return esc_html__( 'Image Hotspot Box', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-image-box';
	}

	public function get_keywords() {
		return [ 'image', 'photo', 'visual', 'box', 'hotspot' ];
	}

    protected function register_controls() {
		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'Image Hotspot Box', 'elementor' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'elementor' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' => esc_html__( 'Title & Description', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'This is the heading', 'elementor' ),
				'placeholder' => esc_html__( 'Enter your title', 'elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'description_text',
			[
				'label' => esc_html__( 'Content', 'elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
				'placeholder' => esc_html__( 'Enter your description', 'elementor' ),
				'separator' => 'none',
				'rows' => 10,
				'show_label' => false,
			]
		);

		$this->add_control(
			'tooltip_text',
			[
				'label' => esc_html__( 'Tooltip text', 'elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
				'placeholder' => esc_html__( 'Enter your tooltip text', 'elementor' ),
				'separator' => 'none',
				'rows' => 10,
				'show_label' => true,
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'elementor' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'position',
			[
				'label' => esc_html__( 'Image Position', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => esc_html__( 'Top', 'elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'elementor-position-',
				'toggle' => false,
			]
		);

		$this->add_control(
			'title_size',
			[
				'label' => esc_html__( 'Title HTML Tag', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h3',
			]
		);

		$this->add_control(
			'view',
			[
				'label' => esc_html__( 'View', 'elementor' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_space',
			[
				'label' => esc_html__( 'Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-position-right .elementor-image-box-img' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-left .elementor-image-box-img' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-top .elementor-image-box-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .elementor-image-box-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_size',
			[
				'label' => esc_html__( 'Width', 'elementor' ) . ' (%)',
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-wrapper .elementor-image-box-img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-wrapper img' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'elementor' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab( 'normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .elementor-image-box-img img',
			]
		);

		$this->add_control(
			'image_opacity',
			[
				'label' => esc_html__( 'Opacity', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-img img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'background_hover_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-img img' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}}:hover .elementor-image-box-img img',
			]
		);

		$this->add_control(
			'image_opacity_hover',
			[
				'label' => esc_html__( 'Opacity', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover .elementor-image-box-img img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_vertical_alignment',
			[
				'label' => esc_html__( 'Vertical Alignment', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => esc_html__( 'Top', 'elementor' ),
					'middle' => esc_html__( 'Middle', 'elementor' ),
					'bottom' => esc_html__( 'Bottom', 'elementor' ),
				],
				'default' => 'top',
				'prefix_class' => 'elementor-vertical-align-',
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => esc_html__( 'Title', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => esc_html__( 'Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-title' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .elementor-image-box-title',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .elementor-image-box-title',
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => esc_html__( 'Description', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-description' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .elementor-image-box-description',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'description_shadow',
				'selector' => '{{WRAPPER}} .elementor-image-box-description',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render image box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
        $settings = $this->get_settings_for_display();

        $widget_id = mt_rand(1000000, 9999999);

		$has_content = ! Utils::is_empty( $settings['title_text'] ) || ! Utils::is_empty( $settings['description_text'] ) || ! Utils::is_empty( $settings['tooltip_text'] );

		$html = '<div class="elementor-image-box-wrapper elementor-image-hotspot-box-wrapper">';

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'link', $settings['link'] );
		}

		if ( ! empty( $settings['image']['url'] ) ) {
			$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
			$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
			$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );

			if ( $settings['hover_animation'] ) {
				$this->add_render_attribute( 'image', 'class', 'elementor-animation-' . $settings['hover_animation'] );
			}

			$image_html = wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ) );

			//$image_html = '<a data-fancybox data-src="#hidden-content-' . $widget_id . '" href="javascript:;">' . $image_html . '</a>';

			$html .= '<figure class="elementor-image-box-img">' . $image_html . '</figure>';
		}

		if ( $has_content ) {
			$html .= '<a data-fancybox data-src="#hidden-content-' . $widget_id . '" href="javascript:;" class="elementor-image-box-content">';

			if ( ! Utils::is_empty( $settings['title_text'] ) ) {
				$this->add_render_attribute( 'title_text', 'class', 'elementor-image-box-title' );

				$this->add_inline_editing_attributes( 'title_text', 'none' );

				$title_html = '<a data-fancybox data-src="#hidden-content-' . $widget_id . '" href="javascript:;">' . $settings['title_text'] . '</a>';
				$title_html = $settings['title_text'];

				$html .= sprintf( '<%1$s %2$s>%3$s</%1$s>', Utils::validate_html_tag( $settings['title_size'] ), $this->get_render_attribute_string( 'title_text' ), $title_html );
			}

			if ( ! Utils::is_empty( $settings['description_text'] ) ) {
				$this->add_render_attribute( 'description_text', 'class', 'elementor-image-box-description' );

				$this->add_inline_editing_attributes( 'description_text' );

				$html .= sprintf( '<p %1$s>%2$s</p>', $this->get_render_attribute_string( 'description_text' ), $settings['description_text'] );
			}

			$html .= '</a>';

            $html .= '<div style="display: none;" class="fancybox-people__content" id="hidden-content-' . $widget_id . '">';

                $html .= '<h2 class="fancybox-people__title">' . $settings['title_text'] . '</h2>';

                $html .= '<span class="fancybox-people__position">' . $settings['description_text'] . '</span>';

                $html .= '<p class="fancybox-people__description">' . $settings['tooltip_text'] . '</p>';

            $html .= '</div>';
		}

		$html .= '</div>';

		Utils::print_unescaped_internal_string( $html );
	}

	/**
	 * Render image box widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() {
		?>
		<#
		var html = '<div class="elementor-image-box-wrapper elementor-image-hotspot-box-wrapper">';

		if ( settings.image.url ) {
			var image = {
				id: settings.image.id,
				url: settings.image.url,
				size: settings.thumbnail_size,
				dimension: settings.thumbnail_custom_dimension,
				model: view.getEditModel()
			};

			var image_url = elementor.imagesManager.getImageUrl( image );

			var imageHtml = '<img src="' + image_url + '" class="elementor-animation-' + settings.hover_animation + '" />';

			html += '<figure class="elementor-image-box-img">' + imageHtml + '</figure>';
		}

		var hasContent = !! ( settings.title_text || settings.description_text || settings.tooltip_text );

		if ( hasContent ) {
			html += '<div class="elementor-image-box-content">';

			if ( settings.title_text ) {
				var title_html = settings.title_text,
					titleSizeTag = elementor.helpers.validateHTMLTag( settings.title_size );

				view.addRenderAttribute( 'title_text', 'class', 'elementor-image-box-title' );

				view.addInlineEditingAttributes( 'title_text', 'none' );

				html += '<' + titleSizeTag  + ' ' + view.getRenderAttributeString( 'title_text' ) + '>' + title_html + '</' + titleSizeTag  + '>';
			}

			if ( settings.description_text ) {
				view.addRenderAttribute( 'description_text', 'class', 'elementor-image-box-description' );

				view.addInlineEditingAttributes( 'description_text' );

				html += '<p ' + view.getRenderAttributeString( 'description_text' ) + '>' + settings.description_text + '</p>';
			}

			html += '</div>';
		}

		html += '</div>';

		print( html );
		#>
		<?php
	}
}