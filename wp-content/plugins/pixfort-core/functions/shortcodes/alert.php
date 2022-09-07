<?php

/* ---------------------------------------------------------------------------
 * Alert Block [alertblock]
 * --------------------------------------------------------------------------- */
if (!function_exists('pf_alertblock')) {
	function pf_alertblock($attr, $content = null) {
		extract(shortcode_atts(array(
			'title' 	=> ' ',
			'bold'		=> 'font-weight-bold',
			'alert_inner_typography_font_weight'		=> '',
			'italic'		=> '',
			'secondary_font'		=> '',
			'alert_type_1' 	=> 'success',
			'shadow' 	=> '1',
			'hover_effect' 		=> '',
			'add_hover_effect' 		=> '',
			'rounded_img' 		=> 'rounded',
			'media_type'			=> '',
			'char'			=> '1',
			'pix_duo_icon'			=> '',
			'icon'			=> 'pixicon-question-circle',
			'icon_color'	=> 'primary',
			'custom_icon_color'	=> '',
			'icon_size'		=> '30',
			'image'			=> '',
			'image_size'	=> '',
			'circle'		=> '',
			'animation' 	=> '',
			'link_text'  => '',
			'link' 	=> '',
			'link_color' 	=> 'alert-default',
			'text_custom_color' 	=> '',
			'target' 	=> '',
			'delay' 	=> '0',
			'hide_close' 	=> '',
			'css' 	=> '',
		), $attr));
		if(!empty($alert_inner_typography_font_weight)) $bold = '';
		$output  = '';
		$shadow_class = '';

		$classes = array();
		$css_class = '';
		if (function_exists('vc_shortcode_custom_css_class')) {
			$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
		}
		array_push($classes, $css_class);
		array_push($classes, $rounded_img);

		$link_style = '';
		$link_classes = '';
		if (!empty($link_color)) {
			if ($link_color != 'custom') {
				$link_classes = 'text-' . $link_color;
			} else {
				$link_style .= 'style="color:' . $text_custom_color . ' !important;"';
			}
		}

		if (!empty($bold)) array_push($classes, $bold);
		if (!empty($italic)) array_push($classes, $italic);
		if (!empty($secondary_font)) array_push($classes, $secondary_font);

		if($shadow==='true') $shadow = "2";
		$style_arr = array(
			"none" => "",
			"1"       => "shadow-sm",
			"2"       => "shadow",
			"3"       => "shadow-lg",
			"4"       => "shadow-inverse-sm",
			"5"       => "shadow-inverse",
			"6"       => "shadow-inverse-lg",
		);

		$hover_effect_arr = array(
			""       => "",
			"1"       => "shadow-hover-sm",
			"2"       => "shadow-hover",
			"3"       => "shadow-hover-lg",
			"4"       => "shadow-inverse-hover-sm",
			"5"       => "shadow-inverse-hover",
			"6"       => "shadow-inverse-hover-lg",
		);

		$add_hover_effect_arr = array(
			""       => "",
			"1"       => "fly-sm",
			"2"       => "fly",
			"3"       => "fly-lg",
			"4"       => "scale-sm",
			"5"       => "scale",
			"6"       => "scale-lg",
			"7"       => "scale-inverse-sm",
			"8"       => "scale-inverse",
			"9"       => "scale-inverse-lg",
		);


		$anim_attrs = '';
		if (!empty($animation)) {
			array_push($classes, 'animate-in');
			$anim_attrs = 'data-anim-delay="' . $delay . '" data-anim-type="' . $animation . '"';
		}

		if ($shadow) {
			array_push($classes, $style_arr[$shadow]);
		}
		if ($hover_effect) {
			array_push($classes, $hover_effect_arr[$hover_effect]);
		}
		if ($add_hover_effect) {
			array_push($classes, $add_hover_effect_arr[$add_hover_effect]);
		}
		$i_color = '';
		$i_custom_color = '';
		if (!empty($icon_color)) {
			if ($icon_color != 'custom') {
				$i_color = 'text-' . $icon_color;
			} else {
				$i_custom_color .= 'color:' . $custom_icon_color . ';';
				if ($media_type == "duo_icon") {
					$customStyle = '#' . $element_id . ' path, ';
					$customStyle .= '#' . $element_id . ' rect, ';
					$customStyle .= '#' . $element_id . ' circle, ';
					$customStyle .= '#' . $element_id . ' polygon { fill: ' . $custom_icon_color . ' !important; }';
					wp_register_style('pix-duo-icons-handle', false);
					wp_enqueue_style('pix-duo-icons-handle');
					wp_add_inline_style('pix-duo-icons-handle', $customStyle);
				}
			}
		}
		$size = 'full';
		$size_style = '';

		if (!empty($image_size)) {
			$size_style = 'width:' . $image_size . ';height:auto;';
		}
		if (!empty($circle)) {
			$image_int_size = (int) filter_var($image_size, FILTER_SANITIZE_NUMBER_INT);
			$size = array($image_int_size, $image_int_size);
			$circle = 'rounded-circle';
		}
		$icon_size_div = $icon_size;
		$imgSrc = '';
		if ($image) {
			if (is_string($image) && substr($image, 0, 4) === "http") {
				$img = $image;
				$imgSrc = $img;
			} else {
				if (!empty($image['id'])) {
					$img = wp_get_attachment_image_src($image['id'], $size);
				} else {
					$img = wp_get_attachment_image_src($image, $size);
				}
				$imgSrc = $img[0];
			}
		}

		if(!empty($link)&&is_array($link)){
			if(!empty($link['is_external'])){
				$target = $link['is_external'];
			}
			$link = $link['url'];
		}
		
		$target_out = '';
		if (!empty($target)) {
			$target_out = 'target="_blank"';
		}

		$class_names = join(' ', $classes);
		$output = '';

		if (empty($link_text)) {
			if (!empty($link)) {
				$output .= '<a href="' . $link . '" ' . $target_out . ' class="alert-link pix-hover-item">';
			}
		}
		$output .= '<div class="alert d-flex flex-column flex-sm-row justify-content-between align-items-center alert-' . $alert_type_1 . ' ' . $shadow_class . ' ' . $class_names . '" role="alert" ' . $anim_attrs . '>';

		/*	Alert Icon	*/
		if (!empty($media_type)) {
			$output .= '<div class="pix-alert-icon mb-2 mb-sm-0 order-2">';
			if ($media_type == "icon") {
				$output .= '<div class="mr-0 mr-sm-3 feature_img" style="position:relative;text-align:center;"><i style="display:inline-block;font-size:' . $icon_size . 'px;min-width:' . $icon_size . 'px;line-height:' . $icon_size . 'px;' . $i_custom_color . '" class="' . $i_color . ' align-middle ' . $icon . '"></i></div>';
			} else if ($media_type == "image") {
				$output .= '<div class="feature_img  mr-0 mr-sm-3 d-inline-block position-relative" style="' . $size_style . '"><img style="' . $size_style . '" class="img-fluid2 pix-fit-cover ' . $circle . '" src="' . $imgSrc . '" alt="' . do_shortcode($title) . '"></div>';
			} else if ($media_type == "char") {
				$output .= '<div class="d-inline-block mr-0 mr-sm-3 feature_img" style="width:' . $icon_size_div . 'px;height:' . $icon_size_div . 'px;position:relative;line-height:' . $icon_size_div . 'px;text-align:center;"><span style="display:inline-block;font-size:' . $icon_size . 'px;line-height:' . $icon_size . 'px;' . $i_custom_color . '" class="' . $i_color . ' align-middle">' . $char . '</span></div>';
			} else if ($media_type == "duo_icon") {
				if (!empty($pix_duo_icon)) {
					$output .= '<div class="mr-0 mr-sm-3 ' . $i_color . '" style="width:' . $icon_size_div . 'px;height:' . $icon_size_div . 'px;position:relative;line-height:' . $icon_size_div . 'px;text-align:center;">';
					$output .= pix_load_inline_svg(PIX_CORE_PLUGIN_DIR . '/functions/images/icons/' . $pix_duo_icon . '.svg');
					$output .= '</div>';
				}
			}
			$output .= '</div>';
		}



		$output .= '<div class="pix-alert-title mr-2 flex-grow-1 mb-2 mb-sm-0 order-2">';
		$output .= do_shortcode($title);
		$output .= '</div>';
		
		if (!empty($link_text)) {
			$output .= '<div class="pix-alert-link mr-0 mr-sm-2 order-2">';
			if (!empty($link)) {
				$output .= '<a href="' . $link . '" ' . $target_out . ' class="pix-alert-link pix-hover-item alert-' . $link_classes . '" ' . $link_style . '>';
			}
			$output .= '<span class="d-flex align-items-center"><span class="text-nowrap ' . $link_classes . '">' . do_shortcode($link_text) . '</span><i class="pixicon-angle-right pix-hover-right pix-hover-item pix-ml-10 font-weight-bold text-20 ' . $link_classes . '"></i></span>';
			if (!empty($link)) {
				$output .= '</a>';
			}
			$output .= '</div>';
		}
		
		if (empty($hide_close)) {
			$output .= '<button type="button" class="close order-1 order-sm-3 text-right text-sm-center" data-dismiss="alert" aria-label="Close">';
			$output .= '<span aria-hidden="true">&times;</span>';
			$output .= '</button>';
		}

		$output .= '</div>';
		if (empty($link_text)) {
			if (!empty($link)) {
				$output .= '</a>';
			}
		}
		return $output;
	}
}

add_shortcode('alertblock', 'pf_alertblock');
add_shortcode('alert', 'pf_alertblock');
