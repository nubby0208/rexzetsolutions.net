<?php

namespace Elementor;

class Pix_Eor_Img extends Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
	}

	public function get_name() {
		return 'pix-img';
	}

	public function get_title() {
		return 'Image';
	}

	public function get_icon() {
		return 'eicon-image pixfort-elementor-element pixfort-elementor-image';
	}

	public function get_categories() {
		return ['pixfort'];
	}

	public function get_help_url() {
		return 'https://essentials.pixfort.com/knowledge-base/';
	}

	protected function register_controls() {
		$infinite_animation = array(
			"None"                  => "",
			"Rotating"              => "pix-rotating",
			"Rotating inversed"     => "pix-rotating-inverse",
			"Fade"                  => "pix-fade",
			"Bounce Small"          => "pix-bounce-sm",
			"Bounce Medium" 		=> "pix-bounce-md",
			"Bounce Large" 			=> "pix-bounce-lg",
			"Scale Small"           => "pix-scale-sm",
			"Scale Medium"           => "pix-scale-md",
			"Scale Large"           => "pix-scale-lg",

		);
		$animation_speeds = array(
			"Fast" 			=> "pix-duration-fast",
			"Medium" 		=> "pix-duration-md",
			"Slow" 			=> "pix-duration-slow",
		);
		$this->start_controls_section(
			'section_title',
			[
				'label' => __('General', 'pixfort-core'),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __('Choose Image', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic'     => array(
					'active'  => true
				),
			]
		);

		$this->add_control(
			'alt',
			[
				'label' => __('Image alternative text', 'elementor'),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active'  => true
				),
				'placeholder' => __('', 'elementor'),
				'default' => '',
			]
		);

		$this->add_control(
			'rounded_img',
			[
				'label' => __('Rounded corners', 'pixfort-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'rounded-lg',
				'options' => [
					'rounded-0' => __('No', 'pixfort-core'),
					'rounded' => __('Rounded', 'pixfort-core'),
					'rounded-lg' => __('Rounded Large', 'pixfort-core'),
					'rounded-xl' => __('Rounded 5px', 'pixfort-core'),
					'rounded-10' => __('Rounded 10px', 'pixfort-core'),
				],
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label' => __('Image alignment', 'pixfort-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					''			=> 'Default',
					'left'			=> 'Left',
					'center'		=> 'Center',
					'right' 		=> 'Right',
				],
				'selectors' => [
					'{{WRAPPER}} .pix-img-el, {{WRAPPER}} .pix-img-div, {{WRAPPER}} div' => 'text-align: {{value}} !important;',
				],
			]
		);
		$this->add_control(
			'width',
			[
				'label' => __('Width (Optional)', 'elementor'),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('input the value (with the unit: %, px,.. etc).', 'elementor'),
			]
		);
		$this->add_control(
			'height',
			[
				'label' => __('Height (Optional)', 'elementor'),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('input the value (with the unit: %, px,.. etc).', 'elementor'),
			]
		);
		$this->add_control(
			'link',
			[
				'label' => __('Link', 'elementor'),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('', 'elementor'),
			]
		);
		$this->add_control(
			'target',
			[
				'label' => __('Open in a new tab', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'pixfort-core'),
				'label_off' => __('No', 'pixfort-core'),
				'return_value' => 'Yes',
				// 'default' => '',
			]
		);

		$this->add_control(
			'pix_scale_in',
			[
				'label' => __('Image Scale In effect', 'pixfort-core'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					'' 		=> 'Disabled',
					'pix-scale-in-sm' 		=> 'Small scale',
					'pix-scale-in' 		=> 'Normal scale',
					'pix-scale-in-lg' 		=> 'Large scale',
				),
			]
		);

		$this->add_control(
			'pix_scroll_parallax',
			[
				'label' => __('Scroll Parallax', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Enable', 'pixfort-core'),
				'label_off' => __('Disable', 'pixfort-core'),
				'return_value' => 'scroll_parallax',
				'default' => 'no',
			]
		);

		$this->add_control(
			'xaxis',
			[
				'label' => __('X axis', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('0', 'pixfort-core'),
				'placeholder' => __('X axix value', 'pixfort-core'),
				'condition' => [
					'pix_scroll_parallax' => 'scroll_parallax',
				],
			]
		);
		$this->add_control(
			'yaxis',
			[
				'label' => __('Y axis', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('0', 'pixfort-core'),
				'placeholder' => __('Y axix value', 'pixfort-core'),
				'condition' => [
					'pix_scroll_parallax' => 'scroll_parallax',
				],
			]
		);

		$this->add_control(
			'pix_tilt',
			[
				'label' => __('3D Hover', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Enable', 'pixfort-core'),
				'label_off' => __('Disable', 'pixfort-core'),
				'return_value' => 'tilt',
				'default' => false,

			]
		);

		$this->add_control(
			'pix_tilt_size',
			[
				'label' => __('3d hover size', 'pixfort-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'tilt',
				'options' => [
					'tilt' => __('Default', 'pixfort-core'),
					'tilt_big' => __('Big', 'pixfort-core'),
					'tilt_small' => __('Small', 'pixfort-core'),
				],
				'condition' => [
					'pix_tilt' => 'tilt',
				],
			]
		);
		$this->add_control(
			'animation',
			[
				'label' => __('Animation', 'pixfort-core'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => pix_get_animations(true),
			]
		);
		$this->add_control(
			'delay',
			[
				'label' => __('Animation delay (in miliseconds)', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('0', 'pixfort-core'),
				'placeholder' => __('', 'pixfort-core'),
				'condition' => [
					'animation!' => '',
				],
			]
		);
		$this->add_control(
			'pix_infinite_animation',
			[
				'label' => __('Infinite Animation type', 'pixfort-core'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => array_flip($infinite_animation),
			]
		);
		$this->add_control(
			'pix_infinite_speed',
			[
				'label' => __('Infinite Animation Speed', 'pixfort-core'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => array_flip($animation_speeds),
			]
		);

		$this->add_control(
			'img_div',
			[
				'label' => __('Image inside a container', 'pixfort-core'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' 		=> 'Disabled',
					'text-center' 		=> 'Center align',
					'text-left' 		=> 'Left align',
					'text-right' 		=> 'Right align',
				],
			]
		);


		$this->end_controls_section();




		pix_get_elementor_effects($this);





		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__('Advanced Image Options', 'elementor'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'advanced_width',
			[
				'label' => esc_html__('Width', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => ['%', 'px', 'vw'],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'advanced_space',
			[
				'label' => esc_html__('Max Width', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => ['%', 'px', 'vw'],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'max-width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'advanced_height',
			[
				'label' => esc_html__('Height', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => ['px', 'vh'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'advanced_object-fit',
			[
				'label' => esc_html__('Object Fit', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'condition' => [
					'advanced_height[size]!' => '',
				],
				'options' => [
					'' => esc_html__('Default', 'elementor'),
					'fill' => esc_html__('Fill', 'elementor'),
					'cover' => esc_html__('Cover', 'elementor'),
					'contain' => esc_html__('Contain', 'elementor'),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} img' => 'object-fit: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'separator_panel_style',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs('image_effects');

		$this->start_controls_tab(
			'normal',
			[
				'label' => esc_html__('Normal', 'elementor'),
			]
		);

		$this->add_control(
			'advanced_opacity',
			[
				'label' => esc_html__('Opacity', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pix-img-el' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .pix-img-el',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover',
			[
				'label' => esc_html__('Hover', 'elementor'),
			]
		);

		$this->add_control(
			'advanced_opacity_hover',
			[
				'label' => esc_html__('Opacity', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover .pix-img-el' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}}:hover .pix-img-el',
			]
		);

		$this->add_control(
			'advanced_background_hover_transition',
			[
				'label' => esc_html__('Transition Duration', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pix-img-el' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_control(
			'advanced_hover_animation',
			[
				'label' => esc_html__('Hover Animation', 'elementor'),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'advanced_image_border',
				'selector' => '{{WRAPPER}} img',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'advanced_image_border_radius',
			[
				'label' => esc_html__('Border Radius', 'elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .pix-img-el' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'advanced_image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} img',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		echo sc_pix_img($settings);
	}

	public function get_script_depends() {
		if (is_user_logged_in()) return ['pix-global'];
		return [];
	}
}
