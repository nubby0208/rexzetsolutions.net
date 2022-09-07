<?php
namespace Elementor;

class Pix_Eor_Blog_Slider extends Widget_Base {

	public function __construct($data = [], $args = null) {
      parent::__construct($data, $args);

      wp_register_script( 'pix-blog-slider-handle', PIX_CORE_PLUGIN_URI.'functions/elementor/js/blog-slider.js', [ 'elementor-frontend' ], PIXFORT_PLUGIN_VERSION, true );
   	}

	public function get_name() {
		return 'pix-blog-slider';
	}

	public function get_title() {
		return 'Blog Slider';
	}

	public function get_icon() {
		return 'eicon-posts-carousel pixfort-elementor-element pixfort-elementor-blog-carousel';
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


		$this->add_control(
			'count',
			[
				'label' => __( 'Posts count', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Number of posts to show', 'elementor' ),
				'default' => '5',
			]
		);

		$this->add_control(
			'category',
			[
				'label' => __( 'Category', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => array_flip(pix_get_categories( 'category' )),
			]
		);
		$this->add_control(
			'category_multi',
			[
				'label' => __( 'Multiple Categories', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Categories Slugs separated with coma', 'elementor' ),
				'default' => '',
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => __( 'Order by', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array_flip(array(
                    __('Date','pixfort-core') 	=> 'date',
                    __('Title','pixfort-core')	    => 'title',
                    __('Random','pixfort-core')	    => 'rand',
                    __('Number of comments','pixfort-core')	    => 'comment_count',
                    __('Last modified','pixfort-core')	    => 'modified',
                )),
			]
		);
		$this->add_control(
			'order',
			[
				'label' => __( 'Order', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => array_flip(array(
					__('DESC','pixfort-core') 	=> 'DESC',
                    __('ASC','pixfort-core')	    => 'ASC',
                )),
			]
		);


		$this->add_control(
			'blog_style',
			[
				'label' => __( 'Style', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'rounded-0',
				'options' => array_flip(array(
					"Default (with dividers)" 	=> '',
                    "Default (with padding & dividers)" 	=> 'padding',
                    "Default (with post types)" 	=> 'default',
                    "Default (with padding & post types)" 	=> 'with-padding',
                    "Full image (with post types)" 	=> 'full-img',
					"Left image (with post types)" 	=> 'left-img',
                    "Right image (with post types)" 	=> 'right-img',
				)),
			]
		);
		$this->add_control(
			'blog_size',
			[
				'label' => __( 'Size', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'lg',
				'options' => array_flip(array(
					"Default (Extended)" 	=> 'lg',
                    "Medium" 	=> 'md',
                    "Small" 	=> 'sm',
				)),
				'condition' => [
					'blog_style' => array('', 'padding', 'default', 'with-padding'),
				],
			]
		);

		$this->add_control(
			'blog_style_box',
			[
				'label' => __( 'Add box style', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => true,
				'default' => false,
				'condition' => [
					'blog_style' => array('', 'padding', 'default', 'with-padding'),
				],
			]
		);
		$this->add_control(
			'blog_dark_mode',
			[
				'label' => __( 'Use dark mode', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => 'pix-dark',
				'default' => '',
				'condition' => [
					'blog_style' => array('', 'padding', 'default', 'with-padding'),
				],
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
		$this->end_controls_section();
		$this->start_controls_section(
			'info_section',
			[
				'label' => __( 'Info', 'pixfort-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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

		$this->end_controls_section();


		$this->start_controls_section(
			'divider_section',
			[
				'label' => __( 'Divider', 'pixfort-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'blog_style' => array('', 'padding'),
				],
			]
		);
		$this->add_control(
			'bottom_divider_select',
			[
				'label' => __( 'Divider Style', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '0',
				'options' => array_flip(array(
					"Disabled" 	=> '0',
					"Dynamic" 	=> 'dynamic',
					"Style 2" 	=> '2',
					"Style 3" 	=> '3',
					"Style 4" 	=> '4',
					"Style 5" 	=> '5',
					"Style 6" 	=> '6',
					"Style 7" 	=> '7',
					"Style 8" 	=> '8',
					"Style 9" 	=> '9',
					"Style 10" 	=> '10',
					"Style 11" 	=> '11',
					"Style 12" 	=> '12',
					"Style 13" 	=> '13',
					"Style 14" 	=> '14',
					"Style 15" 	=> '15',
					"Style 16" 	=> '16',
					"Style 17" 	=> '17',
					"Style 18" 	=> '18',
					"Style 19" 	=> '19',
					"Style 20" 	=> '20',
					"Style 21" 	=> '21',
					"Style 22" 	=> '22',
					"Style 23" 	=> '23',
				)),
			]
		);


		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'd_gradient', [
				'label' => __( 'Use Gradient', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => '1',
				'default' => ''
			]
		);
		$repeater->add_control(
			'd_color_1', [
				'label' => __( 'Layer color', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f8f9fa',
			]
		);
		$repeater->add_control(
			'd_color_2', [
				'label' => __( 'Layer color 2', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f8f9fa'
			]
		);

		$this->add_control(
			'bottom_moving_divider_color',
			[
				'label' => __( 'Items', 'pixfort-core' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'condition' => [
					'bottom_divider_select' => array('dynamic')
				]
			]

		);

		$this->add_control(
			'bottom_layers',
			[
				'label' => __( 'The number of Layers', 'pixfort-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					"1"       => "1 Layer",
                    "2"       => "2 Layer",
                    "3"       => "3 Layer",
				],
				'condition' => [
					'bottom_divider_select' => array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26")
				],
			]
		);
		$this->add_control(
			'b_flip_h',
			[
				'label' => __( 'Flip the divider', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pixfort-core' ),
				'label_off' => __( 'No', 'pixfort-core' ),
				'return_value' => true,
				'default' => false,
				'condition' => [
					'blog_style' => array('', 'padding')
				],
			]
		);
		$this->add_control(
			'b_custom_height',
			[
				'label' => __( 'Divider custom height (Optional)', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '', 'pixfort-core' ),
				'placeholder' => __( 'Add custom height (with unit, e.g: 200px)', 'pixfort-core' ),
			]
		);

		$this->end_controls_section();

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
		echo sc_pix_blog_slider($settings);
	}



	public function get_script_depends() {
		if(is_user_logged_in()) return [ 'pix-global', 'pix-blog-slider-handle' ];
 		return [];
	  }


}
