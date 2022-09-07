<?php

function pixfort_demo_forms(){
    $data = array();

    $import_url = 'https://import.pixfort.com/essentials/';

    $demo = array(
        'import_file_name'             => 'Simple Subscription Form',
        'categories'                   => array( 'Contact Form 7' ),
        'import_file_url'            => $import_url.'demo-content/contact-forms/simple-subscription-form.xml',
        'import_preview_image_url'     => 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/one_click/forms/simple-subscription-form.webp',
        'import_notice'                => esc_html__( 'Contact Form 7 plugin should be installed and activated in order to import & use the forms.', 'essentials' ),
    );
    array_push($data, $demo);

    $demo = array(
        'import_file_name'             => 'Horizontal Subscription Form',
        'categories'                   => array( 'Contact Form 7' ),
        'import_file_url'            => $import_url.'demo-content/contact-forms/horizontal-subscription-form.xml',
        'import_preview_image_url'     => 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/one_click/forms/horizontal-subscription-form.jpg',
        'import_notice'                => esc_html__( 'Contact Form 7 plugin should be installed and activated in order to import & use the forms.', 'essentials' ),
    );
    array_push($data, $demo);

    $demo = array(
        'import_file_name'             => 'Contact Form',
        'categories'                   => array( 'Contact Form 7' ),
        'import_file_url'            => $import_url.'demo-content/contact-forms/contact-form.xml',
        'import_preview_image_url'     => 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/one_click/forms/contact-form.jpg',
        'import_notice'                => esc_html__( 'Contact Form 7 plugin should be installed and activated in order to import & use the forms.', 'essentials' ),

    );
    array_push($data, $demo);

    $demo = array(
        'import_file_name'             => 'Advanced Contact Form',
        'categories'                   => array( 'Contact Form 7' ),
        'import_file_url'            => $import_url.'demo-content/contact-forms/advanced-contact-form.xml',
        'import_preview_image_url'     => 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/one_click/forms/advanced-contact-form.jpg',
        'import_notice'                => esc_html__( 'Contact Form 7 plugin should be installed and activated in order to import & use the forms.', 'essentials' ),

    );
    array_push($data, $demo);

    $demo = array(
        'import_file_name'             => 'Vertical Subscription Form',
        'categories'                   => array( 'Contact Form 7' ),
        'import_file_url'            => $import_url.'demo-content/contact-forms/vertical-subscription-form.xml',
        'import_preview_image_url'     => 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/one_click/forms/vertical-subscription-form.jpg',
        'import_notice'                => esc_html__( 'Contact Form 7 plugin should be installed and activated in order to import & use the forms.', 'essentials' ),

    );
    array_push($data, $demo);



    return $data;
}
     ?>
