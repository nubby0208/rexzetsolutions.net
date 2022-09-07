<?php
namespace Elementor;

class Pix_Eor_Alert extends Widget_Base {

	public function __construct($data = [], $args = null) {
      parent::__construct($data, $args);

      // wp_register_script( 'pix-alert-handle', PIX_CORE_PLUGIN_URI.'functions/elementor/js/alert.js', [ 'elementor-frontend' ], PIXFORT_PLUGIN_VERSION, true );
   	}

	public function get_name() {
		return 'pix-alert';
	}

	public function get_title() {
		return 'Alert';
	}

	public function get_icon() {
		return 'eicon-alert pixfort-elementor-element pixfort-elementor-alert';
	}

	public function get_categories() {
		return [ 'pixfort' ];
	}

	public function get_help_url() {
		return 'https://essentials.pixfort.com/knowledge-base/';
	}

	protected function register_controls() {


		$colors = array(
			"Default"   => 'alert-default',
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
			"Custom"		=> "custom",
		);


		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'elementor' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'elementor' ),
				'default' => 'Alert title',
				'dynamic'     => array(
                    'active'  => true
                ),
			]
		);
		$this->add_control(
			'bold',
			[
				'label' => __( 'Bold', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => 'font-weight-bold',
				'default' => 'font-weight-bold',
			]
		);
		
		$this->add_control(
			'alert_type_1',
			[
				'label' => __( 'Alert Type', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'success'		=> 'Success',
	                'secondary'		=> 'Secondary',
	                'primary' 		=> 'Primary',
	                'danger' 		=> 'Danger',
	                'warning' 		=> 'Warning',
	                'info' 		    => 'Info',
	                'light' 		=> 'Light',
	                'dark' 		    => 'Dark'
				],
				'default' => 'success',
			]
		);

		

			$this->add_control(
				'rounded_img',
				[
					'label' => __( 'Rounded corners', 'pixfort-core' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'rounded-lg',
					'options' => [
						'rounded-0' => __( 'No', 'pixfort-core' ),
						'rounded' => __( 'Rounded', 'pixfort-core' ),
						'rounded-lg' => __( 'Rounded Large', 'pixfort-core' ),
						'rounded-xl' => __( 'Rounded 5px', 'pixfort-core' ),
						'rounded-10' => __( 'Rounded 10px', 'pixfort-core' ),
					],
				]
			);
			$this->add_control(
				'shadow',
				[
					'label' => __( 'Shadow Style', 'pixfort-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array(
						"0" => "Default",
						"1"       => "Small shadow",
						"2"       => "Medium shadow",
						"3"       => "Large shadow",
						"4"       => "Inverse Small shadow",
						"5"       => "Inverse Medium shadow",
						"6"       => "Inverse Large shadow",
					),
					'default' => '2',
				]
			);
			$this->add_control(
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
				]
			);
			$this->add_control(
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
				]
			);

			$this->add_control(
				'hide_close',
				[
					'label' => __('Hide Close button', 'pixfort-core'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __('Yes', 'pixfort-core'),
					'label_off' => __('No', 'pixfort-core'),
					'return_value' => 'true',
					'default' => ''
				]
			);

			$this->add_control(
				'animation',
				[
					'label' => __( 'Animation', 'pixfort-core' ),
					'type' => Controls_Manager::SELECT,
					'default' => '',
					'options' => pix_get_animations(true),
				]
			);
			$this->add_control(
				'delay',
				[
					'label' => __( 'Animation delay (in miliseconds)', 'pixfort-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( '0', 'pixfort-core' ),
					'placeholder' => __( '', 'pixfort-core' ),
					'condition' => [
						'animation!' => '',
					],
				]
			);


			$this->end_controls_section();

			$this->start_controls_section(
				'section_element_link',
				[
					'label' => __( 'Link', 'elementor' ),
				]
			);
			$this->add_control(
				'link_text',
				[
					'label' => __('Link Text', 'elementor'),
					'label_block' => false,
					'type' => Controls_Manager::TEXT,
					'placeholder' => __('', 'elementor'),
					'default' => '',
				]
			);
			$this->add_control(
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
				'link_color',
				[
					'label' => __('Link text color', 'pixfort-core'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array_flip($colors),
					'default' => 'alert-default',
					'condition' => [
						'link_text!' => '',
					],
				]
			);
			$this->add_control(
				'text_custom_color',
				[
					'label' => __('Link custom text color', 'pixfort-core'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'condition' => [
						'link_color' => 'custom',
					],
				]
			);
			$this->end_controls_section();


			$this->start_controls_section(
				'section_element_image',
				[
					'label' => __( 'Image / Icon', 'elementor' ),
				]
			);
			$this->add_control(
				'media_type',
				[
					'label' => __( 'Use image or icon', 'pixfort-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array(
						"none"       => "None",
						"image"       => "Image",
						"icon"       => "Icon",
						"duo_icon"       => "Duo tone icon",
						"char"       => "Character",
					),
					'default' => 'none',
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
			$this->add_control(
				'pix_duo_icon',
				[
					'label' => __('Duo tone icons', 'pixfort-core'),
					'type' => \Elementor\CustomControl\IconSelector_Control::IconSelector,
					'options'	=> $due_opts,
					'default' => '',
					'condition' => [
						'media_type' => 'duo_icon',
					],
				]
			);
			$this->add_control(
				'char',
				[
					'label' => __( 'Character', 'pixfort-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( '1', 'pixfort-core' ),
					'placeholder' => __( '', 'pixfort-core' ),
					'condition' => [
						'media_type' => 'char',
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
			$this->add_control(
				'icon',
				[
					'label' => __('Icon', 'pixfort-core'),
					'type' => \Elementor\CustomControl\FonticonSelector_Control::FonticonSelector,
					'options'	=> $fontiocns_opts,
					'default' => '',
					'condition' => [
						'media_type' => 'icon',
					],
				]
			);
			$this->add_control(
				'icon_color',
				[
					'label' => __( 'Icon color', 'pixfort-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array_flip($colors),
					'default' => 'primary',
				]
			);
			$this->add_control(
				'custom_icon_color',
				[
					'label' => __( 'Custom Icon Color', 'pixfort-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'condition' => [
						'icon_color' => 'custom',
					],
				]
			);
			$this->add_control(
				'icon_size',
				[
					'label' => __( 'Icon Size (without unit)', 'pixfort-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( '30', 'pixfort-core' ),
					'placeholder' => __( '', 'pixfort-core' ),
					'condition' => [
						'media_type' => array("icon", "char", "duo_icon")
					],
				]
			);

			$this->add_control(
				'image',
				[
					'label' => __( 'Image', 'pixfort-core' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'dynamic'     => array(
						'active'  => true
					),
					'condition' => [
						'media_type' => 'image',
					],
				]
			);
			$this->add_control(
				'image_size',
				[
					'label' => __( 'Image Size (with unit)', 'pixfort-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( '', 'pixfort-core' ),
					'placeholder' => __( 'Leave empty for full size.', 'pixfort-core' ),
					'condition' => [
						'media_type' => 'image',
					],
				]
			);
			$this->add_control(
				'circle',
				[
					'label' => __( 'Circle image', 'pixfort-core' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Yes', 'pixfort-core' ),
					'label_off' => __( 'No', 'pixfort-core' ),
					'return_value' => 'yes',
					'default' => '',
					'condition' => [
						'media_type' => 'image',
					],
				]
			);

	

		$this->end_controls_section();


		$this->start_controls_section(
			'section_element_style',
			[
				'label' => __( 'Style', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'alert_inner_typography',
				'selector' => '{{WRAPPER}}, {{WRAPPER}} .heading-text span, {{WRAPPER}} .body-font, {{WRAPPER}} .secondary-font',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}}',
			]
		);
		
		$this->end_controls_section();

	}

	protected function render() {
        $settings = $this->get_settings_for_display();
		echo pf_alertblock($settings);
	}



	public function get_script_depends() {
		if(is_user_logged_in()) return [ 'pix-global' ];
 		return [];
	  }


}
