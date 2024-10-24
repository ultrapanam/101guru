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


function enable_tags_for_acf_cpt() {
    // Replace 'your_cpt' with the actual name of your custom post type.
    register_taxonomy_for_object_type( 'post_tag', 'review' );
}
add_action( 'init', 'enable_tags_for_acf_cpt' );


// Adding Tags in standard WP search

function custom_search_where($where) {
    global $wpdb;
    if (is_search() && !is_admin()) {
        // Safely escape the search query to prevent SQL injection
        $search_query = esc_sql(get_search_query());

        // Ensure the query includes titles, content, and tags
        $where .= " OR ({$wpdb->terms}.name LIKE '%" . $search_query . "%' AND {$wpdb->term_taxonomy}.taxonomy = 'post_tag')";
    }
    return $where;
}
  
function custom_search_join($join) {
    global $wpdb;
    if (is_search() && !is_admin()) {
        // Join necessary tables to include tags in the search
        $join .= " LEFT JOIN {$wpdb->term_relationships} ON ({$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id)";
        $join .= " LEFT JOIN {$wpdb->term_taxonomy} ON ({$wpdb->term_relationships}.term_taxonomy_id = {$wpdb->term_taxonomy}.term_taxonomy_id)";
        $join .= " LEFT JOIN {$wpdb->terms} ON ({$wpdb->term_taxonomy}.term_id = {$wpdb->terms}.term_id)";
    }
    return $join;
}
  
function custom_search_groupby($groupby) {
    global $wpdb;

    // Group by post ID to prevent duplicates when joining with tags
    $groupby_id = "{$wpdb->posts}.ID";
    if (!is_search() || strpos($groupby, $groupby_id) !== false) {
        return $groupby;
    }
  
    // Append or create the GROUP BY condition
    return strlen(trim($groupby)) ? "$groupby, $groupby_id" : $groupby_id;
}
  
add_filter('posts_where', 'custom_search_where');
add_filter('posts_join', 'custom_search_join');
add_filter('posts_groupby', 'custom_search_groupby');


// Custom rewrite rule for Reviews by Tag
function custom_reviews_by_tag_rewrite() {
    add_rewrite_rule(
        '^reviews-by-tag/([^/]*)/?',
        'index.php?pagename=reviews-by-tag&tag=$matches[1]',
        'top'
    );
}
add_action( 'init', 'custom_reviews_by_tag_rewrite' );

// Pass the 'tag' query variable to the page template
function custom_reviews_by_tag_query_vars( $vars ) {
    $vars[] = 'tag';
    return $vars;
}
add_filter( 'query_vars', 'custom_reviews_by_tag_query_vars' );


// Include the module_bottom-bar.php template

function add_bottom_bar_template() {
    get_template_part('/components/modules/module_bottom-bar');
}
add_action('wp_footer', 'add_bottom_bar_template');


// Define default tab blink message and set the ACF to edit it

function enqueue_blinking_title_script() {
    // Get the ACF field value (assuming it's in an options page, but adjust based on where your field is located)
    $blink_message = get_field('tab_blink_message', 'option'); // 'option' for global fields, adjust as necessary

    // Fallback in case the ACF field is empty
    if (!$blink_message) {
        $blink_message = "Don't forget us!";
    }

    // Output the blink message dynamically in a script tag
    ?>
    <script type="text/javascript">
        const acfBlinkMessage = "<?php echo esc_js($blink_message); ?>";
    </script>
    <?php
}
add_action('wp_footer', 'enqueue_blinking_title_script');

