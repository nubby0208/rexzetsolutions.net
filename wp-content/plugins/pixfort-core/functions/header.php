<?php

/**
 * pixheader custom meta fields.
 */

/* ---------------------------------------------------------------------------
 * Create new post type
 * --------------------------------------------------------------------------- */
function pix_pixheader_post_type() {
	$pixheader_item_slug = "pixheader-item";

	$labels = array(
		'name' 					=> __('Headers', 'pixfort-core'),
		'singular_name' 		=> __('Header item', 'pixfort-core'),
		'add_new' 				=> __('Add New Header', 'pixfort-core'),
		'add_new_item' 			=> __('Add New Header item', 'pixfort-core'),
		'edit_item' 			=> __('Edit Header item', 'pixfort-core'),
		'new_item' 				=> __('New Header item', 'pixfort-core'),
		'view_item' 			=> __('View Header item', 'pixfort-core'),
		'search_items' 			=> __('Search Header items', 'pixfort-core'),
		'not_found' 			=> __('No Header items found', 'pixfort-core'),
		'not_found_in_trash' 	=> __('No Header items found in Trash', 'pixfort-core'),
		'parent_item_colon' 	=> ''
	);

	$args = array(
		'labels' 				=> $labels,
		'public' 				=> true,
		'menu_icon' 				=> PIX_CORE_PLUGIN_URI . 'functions/images/admin/header-icon.svg',
		'publicly_queryable' 	=> true,
		'show_ui' 				=> true,
		'query_var' 			=> true,
		'capability_type' 		=> 'post',
		'hierarchical' 			=> false,
		'menu_position' 		=> null,
		'exclude_from_search' 	=> true,
		'rewrite' 				=> array('slug' => $pixheader_item_slug, 'with_front' => true),
		'supports' 				=> array('title', 'page-attributes', 'revisions'),
	);

	register_post_type('pixheader', $args);
}
add_action('init', 'pix_pixheader_post_type');






function pix_header_meta_add() {
	global $pix_header_meta_box;

	// Layouts ----------------------------------
	$layouts = array(0 => '-- Theme Options --');

	// Custom menu ------------------------------
	$aMenus = array(0 => '-- Default --');
	$oMenus = get_terms('nav_menu', array('hide_empty' => false));

	if (is_array($oMenus)) {
		foreach ($oMenus as $menu) {
			$aMenus[$menu->term_id] = $menu->name;
		}
	}

	$pix_header_meta_box = array(
		'id' 		=> 'pix-meta-page',
		'title' 	=> __('PixFort Header Options', 'pixfort-core'),
		'page' 		=> 'pixheader',
		'post_types'	=> array('pixheader'),
		'context' 	=> 'normal',
		'priority' 	=> 'high',
		'fields'	=> array(
			array(
				'id' 		=> 'pix-header-drag',
				'type' 		=> 'header_drag',
				'title' 	=> __('Header builder', 'pixfort-core'),
			),

			array(
				'id' 		=> 'pix-header-style',
				'type' 		=> 'select',
				'title' 	=> __('Header Style', 'pixfort-core'),
				'sub_desc' 	=> __('Select Desktop header style.', 'pixfort-core'),
				'options' 	=> array(
					''			=> "Default",
					'default-full'			=> "Default (Full width)",
					'transparent'			=> "Transparent",
					'transparent-full'			=> "Transparent (Full width)",
					'boxed'					=> "Boxed",
					'boxed-full'			=> "Boxed (Full width)"
				),
			),

			array(
				'id' 		=> 'pix-enable-sticky',
				'type' 		=> 'select',
				'title' 	=> __('Enable Desktop sticky header', 'pixfort-core'),
				'options' 	=> array(
					'enable'			=> "Yes",
					'disable'			=> "No",
				),
				'std'		=> 'enable'
			),
			array(
				'id' 		=> 'pix-enable-mobile-sticky',
				'type' 		=> 'select',
				'title' 	=> __('Enable Mobile sticky header', 'pixfort-core'),
				'options' 	=> array(
					'enable'			=> "Yes",
					'disable'			=> "No",
				),
				'std'		=> 'disable'
			),

			array(
				'id'		=> 'is_secondary_font',
				'type'		=> 'switch',
				'title'		=> __('Use secondary font', 'pixfort-core'),
				'options'	=> array('1' => 'Yes', '0' => 'No'),
				'std'		=> '0'
			),


		),
	);


	add_meta_box($pix_header_meta_box['id'], $pix_header_meta_box['title'], 'pix_header_show_box', $pix_header_meta_box['page'], $pix_header_meta_box['context'], $pix_header_meta_box['priority']);
}
add_action('admin_menu', 'pix_header_meta_add');

