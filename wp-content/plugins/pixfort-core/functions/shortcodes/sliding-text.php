<?php


/* ---------------------------------------------------------------------------
* Sliding text [sliding-text] [/sliding-text]
* --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_sliding_text' ) ){
	function sc_sliding_text( $attr, $content = null ){
		extract(shortcode_atts(array(
			'position'  => 'left',
			'size'  => 'h1',
			'custom_font_size'  => 'h1',
			'bold'  => 'font-weight-bold',
			'italic'  => '',
			'secondary_font'  => 'body-font',
			'text_color'  => 'heading-default',
			'text_custom_color'  => '',
			'display'  => '',
			'max_width'  => '',
			'remove_mb'  => false,
			'css'  => '',
			'el_id'  => '',
			'el_class' 		=> '',
			'delay'  => '0',
			'words_delay'  => 150,
			'pix_animation_duration'  => false,
			'sliding_letters'  => false,
			'letters_delay'  => false,
			'bar_inner_typography_font_family'  => false,
		), $attr));


		$css_class = '';
		if(function_exists('vc_shortcode_custom_css_class')){
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
		}
		if(!$bar_inner_typography_font_family){
			if($secondary_font!='secondary-font'){$secondary_font= 'body-font';}
		}
		
		$classes = array();
		if(!empty($bold)) array_push($classes, $bold );
		if(!empty($italic)) array_push($classes, $italic );
		if(!empty($secondary_font)) array_push($classes, $secondary_font );
		if(!empty($display)) array_push($classes, $display );
		if(!empty($el_class)) array_push($classes, $el_class );

		if(empty($el_id)) {
			$el_id = 'sliding-text-'.rand(1,200000000);
		}else{
            if(is_numeric($el_id[0])){
                $el_id = 'el'.$el_id;
            }
        }
		if(!empty($custom_font_size)){
			$customStyle = '#'.$el_id.' .pix-sliding-headline { font-size: '.$custom_font_size.' !important; }';
			wp_register_style( 'pix-sliding-text-handle', false );
			wp_enqueue_style( 'pix-sliding-text-handle' );
			wp_add_inline_style( 'pix-sliding-text-handle', $customStyle );
		}
		
		$is_gradient_color = false;
		$t_color = $secondary_font .' ';
		$t_custom_color = '';
		if(!empty($text_color)){
			if($text_color!='custom'){
				// if($text_color==='gradient-primary'){
				// 	array_push($classes, 'is-gradient-text' );
				// 	$is_gradient_color = true;
				// }
				$t_color .= 'text-'.$text_color;
				
				// if($text_color!='gradient-primary2'){
				// 	$t_color .= 'text-'.$text_color;
				// }else{
				// 	array_push($classes, 'text-gradient-primary' );
				// }

			}else{
				$t_custom_color = 'color:'.$text_custom_color.';';
			}
		}
		$custom_style = '';

		$class_names = join( ' ', $classes );

		$pix_mb = '';
		if(!$remove_mb){
			$pix_mb = 'mb-3';
		}
	
		
		$content = pix_specialchars_decode($content); 
		$items = explode(" ", $content);
			if(!empty($items)){
			$transitionFunction = '';
			if(!empty($pix_animation_duration)){
				$transitionFunction = 'transition-duration: '.$pix_animation_duration.'ms;';
			}
			$output = '<div id="'.$el_id.'" class="'.$pix_mb.' text-'.$position.' '.$css_class.'">';
			if(!empty($max_width)) {
				$custom_style = 'style="max-width:'.$max_width.';"';
				$output .= '<div class="d-inline-block" '.$custom_style.'>';
			}
			$delay = (int) $delay;
			$output .= '<'.$size.' class="mb-32 pix-sliding-headline-2 animate-in '.$class_names.' " data-anim-type="pix-sliding-text" pix-anim-delay="500" data-class="'.$t_color.'" style="'.$t_custom_color.'">';
			$letters_delay_value = (int) $letters_delay;
			foreach ($items as $key => $value) {
				if($sliding_letters){
					$letters = preg_split('//u', $value, -1, PREG_SPLIT_NO_EMPTY);
					$innerDelay = $delay;
					$output .= '<span class="slide-in-container">';	
					if($letters_delay===false||$letters_delay===''){
						$letters_delay_value = $words_delay/count($letters);
					}
					foreach ($letters as $k => $v) {
						$output .= '<span class="pix-sliding-item pix-sliding-letter '.$t_color.'" style="transition-delay: '.$innerDelay.'ms;'.$transitionFunction.'">'.  $v .'</span>';	
						$innerDelay += $letters_delay_value;
					}
					$output .= '</span> ';	
				}else{
					$output .= '<span class="slide-in-container ">';	
					if($is_gradient_color){
						$output .= '<span class="pix-sliding-item-placeholder" style="opacity: 0; display: inline-block; pointer-events: none; visibility: hidden; padding: 10px 0; margin: -10px 0; overflow: hidden;">'. do_shortcode( $value ) .'</span> ';	
					}
					$output .= '<span class="pix-sliding-item '.$t_color.'" style="transition-delay: '.$delay.'ms;'.$transitionFunction.'">'. do_shortcode( $value ) .'&#32;</span></span> ';	
				}
				$delay += (int) $words_delay;
			}
			$output .= '</'.$size.'>';
			if(!empty($max_width)) {
				$output .= '</div>';
			}
			$output .= '</div>';
		}
		
			


		return $output;
	}
}


add_shortcode( 'sliding-text', 'sc_sliding_text' );

?>
