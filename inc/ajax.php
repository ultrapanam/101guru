<?php

function ajax_live_search() {
    // Check for search query
    $search_query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';

    if ( !empty( $search_query ) ) {
        $post_type = 'review'; // Set the custom post type

        // First, search by post title/content using the 's' parameter
        $args_title_search = array(
            'post_type'      => $post_type,
            'posts_per_page' => 5,
            's'              => $search_query, // Search in post title/content
        );
        
        // Next, search for posts by matching the tags
        $args_tag_search = array(
            'post_type'      => $post_type,
            'posts_per_page' => -1,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'name',
                    'terms'    => array($search_query), // Match tag name to the search query
                    'operator' => 'IN',
                ),
            ),
        );

        // Execute both queries separately
        $query_title = new WP_Query( $args_title_search );
        $query_tag = new WP_Query( $args_tag_search );

        // Combine the results into a single array of post IDs
        $post_ids = array(); // Store unique post IDs

        // Add posts found by title/content
        if ( $query_title->have_posts() ) {
            while ( $query_title->have_posts() ) {
                $query_title->the_post();
                $post_ids[] = get_the_ID(); // Collect the post ID
            }
        }

        // Add posts found by tags
        if ( $query_tag->have_posts() ) {
            while ( $query_tag->have_posts() ) {
                $query_tag->the_post();
                if ( !in_array( get_the_ID(), $post_ids ) ) {
                    $post_ids[] = get_the_ID(); // Add unique post ID
                }
            }
        }

        // If posts are found
        if ( !empty( $post_ids ) ) {
            // Perform a final query to get the combined list of posts
            $args_final = array(
                'post_type'      => $post_type,
                'posts_per_page' => -1,
                'post__in'       => $post_ids, // Only fetch these specific post IDs
                'orderby'        => 'post__in', // Maintain the original order
            );

            $final_query = new WP_Query( $args_final );

            // Output the search results
            if ( $final_query->have_posts() ) {
                echo '<ul class="search-results-dropdown">';
                while ( $final_query->have_posts() ) {
                    $final_query->the_post();
                    echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                }
                echo '</ul>';
            }
        } else {
            // No results found
            echo '<ul class="search-results-dropdown"><li style="color: white;">No results found</li></ul>';
        }
    }

    // Terminate AJAX request
    wp_die();
}

add_action( 'wp_ajax_nopriv_ajax_live_search', 'ajax_live_search' );
add_action( 'wp_ajax_ajax_live_search', 'ajax_live_search' );