function pix_header_show_box() {
	global $pix_header_meta_box, $post;

	// Use nonce for verification
	echo '<div id="pix-wrapper">';
	echo '<input type="hidden" name="pix_page_meta_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	echo '<table class="form-table">';
	echo '<tbody>';
	$pixfortBuilder = new PixfortOptions();
	$pixfortBuilder->initOptions(
		'meta',
		$post
	);
	$pixfortBuilder->addOption(
		'pix-header-drag',
		[
			'type' => 'header-builder',
			'label' => 'Header builder',
		]
	);
	$pixfortBuilder->addOption(
		'pix-header-style',
		[
			'type' => 'select',
			'label' => 'Header Style',
			'description' => 'Select Desktop header style.',
			'options' => array(
				''			=> "Default",
				'default-full'			=> "Default (Full width)",
				'transparent'			=> "Transparent",
				'transparent-full'			=> "Transparent (Full width)",
				'boxed'					=> "Boxed",
				'boxed-full'			=> "Boxed (Full width)"
			)
		]
	);

	$pixfortBuilder->addOption(
		'pix-enable-sticky',
		[
			'type' => 'select',
			'label' => 'Enable Desktop sticky header',
			'default' => 'enable',
			'options' => array(
				'enable'			=> "Yes",
				'smart'			=> "Yes (Smart Sticky)",
				'disable'			=> "No"
			)
		]
	);
	$pixfortBuilder->addOption(
		'pix-enable-mobile-sticky',
		[
			'type' => 'select',
			'label' => 'Enable Mobile sticky header',
			'default' => 'disable',
			'options' => array(
				'enable'			=> "Yes",
				'smart'			=> "Yes (Smart Sticky)",
				'disable'			=> "No"
			)
		]
	);
	$pixfortBuilder->addOption(
		'is_secondary_font',
		[
			'label'	=> __('Use secondary font', 'pixfort-core'),
			'type' => 'checkbox'
		]
	);
	$pixfortBuilder->loadOptionsData();
?>
	<div style="width:100%;text-align:center;" class="pixfort_headerbuilder_loading"><img src="<?php echo PIX_IMG_PLACEHOLDER; ?>" /></div>
<?php

	echo '<div id="qdxy6294b"></div>';
	echo '</tbody>';
	echo '</table>';
	echo '</div>';
}

