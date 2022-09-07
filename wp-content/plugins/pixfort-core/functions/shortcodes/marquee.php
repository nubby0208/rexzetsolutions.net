<?php

/* ---------------------------------------------------------------------------
* Marquee [pix_marquee][/pix_marquee]
* --------------------------------------------------------------------------- */
if (!function_exists('sc_pix_marquee')) {
	function sc_pix_marquee($attr, $content = null) {
		extract(shortcode_atts(array(
			'items'  => '',
			'content_color'		=> '',
			'content_custom_color'		=> '',
			'content_size'		=> 'h1',
			'display'		=> '',
			'content_custom_size'		=> '',
			'reversed'		=> false,
			'pause_on_hover'		=> false,
			'pix_gray_effect'		=> false,
			'pix_colored_hover'		=> false,
			'speed'		=> '',
			'items_padding'		=> false,
			'element_id'		=> '',
			'css' 		=> '',
		), $attr));

		$css_class = '';
		if (function_exists('vc_shortcode_custom_css_class')) {
			$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
		}

		$c_color = '';
		$c_custom_color = '';
		if (!empty($content_color)) {
			if ($content_color != 'custom') {
				$c_color = 'text-' . $content_color;
			} else {
				$c_color = 'el-content_custom_color';
				$c_custom_color = 'color:' . $content_custom_color . ';';
			}
		}
		if (empty($element_id)) {
			$element_id = 'marquee-' . rand(1, 200000000);
		} else {
			if (is_numeric($element_id[0])) {
				$element_id = 'el' . $element_id;
			}
		}

		$content_tag = $content_size;
		$c_size_style = '';
		$c_height_style = '';
		if ($content_size == 'custom') {
			$content_tag = "div";
		}
		if(!empty($content_custom_size)){
			$c_size_style = "font-size:" . $content_custom_size . ';';
			$c_height_style = "height:" . $content_custom_size . ';';
			$c_color .= ' pix-custom-text-size';
		}


		$texts = false;
		if (is_array($items)) {
			$texts = $items;
		} else {
			if (function_exists('vc_param_group_parse_atts')) {
				$texts = vc_param_group_parse_atts($items);
			}
		}
		$innerClasses = '';
		if (!empty($reversed)) {
			$innerClasses .= ' pix-reversed';
		}
		$mainClasses = '';
		if (!empty($pause_on_hover)) {
			$mainClasses .= ' pix-pause-hover';
		}
		if (!empty($pix_gray_effect)) {
			$mainClasses .= ' pix-gray-effect';
			if (!empty($pix_colored_hover)) {
				$mainClasses .= ' pix-colored-hover';
			}
		}
		$customStyle = '';
		if (!empty($speed)) {
			$customStyle .= '#' . $element_id . ' .marquee__inner { animation-duration: ' . $speed . 's;}';
		}
		if (!empty($items_padding)&&$items_padding!=='') {
			$customStyle .= '#' . $element_id . ' .pix-marquee-item { padding: 0 ' . $items_padding . ';}';
		}
		if (!empty($customStyle)) {
			wp_register_style('pix-marquee-handle', false);
			wp_enqueue_style('pix-marquee-handle');
			wp_add_inline_style('pix-marquee-handle', $customStyle);
		}

		$output = '';
		if ($texts) {
			$output = '<div id="' . $element_id . '" class="pix-marquee-element d-flex ' . esc_attr($css_class) . '" >';
			$output .= '<div class="pix-marquee ' . $mainClasses . ' " ><div class="marquee__inner ' . $innerClasses . '" aria-hidden="true">';
			foreach ($texts as $key => $value) {
				extract(shortcode_atts(array(
					'item_type'		=> '',
					'text'		=> '',
					'text_image'		=> '',
					'bold'		=> '',
					'italic'		=> '',
					'heading_font'		=> '',
					'icon'		=> '',
					'pix_duo_icon'		=> '',
					'image'		=> '',
					'image_size'		=> '',
					'rounded_img'		=> '',
					'style'		=> '',
					'hover_effect'		=> '',
					'add_hover_effect'		=> '',
					'link'			=> '',
					'target'		=> '',
				), $value));
				
				if(!empty($link)&&is_array($link)){
					if(!empty($link['is_external'])){
						$target = $link['is_external'];
					}
					$link = $link['url'];
				}
				if(!empty($target)) {
					$target = 'target="_blank"';
				} else {
					$target = '';
				}
				if (!empty($link)) {
					$output .= '<a href="' . $link . '" ' . $target . '>';
				}
				if ($item_type == "icon") {
					if (!empty($icon)) {
						$output .= '<' . $content_tag . ' class="pix-marquee-item ' . $c_color . '" style="' . $c_custom_color . $c_size_style . $c_height_style . '">';
						$output .= '<div><i class="align-middle d-block ' . $icon . '"></i></div>';
						$output .= '</' . $content_tag . '>';
					}
				} else if ($item_type == "image") {
					if (!empty($image)) {

						$style_arr = array(
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
						$classes = array();
						if($style){
							array_push($classes, $style_arr[$style]);
						}
						if($hover_effect){
							array_push($classes, $hover_effect_arr[$hover_effect]);
						}
						if($add_hover_effect){
							array_push($classes, $add_hover_effect_arr[$add_hover_effect]);
						}
						
						$imgSrc = '';
						$imgWidth = '';
						$imgHeight = '';
						$size_style = '';
						$size = 'full';
						if (!empty($image_size)) {
							$image_size = (int) filter_var($image_size, FILTER_SANITIZE_NUMBER_INT);
							if (!empty($rounded_img) && $rounded_img === 'rounded-circle') {
								$size_style = 'width:' . $image_size . 'px;height:' . $image_size . 'px;display:inline-block;position:relative;';
							}else{
								$size_style = 'width:' . $image_size . 'px;height:auto;display:inline-block;position:relative;';
							}
							
						}
						if (!empty($rounded_img) && $rounded_img === 'rounded-circle') {
							$size = "thumbnail";
							if (!empty($image_size)) {
								$size = array($image_size, $image_size);
							}
						}
						if (is_string($image) && substr($image, 0, 4) === "http") {
							$img = $image;
							$imgSrc = $img;
						} else {
							if (!empty($image['id'])) {
								$img = wp_get_attachment_image_src($image['id'], $size);
							} else {
								$img = wp_get_attachment_image_src($image, $size);
							}
							if (!empty($img[0])) $imgSrc = $img[0];
							if (!empty($img[1]) && !empty($img[2])) {
								$imgWidth = 'width="' . $img[1] . '"';
								$imgHeight = 'height="' . $img[2] . '"';
							}
						}
						array_push($classes, $rounded_img);
						$class_names = join(' ', $classes);
						$output .= '<' . $content_tag . ' class="pix-marquee-item ' . $c_color . ' ">';
						$output .= '<img class="pix-fit-cover ' . $class_names . '" src="' . $imgSrc . '" ' . $imgWidth . ' ' . $imgHeight . ' style="' . $size_style . '" alt="">';
						$output .= '</' . $content_tag . '>';
					}
				} else if ($item_type == "duo_icon") {
					$classes = array();
					$class_names = join(' ', $classes);
					if (!empty($pix_duo_icon)) {
						$output .= '<' . $content_tag . ' class="pix-marquee-item d-flex ' . $c_color . ' ' . $class_names . '" style="' . $c_custom_color . $c_size_style . $c_height_style . '">';
						$output .= pix_load_inline_svg(PIX_CORE_PLUGIN_DIR . '/functions/images/icons/' . $pix_duo_icon . '.svg');
						$output .= '</' . $content_tag . '>';
					}
				} else {
					$classes = array();
					$imgSrc = '';
					$text_image_style = '';
					if (!empty($text_image)) {
						if (is_string($text_image) && substr($text_image, 0, 4) === "http") {
							$img = $text_image;
							$imgSrc = $img;
							array_push($classes, 'text-gradient-primary');
						} else {
							if (is_array($text_image)) {
								if (!empty($text_image['id'])) {
									$img = wp_get_attachment_image_src($text_image['id'], "full");
									array_push($classes, 'text-gradient-primary');
									$imgSrc = $img[0];
								}
							} else {
								$img = wp_get_attachment_image_src($text_image, "full");
								array_push($classes, 'text-gradient-primary');
								if (!empty($img[0])) $imgSrc = $img[0];
							}
						}
						if (!empty($imgSrc)) {
							$text_image_style = 'background-image:url(\'' . $imgSrc . '\') !important;';
							array_push($classes, 'pix-text-image');
						}
					}
					if (!empty($bold)) array_push($classes, $bold);
					if (!empty($italic)) array_push($classes, $italic);
					if(!empty($display)) array_push($classes, $display );
					if (!empty($heading_font)) {
						array_push($classes, $heading_font);
					} else {
						// array_push($classes, 'body-font');
					}
					$class_names = join(' ', $classes);
					$output .= '<' . $content_tag . ' class="pix-marquee-item ' . $c_color . ' ' . $class_names . '" style="' . $text_image_style . $c_custom_color . $c_size_style . '">' . do_shortcode($text)  . '</' . $content_tag . '>';
				}
				if (!empty($link)) {
					$output .= '</a>';
				}
			}
			$output .= '</div></div>';
			$output .= '</div>';
		}
		return $output;
	}
}

add_shortcode('pix_marquee', 'sc_pix_marquee');
