<?php

add_action('admin_menu', 'pixfort_options_init', 99);
function pixfort_options_init(){
    add_submenu_page( 'pixfort-dashboard', 'New Options', 'New Options', 'manage_options', 'pixfort-options', 'pixfort_options_page', 3  );
}
function pixfort_options_page(){
        ?>
        <h1>Theme options</h1>
        <?php
        $redux_demo = get_option( "pix_options" );

        $bg_colors_no_custom = array(
            __("Transparent", 'pixfort-core')			=> "transparent",
            __("Primary", 'pixfort-core')				=> "primary",
            __("Primary Light", 'pixfort-core')			=> "primary-light",
            __("Primary Gradient", 'pixfort-core')		=> "gradient-primary",
            __("Primary Gradient Light", 'pixfort-core')		=> "gradient-primary-light",
            __("Secondary", 'pixfort-core')				=> "secondary",
            __("Secondary Light", 'pixfort-core')		=> "secondary-light",
            __("White", 'pixfort-core')					=> "white",
            __("Black", 'pixfort-core')					=> "black",
            __("Green", 'pixfort-core')					=> "green",
            __("Green Light", 'pixfort-core')			=> "green-light",
            __("Blue", 'pixfort-core')					=> "blue",
            __("Blue Light", 'pixfort-core')			=> "blue-light",
            __("Red", 'pixfort-core')					=> "red",
            __("Red Light", 'pixfort-core')				=> "red-light",
            __("Yellow", 'pixfort-core')				=> "yellow",
            __("Yellow Light", 'pixfort-core')			=> "yellow-light",
            __("Brown", 'pixfort-core')					=> "brown",
            __("Brown Light", 'pixfort-core')			=> "brown-light",
            __("Purple", 'pixfort-core')				=> "purple",
            __("Purple Light", 'pixfort-core')			=> "purple-light",
            __("Orange", 'pixfort-core')				=> "orange",
            __("Orange Light", 'pixfort-core')			=> "orange-light",
            __("Cyan", 'pixfort-core')					=> "cyan",
            __("Cyan Light", 'pixfort-core')			=> "cyan-light",
            __("Gray 1", 'pixfort-core')				=> "gray-1",
            __("Gray 2", 'pixfort-core')				=> "gray-2",
            __("Gray 3", 'pixfort-core')				=> "gray-3",
            __("Gray 4", 'pixfort-core')				=> "gray-4",
            __("Gray 5", 'pixfort-core')				=> "gray-5",
            __("Gray 6", 'pixfort-core')				=> "gray-6",
            __("Gray 7", 'pixfort-core')				=> "gray-7",
            __("Gray 8", 'pixfort-core')				=> "gray-8",
            __("Gray 9", 'pixfort-core')				=> "gray-9",
            __("Dark opacity 1", 'pixfort-core')		=> "dark-opacity-1",
            __("Dark opacity 2", 'pixfort-core')		=> "dark-opacity-2",
            __("Dark opacity 3", 'pixfort-core')		=> "dark-opacity-3",
            __("Dark opacity 4", 'pixfort-core')		=> "dark-opacity-4",
            __("Dark opacity 5", 'pixfort-core')		=> "dark-opacity-5",
            __("Dark opacity 6", 'pixfort-core')		=> "dark-opacity-6",
            __("Dark opacity 7", 'pixfort-core')		=> "dark-opacity-7",
            __("Dark opacity 8", 'pixfort-core')		=> "dark-opacity-8",
            __("Dark opacity 9", 'pixfort-core')		=> "dark-opacity-9",
            __("Light opacity 1", 'pixfort-core')		=> "light-opacity-1",
            __("Light opacity 2", 'pixfort-core')		=> "light-opacity-2",
            __("Light opacity 3", 'pixfort-core')		=> "light-opacity-3",
            __("Light opacity 4", 'pixfort-core')		=> "light-opacity-4",
            __("Light opacity 5", 'pixfort-core')		=> "light-opacity-5",
            __("Light opacity 6", 'pixfort-core')		=> "light-opacity-6",
            __("Light opacity 7", 'pixfort-core')		=> "light-opacity-7",
            __("Light opacity 8", 'pixfort-core')		=> "light-opacity-8",
            __("Light opacity 9", 'pixfort-core')		=> "light-opacity-9"
        );
    
        $bg_colors = $bg_colors_no_custom;
        $bg_colors['Custom'] = "custom";


        
        $test = new PixfortOptions();
        $test->initOptions();

        $test->addOption(
            'test1', 
            [
                'type' => 'text'
            ]
        );
        $test->addOption(
            'banner-id', 
            [
                'type' => 'text',
                'label' => 'Banner ID',
            ]
        );
        $test->addOption(
            'banner-btn-text', 
            [
                'type' => 'text',
                'label' => 'Banner text',
            ]
        );
        $test->addOption(
            'banner-bg', 
            [
                'type' => 'select',
                'label' => 'Banner Background color',
                'options' => array_flip($bg_colors)
            ]
        );
        $test->addOption(
            'pic-custom-css', 
            [
                'type' => 'code',
                'label' => 'Code test',
            ]
        );
        $test->fillData();
        $test->loadOptionsData();
        
        echo '<div id="qdxy6294b"></div>';
        echo '<input type="text" name="pixfort-options" id="pixfort-options" class="large-text" value="" >';

        var_dump($redux_demo);
        
}