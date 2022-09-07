<?php

function pixfort_demo_misc(){
    $data = array();

    $demo = array(
        'import_file_name'             => 'Default Menu',
        'categories'                   => array( 'Miscellaneous' ),
        'import_file_url'            => 'https://import.pixfort.com/essentials/demo-content/default-menu.xml',
        'import_preview_image_url'     => 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/one_click/default-menu.jpg',
        'import_notice'                => esc_html__( 'Default Essentials menu example.', 'essentials' ),
    );
    array_push($data, $demo);

    $demo = array(
        'import_file_name'             => 'Default Portfolio items WPBakery',
        'categories'                   => array( 'Miscellaneous' ),
        'import_file_url'            => 'https://import.pixfort.com/essentials/demo-content/portfolio-12-items.xml',
        'import_preview_image_url'     => 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/one_click/portfolio-12-default-items.jpg',
        'import_notice'                => esc_html__( '12 default portfolio items will be imported with associated images, you can change portfolio layout from theme options.', 'essentials' ),
        'preview_url'                  => 'https://essentials.pixfort.com/original/portfolio/?portfolio_style=default&line_count=3&count=9',
    );
    array_push($data, $demo);

    $demo = array(
        'import_file_name'             => 'Default Portfolio items Elementor',
        'categories'                   => array( 'Miscellaneous' ),
        'import_file_url'            => 'https://import.pixfort.com/essentials/demo-content/portfolio-items-elementor.xml',
        'import_preview_image_url'     => 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/one_click/portfolio-4-default-items-elementor.jpg',
        'import_notice'                => esc_html__( '4 default portfolio items will be imported with associated images, you can change portfolio layout from theme options. <br /><strong>Note:</strong> Make sure that Elementor plugin is installed and activated before import!', 'essentials' ),
        'preview_url'                  => 'https://essentials.pixfort.com/original/portfolio/?portfolio_style=default&line_count=3&count=9',
    );
    array_push($data, $demo);

    $demo = array(
        'import_file_name'             => 'Default woocommerce Products',
        'categories'                   => array( 'Miscellaneous' ),
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo-content/products/ecommerce-products.xml',
        'import_preview_image_url'     => 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/one_click/shop-12-products.jpg',
        'import_notice'                => esc_html__( '12 default products will be imported with associated images. <br /> <strong>Please note that woocommerce should be installed and activated.</strong>', 'essentials' ),
        'preview_url'                  => 'https://essentials.pixfort.com/ecommerce',
    );
    array_push($data, $demo);

    $demo = array(
        'import_file_name'             => 'Default 5 Posts',
        'categories'                   => array( 'Miscellaneous' ),
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo-content/posts/blog-5-posts.xml',
        'import_preview_image_url'     => 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/one_click/blog-5-posts.jpg',
        'import_notice'                => esc_html__( '5 default posts will be imported with associated images.', 'essentials' ),
        'preview_url'                  => 'https://essentials.pixfort.com/saas/',
    );
    array_push($data, $demo);

    $demo = array(
        'import_file_name'             => 'Blog widgets',
        'categories'                   => array( 'Miscellaneous' ),
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demo-content/widgets/blog-widgets.wie',
        'import_preview_image_url'     => 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/one_click/blog-widgets.jpg',
        'import_notice'                => esc_html__( 'Default blog widgets will be imported.', 'essentials' ),
        'preview_url'                  => 'https://essentials.pixfort.com/software/?s=',
    );
    array_push($data, $demo);

    $demo = array(
        'import_file_name'             => 'Shop widgets',
        'categories'                   => array( 'Miscellaneous' ),
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demo-content/widgets/shop-widgets.wie',
        'import_preview_image_url'     => 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/one_click/shop-widgets.jpg',
        'import_notice'                => esc_html__( 'Default shop widgets will be imported.', 'essentials' ),
        'preview_url'                  => 'https://essentials.pixfort.com/original/shop/',
    );
    array_push($data, $demo);

    $demo = array(
        'import_file_name'             => 'Demo Menu',
        'categories'                   => array( 'Miscellaneous' ),
        'import_file_url'            => 'https://import.pixfort.com/essentials/demo-content/demo-menu.xml',
        'import_preview_image_url'     => 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/one_click/demo-menu.jpg',
        'preview_url'                  => 'https://essentials.pixfort.com/menu/',
    );
    array_push($data, $demo);

    $demo = array(
        'import_file_name'             => 'Demo Company Menu',
        'categories'                   => array( 'Miscellaneous' ),
        'import_file_url'            => 'https://import.pixfort.com/essentials/demo-content/menu/company-menu.xml',
        'import_preview_image_url'     => 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/one_click/company-menu.jpg',
        'preview_url'                  => 'https://essentials.pixfort.com/company/',
    );
    array_push($data, $demo);

    $demo = array(
        'import_file_name'             => 'Consulting Menu',
        'categories'                   => array( 'Miscellaneous' ),
        'import_file_url'            => 'https://import.pixfort.com/essentials/demo-content/consulting-menu.xml',
        'import_preview_image_url'     => 'https://pixfort-space.sfo2.cdn.digitaloceanspaces.com/wordpress/essentials/data/thumbnails/one_click/consulting-menu.webp',
        'import_notice'                => esc_html__( 'Consulting Essentials menu example.', 'essentials' ),
        'preview_url'                  => 'https://essentials.pixfort.com/consulting',
    );
    array_push($data, $demo);

    return $data;
}
     ?>
