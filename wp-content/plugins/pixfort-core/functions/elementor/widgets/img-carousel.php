<?php
namespace Elementor;

class Pix_Eor_Img_Carousel extends Widget_Base {

	public function __construct($data = [], $args = null) {
      parent::__construct($data, $args);

      wp_register_script( 'pix-img-carousel-handle', PIX_CORE_PLUGIN_URI.'functions/elementor/js/img-carousel.js', [ 'elementor-frontend' ], PIXFORT_PLUGIN_VERSION, true );
   	}

	public function get_name() {
		return 'pix-img-carousel';
	}

	public function get_title() {
		return 'Image Carousel';
	}

	public function get_icon() {
		return 'eicon-slider-album pixfort-elementor-element pixfort-elementor-image-carousel';
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
			'alt', [
				'label' => __( 'Image alternative text', 'pixfort-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '' , 'pixfort-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'link', [
				'label' => __( 'Link', 'pixfort-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '' , 'pixfort-core' ),
			]
		);
		$repeater->add_control(
			'target', [
				'label' => __( 'Open in a new tab', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'items',
			[
				'label' => __( 'Items', 'pixfort-core' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls()
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
			'pix_scroll_parallax',
			[
				'label' => __( 'Scroll Parallax', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Enable', 'pixfort-core' ),
				'label_off' => __( 'Disable', 'pixfort-core' ),
				'return_value' => 'scroll_parallax',
				'default' => 'no',
			]
		);

		$this->add_control(
			'xaxis',
			[
				'label' => __( 'X axis', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '0', 'pixfort-core' ),
				'placeholder' => __( 'Type your title here', 'pixfort-core' ),
				'condition' => [
					'pix_scroll_parallax' => 'scroll_parallax',
				],
			]
		);
		$this->add_control(
			'yaxis',
			[
				'label' => __( 'Y axis', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '0', 'pixfort-core' ),
				'placeholder' => __( 'Type your title here', 'pixfort-core' ),
				'condition' => [
					'pix_scroll_parallax' => 'scroll_parallax',
				],
			]
		);

		$this->add_control(
			'pix_tilt',
			[
				'label' => __( '3D Hover', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Enable', 'pixfort-core' ),
				'label_off' => __( 'Disable', 'pixfort-core' ),
				'return_value' => 'tilt',
				'default' => 'no',

			]
		);

		$this->add_control(
			'pix_tilt_size',
			[
				'label' => __( '3d hover size', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'tilt',
				'options' => [
					'tilt' => __( 'Default', 'pixfort-core' ),
					'tilt_big' => __( 'Big', 'pixfort-core' ),
					'tilt_small' => __( 'Small', 'pixfort-core' ),
				],
				'condition' => [
					'pix_tilt' => 'tilt',
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



		$this->start_controls_section(
			'section_title_style',
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
				'default' => false,
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
		echo sc_pix_img_carousel($settings);
	}



	public function get_script_depends() {
		if(is_user_logged_in()) return [ 'pix-global', 'pix-img-carousel-handle' ];
		return [];
	  }


}
