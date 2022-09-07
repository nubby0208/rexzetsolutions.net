<?php
namespace Elementor;

class Pix_Eor_Search extends Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		// wp_register_script( 'pix-search-handle', PIX_CORE_PLUGIN_URI.'functions/elementor/js/search.js', [ 'elementor-frontend' ], PIXFORT_PLUGIN_VERSION, true );
	}

	public function get_name() {
		return 'pix-search';
	}

	public function get_title() {
		return 'Search';
	}

	public function get_icon() {
		return 'eicon-search pixfort-elementor-element pixfort-elementor-search';
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

		$this->add_control(
			'search_div',
			[
				'label' => __( 'Field inside a container', 'pixfort-core' ),
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
			'max_width',
			[
				'label' => __( 'Field max width', 'pixfort-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '', 'pixfort-core' ),
				'placeholder' => __( 'Input the width with the unit (eg. 300px)', 'pixfort-core' ),
			]
		);

		$this->end_controls_section();


	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		echo sc_pix_search($settings);
	}

	// protected function _content_template() {

	// }

	public function get_script_depends() {
		if(is_user_logged_in()) return [ 'pix-global' ];
		return [];
	}


}
