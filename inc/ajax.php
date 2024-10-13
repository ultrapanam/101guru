<?php

function ajax_live_search() {
    // Check for search query
    $search_query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';

    if ( !empty( $search_query ) ) {
        // Run a basic WP_Query to search for posts/pages
        $args = array(
            'post_type'      => 'post', // You can specify post types
            'posts_per_page' => 5, // Limit number of results
            's'              => $search_query,
        );
        $query = new WP_Query( $args );

        if ( $query->have_posts() ) {
            echo '<ul class="search-results-dropdown">';
            while ( $query->have_posts() ) {
                $query->the_post();
                // Output search results as list items
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
        } else {
            // No results found
            echo '<ul class="search-results-dropdown"><li>No results found</li></ul>';
        }
    }

    // Terminate AJAX request
    wp_die();
}

add_action( 'wp_ajax_nopriv_ajax_live_search', 'ajax_live_search' );
add_action( 'wp_ajax_ajax_live_search', 'ajax_live_search' );
