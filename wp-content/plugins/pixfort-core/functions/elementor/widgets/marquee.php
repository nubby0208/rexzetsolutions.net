<?php

namespace Elementor;

class Pix_Eor_Marquee extends Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		wp_register_script('pix-marquee-handle', PIX_CORE_PLUGIN_URI . 'functions/elementor/js/marquee.js', ['elementor-frontend'], PIXFORT_PLUGIN_VERSION, true);
	}

	public function get_name() {
		return 'pix-marquee';
	}

	public function get_title() {
		return 'Marquee';
	}

	public function get_icon() {
		return 'eicon-code-highlight pixfort-elementor-element pixfort-elementor-marquee';
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
			'item_type',
			[
				'label' => __('Item type', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => array_flip(array(
					__("Text", 'pixfort-core')  => "text",
					__("Image", 'pixfort-core') => "image",
					__("Icon", 'pixfort-core') => "icon",
					__("Duo tone icon", 'pixfort-core') => "duo_icon"
				)),
				'default' => 'text',
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
					'item_type' => 'text',
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
					'item_type' => 'text',
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
					'item_type' => 'text',
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
					'item_type' => 'text',
				],
			]
		);
		$repeater->add_control(
			'text_image',
			[
				'label' => __( 'Use image as text color', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic'     => array(
                    'active'  => true
                ),
				'condition' => [
					'item_type' => 'text',
				],
			]
		);

		require PIX_CORE_PLUGIN_DIR.'/functions/images/icons_list.php';
		$due_opts = array();
		foreach ($pix_icons_list as $key) {
			$due_opts[$key] = array(
				'title'	=> $key,
				'url'	=> PIX_CORE_PLUGIN_URI.'functions/images/icons/'.$key.'.svg'
			);
		}
		$repeater->add_control(
			'pix_duo_icon',
			[
				'label' => __('Duo tone icons', 'pixfort-core'),
				'type' => \Elementor\CustomControl\IconSelector_Control::IconSelector,
				'options'	=> $due_opts,
				'default' => '',
				'condition' => [
					'item_type' => 'duo_icon',
				],
			]
		);
		$fontiocns_opts = array();
	    $fontiocns_opts[''] = array('title' => 'None', 'url' => '' );
	    $pixicons = vc_iconpicker_type_pixicons( array() );
	        foreach ($pixicons as $key) {
	            $fontiocns_opts[array_keys($key)[0]] = array(
	                'title'	=> array_keys($key)[0],
	                'url'	=> array_keys($key)[0]
	            );
	        }
	    $repeater->add_control(
	        'icon',
	        [
	            'label' => __('Icon', 'pixfort-core'),
	            'type' => \Elementor\CustomControl\FonticonSelector_Control::FonticonSelector,
	            'options'	=> $fontiocns_opts,
	            'default' => '',
				'condition' => [
					'item_type' => 'icon',
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
					'item_type' => 'image',
				],
			]
		);
		$repeater->add_control(
			'image_size',
			[
				'label' => __('Image Size', 'pixfort-core'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('The size of the image (in pixels), leave empty for full size.', 'pixfort-core'),
				'default' => '',
				'dynamic'     => array(
					'active'  => true
				),
				'condition' => [
					'item_type' => 'image',
				],
			]
		);
		$repeater->add_control(
			'rounded_img',
			[
				'label' => __( 'Rounded corners', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'rounded-0',
				'options' => [
					'rounded-0' 		=> __( 'No', 'pixfort-core' ),
					'rounded' 			=> __( 'Rounded', 'pixfort-core' ),
					'rounded-lg' 		=> __( 'Rounded Large', 'pixfort-core' ),
					'rounded-xl' 		=> __( 'Rounded 5px', 'pixfort-core' ),
					'rounded-10' 		=> __( 'Rounded 10px', 'pixfort-core' ),
					'rounded-circle'	=>	__('Circle','pixfort-core')
				],
				'condition' => [
					'item_type' => 'image',
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
					'item_type' => 'image',
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
					'item_type' => 'image',
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
					'item_type' => 'image',
				],
			]
		);
		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'pixfort-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( '', 'pixfort-core' ),
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => true,
				],
				'dynamic'     => array(
                    'active'  => true
                ),
			]
		);


		

		$this->add_control(
			'items',
			[
				'label' => __('Items', 'pixfort-core'),
				'type' => Controls_Manager::REPEATER,
				'title_field' => '{{{ text }}}',
				'fields' => $repeater->get_controls(),
				'default'	=> [
					[
						'item_type'	=>	'text',
						'text'		=>	'Marquee text!',
					],
					[
						'item_type'	=>	'text',
						'text'		=>	'Hello World',
					]
				]
			]
		);


		$this->add_control(
			'content_color',
			[
				'label' => __('Content color', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => array_flip($colors),
				'default' => '',
			]
		);
		$this->add_control(
			'content_custom_color',
			[
				'label' => __('Custom Content color', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'content_color' => 'custom',
				],
				// 'selectors' => [
				// 	'{{WRAPPER}} .el-title_custom_color' => 'color: {{VALUE}};',
				// ],
			]
		);
		$this->add_control(
			'content_size',
			[
				'label' => __( 'Content size', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => array_flip(array(
		            __('H1','pixfort-core') 	=> 'h1',
 				   __('H2','pixfort-core')	    => 'h2',
 				   __('H3','pixfort-core')	    => 'h3',
 				   __('H4','pixfort-core')	    => 'h4',
 				   __('H5','pixfort-core')	    => 'h5',
 				   __('H6','pixfort-core')	    => 'h6',
 				   __('Custom','pixfort-core')	    => 'custom',
		        )),
				'default' => 'h1',
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
					'content_size' => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6')
				],
			]
		);
		$this->add_control(
			'content_custom_size',
			[
				'label' => __('Content custom text Size', 'elementor'),
				'label_block' => false,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('Enter custom size', 'elementor'),
				'default' => '',
				'condition' => [
					'content_size' => 'custom',
				],
			]
		);
		$this->add_control(
			'reversed',
			[
				'label' => __('Reverse direction', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'pixfort-core'),
				'label_off' => __('No', 'pixfort-core'),
				'return_value' => 'pix-reversed',
				'default' => ''
			]
		);
		$this->add_control(
			'pause_on_hover',
			[
				'label' => __('Pause on hover', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'pixfort-core'),
				'label_off' => __('No', 'pixfort-core'),
				'return_value' => 'pix-pause-hover',
				'default' => ''
			]
		);
		$this->add_control(
			'pix_gray_effect',
			[
				'label' => __('Enable Gray effect', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'pixfort-core'),
				'label_off' => __('No', 'pixfort-core'),
				'return_value' => 'pix-gray-effect',
				'default' => ''
			]
		);
		$this->add_control(
			'pix_colored_hover',
			[
				'label' => __('Show original colors on hover', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'pixfort-core'),
				'label_off' => __('No', 'pixfort-core'),
				'return_value' => 'pix-colored-hover',
				'default' => '',
				'condition' => [
					'pix_gray_effect' => 'pix-gray-effect',
				],
			]
		);

		$this->end_controls_section();




		$this->start_controls_section(
			'advanced_section',
			[
				'label' => __( 'Advanced', 'pixfort-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'speed',
			[
				'label' => __('Speed (in seconds)', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('', 'pixfort-core'),
				'placeholder' => __('', 'pixfort-core'),
				'description' => __('The number of seconds to complete one full rotation (leave empty to use default 10).', 'pixfort-core'),
				'selectors' => [
					'{{WRAPPER}} .marquee__inner' => 'animation-duration: {{VALUE}}s !important;',
				],
			]
		);
		$this->add_control(
			'element_id',
			[
				'label' => __('Element ID', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('', 'pixfort-core'),
				'placeholder' => __('', 'pixfort-core'),
			]
		);
		$this->add_responsive_control(
			'items_padding',
			[
				'label' => __('Padding between items (with unit)', 'pixfort-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('', 'pixfort-core'),
				'placeholder' => __('', 'pixfort-core'),
				'description' => __('The padding for each Marquee item (leave empty to use default 4vw).<br>Tip: use relative unit for example "vw" to have responsive padding.', 'pixfort-core'),
				'selectors' => [
					'{{WRAPPER}} .pix-marquee-item' => 'padding: 0 {{VALUE}} !important;',
				],
			]
		);


		$this->end_controls_section();



		$this->start_controls_section(
			'section_element_style',
			[
				'label' => __('Style', 'elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'marquee_typography',
				'selector' => '{{WRAPPER}} .pix-marquee-item, {{WRAPPER}} .body-font, {{WRAPPER}} .heading-font, {{WRAPPER}} .secondary-font',
				'exclude' => [
					'text_decoration',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'marquee_text_shadow',
				'selector' => '{{WRAPPER}}',
			]
		);

		$this->end_controls_section();



	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		echo sc_pix_marquee($settings);
	}



	public function get_script_depends() {
		if (is_user_logged_in()) return ['pix-global', 'pix-marquee-handle'];
		return [];
	}
}
