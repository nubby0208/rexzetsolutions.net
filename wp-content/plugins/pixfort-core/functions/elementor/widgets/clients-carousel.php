<?php
namespace Elementor;

class Pix_Eor_Clients_Carousel extends Widget_Base {

	public function __construct($data = [], $args = null) {

		// Link migration code
		if(!empty($data['settings'])){
			if(!empty($data['settings']['clients'])){
				foreach ($data['settings']['clients'] as $key => $value) {
					$is_external = true;
					if( array_key_exists('target', $data['settings']['clients'][$key]) ){
						$is_external = false;
					}
					if(!empty($data['settings']['clients'][$key]['link'])&&!is_array($data['settings']['clients'][$key]['link'])){
						$data['settings']['clients'][$key]['link'] = [
							'url' => $data['settings']['clients'][$key]['link'],
							'is_external' => $is_external,
							'nofollow' => false,
						];
					}
				}
			}
		}
      parent::__construct($data, $args);

      wp_register_script( 'pix-clients-carousel-handle', PIX_CORE_PLUGIN_URI.'functions/elementor/js/clients-carousel.js', [ 'elementor-frontend' ], PIXFORT_PLUGIN_VERSION, true );
   	}

	public function get_name() {
		return 'pix-clients-carousel';
	}

	public function get_title() {
		return 'Clients Carousel';
	}

	public function get_icon() {
		return 'eicon-logo pixfort-elementor-element pixfort-elementor-clients-carousel';
	}

	public function get_categories() {
		return [ 'pixfort' ];
	}

