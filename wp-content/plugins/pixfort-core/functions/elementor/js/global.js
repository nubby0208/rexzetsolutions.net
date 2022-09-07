jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        pixLoadImgs();
        pix_animation($element);
        if(typeof window.pix_init_gradient_fix === "function"){
            window.pix_init_gradient_fix();
        }
    };
    elementorFrontend.hooks.addAction(
        'frontend/element_ready/widget',
        function ($scope) {
            pix_animation($scope, true);
        }
    );
    elementorFrontend.hooks.addAction(
        'frontend/element_ready/widget',
        addHandler
    );
    
});