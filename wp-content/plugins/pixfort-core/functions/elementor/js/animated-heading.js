jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        piximations.init();
    };

    elementorFrontend.hooks.addAction(
        'frontend/element_ready/pix-animated-heading.default',
        addHandler
    );
});
