<?php




function pix_templates_faq(){
    $templates = array();

    // startup

    $data = array(); // Create new array
    $data['name'] = __( 'FAQ Startup', 'pixfort-core' ); // Assign name for your custom template
    $data['weight'] = 0; // Weight of your template in the template list
    $data['type'] = 'default_templates'; // Weight of your template in the template list
    $data['category'] = 'default_templates'; // Weight of your template in the template list
    $data['image_path'] = 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/faq/startup-faq.png'; // Always use preg replace to be sure that "space" will not break logic. Thumbnail should have this dimensions: 114x154px
    $data['custom_class'] = 'custom_template_for_vc_custom_template all faq'; // CSS class name
    $data['content']  = <<<CONTENT
[vc_section full_width="stretch_row" b_flip_h="true" css=".vc_custom_1589722836006{padding-top: 80px !important;padding-bottom: 80px !important;}" b_custom_height="400px"][vc_row][vc_column offset="vc_col-md-offset-2 vc_col-md-8"][pix_badge bold="font-weight-bold" secondary_font="" style="" hover_effect="" add_hover_effect="" animation="fade-in-up" element_div="text-center" padding="" text="First Time on Themeforest" css=".vc_custom_1589677871505{padding-top: 7px !important;padding-right: 12px !important;padding-bottom: 7px !important;padding-left: 12px !important;}"][heading title_color="dark-opacity-8" title_size="h4" title="Your pixfort license explained" css=".vc_custom_1589597934083{padding-top: 20px !important;}"][pix_text size="text-20" content_color="body-default" position="text-center" animation="fade-in-up" max_width="600px" css=".vc_custom_1589677862215{padding-top: 10px !important;}" delay="200"]Here’s what you need to know about your PixFort license, based on the questions we get asked the most.[/pix_text][/vc_column][/vc_row][vc_row css=".vc_custom_1589722848078{padding-top: 60px !important;}"][vc_column width="1/2"][pix_faq title_bold="font-weight-bold" title_color="primary" title_size="h6" media_type="duo_icon" pix_duo_icon="question-circle" content_color="gray-5" animation="fade-in" content_animation="fade-in" title="Where can I find the End User License Agreement (EULA)?" delay="200" content_delay="200"]You can read the PixFort End User License Agreement here, which is a legal contract between a software application author or publisher and the user of that application.[/pix_faq][pix_faq title_bold="font-weight-bold" title_color="primary" title_size="h6" media_type="duo_icon" pix_duo_icon="question-circle" content_color="gray-5" animation="fade-in" content_animation="fade-in" title="What happens if I don’t renew my license?" delay="400" content_delay="400" css=".vc_custom_1589676310952{padding-top: 30px !important;}"]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.[/pix_faq][/vc_column][vc_column width="1/2"][pix_faq title_bold="font-weight-bold" title_color="primary" title_size="h6" media_type="duo_icon" pix_duo_icon="question-circle" content_color="gray-5" animation="fade-in" content_animation="fade-in" title="How long does my license/seats last for?" delay="600" content_delay="600"]Your license is valid for a year from the date you purchase it. you’ll get regular updates to PixFort until 11th April, 2020. [pix_br][pix_br]An active PixFort license also enables you to upload your documents to our PixFort Cloud service.[/pix_faq][pix_faq title_bold="font-weight-bold" title_color="primary" title_size="h6" media_type="duo_icon" pix_duo_icon="question-circle" content_color="gray-5" animation="fade-in" content_animation="fade-in" title="Do I need to renew my license to receive fixes?" delay="800" content_delay="800" css=".vc_custom_1589676300951{padding-top: 30px !important;}"]We split up PixFort releases into regular updates and bug-fix updates. You’ll always be entitled to a bug-fix update for your last version, even after your license has expired.[/pix_faq][/vc_column][/vc_row][/vc_section]
CONTENT;

    array_push($templates, $data);

    // startup

    $data = array(); // Create new array
    $data['name'] = __( 'FAQ left SaaS', 'pixfort-core' ); // Assign name for your custom template
    $data['weight'] = 0; // Weight of your template in the template list
    $data['type'] = 'default_templates'; // Weight of your template in the template list
    $data['category'] = 'default_templates'; // Weight of your template in the template list
    $data['image_path'] = 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/faq/saas-faq-left.png'; // Always use preg replace to be sure that "space" will not break logic. Thumbnail should have this dimensions: 114x154px
    $data['custom_class'] = 'custom_template_for_vc_custom_template all faq'; // CSS class name
    $data['content']  = <<<CONTENT
[vc_section full_width="stretch_row" css=".vc_custom_1590117319105{padding-top: 80px !important;padding-bottom: 80px !important;background-color: #ffffff !important;}"][vc_row content_placement="middle"][vc_column width="1/2" css=".vc_custom_1560697802293{margin-top: 60px !important;}"][pix_faq title_bold="font-weight-bold" title_size="h5" media_type="duo_icon" pix_duo_icon="question-circle" icon_has_color="true" icon_color="gradient-primary" animation="fade-in-up" content_animation="fade-in-up" title="Can I Pay with PayPal?" content_delay="400" css=".vc_custom_1590022548612{margin-top: 30px !important;margin-bottom: 30px !important;}" delay="200"]We provides you with a full management functionality that results in faster revenue, more users, and the ability to serve your users better engaging with them efficiently.[/pix_faq][pix_faq title_bold="font-weight-bold" title_size="h5" media_type="duo_icon" pix_duo_icon="question-circle" icon_has_color="true" icon_color="gradient-primary" animation="fade-in-up" content_animation="fade-in-up" title="How about Refund policy?" content_delay="800" css=".vc_custom_1590022543904{margin-top: 30px !important;margin-bottom: 30px !important;}" delay="600"]We provides you with a full management functionality that results in faster revenue, more users, and the ability to serve your users better engaging with them efficiently.[/pix_faq][pix_faq title_bold="font-weight-bold" title_size="h5" media_type="duo_icon" pix_duo_icon="question-circle" icon_has_color="true" icon_color="gradient-primary" animation="fade-in-up" content_animation="fade-in-up" title="Is There a Free Trial?" content_delay="1200" css=".vc_custom_1590022537408{margin-top: 30px !important;margin-bottom: 30px !important;}" delay="1000"]We provides you with a full management functionality that results in faster revenue, more users, and the ability to serve your users better engaging with them efficiently.[/pix_faq][/vc_column][vc_column width="1/2" css=".vc_custom_1590021058439{border-top-width: 2px !important;border-right-width: 2px !important;border-bottom-width: 2px !important;border-left-width: 2px !important;padding-top: 80px !important;padding-right: 30px !important;padding-bottom: 80px !important;padding-left: 30px !important;border-left-color: #e9ecef !important;border-left-style: solid !important;border-right-color: #e9ecef !important;border-right-style: solid !important;border-top-color: #e9ecef !important;border-top-style: solid !important;border-bottom-color: #e9ecef !important;border-bottom-style: solid !important;border-radius: 10px !important;margin-left: 20px !important;margin-right: 20px !important;}"][pix_feature media_type="duo_icon" title_size="h4" title_color="gradient-primary" title_bold="font-weight-bold" content_size="text-18" content_color="body-default" pix_duo_icon="group-chat" icon_color="gradient-primary" icon_size="48" padding_content="10px" content_align="center" animation="fade-in-up" title="Ask Us a Question" delay="800" css=".vc_custom_1590024481618{padding-top: 40px !important;padding-bottom: 10px !important;}"]This is just a simple text made for this unique and awesome template, you can replace it with any text.[/pix_feature][pix_button btn_text="Purchase a License" btn_target="true" btn_color="white" btn_text_color="heading-default" btn_size="md" btn_rounded="btn-rounded" btn_effect="" btn_hover_effect="" btn_add_hover_effect="" btn_icon_animation="yes" btn_div="text-center" btn_animation="fade-in-up" btn_link="https://pixfort.website/redirect?to=essentials" btn_icon="pixicon-bag-2" btn_anim_delay="800"][/vc_column][/vc_row][/vc_section]
CONTENT;

    array_push($templates, $data);

    $data = array(); // Create new array
    $data['name'] = __( 'FAQ right SaaS', 'pixfort-core' ); // Assign name for your custom template
    $data['weight'] = 0; // Weight of your template in the template list
    $data['type'] = 'default_templates'; // Weight of your template in the template list
    $data['category'] = 'default_templates'; // Weight of your template in the template list
    $data['image_path'] = 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/faq/saas-faq-right.png'; // Always use preg replace to be sure that "space" will not break logic. Thumbnail should have this dimensions: 114x154px
    $data['custom_class'] = 'custom_template_for_vc_custom_template all faq'; // CSS class name
    $data['content']  = <<<CONTENT
[vc_section full_width="stretch_row" css=".vc_custom_1590117319105{padding-top: 80px !important;padding-bottom: 80px !important;background-color: #ffffff !important;}"][vc_row content_placement="middle"][vc_column width="1/2" css=".vc_custom_1590021058439{border-top-width: 2px !important;border-right-width: 2px !important;border-bottom-width: 2px !important;border-left-width: 2px !important;padding-top: 80px !important;padding-right: 30px !important;padding-bottom: 80px !important;padding-left: 30px !important;border-left-color: #e9ecef !important;border-left-style: solid !important;border-right-color: #e9ecef !important;border-right-style: solid !important;border-top-color: #e9ecef !important;border-top-style: solid !important;border-bottom-color: #e9ecef !important;border-bottom-style: solid !important;border-radius: 10px !important;margin-left: 20px !important;margin-right: 20px !important;}"][pix_feature media_type="duo_icon" title_size="h4" title_color="gradient-primary" title_bold="font-weight-bold" content_size="text-18" content_color="body-default" pix_duo_icon="group-chat" icon_color="gradient-primary" icon_size="48" padding_content="10px" content_align="center" animation="fade-in-up" title="Ask Us a Question" delay="800" css=".vc_custom_1590024481618{padding-top: 40px !important;padding-bottom: 10px !important;}"]This is just a simple text made for this unique and awesome template, you can replace it with any text.[/pix_feature][pix_button btn_text="Purchase a License" btn_target="true" btn_color="white" btn_text_color="heading-default" btn_size="md" btn_rounded="btn-rounded" btn_effect="" btn_hover_effect="" btn_add_hover_effect="" btn_icon_animation="yes" btn_div="text-center" btn_animation="fade-in-up" btn_link="https://pixfort.website/redirect?to=essentials" btn_icon="pixicon-bag-2" btn_anim_delay="800"][/vc_column][vc_column width="1/2" css=".vc_custom_1560697802293{margin-top: 60px !important;}"][pix_faq title_bold="font-weight-bold" title_size="h5" media_type="duo_icon" pix_duo_icon="question-circle" icon_has_color="true" icon_color="gradient-primary" animation="fade-in-up" content_animation="fade-in-up" title="Can I Pay with PayPal?" content_delay="400" css=".vc_custom_1590022548612{margin-top: 30px !important;margin-bottom: 30px !important;}" delay="200"]We provides you with a full management functionality that results in faster revenue, more users, and the ability to serve your users better engaging with them efficiently.[/pix_faq][pix_faq title_bold="font-weight-bold" title_size="h5" media_type="duo_icon" pix_duo_icon="question-circle" icon_has_color="true" icon_color="gradient-primary" animation="fade-in-up" content_animation="fade-in-up" title="How about Refund policy?" content_delay="800" css=".vc_custom_1590022543904{margin-top: 30px !important;margin-bottom: 30px !important;}" delay="600"]We provides you with a full management functionality that results in faster revenue, more users, and the ability to serve your users better engaging with them efficiently.[/pix_faq][pix_faq title_bold="font-weight-bold" title_size="h5" media_type="duo_icon" pix_duo_icon="question-circle" icon_has_color="true" icon_color="gradient-primary" animation="fade-in-up" content_animation="fade-in-up" title="Is There a Free Trial?" content_delay="1200" css=".vc_custom_1590022537408{margin-top: 30px !important;margin-bottom: 30px !important;}" delay="1000"]We provides you with a full management functionality that results in faster revenue, more users, and the ability to serve your users better engaging with them efficiently.[/pix_faq][/vc_column][/vc_row][/vc_section]
CONTENT;

    array_push($templates, $data);

    // corporate

    $data = array();
    $data['name'] = __( 'FAQ right SaaS', 'pixfort-core' );
    $data['weight'] = 0;
    $data['type'] = 'default_templates';
    $data['category'] = 'default_templates';
    $data['image_path'] = 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/faq/corporate-faq.png';
    $data['custom_class'] = 'custom_template_for_vc_custom_template all faq';
    $data['content']  = <<<CONTENT
[vc_section full_width="stretch_row" pix_over_visibility="" css=".vc_custom_1592707768527{padding-top: 120px !important;padding-bottom: 120px !important;background-color: #ffffff !important;}"][vc_row content_placement="middle" css=".vc_custom_1592230566326{padding-bottom: 40px !important;}"][vc_column offset="vc_col-md-offset-1 vc_col-md-10"][vc_row_inner][vc_column_inner width="1/2"][pix_faq title_bold="font-weight-bold" title_size="h5" media_type="duo_icon" pix_duo_icon="question-circle" icon_has_color="true" icon_color="primary" animation="fade-in-up" content_animation="fade-in-up" title="How about Refund policy?" content_delay="800" css=".vc_custom_1592230617306{margin-top: 30px !important;margin-bottom: 30px !important;}" delay="600"]We provides you with a full management functionality that results in faster revenue, more users, and the ability to serve your users better engaging with them efficiently.[/pix_faq][pix_faq title_bold="font-weight-bold" title_size="h5" media_type="duo_icon" pix_duo_icon="question-circle" icon_has_color="true" icon_color="primary" animation="fade-in-up" content_animation="fade-in-up" title="Is There a Free Trial?" content_delay="1200" css=".vc_custom_1592230626382{margin-top: 30px !important;margin-bottom: 30px !important;}" delay="1000"]We provides you with a full management functionality that results in faster revenue, more users, and the ability to serve your users better engaging with them efficiently.[/pix_faq][/vc_column_inner][vc_column_inner width="1/2"][pix_faq title_bold="font-weight-bold" title_size="h5" media_type="duo_icon" pix_duo_icon="question-circle" icon_has_color="true" icon_color="primary" animation="fade-in-up" content_animation="fade-in-up" title="Can I Pay with PayPal?" content_delay="400" css=".vc_custom_1592230631931{margin-top: 30px !important;margin-bottom: 30px !important;}" delay="200"]We provides you with a full management functionality that results in faster revenue, more users, and the ability to serve your users better engaging with them efficiently.[/pix_faq][pix_faq title_bold="font-weight-bold" title_size="h5" media_type="duo_icon" pix_duo_icon="question-circle" icon_has_color="true" icon_color="primary" animation="fade-in-up" content_animation="fade-in-up" title="Do I get free support?" content_delay="400" css=".vc_custom_1592230645430{margin-top: 30px !important;margin-bottom: 30px !important;}" delay="200"]We provides you with a full management functionality that results in faster revenue, more users, and the ability to serve your users better engaging with them efficiently.[/pix_faq][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row][vc_column offset="vc_col-md-offset-2 vc_col-md-8"][content_box style="3" hover_effect="" add_hover_effect="" animation="" css=".vc_custom_1592230553035{padding: 30px !important;background-color: #ffffff !important;}"][pix_feature media_type="duo_icon" title_size="h4" title_bold="font-weight-bold" content_size="text-18" content_color="body-default" pix_duo_icon="group-chat" icon_color="secondary" has_icon_bg="true" icon_bg_color="secondary-light" icon_size="48" padding_title="" padding_content="10px" icon_position="left" animation="fade-in-up" title="Ask Us a Question" delay="800" css=".vc_custom_1592230889005{padding-top: 20px !important;padding-bottom: 40px !important;}"]This is just a simple text made for Essentials unique and awesome WordPress theme, you can replace it with any text you want.[/pix_feature][pix_button btn_text="Purchase a License" btn_target="true" btn_color="white" btn_text_color="heading-default" btn_size="lg" btn_effect="" btn_hover_effect="" btn_add_hover_effect="" btn_icon_animation="yes" btn_full="true" btn_div="text-center" btn_animation="fade-in-up" btn_link="https://pixfort.website/redirect?to=essentials" btn_icon="pixicon-bag-2" btn_anim_delay="800" css=".vc_custom_1592230868342{background-color: rgba(10,10,10,0.03) !important;*background-color: rgb(10,10,10) !important;}"][/content_box][/vc_column][/vc_row][/vc_section]
CONTENT;

    array_push($templates, $data);

    // original

    $data = array();
    $data['name'] = __( 'FAQ Pricing simple page', 'pixfort-core' );
    $data['weight'] = 0;
    $data['type'] = 'default_templates';
    $data['category'] = 'default_templates';
    $data['image_path'] = 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/faq/original-pricing-simple-page-faq.png';
    $data['custom_class'] = 'custom_template_for_vc_custom_template all faq';
    $data['content']  = <<<CONTENT
[vc_section full_width="stretch_row" pix_over_visibility="" css=".vc_custom_1588890038834{padding-top: 80px !important;padding-bottom: 80px !important;background-color: #ffffff !important;}"][vc_row css=".vc_custom_1588890792027{padding-bottom: 40px !important;}"][vc_column][pix_badge bold="font-weight-bold" secondary_font="secondary-font" style="" hover_effect="" add_hover_effect="" animation="fade-in-up" element_div="text-center" padding="" text="Frequently Asked Questions" css=".vc_custom_1588890259384{padding-top: 5px !important;padding-right: 9px !important;padding-bottom: 5px !important;padding-left: 9px !important;}"][pix_text size="text-18" content_color="body-default" position="text-center" animation="fade-in-up" delay="200" css=".vc_custom_1588890628936{padding-top: 20px !important;}"]We design and develop world-class websites and applications.[/pix_text][/vc_column][/vc_row][vc_row][vc_column width="1/2" css=".vc_custom_1580913185779{padding-top: 20px !important;padding-bottom: 20px !important;}"][pix_faq title_bold="font-weight-bold" title_size="h5" icon="" animation="fade-in-up" content_animation="fade-in-up" title="Can I build one page website?" content_delay="200" css=".vc_custom_1588890466281{padding-top: 10px !important;padding-bottom: 10px !important;}"]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim.[/pix_faq][pix_faq title_bold="font-weight-bold" title_size="h5" icon="" animation="fade-in-up" content_animation="fade-in-up" title="Is there a limit for usage?" content_delay="200" css=".vc_custom_1588890472674{padding-top: 10px !important;}"]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim.[/pix_faq][/vc_column][vc_column width="1/2" css=".vc_custom_1581372181781{padding-top: 20px !important;padding-bottom: 20px !important;}"][pix_faq title_bold="font-weight-bold" title_size="h5" icon="" animation="fade-in-up" content_animation="fade-in-up" title="Do I get free support?" content_delay="200" css=".vc_custom_1588890445622{padding-top: 10px !important;padding-bottom: 10px !important;}"]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim.[/pix_faq][pix_faq title_bold="font-weight-bold" title_size="h5" icon="" animation="fade-in-up" content_animation="fade-in-up" title="Do I get future updates?" content_delay="200" css=".vc_custom_1588890459382{padding-top: 10px !important;}"]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim.[/pix_faq][/vc_column][/vc_row][vc_row css=".vc_custom_1588890898137{padding-top: 20px !important;}"][vc_column][pix_text size="text-18" content_color="body-default" position="text-center" animation="fade-in-up" delay="200" css=".vc_custom_1588890939127{padding-top: 20px !important;}"]Didn't find the right response? view more from here[/pix_text][pix_button btn_text="Learn more about pricing" btn_color="gray-1" btn_text_color="body-default" btn_size="sm" btn_effect="" btn_hover_effect="" btn_add_hover_effect="" btn_icon_position="after" btn_icon_animation="yes" btn_div="text-center" btn_animation="fade-in-up" btn_link="https://essentials.pixfort.com/original/faq/" btn_icon="pixicon-angle-right"][/vc_column][/vc_row][/vc_section]            
CONTENT;

    array_push($templates, $data);


    return $templates;
}




 ?>