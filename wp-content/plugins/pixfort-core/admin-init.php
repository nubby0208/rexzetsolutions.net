<?php
if (!defined('ABSPATH')) die;

define('PIX_CORE_PLUGIN_URI', plugin_dir_url(__FILE__));
define('PIX_CORE_PLUGIN_DIR', dirname(__FILE__));
define('PLUGIN_VERSION', PIXFORT_PLUGIN_VERSION);
// define( 'PIX_IMG_PLACEHOLDER', PIX_CORE_PLUGIN_URI .'functions/images/placeholder.png' );
define('PIX_IMG_PLACEHOLDER', PIX_CORE_PLUGIN_URI . 'functions/images/loading.webp');

function pixfort_core_setup_hook() {
    load_plugin_textdomain('pixfort-core', false, PIX_CORE_PLUGIN_URI . 'languages');

    // Load functions meta
    require_once dirname(__FILE__) . '/functions/meta-functions.php';
    // Load Global functions
    require_once dirname(__FILE__) . '/functions/global-functions.php';
    // Load Page meta
    require_once dirname( __FILE__ ) . '/functions/options-core/main.php';
    require_once dirname(__FILE__) . '/functions/meta-page.php';
    // Load Post meta
    require_once dirname(__FILE__) . '/functions/meta-post.php';
    // Load Popup meta
    require_once dirname(__FILE__) . '/functions/popup.php';
    // Load Portfolio meta
    require_once dirname(__FILE__) . '/functions/portfolio.php';
    if (is_user_logged_in()) {
        // Load Header meta
        require_once dirname(__FILE__) . '/functions/header.php';
        // Load Footer meta
        require_once dirname(__FILE__) . '/functions/footer.php';
        // Load Post category meta
        require_once dirname(__FILE__) . '/functions/categories.php';
        // Load the embedded Redux Framework
        require_once dirname(__FILE__) . '/redux-framework/framework.php';
        // Load the theme/plugin options
        require_once dirname(__FILE__) . '/options-init.php';
        // Load Redux extensions
        require_once dirname(__FILE__) . '/redux-extensions/extensions-init.php';
    }
    // Load custom theme css
    require_once dirname(__FILE__) . '/functions/style/pix-css.php';
    // Load shortcodes
    require_once dirname(__FILE__) . '/functions/shortcodes.php';
    // Widgets
    require_once dirname(__FILE__) . '/functions/widgets.php';
    if (class_exists('WooCommerce')) {
        // product
        require_once dirname(__FILE__) . '/functions/product.php';
    }
}
add_action('after_setup_theme', 'pixfort_core_setup_hook');



add_action('init', 'admin_only');
function admin_only() {
    if (defined('WPB_VC_VERSION')) {
        // Load visual-composer shortcodes
        if (file_exists(dirname(__FILE__) . '/functions/visual-composer.php')) {
            require_once dirname(__FILE__) . '/functions/visual-composer.php';
        }
        if (file_exists(dirname(__FILE__) . '/functions/params.php')) {
            require_once dirname(__FILE__) . '/functions/params.php';
        }
    }
    if (defined('WPB_VC_VERSION') || class_exists('\Elementor\Plugin')) {
        if (file_exists(dirname(__FILE__) . '/functions/visual-composer-icons.php')) {
            require_once dirname(__FILE__) . '/functions/visual-composer-icons.php';
        }
    }
}

add_action('plugins_loaded', 'pix_after_plugin_loaded');
function pix_after_plugin_loaded() {
    // Elementor
    if (class_exists('\Elementor\Plugin')) {
        if (file_exists(dirname(__FILE__) . '/functions/elementor/init.php')) {
            $code = get_option('envato_purchase_code_27889640');
            if ($code) {
                require_once dirname(__FILE__) . '/functions/elementor/init.php';
            }
        }
    }
}

add_action('wp_head', 'pix_head_options', 2);
function pix_head_options() {
    if (!(function_exists('has_site_icon') && has_site_icon())) {
        if (pix_plugin_get_option('favicon-img')) {
            if (!empty(pix_plugin_get_option('favicon-img')['url'])) {
?>
                <link rel="Shortcut Icon" type="image/x-icon" href="<?php echo esc_url(pix_plugin_get_option('favicon-img')['url']); ?>" />
                <link rel="shortcut Icon" href="<?php echo esc_url(pix_plugin_get_option('favicon-img')['url']); ?>" />
                <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(pix_plugin_get_option('favicon-img')['url']); ?>" />
                <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url(pix_plugin_get_option('favicon-img')['url']); ?>" />
                <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url(pix_plugin_get_option('favicon-img')['url']); ?>" />
            <?php
            }
        }
    }
    if (pix_plugin_get_option('website-preview')) {
        if (pix_plugin_get_option('website-preview')['url']) {
            ?>
            <meta property="og:image" content="<?php echo esc_url(pix_plugin_get_option('website-preview')['url']); ?>" />
            <meta name="twitter:image" content="<?php echo esc_url(pix_plugin_get_option('website-preview')['url']); ?>" />
<?php
        }
    }
}



function pix_custom_header_includes() {
    if (pix_plugin_get_option('pix-custom-header-includes')) {
        echo pix_plugin_get_option('pix-custom-header-includes');
    }
    if (get_option('pix_google_font_1')||get_option('pix_google_font_2')) {
        echo '<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>';
        echo '<link rel="preconnect" href="https://fonts.googleapis.com/" crossorigin>';
    }
}
add_action('wp_head', 'pix_custom_header_includes', 2);

function pix_admin_init_scripts() {
    if (function_exists('pix_get_icons_url')) {
        $iconsURL = pix_get_icons_url();
        wp_enqueue_style('pix-icons', $iconsURL, false, PLUGIN_VERSION, 'all');
    }
}
add_action('admin_init', 'pix_admin_init_scripts');



/**
 * Add Font Group
 */
add_filter('elementor/fonts/groups', function ($font_groups) {
    $font_groups['theme_fonts'] = __('pixfort Fonts');
    return $font_groups;
});
/**
 * Add Group Fonts
 */
add_filter('elementor/fonts/additional_fonts', function ($additional_fonts) {
    $body_font = pix_plugin_get_option('opt-primary-font');
    $heading_font = pix_plugin_get_option('opt-secondary-font');
    if ($body_font) {
        if (!empty($body_font['font-family'])) {
            $additional_fonts[$body_font['font-family']] = 'theme_fonts';
        }
    }
    if ($heading_font) {
        if (!empty($heading_font['font-family'])) {
            $additional_fonts[$heading_font['font-family']] = 'theme_fonts';
        }
    }
    return $additional_fonts;
});
