<?php

/**
 * Adding Menu Support to the custom theme
 */
if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(
        array(
        'header-menu' => __( 'Header Menu' ),
        'footer-menu' => __( 'Footer Menu' ),
        )
    );
}

/**
 * Adding logo support
 */
function themename_custom_logo_setup() {
    $defaults = array(
        'height'               => 100,
        'width'                => 400,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => true,
    );

    add_theme_support( 'custom-logo', $defaults );
}
themename_custom_logo_setup();

/**
 * Adding Featured Image support
*/
function featured_images_on_posts() {
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'featured_images_on_posts');

/**
 * Adding menu support
 */
function register_my_menu() {
    register_nav_menu('secondary-menu',__( 'Secondary Menu' ));
}
add_action( 'init', 'register_my_menu' );

/**
 * generate_modules( array $modules )
 *
 * Used to generate a set of modules set in the WP Admin.
 * Uses ACF flexible content field. Goes through each entry of a $modules array
 * and includes the structure of the modules from "/components/modules/"
 *
 * @param array $modules
 *
 * @return Includes all modules that were added from ACF
 */

function generate_modules($modules)
{
    /**
     * Checking if the $modules argument is set and not empty
     */
    if (isset($modules) && !empty($modules)) {
        /**
         * Goes through each module in the set
         */
        foreach ($modules as $module) {
            /**
             * Checks if it has assigned layout
             */
            if (isset($module['acf_fc_layout'])) {
                /**
                 * Preseting filename and file path
                 */
                $file_name = "module_" . str_replace('_', '-', $module['acf_fc_layout']) . ".php";
                $file_path = get_template_directory() . "/components/modules/" . $file_name;

                /**
                 * Checking if the file exists in the corresponding directory
                 */
                if (file_exists($file_path)) {
                    /**
                     * Includes the file on the frontend
                     */
                    include($file_path);
                }
            }
        }
    }
}


