<?php
namespace Elementor;

class Pix_Eor_Auto_Video extends Widget_Base {

	public function __construct($data = [], $args = null) {
      parent::__construct($data, $args);

      wp_register_script( 'pix-auto-video-handle', PIX_CORE_PLUGIN_URI.'functions/elementor/js/auto-video.js', [ 'elementor-frontend' ], PIXFORT_PLUGIN_VERSION, true );
   	}

	public function get_name() {
		return 'pix-auto-video';
	}

	public function get_title() {
		return 'Auto video';
	}

	public function get_icon() {
		return 'eicon-video-camera pixfort-elementor-element pixfort-elementor-auto-video';
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
				'label' => __( 'Content', 'elementor' ),
			]
		);

		$this->add_control(
			'mp4_video',
			[
				'label' => __( 'MP4 Video URL', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter video URL', 'elementor' ),
				'dynamic'     => array(
                    'active'  => true
                ),
			]
		);

		$this->add_control(
			'loop',
			[
				'label' => __( 'Loop', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => 'loop',
				// 'default' => '',
			]
		);
		$this->add_control(
			'rounded_img',
			[
				'label' => __( 'Rounded corners', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'rounded-0',
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
			'poster',
			[
				'label' => __( 'Poster image', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic'     => array(
                    'active'  => true
                ),
			]
		);

		$this->add_control(
			'width',
			[
				'label' => __( 'Width (Optional)', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'input the value (with the unit: %, px,.. etc).', 'elementor' ),
			]
		);
		$this->add_control(
			'height',
			[
				'label' => __( 'Height (Optional)', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'input the value (with the unit: %, px,.. etc).', 'elementor' ),
			]
		);
		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( '', 'elementor' ),
			]
		);
		$this->add_control(
			'target',
			[
				'label' => __( 'Open in a new tab', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => 'Yes',
				// 'default' => '',
			]
		);
		$this->add_control(
			'pix_scroll_parallax',
			[
				'label' => __( 'Scroll Parallax', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => 'scroll_parallax',
			]
		);
		$this->add_control(
			'xaxis',
			[
				'label' => __( 'X axis', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( '', 'elementor' ),
				'default'	=> '0'
			]
		);
		$this->add_control(
			'yaxis',
			[
				'label' => __( 'Y axis', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( '', 'elementor' ),
				'default'	=> '0'
			]
		);
		$this->add_control(
			'pix_tilt',
			[
				'label' => __( '3D Hover', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => 'tilt',
			]
		);
		$this->add_control(
			'pix_tilt_size',
			[
				'label' => __( '3d hover size', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'tilt',
				'options' => [
					'tilt'			=> 'Default',
					'tilt_big'		=> 'Big',
					'tilt_small' 		=> 'Small',
				],
			]
		);
		// $this->add_control(
		// 	'pix_infinite_animation',
		// 	[
		// 		'label' => __( 'Infinite Animation type', 'pixfort-core' ),
		// 		'type' => Controls_Manager::SELECT,
		// 		'default' => 'tilt',
		// 		'options' => $infinite_animation,
		// 	]
		// );
		// $this->add_control(
		// 	'pix_infinite_speed',
		// 	[
		// 		'label' => __( 'Infinite Animation Speed', 'pixfort-core' ),
		// 		'type' => Controls_Manager::SELECT,
		// 		'default' => 'tilt',
		// 		'options' => $animation_speeds,
		// 	]
		// );
		$this->add_control(
			'img_div',
			[
				'label' => __( 'Video inside a container', 'pixfort-core' ),
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

		$this->add_control(
			'pix_scale_in',
			[
				'label' => __( 'Video Scale In effect', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' 		=> 'Disabled',
   				 'pix-scale-in-sm' 		=> 'Small scale',
   				 'pix-scale-in' 		=> 'Normal scale',
   				 'pix-scale-in-lg' 		=> 'Large scale',
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
				'placeholder' => __( '', 'pixfort-core' ),
				'condition' => [
					'animation!' => '',
				],
			]
		);

		$this->end_controls_section();

		pix_get_elementor_effects($this);


		// $this->start_controls_section(
		// 	'style_section',
		// 	[
		// 		'label' => __( 'Style', 'pixfort-core' ),
		// 		'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		// 	]
		// );
		// $this->end_controls_section();


	}

	protected function render() {
        $settings = $this->get_settings_for_display();
		echo sc_pix_auto_video($settings);
	}



	public function get_script_depends() {
		if(is_user_logged_in()) return [ 'pix-global', 'pix-auto-video-handle' ];
		return [];
	  }


}
