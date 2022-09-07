<?php




function pix_templates_404(){
    $templates = array();

    // seo

    $data = array();
    $data['name'] = __( '404 Page SEO', 'pixfort-core' );
    $data['weight'] = 0;
    $data['type'] = 'default_templates';
    $data['category'] = 'default_templates';
    // $data['image_path'] = 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/404/seo-404-page.jpg';
    $data['image_path'] = 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/404/seo-404-page.jpg';
    $data['custom_class'] = 'custom_template_for_vc_custom_template all custom_404 pages';
    $data['content']  = <<<CONTENT
[vc_section full_width="stretch_row" full_height="yes" content_placement="middle" pix_over_visibility="" bottom_divider_select="2" bottom_layers="1" pix_overlay_color="gray-1"][vc_row full_width="stretch_row" content_placement="middle" pix_particles_check="" responsive_css="{``pix_res_sm_pt``:``60``,``pix_res_sm_pb``:``60``,``pix_res_md_pt``:``60``,``pix_res_md_pb``:``60``}" css=".vc_custom_1605062747142{padding-top: 80px !important;padding-bottom: 80px !important;}"][vc_column width="1/2" css=".vc_custom_1559101053478{padding: 30px !important;}"][pix_highlighted_text items="%5B%7B%22text%22%3A%22Oppps%22%2C%22is_highlighted%22%3A%22true%22%2C%22highlight_color%22%3A%22%23ffd900%22%2C%22bold%22%3A%22font-weight-bold%22%2C%22heading_font%22%3A%22heading-font%22%7D%5D" position="text-left" heading_id="1604288510938-88c6fcb0-435c"][pix_feature title_size="h3" title_bold="font-weight-bold" content_size="text-18" content_color="body-default" padding_title="30px" animation="fade-in-up" title="Page not found!" delay="400" css=".vc_custom_1604288491658{margin-bottom: 30px !important;}" element_id="1604288454580-fd4a5406-7191"]Combine seamlessly fitting layouts, customize everything you want, switch components on the go using our bootstrap.[/pix_feature][pix_button btn_text="Go back to home" btn_color="primary-light" btn_size="md" btn_effect="" btn_hover_effect="" btn_add_hover_effect="" btn_icon_position="after" btn_icon_animation="yes" btn_animation="fade-in-up" btn_link="http://essentials.pixfort.com/seo/" btn_icon="pixicon-angle-right" btn_anim_delay="800"][/vc_column][vc_column width="1/2"][pix_img rounded_img="rounded-lg" align="text-center" pix_scale_in="pix-scale-in-sm" style="" hover_effect="" add_hover_effect="1" image="https://essentials.pixfort.com/seo/wp-content/uploads/sites/42/2020/11/404-image.png"][/vc_column][/vc_row][/vc_section]
CONTENT;

    array_push($templates, $data);

    // minimal

    $data = array();
    $data['name'] = __( '404 Page Minimal', 'pixfort-core' );
    $data['weight'] = 0;
    $data['type'] = 'default_templates';
    $data['category'] = 'default_templates';
    $data['image_path'] = 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/404/minimal-404-page.webp';
    $data['custom_class'] = 'custom_template_for_vc_custom_template all custom_404 pages';
    $data['content']  = <<<CONTENT
[vc_section full_width="stretch_row" full_height="yes" content_placement="middle" pix_over_visibility="" responsive_css="{``pix_res_sm_pt``:``60``,``pix_res_sm_pb``:``60``,``pix_res_md_pt``:``80``,``pix_res_md_pb``:``80``}" css=".vc_custom_1647992832119{padding-top: 120px !important;padding-bottom: 120px !important;}"][vc_row full_width="stretch_row_content_no_spaces" pix_particles_check=""][vc_column][pix_marquee items="%5B%7B%22item_type%22%3A%22text%22%2C%22text%22%3A%22404%20Error%22%2C%22bold%22%3A%22font-weight-bold%22%2C%22heading_font%22%3A%22heading-font%22%2C%22pix_duo_icon%22%3A%220%22%7D%2C%7B%22item_type%22%3A%22duo_icon%22%2C%22bold%22%3A%22font-weight-bold%22%2C%22heading_font%22%3A%22heading-font%22%2C%22pix_duo_icon%22%3A%22warning-2%22%2C%22icon%22%3A%22pixicon-warning-triangle%22%7D%5D" content_color="gradient-primary" content_size="custom" pix_gray_effect="pix-gray-effect" pix_colored_hover="pix-colored-hover" content_custom_size="100px"][/vc_column][/vc_row][vc_row full_width="stretch_row" content_placement="middle" pix_particles_check=""][vc_column content_align="text-center" offset="vc_col-lg-offset-2 vc_col-lg-8 vc_col-md-offset-1 vc_col-md-10"][pix_highlighted_text items="%5B%7B%22text%22%3A%22Oops!%22%2C%22is_highlighted%22%3A%22true%22%2C%22highlight_color%22%3A%22%23ffd900%22%2C%22custom_height%22%3A%2210%22%2C%22bold%22%3A%22font-weight-bold%22%2C%22heading_font%22%3A%22heading-font%22%7D%2C%7B%22text%22%3A%22%20That%20page%20can%E2%80%99t%20be%20found.%22%2C%22highlight_color%22%3A%22%23ffd900%22%2C%22heading_font%22%3A%22heading-font%22%7D%5D" heading_id="1609292819644-5e128699-7b78" css=".vc_custom_1644361055477{padding-top: 20px !important;padding-bottom: 20px !important;}" max_width="500px"][pix_text size="text-20" content_color="body-default" css=".vc_custom_1615682368123{padding-top: 10px !important;padding-bottom: 10px !important;}"]It looks like nothing was found at this location. Maybe try a search?[/pix_text][pix_button btn_text="Go back to home" btn_color="gradient-primary" btn_text_color="white" btn_size="md" btn_effect="" btn_hover_effect="" btn_add_hover_effect="7" btn_icon_position="after" btn_icon_animation="yes" btn_link="#" btn_icon="pixicon-angle-right"][/vc_column][/vc_row][/vc_section]
CONTENT;

    array_push($templates, $data);

    // consulting

    $data = array();
    $data['name'] = __( '404 Page Consulting', 'pixfort-core' );
    $data['weight'] = 0;
    $data['type'] = 'default_templates';
    $data['category'] = 'default_templates';
    $data['image_path'] = 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/404/consulting-404-page.webp';
    $data['custom_class'] = 'custom_template_for_vc_custom_template all custom_404 pages';
    $data['content']  = <<<CONTENT
    [vc_section full_width="stretch_row" full_height="yes" content_placement="middle" pix_over_visibility=""][vc_row full_width="stretch_row" content_placement="middle" pix_particles_check="" responsive_css="{``pix_res_sm_pt``:``60``,``pix_res_sm_pb``:``60``,``pix_res_md_pt``:``60``,``pix_res_md_pb``:``60``}" css=".vc_custom_1605062747142{padding-top: 80px !important;padding-bottom: 80px !important;}"][vc_column width="1/4" content_align="text-center"][heading title_color="heading-default" display="display-3" position="text-left" vertical_element="true" title="Error 404 `{`pix_br`}` Page not found" image="https://essentials.pixfort.com/consulting/wp-content/uploads/sites/51/2021/11/banner-image-orange.jpg"][/vc_column][vc_column width="2/4" css=".vc_custom_1559101053478{padding: 30px !important;}"][sliding-text bold="font-weight-bold" secondary_font="secondary-font" text_color="heading-default" sliding_letters="1" el_id="1644528973781-6a9e2286-43a9"]Opps![/sliding-text][pix_text content_color="body-default" css=".vc_custom_1648582295097{padding-top: 20px !important;}" max_width="500px"]Sorry but the page you are looking for doesn't exist or is not available anymore, however, you can search for a specific page:[/pix_text][pix_search max_width="500px"][pix_text content_color="body-default" css=".vc_custom_1648582301578{padding-top: 20px !important;}"]Or go back to website main page:[/pix_text][pix_button btn_text="Go back to home" btn_color="secondary" btn_size="normal" btn_rounded="btn-rounded" btn_effect="" btn_hover_effect="" btn_add_hover_effect="" btn_icon_position="after" btn_icon_animation="yes" btn_icon="pixicon-angle-right" btn_link="#"][/vc_column][vc_column width="1/4" content_align="text-center"][heading title_color="gray-2" display="display-1" position="text-left" vertical_element="true" title="!@#$%^&*"][/vc_column][/vc_row][/vc_section]
CONTENT;

    array_push($templates, $data);


    return $templates;
}




 ?>
