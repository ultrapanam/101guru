<?php

/**
 * ACF Image Helper
 * Generates an <img> tag with given ACF array for field type "link"
 *
 * @param array $img - ACF's image array
 *
 * @param array/string $classes, defaults to false - All additional classes that need
 * to be printed in the class attribute
 *
 * @param bool $responsive - Choose whether you want the image to be responsive.
 * Setting it to true, prints srcset & sizes attributes which tells the browser
 * which image size to load depending on the screen size
 *
 * @return string - Preset <img> tag with all passed attributes
 *
 * @author OrbisAgency
 */

 function generate_acf_image($img, $classes = false, $responsive = true, $id = false) {
    if (isset($img) && is_array($img)) {
        /**
         * Setting up responsive attributes
         */
        $src_set = "";
        $sizes = "";

        if ($responsive && isset($img['sizes'])) {
            $img_sizes = $img['sizes'];
            $src_set = array(
                '1366'  => $img['url'] . " 1366w",
                '991'   => $img_sizes['large'] . " 991w",
                '768'   => $img_sizes['medium'] . " 768w",
                '425'   => $img_sizes['thumbnail'] . " 425w",
            );

            $src_set = "srcset='" . implode(', ', $src_set) . "'";

            $sizes = array(
                '1366'  => "(min-width: 991px) 1366px",
                '991'   => "(min-width: 768px) and (max-width: 991px) 991px",
                '768'   => "(min-width: 425px) and (max-width: 768px) 768px",
                '425'   => "(max-width: 425px) 425px",
            );

            $sizes = "sizes='" . implode(', ', $sizes) . "'";
        }

        /**
         * Setting up ID attribute
         */
        if ($id && !is_array($id)) {
            $id = "id='" . $id . "'";
        } else {
            $id = "";
        }


        /**
         * Setting up Classes attribute
         */
        if ($classes && is_array($classes)) {
            $classes = implode(" ", $classes);
        } else {
            $classes = "";
        }

        return "<img src='" . esc_url($img['url']) . "' " . $src_set . " " . $sizes . " class='" . $classes . "' alt='" . $img['alt'] . "' " . $id . ">";
    }
}

function wpb_image_editor_default_to_gd( $editors ) {
    $gd_editor = 'WP_Image_Editor_GD';
    $editors = array_diff( $editors, array( $gd_editor ) );
    array_unshift( $editors, $gd_editor );
    return $editors;
}
add_filter( 'wp_image_editors', 'wpb_image_editor_default_to_gd' );

/**
 * ACF Link Helper
 * Generates a link with given ACF array for field type "link"
 *
 * @param array $link - ACF's link array containing entries for
 * url, title and target
 *
 * @param array $additional_classes, defaults to false - All additional classes that need
 * to be printed in the class attribute
 *
 * @param string $id, defaults to false - The id of the link
 *
 * @param array $additional_attr, defaults to false - All the additional attributes
 * that need to be assigned to the link
 *
 * @return string - Preset link tag with all passed attributes
 * @author OrbisAgency
 */
function generate_acf_link($link, $additional_classes = false, $id = false, $additional_attr = false) {
    /**
     * Forming the Classes string variable
     */
    $classes = (isset($additional_classes)) ? $additional_classes : "";

    if (!empty($classes) && is_array($classes)) {
        $classes = implode(" ", $classes);
    }

    /**
     * Forming the Id string
     */
    if ($id && !is_array($id)) {
        $id = "id='" . $id . "'";
    } else {
        $id = "";
    }

    /**
     * Checking for additional attributes & if there are,
     * setting up a string to print them
     */

    $attributes = "";

    if ($additional_attr && is_array($additional_attr)) {
        foreach ($additional_attr as $key => $value) {
            $attributes .= " " . $key . "='" . $value . "'";
        }
    }

    /**
     * Checking if the target of the link is _blank
     * If it is, we need to set a rel="noreferer, noopener"
     */
    if (isset($link['target']) && $link['target'] == "_blank") {
        $rel = "rel='noopener noreferrer' target='_blank'";
    } else {
        $rel = "";
    }

    /**
     * Checking if we have values in the passed $link array
     *
     * Returning the whole <a> tag
     */
    if (isset($link) && !empty($link)) {
        return "<a href='" . $link['url'] . "' class='" . $classes . "' " . $rel . " " . $id . $attributes . ">" . $link['title'] . "</a>";
    }
}

/**
 * Adding ACF Options pages
 *
 * If more pages needed to separate the dynamic content,
 * please, add another entry below
 */
if(function_exists('acf_add_options_page'))
{

    acf_add_options_page(
        array(
            'page_title' 	=> 'Theme Settings',
            'menu_title'	=> 'Theme Settings',
            'menu_slug' 	=> 'theme-general-settings',
            'capability'	=> 'edit_posts',
            'redirect'		=> false
        )
    );

    acf_add_options_sub_page(
        array(
            'page_title' 	=> 'Theme Header',
            'menu_title'	=> 'Header Settings',
            'parent_slug'	=> 'theme-general-settings',
        )
    );

    acf_add_options_sub_page(
        array(
            'page_title' 	=> 'Theme Footer',
            'menu_title'	=> 'Footer Settings',
            'parent_slug'	=> 'theme-general-settings',
        )
    );

    acf_add_options_sub_page(
        array(
            'page_title' 	=> '404 Page',
            'menu_title'	=> '404 Settings',
            'parent_slug'	=> 'theme-general-settings',
        )
    );

}

//Populate choices with payment methods

// Populate ACF select field with payment method names from Theme Settings options page
function populate_choices_from_theme_settings( $field ) {
    // Reset the choices
    $field['choices'] = array();

    // Check if the repeater field exists on the Theme Settings options page
    if ( have_rows( 'payment_methods_repeater', 'option' ) ) {
        while ( have_rows( 'payment_methods_repeater', 'option' ) ) {
            the_row();
            
            // Get the payment method name (this will be shown in the Select field)
            $payment_method_name = get_sub_field( 'name' );

            // Add the payment method name to the Select field choices
            $field['choices'][ $payment_method_name ] = $payment_method_name;
        }
    }

    return $field;
}

add_filter( 'acf/load_field/name=payment_methods', 'populate_choices_from_theme_settings' );


// Populate ACF select field with payment method names from Theme Settings options page
function populate_choices_from_theme_settings_game_types( $field ) {
    // Reset the choices
    $field['choices'] = array();

    // Check if the repeater field exists on the Theme Settings options page
    if ( have_rows( 'game_types_repeater', 'option' ) ) {
        while ( have_rows( 'game_types_repeater', 'option' ) ) {
            the_row();
            
            // Get the payment method name (this will be shown in the Select field)
            $game_type_name = get_sub_field( 'name' );

            // Add the payment method name to the Select field choices
            $field['choices'][ $game_type_name ] = $game_type_name;
        }
    }

    return $field;
}

add_filter( 'acf/load_field/name=game_types', 'populate_choices_from_theme_settings_game_types' );