<?php
/* ---------------------------------------------------------------------------
 * Circles [circles] [/circles]
* --------------------------------------------------------------------------- */
if (!function_exists('sc_circles')) {
	function sc_circles($attr, $content = null) {
		extract(shortcode_atts(array(
			'circles'				=> '',
			'effect'				=> '',
			'hover_effect'			=> '',
			'btn_text'				=> '',
			'btn_link'				=> '',
			'circles_size'			=> 'pix-sm-circles',
			'circles_align'			=> 'justify-content-start',
			'circles_align_mobile'	=> 'center',
			'animation'				=> 'fade-in-left',
			'delay'					=> '0',
			'c_css' 				=> '',
			'css' 					=> '',
		), $attr));
		$attr['btn_mb'] = 'mb-0';

		$animation_class = '';
		$animation_type = '';
		if (!empty($animation)) {
			$attr['btn_animation'] = $animation;
			$attr['btn_anim_delay'] = intval($delay) + 300;
			$animation_class = 'animate-in';
			$animation_type = 'data-anim-type="' . $animation . '"';
		}

		$circles_arr = array();
		$css_class = '';

		if (is_array($circles)) {
			$circles_arr = $circles;
		} else {
			if (function_exists('vc_param_group_parse_atts')) {
				$circles_arr = vc_param_group_parse_atts($circles);
			}
		}

		$output = '';

		$effect_arr = array(
			"" => "",
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
		if (function_exists('vc_shortcode_custom_css_class')) {
			$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($c_css, ' '));
		}

		$classes = ' ';
		$classes .= $animation_class . ' ';
		if ($effect) {
			$classes .= $effect_arr[$effect] . ' ';
		}
		if ($hover_effect) {
			$classes .= $hover_effect_arr[$hover_effect] . ' ';
		}
		$i = intval($delay);
		$circles_html = '';

		if (!empty($circles_arr)) {
			foreach ($circles_arr as $key => $value) {
				if (!empty($value["img"])) {
					// $img = wp_get_attachment_image_src($value["img"], "full");
					$imgSrcset = '';
					$imgSizes = '';
					// $imgWidth = '';
					// $imgHeight = '';
					if (is_string($value["img"]) && substr($value["img"], 0, 4) === "http") {
						$img = $value["img"];
						$imgSrc = $img;
					} else {
						if (!empty($value["img"]['id'])) {
							$img = wp_get_attachment_image_src($value["img"]['id'], "pix-woocommerce-md");
							$imgSrcset = wp_get_attachment_image_srcset($value["img"]['id']);
							if (!empty($imgSrcset)) {
								$imgSrcset = 'srcset="' . $imgSrcset . '"';
								$imgSizes = 'sizes="' . wp_get_attachment_image_sizes($value["img"]['id'], "full") . '"';
							}

							$imgSrc = '';
							if (is_array($img)) {
								$imgSrc = $img[0];
							}
							if (!$img && $value["img"]['url']) {
								$imgSrc = $value["img"]['url'];
							}
						} else {
							$img = wp_get_attachment_image_src($value["img"], "pix-woocommerce-md");
							$imgSrcset = wp_get_attachment_image_srcset($value["img"]);
							if (!empty($imgSrcset)) {
								$imgSrcset = 'srcset="' . $imgSrcset . '"';
								$imgSizes = 'sizes="' . wp_get_attachment_image_sizes($value["img"], "full") . '"';
							}
							// if(!empty($img[1]) && !empty($img[2])){
							//     $imgWidth = 'width="'.$img[1].'"';
							//     $imgHeight = 'height="'.$img[2].'"';
							// }
							$imgSrc = $img[0];
						}
					}
				}
				if (empty($value['color'])) $value['color'] = '';

				$color = $value['color'];
				$title = empty($value["title"]) ? '' : $value["title"];
				$target = '';
				if (!empty($value['target'])) {
					$target = 'target="_blank"';
				}
				if (empty($value['link'])) {
					$circles_html .= '<span class="align-middle circle-item pix-mr-5 ' . $color . $classes . '" '.$animation_type.' data-anim-delay="' . $i . '" data-toggle="tooltip" data-placement="bottom" title="' . $title . '"><img src="' . $imgSrc . '" ' . $imgSrcset . ' ' . $imgSizes . ' width="60" height="60" class="rounded-circle bg-white" loading="lazy" alt="" /></span>';
				} else {
					$circles_html .= '<a class="align-middle circle-item pix-mr-5 ' . $color . $classes . '" '.$animation_type.' data-anim-delay="' . $i . '"  href="' . $value["link"] . '" ' . $target . ' data-toggle="tooltip" data-placement="bottom" title="' . $title . '"><img src="' . $imgSrc . '" ' . $imgSrcset . ' ' . $imgSizes . ' width="60" height="60" class="rounded-circle bg-white" loading="lazy"  alt="" /></a>';
				}
				$i += 100;
			}
		}

		if(!empty($circles_align_mobile)&&$circles_align_mobile!=='default'){
			$mobile_align = '';
			switch ($circles_align_mobile) {
				case 'left':
					$mobile_align = 'justify-content-start';
					break;
				case 'center':
					$mobile_align = 'justify-content-center';
					break;
				case 'right':
					$mobile_align = 'justify-content-end';
					break;
			}
			$circles_align = $mobile_align . ' '. str_replace("justify-content-","justify-content-sm-",$circles_align);
		}

		$output = '<div class="d-inline-block2 d-flex flex-column flex-sm-row w-100 text-center2 align-items-center2 ' . $circles_align . '  ' . esc_attr($css_class) . '">';
		$output .= '<div class="' . $circles_size . ' d-inline-flex align-items-center align-middle ' . $circles_align . '">' . $circles_html . '</div>';
		if (!empty($btn_text)) {
			$output .= '<div class="pix-ml-5 align-items-center align-items-center d-flex pt-md-0 pt-3 ' . $circles_align . '">';
			$output .= sc_pix_button($attr);
			$output .= '</div>';
		}
		$output .= '</div>';


		return $output;
	}
}
add_shortcode('circles', 'sc_circles');
