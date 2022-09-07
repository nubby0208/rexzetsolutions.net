<?php

/**
 * essentials functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package essentials
 */

define('ESSENTIALS_THEME_VERSION', '3.0.1');


if (!function_exists('essentials_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function essentials_setup() {
		/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		*/
		load_theme_textdomain('essentials', get_template_directory() . '/languages');

		/*
		* Add default posts and comments RSS feed links to head.
		*/
		add_theme_support('automatic-feed-links');

		/*
		* Add Support for additional post formats
		*/
		add_theme_support('post-formats', array('quote', 'video', 'audio', 'link'));

		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support('title-tag');

		/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'menu-1' => esc_attr__('Primary', 'essentials'),
		));

		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('essentials_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		// Add theme support for selective refresh for widgets.
		// add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support('custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		));

		/**
		 * Add support for wide alignment.
		 *
		 * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#wide-alignment
		 */
		add_theme_support('align-wide');

		// EditURI link
		remove_action('wp_head', 'rsd_link');
		// windows live writer
		remove_action('wp_head', 'wlwmanifest_link');
		// links for adjacent posts
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
		// WP version
		remove_action('wp_head', 'wp_generator');
	}
endif;
add_action('after_setup_theme', 'essentials_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function essentials_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('essentials_content_width', 640);
}
add_action('after_setup_theme', 'essentials_content_width', 0);