	public function get_help_url() {
		return 'https://essentials.pixfort.com/knowledge-base/';
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'General', 'pixfort-core' ),
			]
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'image', [
				'label' => __( 'Image', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$repeater->add_control(
			'title', [
				'label' => __( 'Title', 'pixfort-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '' , 'pixfort-core' ),
				'label_block' => true,
				'dynamic'     => array(
                    'active'  => true
                ),
			]
		);
		$repeater->add_control(
			'link', [
				'label' => __( 'Link', 'pixfort-core' ),
				// 'type' => Controls_Manager::TEXT,
				// 'default' => __( '' , 'pixfort-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'Link', 'elementor' ),
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
		// $repeater->add_control(
		// 	'target', [
		// 		'label' => __( 'Open in a new tab', 'pixfort-core' ),
		// 		'type' => \Elementor\Controls_Manager::SWITCHER,
		// 		'label_on' => __( 'Yes', 'pixfort-core' ),
		// 		'label_off' => __( 'No', 'pixfort-core' ),
		// 		'return_value' => 'yes',
		// 		'default' => 'yes',
		// 	]
		// );
		$this->add_control(
			'clients',
			[
				'label' => __( 'Clients', 'pixfort-core' ),
				'type' => Controls_Manager::REPEATER,
				'title_field' => '{{{ title }}}',
				'fields' => $repeater->get_controls()
			]
		);

		$this->add_control(
			'add_hover_effect',
			[
				'label' => __( 'Hover Animation', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
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
				],
			]
		);
		$this->add_control(
			'style',
			[
				'label' => __( 'Additional hover effect', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'pix-box',
				'options' => [
					'pix-box'			=> 'Fade others + Box',
                    'client'			=> 'Fade others',
                    // 'nobox' 	=> 'Without boxes',
                    // 'fly' 	    => 'Fly',
                    'no-effect' 	    => 'No effect',
				],
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
				'placeholder' => __( 'Type your title here', 'pixfort-core' ),
				'condition' => [
					'animation!' => '',
				],
			]
		);
		$this->add_control(
			'delay_items',
			[
				'label' => __( 'Add delay between items', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => array_flip(array(
					''			=> 'No',
  	              'yes'			=> 'Yes',
				)),
				'condition' => [
					'animation!' => '',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_advanced',
			[
				'label' => __( 'Advanced', 'pixfort-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'slider_num',
			[
				'label' => __( 'Slides per page', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 3,
				'options' => [
					1 	=> "1",
                    2 	=> "2",
                    3 	=> "3",
                    4 	=> "4",
                    5 	=> "5",
                    6 	=> "6",
				],
			]
		);
		$this->add_control(
			'slider_style',
			[
				'label' => __( 'Slides style', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'pix-style-standard',
				'options' => [
					'pix-style-standard'        => __('Standard','pixfort-core'),
                    'pix-one-active'         	=> __('One active item','pixfort-core'),
                    'pix-opacity-slider'        => __('Faded items','pixfort-core'),
				],
			]
		);
		$this->add_control(
			'slider_effect',
			[
				'label' => __( 'Slides effect', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'pix-effect-standard',
				'options' => array_flip(
					array(
	                    __('Standard','pixfort-core') 	                => 'pix-effect-standard',
	                    __('Circular effect','pixfort-core') 	        => 'pix-circular-slider',
	                    __('Circular Left only','pixfort-core') 	        => 'pix-circular-left',
	                    __('Circular Right only','pixfort-core') 	    => 'pix-circular-right',
	                     __('Fade out','pixfort-core') 	                => 'pix-fade-out-effect',
	                )
				),
			]
		);

		$this->add_control(
			'prevnextbuttons',
			[
				'label' => __( 'Show navigation buttons', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => true,
				'default' => true,

			]
		);
		$this->add_control(
			'pagedots',
			[
				'label' => __( 'Dots', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => true,
				'default' => true,

			]
		);
		$this->add_control(
			'dots_style',
			[
				'label' => __( 'Dots style', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''			=> 'Default',
					'light-dots' 	=> 'Light',
				],
				'condition' => [
					'pagedots' => true,
				],
			]
		);
		$this->add_control(
			'dots_align',
			[
				'label' => __( 'Dots style', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''			=> 'Center',
					'pix-dots-left' 	=> 'Left',
					'pix-dots-right' 	=> 'Right',
				],
				'condition' => [
					'pagedots' => true,
				],
			]
		);
		$this->add_control(
			'freescroll',
			[
				'label' => __( 'Free Scroll', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => true,
				'default' => false,

			]
		);
		$this->add_control(
			'cellalign',
			[
				'label' => __( 'Main cell Align', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'center'			=> 'Center',
					'left' 	=> 'Left',
					'right' 	=> 'Right',
				],
			]
		);
		$this->add_control(
			'slider_scale',
			[
				'label' => __( 'Scale main item', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => 'pix-slider-scale',
				'default' => false,
			]
		);
		$this->add_control(
			'cellpadding',
			[
				'label' => __( 'Cells padding', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'pix-p-10',
				'options' => [
					'p-0'				=> '0px',
					'pix-p-5'			=> '5px',
					'pix-p-10'			=> '10px',
					'pix-p-15'			=> '15px',
					'pix-p-20'			=> '20px',
					'pix-p-25'			=> '25px',
					'pix-p-30'			=> '30px',
					'pix-p-35'			=> '35px',
					'pix-p-40'			=> '40px',
					'pix-p-45'			=> '45px',
					'pix-p-50'			=> '50px',
				],
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => true,
				'default' => false,
			]
		);
		$this->add_control(
			'autoplay_time',
			[
				'label' => __( 'Autoplay time', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '1500', 'pixfort-core' ),
				'placeholder' => __( 'Type your title here', 'pixfort-core' ),
				// 'condition' => [
				// 	'autoplay' => true,
				// ],
			]
		);
		$this->add_control(
			'adaptiveheight',
			[
				'label' => __( 'Adaptive height', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => true,
				'default' => true,
			]
		);
		$this->add_control(
			'righttoleft',
			[
				'label' => __( 'Right to Left', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => true,
				'default' => false,
			]
		);
		$this->add_control(
			'slider_wrap',
			[
				'label' => __( 'Wrap slides', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => true,
				'default' => true,
			]
		);
		$this->add_control(
			'visible_y',
			[
				'label' => __( 'Increase vertical view', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => 'pix-overflow-y-visible',
				'default' => false,
			]
		);
		$this->add_control(
			'visible_overflow',
			[
				'label' => __( 'Visible overflow', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => 'pix-overflow-all-visible',
				'default' => false,
			]
		);

		$this->end_controls_section();


	}

	protected function render() {
        $settings = $this->get_settings_for_display();
		if(!empty($settings)){
			if(!empty($settings['clients'])){
				foreach ($settings['clients'] as $key => $value) {
					if(!empty($settings['clients'][$key]['link']['is_external'])){
						$settings['clients'][$key]['target'] = $settings['clients'][$key]['link']['is_external'];
					}
					if(!empty($settings['clients'][$key]['link']['custom_attributes'])){
						$settings['clients'][$key]['link_atts'] = $settings['clients'][$key]['link']['custom_attributes'];
					}
					$settings['clients'][$key]['link'] = $settings['clients'][$key]['link']['url'];
					
				}
			}
		}
		echo sc_clients_slider($settings);
	}



	public function get_script_depends() {
		if(is_user_logged_in()) return [ 'pix-global', 'pix-clients-carousel-handle' ];
  		return [];
	  }


}
