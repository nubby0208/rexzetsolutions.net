<?php

/* ---------------------------------------------------------------------------
 * Highlighted Text [pix_highlighted_text] [/pix_highlighted_text]
* --------------------------------------------------------------------------- */
if (!function_exists('sc_pix_highlighted_text')) {
	function sc_pix_highlighted_text($attr, $content = null) {
		extract(shortcode_atts(array(
			'items' 		=> '',
			'title_color'		=> 'heading-default',
			'title_custom_color'		=> '',
			'title_size'		=> 'h1',
			'display'		=> '',
			'title_custom_size'		=> '',
			'position'  => 'text-center',
			'animation' 	=> '',
			'delay' 	=> '0',
			'heading_id' 	=> '',
			'max_width' 	=> '',
			'disable_resp_img'				=> false,
			'css' 		=> '',
		), $attr));
		$css_class = '';
		$classes = array();
		if (function_exists('vc_shortcode_custom_css_class')) {
			$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
		}

		$texts = array();
		if (is_array($items)) {
			$texts = $items;
		} else {
			if (function_exists('vc_param_group_parse_atts')) {
				$texts = vc_param_group_parse_atts($items);
			}
		}
		$output = '';
		if ($texts) {

			$t_color = '';
			$t_custom_color = '';
			if (!empty($title_color)) {
				$t_color = 'text-' . $title_color;
				if ($title_color === 'custom') {
					$t_custom_color .= 'color:' . $title_custom_color . ' !important;';
				}
			}

			if (!empty($display)) array_push($classes, $display);

			$title_tag = $title_size;
			$t_size_style = '';
			if ($title_size == 'custom') {
				$title_tag = "div";
				$t_size_style = "font-size:" . $title_custom_size . ';';
			}
			if (!empty($animation)) {
				array_push($classes, 'animate-in');
			}
			$class_names = join(' ', $classes);

			if (empty($heading_id)) {
				$heading_id = 'highlighted-text-' . rand(1, 200000000);
			} else {
				if (is_numeric($heading_id[0])) {
					$heading_id = 'el' . $heading_id;
				}
			}



			$output .= '<div id="' . $heading_id . '" class="pix-highlighted-element ' . $position . ' ' . $css_class . '">';
			if (!empty($max_width)) {
				$custom_style = 'style="max-width:' . $max_width . ';"';
				$output .= '<div class="d-inline-block" ' . $custom_style . '>';
			}
			$output .= '<' . $title_tag . ' class="pix-highlighted-items ' . $class_names . '" style="' . $t_size_style . '" data-anim-type="' . $animation . '" data-anim-delay="' . $delay . '">';
			foreach ($texts as $key => $value) {
				extract(shortcode_atts(array(
					'is_highlighted'		=> '',
					'text'					=> '',
					'bold'					=> '',
					'italic'				=> '',
					'heading_font'			=> 'body-font',
					'has_color'			=> false,
					'item_color'			=> '',
					'item_custom_color'			=> '',
					'item_custom_gradient_color'			=> '',
					// 'highlighted_color_type'		=> 'simple',
					'highlight_color'		=> '',
					// 'highlight_gradient'		=> '',
					'custom_height'			=> '',
					'image'		=> '',
					'image_size'		=> '',
					'rounded_img'		=> '',
					'style'		=> '',
					'hover_effect'		=> '',
					'add_hover_effect'		=> '',
					'item_animation'		=> '',
					'item_delay'		=> '',
					'new_line'				=> '',
				), $value));

				$classes = 'pix-highlight-item font-weight-normal ';
				if (!empty($bold)) {
					$classes .= ' ' . $bold;
				}
				if (!empty($heading_font)) {
					$classes .= ' ' . $heading_font;
				} else {
					$classes .= ' body-font';
				}
				if (!empty($italic)) {
					$classes .= ' ' . $italic;
				}
				$item_id = $heading_id . '-' . $key;
				$bgClasses = '';
				if (!empty($value['_id'])) {
					// $classes .= ' elementor-repeater-item-' . $value['_id'];
					$bgClasses .= ' elementor-repeater-item-' . $value['_id'];
				}
				
				$customStyle = '';
				$item_color_class = $t_color;
				if(!empty($has_color)){
					if(!empty($item_color)){
						if($item_color=='custom-gradient'){
							$item_color_class = 'text-gradient-primary text-custom-gradient';
							$customStyle .= '.' . $item_id . ' .text-custom-gradient, .' . $item_id . '.text-custom-gradient { background-image:' . $item_custom_gradient_color . ' !important; }';
						}elseif ($item_color=='custom'){
							$customStyle .= '.' . $item_id . ' { color:' . $item_custom_color . '; }';
						}else{
							$item_color_class = 'text-'.$item_color;
						}
					}
				}

				if (!empty($is_highlighted)) {
					if ($is_highlighted == 'image') {
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
							$imageClasses = array();
							if ($style) {
								array_push($imageClasses, $style_arr[$style]);
							}
							if ($hover_effect) {
								array_push($imageClasses, $hover_effect_arr[$hover_effect]);
							}
							if ($add_hover_effect) {
								array_push($imageClasses, $add_hover_effect_arr[$add_hover_effect]);
							}

							$imgSrc = '';
							$imgWidth = '';
							$imgHeight = '';
							$size_style = '';
							$size = 'full';
							if (!empty($rounded_img) && $rounded_img === 'rounded-circle') {
								$size = "thumbnail";
							}
							if (!empty($image_size)) {
								$image_size = (int) filter_var($image_size, FILTER_SANITIZE_NUMBER_INT);
								$image_height = 'auto';
								if (!empty($rounded_img) && $rounded_img === 'rounded-circle') {
									$size = array($image_size, $image_size);
									$image_height = $image_size.'px';
								}
								array_push($imageClasses, $item_id);
								// $size_style = 'width:' . $image_size . 'px;height:auto;display:inline-block;position:relative;';
								$customStyle .= '.' . $item_id . ' img { width:' . $image_size . 'px;height:'.$image_height.';display:inline-block;position:relative; }';
								if(empty($disable_resp_img)||!$disable_resp_img){
									$mobileImgSize = $image_size * 0.6;
									$tabletImgSize = $image_size * 0.8;
									$customStyle .= '@media (min-width:576px) and (max-width:920px) { .' . $item_id . ' img { width:' . $tabletImgSize . 'px;height: auto; }}';
									$customStyle .= '@media only screen and (max-width:576px) { .' . $item_id . ' img { width:' . $mobileImgSize . 'px;height: auto; }}';
								}
								$handle = 'pix-highlighted-text-'.$item_id;
								wp_register_style($handle, false);
								wp_enqueue_style($handle);
								wp_add_inline_style($handle, $customStyle);
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
									if (!empty($image_size)) {
										$ratio = (int) $img[2] / (int) $img[1];
										$newHeight = $image_size * $ratio;
										$imgHeight = 'height="' . $newHeight . '"';
										$imgWidth = 'width="' . $image_size . '"';
									}
								}
							}
							$anim_type = '';
            				$anim_delay = '';
							if(!empty($item_animation)){
								$anim_type = 'data-anim-type="'.$item_animation.'"';
								$anim_delay = 'data-anim-delay="'.$item_delay.'"';
								array_push($imageClasses, 'animate-in');
							}
							array_push($imageClasses, $rounded_img);
							$image_class_names = join(' ', $imageClasses);

							$output .= '<div class="d-inline-flex mx-2 ' . $image_class_names . '" '.$anim_type.' '.$anim_delay.' style="vertical-align: middle;line-height:1;">';
							$output .= '<img class="pix-fit-cover '.$rounded_img. ' ' . $class_names . '" src="' . $imgSrc . '" ' . $imgWidth . ' ' . $imgHeight . ' style="' . $size_style . '" alt="">';
							$output .= '</div>';
						}
					} else {

						
						$css_color = '';
						
						// if (!empty($highlighted_color_type)&&$highlighted_color_type=='gradient') {
						// 	if (!empty($highlight_gradient)) {
						// 		$customStyle .= '.' . $item_id . ' { background-image: ' . $highlight_gradient.' !important; }';
						// 	}
						// }else{
							if (!empty($highlight_color)) {
								if (!empty($value['__globals__'])) {
									if (!empty($value['__globals__']['highlight_color'])) {
										$highlight_color = str_replace('globals/colors?id=', "", $value['__globals__']['highlight_color']);
										$highlight_color = 'var(--e-global-color-' . $highlight_color . ')';
									}
								}
								if ($highlight_color != '#ffd900') {
									 $customStyle .= '.' . $item_id . '.pix-highlight-bg { background-image: linear-gradient(' . $highlight_color . ', ' . $highlight_color . ') !important; }';
									
								}
							}	
						// }
						
						if (!empty($custom_height)) {
							$customStyle .= '.' . $item_id . '.pix-highlight-bg { background-size: 0% ' . $custom_height . '%; }';
							$customStyle .= '.' . $item_id . '.animated.pix-highlight-bg, .' . $item_id . '.highlight-grow.pix-highlight-bg { background-size: 100% ' . $custom_height . '% !important; }';
						}
						if (!empty($customStyle)) {
							$bgClasses .= ' ' . $item_id;
							wp_register_style('pix-highlighted-text-handle', false);
							wp_enqueue_style('pix-highlighted-text-handle');
							wp_add_inline_style('pix-highlighted-text-handle', $customStyle);
						}
						
						$output .= '<span id="'.$item_id.'" class="pix-highlight-bg align-middle2 '.$bgClasses.' animate-in" data-anim-type="highlight-grow" data-anim-delay="200"><span class="pix-highlighted-text  ' . $classes . ' '.$item_color_class.'">' . do_shortcode($text) . '</span></span>';
					}
				} else {
					if (!empty($customStyle)) {
						$classes .= ' ' . $item_id;
						wp_register_style('pix-highlighted-text-handle', false);
						wp_enqueue_style('pix-highlighted-text-handle');
						wp_add_inline_style('pix-highlighted-text-handle', $customStyle);
					}
					$output .= '<span class=""><span class="pix-highlighted-text ' . $classes . ' '.$item_color_class.'">' . do_shortcode($text) . '</span></span>';
				}
				if (!empty($new_line)) {
					$output .= '</br>';
				}
			}
			$output .= '</' . $title_tag . '>';
			if (!empty($max_width)) {
				$output .= '</div>';
			}
			$output .= '</div>';
		}

		return $output;
	}
}


add_shortcode('pix_highlighted_text', 'sc_pix_highlighted_text');
