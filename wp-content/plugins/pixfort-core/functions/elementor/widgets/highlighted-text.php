<?php

namespace Elementor;

class Pix_Eor_Highlighted_Text extends Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
	}

	public function get_name() {
		return 'pix-highlighted-text';
	}

	public function get_title() {
		return 'Highlighted text';
	}

	public function get_icon() {
		return 'eicon-code-highlight pixfort-elementor-element pixfort-elementor-highlighted-text';
	}

	public function get_categories() {
		return ['pixfort'];
	}

	public function get_help_url() {
		return 'https://essentials.pixfort.com/knowledge-base/';
	}

	protected function register_controls() {
		$colors = array(
			"Body default"			=> "body-default",
			"Heading default"		=> "heading-default",
			"Primary"				=> "primary",
			"Primary Gradient"		=> "gradient-primary",
			"Secondary"				=> "secondary",
			"White"					=> "white",
			"Black"					=> "black",
			"Green"					=> "green",
			"Blue"					=> "blue",
			"Red"					=> "red",
			"Yellow"				=> "yellow",
			"Brown"					=> "brown",
			"Purple"				=> "purple",
			"Orange"				=> "orange",
			"Cyan"					=> "cyan",
			// "Transparent"					=> "transparent",
			"Gray 1"				=> "gray-1",
			"Gray 2"				=> "gray-2",
			"Gray 3"				=> "gray-3",
			"Gray 4"				=> "gray-4",
			"Gray 5"				=> "gray-5",
			"Gray 6"				=> "gray-6",
			"Gray 7"				=> "gray-7",
			"Gray 8"				=> "gray-8",
			"Gray 9"				=> "gray-9",
			"Dark opacity 1"		=> "dark-opacity-1",
			"Dark opacity 2"		=> "dark-opacity-2",
			"Dark opacity 3"		=> "dark-opacity-3",
			"Dark opacity 4"		=> "dark-opacity-4",
			"Dark opacity 5"		=> "dark-opacity-5",
			"Dark opacity 6"		=> "dark-opacity-6",
			"Dark opacity 7"		=> "dark-opacity-7",
			"Dark opacity 8"		=> "dark-opacity-8",
			"Dark opacity 9"		=> "dark-opacity-9",
			"Light opacity 1"		=> "light-opacity-1",
			"Light opacity 2"		=> "light-opacity-2",
			"Light opacity 3"		=> "light-opacity-3",
			"Light opacity 4"		=> "light-opacity-4",
			"Light opacity 5"		=> "light-opacity-5",
			"Light opacity 6"		=> "light-opacity-6",
			"Light opacity 7"		=> "light-opacity-7",
			"Light opacity 8"		=> "light-opacity-8",
			"Light opacity 9"		=> "light-opacity-9",
			"Custom"				=> "custom"
		);


		$this->start_controls_section(
			'section_title',
			[
				'label' => __('Content', 'elementor'),
			]
		);



		$repeater = new \Elementor\Repeater();
		
		
			$repeater->add_control(
				'is_highlighted',
				[
					'label' => __('Highlighted', 'pixfort-core'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '',
					'options' => array_flip(array(
						__('Normal text', 'pixfort-core')     => '',
						__('Highlighted text', 'pixfort-core')    => 'yes',
						__('Image', 'pixfort-core')        => 'image',
					)),
				]
			);
			$repeater->add_control(
				'text',
				[
					'label' => __('Text', 'elementor'),
					'label_block' => true,
					'type' => Controls_Manager::TEXT,
					'placeholder' => __('Enter the text', 'elementor'),
					'default' => '',
					'dynamic'     => array(
						'active'  => true
					),
					'condition' => [
						'is_highlighted!' => 'image',
					],
				]
			);
			$repeater->add_control(
				'highlight_color',
				[
					'label' => __('Highlight color', 'pixfort-core'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#ffd900',
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.pix-highlight-bg' => 'background-image: linear-gradient( {{VALUE}}, {{VALUE}} ) !important;',
					],
					'dynamic'     => array(
						'active'  => true
					),
					'condition' => [
						'is_highlighted' => 'yes',
					],
				]
			);
			$repeater->add_control(
				'custom_height',
				[
					'label' => __('Custom height (default is 30)', 'elementor'),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __('Input number between 0 and 100', 'elementor'),
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.animated:not(:hover), {{WRAPPER}} {{CURRENT_ITEM}}.highlight-grow' => 'background-size: 100% {{VALUE}}% !important;',
					],
					'dynamic'     => array(
						'active'  => true
					),
					'condition' => [
						'is_highlighted' => 'yes',
					],
				]
			);
			$repeater->add_control(
				'bold',
				[
					'label' => __('Bold', 'pixfort-core'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __('Yes', 'pixfort-core'),
					'label_off' => __('No', 'pixfort-core'),
					'return_value' => 'font-weight-bold',
					'default' => false,
					'condition' => [
						'is_highlighted' => ['', 'yes'],
					],
				]
			);
			$repeater->add_control(
				'italic',
				[
					'label' => __('Italic', 'pixfort-core'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __('Yes', 'pixfort-core'),
					'label_off' => __('No', 'pixfort-core'),
					'return_value' => 'font-italic',
					'default' => false,
					'condition' => [
						'is_highlighted' => ['', 'yes'],
					],
				]
			);
			$repeater->add_control(
				'heading_font',
				[
					'label' => __('Heading font', 'pixfort-core'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __('Yes', 'pixfort-core'),
					'label_off' => __('No', 'pixfort-core'),
					'return_value' => 'heading-font',
					'default' => 'heading-font',
					'condition' => [
						'is_highlighted' => ['', 'yes'],
					],
				]
			);
			$repeater->add_control(
				'has_color',
				[
					'label' => __('Different color', 'pixfort-core'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __('Yes', 'pixfort-core'),
					'label_off' => __('No', 'pixfort-core'),
					'return_value' => 'yes',
					'default' => false,
					'condition' => [
						'is_highlighted' => ['', 'yes'],
					],
				]
			);
			$repeater->add_control(
				'item_color',
				[
					'label' => __('Text Color', 'pixfort-core'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array_flip(array_merge(
						$colors,
						array("Custom Gradient" => 'custom-gradient')
					)),
					'default' => '',
					'condition' => [
						'has_color' => ['yes'],
					],
				]
			);
			$repeater->add_control(
				'item_custom_color',
				[
					'label' => __('Custom Text color', 'pixfort-core'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#333',
					'condition' => [
						'item_color' => 'custom',
					],
					'selectors' => [
						'{{WRAPPER}} .el-title_custom_color' => 'color: {{VALUE}};',
					],
				]
			);
			$repeater->add_responsive_control(
				'item_custom_gradient_color',
				[
					'label' => esc_html__('Gradient custom picker', 'pixfort-core'),
					'type' => \Elementor\CustomControl\CustomGradient_Control::CustomGradient,
					'default' => '',
					'class' => '',
					'condition' => [
						'item_color' => 'custom-gradient',
					],
					'selectors' => [
						'{{WRAPPER}}:before' => 'border-radius: inherit;background: {{VALUE}} !important; content: \' \';position: absolute;width: 100%;height: 100%;top: 0;left: 0;pointer-events: none;z-index: 0;',
						'{{WRAPPER}} .elementor-background-video-container' => 'z-index: -1;'
					],
	
				]
			);
			$repeater->add_control(
				'image',
				[
					'label' => __( 'Image', 'pixfort-core' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'dynamic'     => array(
						'active'  => true
					),
					'condition' => [
						'is_highlighted' => 'image',
					],
				]
			);
			$repeater->add_control(
				'image_size',
				[
					'label' => __( 'Image Size', 'pixfort-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( '', 'pixfort-core' ),
					'placeholder' => __( 'Leave empty for full size.', 'pixfort-core' ),
					'condition' => [
						'is_highlighted' => 'image',
					],
				]
			);
			$repeater->add_control(
				'rounded_img',
				[
					'label' => __( 'Rounded corners', 'pixfort-core' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'rounded-lg',
					'options' => [
						'rounded-0' => __( 'No', 'pixfort-core' ),
						'rounded' => __( 'Rounded Small', 'pixfort-core' ),
						'rounded-lg' => __( 'Rounded Large', 'pixfort-core' ),
						'rounded-xl' => __( 'Rounded 5px', 'pixfort-core' ),
						'rounded-10' => __( 'Rounded 10px', 'pixfort-core' ),
						'rounded-circle' => 	__('Circle', 'pixfort-core')
					],
					'condition' => [
						'is_highlighted' => 'image',
					],
				]
			);
			$repeater->add_control(
				'style',
				[
					'label' => __( 'Shadow Style', 'pixfort-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array(
						"" => "Default",
						"1"       => "Small shadow",
						"2"       => "Medium shadow",
						"3"       => "Large shadow",
						"4"       => "Inverse Small shadow",
						"5"       => "Inverse Medium shadow",
						"6"       => "Inverse Large shadow",
					),
					'default' => '',
					'condition' => [
						'is_highlighted' => 'image',
					],
				]
			);
			$repeater->add_control(
				'hover_effect',
				[
					'label' => __( 'Shadow Hover Style', 'pixfort-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array(
						""       => "None",
						"1"       => "Small hover shadow",
						"2"       => "Medium hover shadow",
						"3"       => "Large hover shadow",
						"4"       => "Inverse Small hover shadow",
						"5"       => "Inverse Medium hover shadow",
						"6"       => "Inverse Large hover shadow",
					),
					'default' => '',
					'condition' => [
						'is_highlighted' => 'image',
					],
				]
			);
			$repeater->add_control(
				'add_hover_effect',
				[
					'label' => __( 'Hover Animation', 'pixfort-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array(
						""       => "None",
					  "1"       => "Fly Small",
					  "2"       => "Fly Medium",
					  "3"       => "Fly Large",
					  "4"       => "Scale Small",
					  "5"       => "Scale Medium",
					  "6"       => "Scale Large",
					  "7"       => "Scale Inverse Small",
					  "8"       => "Scale Inverse Medium",
					  "9"       => "Scale Inverse Large",
					),
					'default' => '',
					'condition' => [
						'is_highlighted' => 'image',
					],
				]
			);
			$repeater->add_control(
				'item_animation',
				[
					'label' => __( 'Animation', 'pixfort-core' ),
					'type' => Controls_Manager::SELECT,
					'default' => '',
					'options' => pix_get_animations(true),
					'condition' => [
						'is_highlighted' => 'image',
					],
				]
			);
			$repeater->add_control(
				'item_delay',
				[
					'label' => __( 'Animation delay (in miliseconds)', 'pixfort-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( '0', 'pixfort-core' ),
					'placeholder' => __( '', 'pixfort-core' ),
					'condition' => [
						'item_animation!' => '',
					],
				]
			);

		
		
		
		$repeater->add_control(
			'new_line',
			[
				'label' => __('Add new line after text', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'pixfort-core'),
				'label_off' => __('No', 'pixfort-core'),
				'return_value' => 'yes',
				'default' => false,
			]
		);

		$this->add_control(
			'items',
			[
				'label' => __('Text', 'pixfort-core'),
				'type' => Controls_Manager::REPEATER,
				'title_field' => '{{{ text }}}',
				'fields' => $repeater->get_controls()
			]
		);



		//
		// $this->add_control(
		// 	'title',
		// 	[
		// 		'label' => __( 'Title', 'elementor' ),
		// 		'label_block' => true,
		// 		'type' => Controls_Manager::TEXT,
		// 		'placeholder' => __( '', 'elementor' ),
		// 		'default' => '',
		// 		'dynamic'     => array(
		//             'active'  => true
		//         ),
		// 	]
		// );

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

		$this->end_controls_section();
		$this->start_controls_section(
			'title_section',
			[
				'label' => __('Text format', 'pixfort-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		// $this->add_control(
		// 	'bold',
		// 	[
		// 		'label' => __( 'Bold', 'pixfort-core' ),
		// 		'type' => \Elementor\Controls_Manager::SWITCHER,
		// 		'label_on' => __( 'Yes', 'pixfort-core' ),
		// 		'label_off' => __( 'No', 'pixfort-core' ),
		// 		'return_value' => 'font-weight-bold',
		// 		'default' => 'font-weight-bold',
		// 	]
		// );
		// $this->add_control(
		// 	'italic',
		// 	[
		// 		'label' => __( 'Italic', 'pixfort-core' ),
		// 		'type' => \Elementor\Controls_Manager::SWITCHER,
		// 		'label_on' => __( 'Yes', 'pixfort-core' ),
		// 		'label_off' => __( 'No', 'pixfort-core' ),
		// 		'return_value' => 'font-italic',
		// 		'default' => '',
		// 	]
		// );
		// $this->add_control(
		// 	'secondary_font',
		// 	[
		// 		'label' => __( 'Secondary font', 'pixfort-core' ),
		// 		'type' => \Elementor\Controls_Manager::SWITCHER,
		// 		'label_on' => __( 'Yes', 'pixfort-core' ),
		// 		'label_off' => __( 'No', 'pixfort-core' ),
		// 		'return_value' => 'secondary-font',
		// 		'default' => '',
		// 	]
		// );
		$this->add_control(
			'title_color',
			[
				'label' => __('Text color', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => array_flip($colors),
				'default' => '',
			]
		);
		$this->add_control(
			'title_custom_color',
			[
				'label' => __('Custom Text color', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'title_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .text-custom' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_size',
			[
				'label' => __('Text size', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => array_flip(array(
					__('H1', 'pixfort-core') 	=> 'h1',
					__('H2', 'pixfort-core')	    => 'h2',
					__('H3', 'pixfort-core')	    => 'h3',
					__('H4', 'pixfort-core')	    => 'h4',
					__('H5', 'pixfort-core')	    => 'h5',
					__('H6', 'pixfort-core')	    => 'h6',
					__('Custom', 'pixfort-core')	    => 'custom',
				)),
				'default' => 'h1',
			]
		);
		$this->add_control(
			'title_custom_size',
			[
				'label' => __('Custom Text size', 'elementor'),
				'label_block' => false,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('Enter custom title size', 'elementor'),
				'default' => '',
				'condition' => [
					'title_size' => 'custom',
				],
			]
		);
		$this->add_control(
			'display',
			[
				'label' => __('Bigger Text', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					''		=> 'None',
					'display-1'		=> 'Display 1',
					'display-2'		=> 'Display 2',
					'display-3'		=> 'Display 3',
					'display-4'		=> 'Display 4',
				),
				'default' => '',
				'condition' => [
					'title_size' => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6')
				],
			]
		);
		$this->add_responsive_control(
			'position',
			[
				'label' => __('Position', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'text-center'		=> 'Center',
					'text-left'			=> 'Left',
					'text-right' 		=> 'Right',
				),
				'default' => 'text-center',
				'selectors_dictionary' => [
					'text-center' 		=> 'text-align: center !important;',
					'text-left' 		=> 'text-align: left !important;',
					'text-right' 		=> 'text-align: right !important;'
				],
				'selectors' => [
					'{{WRAPPER}} .pix-highlighted-element' => '{{VALUE}}'
				],
			]
		);

		$this->add_control(
			'max_width',
			[
				'label' => __('Field max width', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('', 'pixfort-core'),
				'placeholder' => __('Input the width with the unit (eg. 300px)', 'pixfort-core'),
			]
		);	

		$this->add_control(
			'disable_resp_img',
			[
				'label' => __('Disable responsive images size in mobile devices', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'pixfort-core'),
				'label_off' => __('No', 'pixfort-core'),
				'return_value' => 'yes',
				// 'default' => false,
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		echo sc_pix_highlighted_text($settings);
	}

	public function get_script_depends() {
		if (is_user_logged_in()) return ['pix-global'];
		return [];
	}
}
