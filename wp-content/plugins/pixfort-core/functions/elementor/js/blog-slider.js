function pixGlobalFunctionCaller($element){
    pix_main_slider();
}
jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        $element.find('.pix-main-slider').removeClass('pix-slider-loaded flickity-enabled is-draggable');
        pixGlobalFunctionCaller();
        pix_main_slider();
        init_tilts();
        pix_animation();
    };

    elementorFrontend.hooks.addAction(
        'frontend/element_ready/pix-blog-slider.default',
        addHandler
    );
});
