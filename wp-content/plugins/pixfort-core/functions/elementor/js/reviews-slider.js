function pixGlobalFunctionCaller($element){
    pix_main_slider();
}
jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        updateReviewsSldier($element);
    };
    function updateReviewsSldier($element) {
        pixGlobalFunctionCaller();
        if (typeof window.Flickity !== 'undefined') {
            $element.find('.pix-main-slider').removeClass('pix-slider-loaded flickity-enabled is-draggable');
            setTimeout(function () {
                pixGlobalFunctionCaller();
                window.testing = function(n){
                    pix_cb_fn(function(){
                        pix_main_slider();
                    });
                }
                init_tilts();
            }, 2500);
        } else {
            setTimeout(function () {
                console.log('retrying slider reviews update...');
                updateReviewsSldier($element);
            }, 1000);
        }
    }
    elementorFrontend.hooks.addAction(
        'frontend/element_ready/pix-reviews-slider.default',
        addHandler
    );
});