if (!function_exists('vc_custom_css')) {
	function vc_custom_css($id) {
		$shortcodes_custom_css = get_post_meta($id, '_wpb_shortcodes_custom_css', true);
		if (!empty($shortcodes_custom_css)) {
			return esc_attr($shortcodes_custom_css);
		}
	}
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function essentials_widgets_init() {
	register_sidebar(array(
		'name'          => esc_attr__('Main Sidebar', 'essentials'),
		'id'            => 'sidebar-1',
		'description'   => esc_attr__('Add widgets here.', 'essentials'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="font-weight-bold text-heading-default widget-title2 pix-mb-10">',
		'after_title'   => '</h5>',
	));

	if (pix_get_option('pix_sidebars')) {
		if (!empty(pix_get_option('pix_sidebars'))) {
			$sidebars = pix_get_option('pix_sidebars');
			foreach ($sidebars as $key => $value) {
				if ($value != '') {
					$sideID = str_replace(' ', '', strtolower($value));
					$sideID = preg_replace('/[^A-Za-z0-9\-]/', '', $sideID);
					$sideID = sanitize_title($sideID);
					$sideID = 'sidebar-' . $sideID;
					register_sidebar(array(
						'name'          => $value,
						'id'            => $sideID,
						'description'   => esc_attr__('Add widgets here.', 'essentials'),
						'before_widget' => '<section id="%1$s" class="widget %2$s">',
						'after_widget'  => '</section>',
						'before_title'  => '<h5 class="font-weight-bold text-heading-default pix-mb-10">',
						'after_title'   => '</h5>',
					));
				}
			}
		}
	}
}
add_action('widgets_init', 'essentials_widgets_init');

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Functions which enhance the theme posts by hooking into WordPress.
 */
require get_template_directory() . '/inc/post-functions.php';
require get_template_directory() . '/inc/portfolio-functions.php';
require get_template_directory() . '/inc/header-functions.php';

/**
 * Enqueue scripts and styles.
 */
function essentials_scripts() {
	$pageTransition = 'default';
	if (!empty(pix_get_option('site-page-transition'))) {
		$pageTransitionVal = pix_get_option('site-page-transition');
		if ($pageTransitionVal == 'fade-page-transition') {
			$pageTransition = 'fade';
		} elseif ($pageTransitionVal == 'disable-page-transition') {
			$pageTransition = 'disable';
		}
	}
	$introStyle = '
	 body:not(.render) .pix-overlay-item {
		 opacity: 0 !important;
	 }
	 body:not(.pix-loaded) .pix-wpml-header-btn {
		 opacity: 0;
	 }';
	$pageTransitionColor = '#ffffff';
	if (!empty(pix_get_option('site-page-transition-color'))) {
		$pageTransitionColor = pix_get_option('site-page-transition-color');
	}
	if ($pageTransition == 'fade') {
		$introStyle .= '
		 html:not(.render) {
			 background: ' . $pageTransitionColor . '  !important;
		 }
		 .pix-page-loading-bg:after {
			 content: " ";
			 position: fixed;
			 top: 0;
			 left: 0;
			 width: 100vw;
			 height: 100vh;
			 display: block;
			 pointer-events: none;
			 transition: opacity .16s ease-in-out;
			 transform-style: flat;
			 z-index: 99999999999999999999;
			 opacity: 1;
			 background: ' . $pageTransitionColor . ' !important;
		 }
		 body.render .pix-page-loading-bg:after {
			 opacity: 0;
		 }
	 	 ';
	} elseif ($pageTransition == 'default') {
		$introStyle .= '
		 html:not(.render) {
			 background: ' . $pageTransitionColor . '  !important;
		 }
 		 .pix-page-loading-bg:after {
 			 content: " ";
 			 position: fixed;
 			 top: 0;
 			 left: 0;
 			 width: 100vw;
 			 height: 100vh;
 			 display: block;
 			 background: ' . $pageTransitionColor . ' !important;
 			 pointer-events: none;
			 transform-style: flat;
 			 transform: scaleX(1);
 			 transition: transform .2s cubic-bezier(.27,.76,.38,.87);
 			 transform-origin: right center;
 			 z-index: 99999999999999999999;
 		 }
 		 body.render .pix-page-loading-bg:after {
 			 transform: scaleX(0);
 			 transform-origin: left center;
 		 }';
	}

	$footer = false;
	if (!empty(pix_get_option('pix-footer'))) {
		$footer = pix_get_option('pix-footer');
	}
	$pagePostTypes = array('page', 'post', 'portfolio');
	$pagePostTypes = apply_filters('pixfort_page_options_post_types', $pagePostTypes);
	if (in_array(get_post_type(), $pagePostTypes)) {
		if (get_post_meta(get_the_ID(), 'pix-disable-wp-block-library', true)) {
			wp_dequeue_style('wp-block-library');
			wp_dequeue_style('wp-block-library-theme');
			wp_dequeue_style('wc-block-style'); // Remove WooCommerce block CSS
		}
		if (get_post_meta(get_the_ID(), 'pix-page-footer', true)) {
			$footer = get_post_meta(get_the_ID(), 'pix-page-footer', true);
		}
	}

	if ($footer) {
		if (function_exists('icl_get_languages')) {
			$correct_id = apply_filters('wpml_object_id', $footer, 'pixfooter', true);
			$footer = $correct_id;
		}
		if (defined('WPB_VC_VERSION')) {
			// WP Bakery
			$introStyle .= vc_custom_css($footer);
		}
		wp_reset_postdata();
	}

	wp_register_style('pix-intro-handle', false);
	wp_enqueue_style('pix-intro-handle');
	wp_add_inline_style('pix-intro-handle', $introStyle);

	wp_enqueue_script('pix-popper-js', get_template_directory_uri() . '/js/build/popper.min.js', array('jquery'), ESSENTIALS_THEME_VERSION, true);
	wp_enqueue_script('pix-bootstrap-js', get_template_directory_uri() . '/js/build/bootstrap.min.js', array('jquery', 'pix-popper-js'), ESSENTIALS_THEME_VERSION, true);
	wp_enqueue_script('pix-bootstrap-select-js', get_template_directory_uri() . '/js/build/bootstrap-select.min.js', array('jquery'), ESSENTIALS_THEME_VERSION, true);
	wp_enqueue_script('pix-flickity-js', get_template_directory_uri() . '/js/build/flickity.pkgd.min.js', false, ESSENTIALS_THEME_VERSION, true);
	wp_enqueue_script('pix-main-essentials', get_template_directory_uri() . '/js/essentials.min.js', array('jquery', 'jquery-ui-core', 'pix-bootstrap-js', 'pix-flickity-js'), ESSENTIALS_THEME_VERSION, true);
	if (class_exists('WooCommerce')) {
		wp_enqueue_script('pix-woo-essentials', get_template_directory_uri() . '/js/modules/woo.min.js', array('jquery'), ESSENTIALS_THEME_VERSION, true);
	}

	$main_values = array();
	$main_values['name'] = 'mainVals';
	if (pix_get_option('pix-preload-page-popups')) {
		$main_values['preloadPopups'] = true;
	}
	if (pix_get_option('pix-exit-popup')) {
		if (pix_show_exit_popup()) {
			$nonce = wp_create_nonce("popup_nonce");
			$exit_link = admin_url('admin-ajax.php?action=pix_popup_content&id=' . pix_get_option('pix-exit-popup') . '&nonce=' . $nonce . '&exitpopup=true');
			$main_values['dataExitPopup'] = $exit_link;
			$main_values['dataExitPopupId'] = pix_get_option('pix-exit-popup');
		}
	}
	if (pix_get_option('pix-automatic-popup')) {
		if (pix_show_automatic_popup()) {
			$nonce = wp_create_nonce("popup_nonce");
			$link = admin_url('admin-ajax.php?action=pix_popup_content&id=' . pix_get_option('pix-automatic-popup') . '&nonce=' . $nonce . '&autopopup=true');
			$exit_data = pix_get_option('pix-automatic-popup-time');
			$main_values['dataAutoPopup'] = $link;
			$main_values['dataAutoPopupId'] = pix_get_option('pix-automatic-popup');
			$main_values['dataAutoPopupTime'] = $exit_data;
		}
	}
	$pixPopupBase = admin_url('admin-ajax.php?action=pix_popup_content');
	$my_current_lang = apply_filters('wpml_current_language', NULL);
	if ($my_current_lang) {
		$pixPopupBase = add_query_arg('wpml_lang', $my_current_lang, $pixPopupBase);
	}
	$main_values['dataPopupBase'] = $pixPopupBase;

	$pix_overlay = 'pix-overlay-2';
	if (pix_get_option('search-style')) {
		$pix_overlay = 'pix-overlay-' . pix_get_option('search-style');
	}
	$main_values['dataPixOverlay'] = $pix_overlay;
	$check_nonce = wp_create_nonce("popup_nonce");
	$popup_check_link = admin_url('admin-ajax.php?action=pix_check_popup_status&nonce=' . $check_nonce);
	$main_values['dataPopupCheckLink'] = $popup_check_link;
	if (class_exists('WooCommerce')) {
		$woo_msg = esc_attr__('The item has been added to your shopping cart!', 'essentials');
		$main_values['dataAddCartMsg'] = $woo_msg;
	}
	if (pix_get_option('pix-body-bg-color')) {
		if (pix_get_option('pix-body-bg-color') == 'custom') {
			$main_values['dataBodyBg'] = pix_get_option('custom-body-bg-color');
		}
	}
	if (pix_get_option('pix-enable-cookies')) {
		if (pix_get_option('pix-cookies-id')) {
			$main_values['datacookiesId'] = pix_get_option('pix-cookies-id');
		}
	}
	if (pix_get_option('pix-mobile-breakpoint')) {
		if (pix_get_option('pix-mobile-breakpoint')) {
			$main_values['dataBreakpoint'] = (int)pix_get_option('pix-mobile-breakpoint');
		}
	}

	if (!empty(pix_get_option('google-api-key'))) {
		$main_values['googleMapsUrl'] = '//maps.googleapis.com/maps/api/js?key=' . pix_get_option('google-api-key');
		if (function_exists('get_rocket_cdn_url')) {
			$main_values['googleMapsScript'] = get_rocket_cdn_url(get_template_directory_uri() . '/js/build/pix-map.js');
		} else {
			$main_values['googleMapsScript'] = get_template_directory_uri() . '/js/build/pix-map.js';
		}
	}
	if (function_exists('get_rocket_cdn_url')) {
		$main_values['lightboxUrl'] = get_rocket_cdn_url(get_template_directory_uri() . '/js/build/jquery.fancybox.min.js');
		$main_values['isotopeUrl'] = get_rocket_cdn_url(get_template_directory_uri() . '/js/build/isotope.pkgd.min.js');
		$main_values['searchUrl'] = get_rocket_cdn_url(get_template_directory_uri() . '/js/build/bootstrap-autocomplete.min.js');
	} else {
		$main_values['lightboxUrl'] = get_template_directory_uri() . '/js/build/jquery.fancybox.min.js';
		$main_values['isotopeUrl'] = get_template_directory_uri() . '/js/build/isotope.pkgd.min.js';
		$main_values['searchUrl'] = get_template_directory_uri() . '/js/build/bootstrap-autocomplete.min.js';
	}

	wp_localize_script('pix-main-essentials', 'pixfort_main_object', $main_values);
	wp_dequeue_style('yith-wcwl-font-awesome');
	wp_deregister_style('yith-wcwl-font-awesome');

	if (!empty(pix_get_option('pix-enable-cf7-css'))) {
		wp_dequeue_style('contact-form-7');
		wp_deregister_style('contact-form-7');
	}

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	if (!empty(pix_get_option('pix-custom-js-header'))) {
		wp_register_script('essentials-options-script-header', false, false, ESSENTIALS_THEME_VERSION);
		wp_enqueue_script('essentials-options-script-header');
		wp_add_inline_script('essentials-options-script-header', pix_get_option('pix-custom-js-header'));
	}
	// Bootstrap
	wp_enqueue_style('essentials-bootstrap', get_template_directory_uri() . '/inc/scss/bootstrap.min.css');
	wp_register_style('pix-lightbox-css', get_template_directory_uri() . '/css/build/jquery.fancybox.min.css');
}
add_action('wp_enqueue_scripts', 'essentials_scripts', 10);

function pix_get_icons_url() {
	$iconsLibrary = 'main';
	if (!empty(pix_get_option('opt-ions-library'))) {
		$iconsLibrary = pix_get_option('opt-ions-library');
	}
	switch ($iconsLibrary) {
		case 'basic':
			return get_template_directory_uri() . '/css/build/pixicon-basic/style.min.css';
			break;
		case 'light':
			return get_template_directory_uri() . '/css/build/pixicon-light/style.min.css';
			break;
	}
	return get_template_directory_uri() . '/css/build/pixicon-main/style.min.css';
}

function essentials_add_styles() {
	if (!function_exists('pixfort_core_plugin')) {
		wp_enqueue_style('essentials-default-style', get_template_directory_uri() . '/css/pix-essentials-style.css');
		wp_enqueue_style('pix-external-font-1', 'https://fonts.googleapis.com/css2?family=Manrope&family=Poppins&display=swap', false);
	}
	wp_enqueue_style('pix-flickity-style',	get_template_directory_uri() . '/css/build/flickity.min.css', false, ESSENTIALS_THEME_VERSION, 'all');
	$iconsLibrary = 'main';
	if (!empty(pix_get_option('opt-ions-library'))) {
		$iconsLibrary = pix_get_option('opt-ions-library');
	}
	switch ($iconsLibrary) {
		case 'basic':
			wp_enqueue_style('essentials-pixicon-font-basic', get_template_directory_uri() . '/css/build/pixicon-basic/style.min.css', false, ESSENTIALS_THEME_VERSION, 'all');
			break;
		case 'light':
			wp_enqueue_style('essentials-pixicon-font-light', get_template_directory_uri() . '/css/build/pixicon-light/style.min.css', false, ESSENTIALS_THEME_VERSION, 'all');
			break;
		default:
			wp_enqueue_style('essentials-pixicon-font', get_template_directory_uri() . '/css/build/pixicon-main/style.min.css', false, ESSENTIALS_THEME_VERSION, 'all');
			break;
	}
	wp_enqueue_style('pix-popups-style',	get_template_directory_uri() . '/css/jquery-confirm.min.css', false, ESSENTIALS_THEME_VERSION, 'all');
	wp_enqueue_style('essentials-select-css', get_template_directory_uri() . '/css/build/bootstrap-select.min.css', false, ESSENTIALS_THEME_VERSION, 'all');

	if (is_user_logged_in()) wp_enqueue_style('pix-theme-admin-style', get_template_directory_uri() . '/css/pix-admin.css');
}

add_action('wp_enqueue_scripts', 'essentials_add_styles', 11);

function pix_theme_footer_extras() {
	if (defined('DOING_AJAX') && DOING_AJAX) {
		return false;
	}
	echo essentials_search_overlay();
	essentials_footer_extras();
	if (pix_get_option('pix-enable-cookies')) {
		if (pix_show_cookies()) {
			get_template_part('template-parts/cookies');
		}
	}
}
add_action('wp_footer', 'pix_theme_footer_extras', 10);

function pix_theme_params() {
	return array(
		'name'			=> 'Essentials',
		'slug'			=> 'essentials',
	);
}

function pix_add_footer_styles() {

	if (!empty(pix_get_option('pix-custom-js-footer'))) {
		wp_register_script('essentials-options-script-footer', false, false, ESSENTIALS_THEME_VERSION);
		wp_enqueue_script('essentials-options-script-footer');
		wp_add_inline_script('essentials-options-script-footer', pix_get_option('pix-custom-js-footer'));
	}
};
add_action('wp_footer', 'pix_add_footer_styles', 10);
function pix_add_footer_custom_styles() {
	if (defined('DOING_AJAX') && DOING_AJAX) {
		return false;
	}
	if (!empty(pix_get_option('pic-custom-css'))) {
		wp_register_style('pix-custom-css', false);
		wp_enqueue_style('pix-custom-css');
		wp_add_inline_style('pix-custom-css', pix_get_option('pic-custom-css'));
	}
};
add_action('wp_footer', 'pix_add_footer_custom_styles', 12);


// Register Admin Script
function pix_theme_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_media();
	wp_enqueue_style('pix-header-confirm', get_template_directory_uri() . '/css/jquery-confirm.min.css', false, ESSENTIALS_THEME_VERSION, 'all');
	if ( ! wp_script_is( 'jquery-confirm-js', 'enqueued' ) ) {
		wp_enqueue_script('pix-admin-confirm', get_template_directory_uri() . '/js/jquery-confirm.min.js', array('jquery'), ESSENTIALS_THEME_VERSION, true);
	}
	wp_enqueue_script('pix-admin-script', get_template_directory_uri() . '/js/pix-admin.min.js', array(), ESSENTIALS_THEME_VERSION, true);
	$icons_admin = pix_admin_icons();
	$icons = [];
	if (function_exists('vc_iconpicker_type_pixicons')) {
		$icons = vc_iconpicker_type_pixicons(array());
	}
	wp_localize_script('pix-admin-script', 'pix_admin_opts_object', array(
		'PIX_ICONS' => $icons,
		'PIX_ICONS_ADMIN' => $icons_admin,
	));
}


// Hook into the 'admin_enqueue_scripts' action
add_action('admin_enqueue_scripts', 'pix_theme_admin_scripts');

function pix_redux_admin_scripts() {
	wp_enqueue_style('pix-theme-admin-style', get_template_directory_uri() . '/css/pix-admin.css', false, ESSENTIALS_THEME_VERSION);
}
add_action('redux/page/pix_options/enqueue', 'pix_redux_admin_scripts');
add_action('admin_menu', 'pix_redux_admin_scripts');

require get_template_directory() . '/inc/config/hub-connect.php';

function pix_get_languages() {
	$languages = apply_filters('wpml_active_languages', NULL, array('skip_missing' => 0));
	return $languages;
}
add_action('wp', 'pix_get_languages');

function pix_add_cpt_support() {
	$cpt_support = get_option('elementor_cpt_support');
	if (!$cpt_support) {
		$cpt_support = ['page', 'post', 'pixfooter', 'pixpopup', 'portfolio'];
		update_option('elementor_cpt_support', $cpt_support);
	} else {
		if (!in_array('pixfooter', $cpt_support)) {
			$cpt_support[] = 'pixfooter';
			update_option('elementor_cpt_support', $cpt_support);
		}
		if (!in_array('pixpopup', $cpt_support)) {
			$cpt_support[] = 'pixpopup';
			update_option('elementor_cpt_support', $cpt_support);
		}
		if (!in_array('portfolio', $cpt_support)) {
			$cpt_support[] = 'portfolio';
			update_option('elementor_cpt_support', $cpt_support);
		}
	}
}

add_action('after_switch_theme', 'pix_add_cpt_support');

add_action('init', function () {
	if (function_exists('pll_register_string')) {
		if (pix_get_option('banner-text')) {
			pll_register_string('essentials-banner-text', pix_get_option('banner-text'));
		}
		if (pix_get_option('banner-btn-text')) {
			pll_register_string('essentials-banner-btn-text', pix_get_option('banner-btn-text'));
		}
		if (pix_get_option('pix-cookies-text')) {
			pll_register_string('essentials-cookies-text', pix_get_option('pix-cookies-text'));
		}
		if (pix_get_option('pix-cookies-btn')) {
			pll_register_string('essentials-cookies-btn', pix_get_option('pix-cookies-btn'));
		}
	} elseif (function_exists('icl_register_string')) {
		if (pix_get_option('banner-text')) {
			icl_register_string('Theme', 'essentials-banner-text', pix_get_option('banner-text'));
		}
		if (pix_get_option('banner-btn-text')) {
			icl_register_string('Theme', 'essentials-banner-btn-text', pix_get_option('banner-btn-text'));
		}
		if (pix_get_option('pix-cookies-text')) {
			icl_register_string('Theme', 'essentials-cookies-text', pix_get_option('pix-cookies-text'));
		}
		if (pix_get_option('pix-cookies-btn')) {
			icl_register_string('Theme', 'essentials-cookies-btn', pix_get_option('pix-cookies-btn'));
		}
	}
});

/**
 * Enqueue supplemental block editor styles.
 */
function pix_block_editor_styles() {
	// Enqueue the editor styles.
	wp_enqueue_style('essentials-block-editor-styles', get_theme_file_uri('/css/editor-style-block.css'), array(), wp_get_theme()->get('Version'), 'all');
}

add_action('enqueue_block_editor_assets', 'pix_block_editor_styles', 1, 1);

function pix_pll__($string = '') {
	if (function_exists('pll__')) {
		return pll__($string);
	} else {
		return esc_attr($string);
	}
}

function theme_prefix_register_elementor_locations($elementor_theme_manager) {
	$elementor_theme_manager->register_location('header');
	$elementor_theme_manager->register_location('footer');
}
add_action('elementor/theme/register_locations', 'theme_prefix_register_elementor_locations');


add_action('elementor/editor/after_save', function ($post_id) {
	if (get_post_type($post_id) === 'pixfooter') {
		\Elementor\Plugin::instance()->files_manager->clear_cache();
	}
});

/**
 * WPML
 */
add_filter('wpml_pb_shortcode_encode', 'wpml_pb_shortcode_encode_urlencoded_json', 10, 3);
function wpml_pb_shortcode_encode_urlencoded_json($string, $encoding, $original_string) {
	if ('urlencoded_json' === $encoding) {
		$output = array();
		foreach ($original_string as $combined_key => $value) {
			$parts = explode('_', $combined_key);
			$i = array_pop($parts);
			$key = implode('_', $parts);
			$output[$i][$key] = $value;
		}
		$string = urlencode(json_encode($output));
	}
	return $string;
}

add_filter('wpml_pb_shortcode_decode', 'wpml_pb_shortcode_decode_urlencoded_json', 10, 3);
function wpml_pb_shortcode_decode_urlencoded_json($string, $encoding, $original_string) {
	if ('urlencoded_json' === $encoding) {
		$rows = json_decode(urldecode($original_string), true);
		$string = array();
		foreach ($rows as $i => $row) {
			foreach ($row as $key => $value) {
				$string[$key . '_' . $i] = array('value' => $value, 'translate' => true);
			}
		}
	}
	return $string;
}

/**
 * Dashboard
 */
if (is_admin()) require get_template_directory() . '/inc/dashboard.php';

/**
 * Media
 */
require get_template_directory() . '/inc/media.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
if (is_admin()) require get_template_directory() . '/inc/menu-customizer.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load Bootstrap Navwalker.
 */
require get_template_directory() . '/inc/bootstrap-wp-navwalker.php';

/**
 * Load required plugins
 */
if (is_admin()) require get_template_directory() . '/inc/plugins.php';

/**
 * Load demo content
 */
if (class_exists('OCDI_Plugin')) {
	if (is_admin()) require get_template_directory() . '/inc/demo.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}

add_action("after_switch_theme", "pix_theme_activated");
function pix_theme_activated(){
    update_option( 'elementor_onboarded', true );
}