/*-----------------------------------------------------------------------------------*/
/*	Save data when page is edited
/*-----------------------------------------------------------------------------------*/
function pix_header_save_data($post_id) {
	global $pix_header_meta_box;

	// verify nonce
	if (key_exists('pix_page_meta_nonce', $_POST)) {
		if (!wp_verify_nonce($_POST['pix_page_meta_nonce'], basename(__FILE__))) {
			return $post_id;
		}
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ((key_exists('post_type', $_POST)) && ('page' == $_POST['post_type'])) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	// check and save fields ( $pix_header_meta_box['fields'] )
	if (!empty($pix_header_meta_box)) {
		foreach ((array)$pix_header_meta_box['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			if (key_exists($field['id'], $_POST)) {
				$new = $_POST[$field['id']];
			} else {
				if ($field['type'] == 'switch') {
					$new = '0';
				} else {
					continue;
				}
			}
			if (isset($new) && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif (isset($new) && '' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
	}
}
add_action('save_post', 'pix_header_save_data', 1, 2);

// Revisions options
function pix_save_revisions($post_id) {

	// Check if it's a revision
	$parent_id = wp_is_post_revision($post_id);

	// If is revision
	if ($parent_id) {
		if ('pixheader' === get_post_type((int) $parent_id)) {
			global $pix_header_meta_box;
			// Get the saved data
			$parent = get_post($parent_id);
			if (!empty($pix_header_meta_box)) {
				foreach ((array)$pix_header_meta_box['fields'] as $field) {
					$details = get_post_meta($parent->ID, $field['id'], true);
					// If data exists and is an array, add to revision
					if (!empty($details)) {
						add_metadata('post', $post_id, $field['id'], $details);
					}
				}
			}
		}
	}
}
add_action('save_post', 'pix_save_revisions');

function pix_header_restore_revision($post_id, $revision_id) {
	if ('pixheader' === get_post_type((int) $post_id)) {
		$post     = get_post($post_id);
		$revision = get_post($revision_id);
		global $pix_header_meta_box;
		if (!empty($pix_header_meta_box)) {
			foreach ((array)$pix_header_meta_box['fields'] as $field) {
				$pix_meta_revision  = get_metadata('post', $revision->ID, $field['id'], true);
				if (false !== $pix_meta_revision) {
					update_post_meta($post_id, $field['id'], $pix_meta_revision);
				} else {
					delete_post_meta($post_id, $field['id']);
				}
			}
		}
	}
}
add_action('wp_restore_post_revision', 'pix_header_restore_revision', 10, 2);

add_filter('_wp_post_revision_fields', function (array $fields, array $post) {
	if ('pixheader' === $post['post_type'] || 'revision' === $post['post_type'] && 'pixheader' === get_post_type((int) $post['post_parent'])) {
		global $pix_header_meta_box;
		if (!empty($pix_header_meta_box)) {
			foreach ((array)$pix_header_meta_box['fields'] as $field) {
				$fields[$field['id']] = __($field['title'], 'pixfort-core');
			}
		}
	}
	return $fields;
}, 10, 2);
add_filter('_wp_post_revision_field_pix-header-drag', 'myplugin_wp_post_revision_field_for_diff', 10, 3);
add_filter('_wp_post_revision_field_pix-header-style', 'myplugin_wp_post_revision_field_for_diff', 10, 3);
add_filter('_wp_post_revision_field_pix-enable-sticky', 'myplugin_wp_post_revision_field_for_diff', 10, 3);
add_filter('_wp_post_revision_field_pix-enable-mobile-sticky', 'myplugin_wp_post_revision_field_for_diff', 10, 3);
add_filter('_wp_post_revision_field_is_secondary_font', 'myplugin_wp_post_revision_field_for_diff', 10, 3);
function myplugin_wp_post_revision_field_for_diff($value, string $field, WP_Post $compare_from): string {
	if (!empty($compare_from->post_content_filtered)) {
		global $revision;
		return (string) get_metadata('post', $revision->ID, $field, true);
	}
	return (string) $value;
}

/*-----------------------------------------------------------------------------------*/
/*	Styles & scripts
/*-----------------------------------------------------------------------------------*/
function pix_edit_form_after_editor() {
	wp_enqueue_style('pix-meta', PIX_CORE_PLUGIN_URI . 'functions/css/pixbuilder.css', false, PLUGIN_VERSION, 'all');
	wp_enqueue_style('pix-header-builder', PIX_CORE_PLUGIN_URI . 'functions/css/pixHeaderBuilder.css', false, PLUGIN_VERSION, 'all');
	wp_enqueue_style('pix-meta2', PIX_CORE_PLUGIN_URI . 'functions/pixbuilder.css', false, PLUGIN_VERSION, 'all');
	wp_enqueue_style('wp-color-picker');
}
add_action('edit_form_after_editor', 'pix_edit_form_after_editor');

// Yoast SEO Plugin fix
function my_remove_wp_seo_meta_box() {
	remove_meta_box('wpseo_meta', 'pixheader', 'normal');
}
add_action('add_meta_boxes', 'my_remove_wp_seo_meta_box', 100);

?>