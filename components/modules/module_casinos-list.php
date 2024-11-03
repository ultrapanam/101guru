<?php

/**
 * Module -- Casinos List
 */

if (isset($module)) {

$heading = (isset($module['heading'])) ? $module['heading'] : false;
$posts_per_page = (isset($module['posts_per_page'])) ? $module['posts_per_page'] : false;
$order_by = (isset($module['order_by'])) ? $module['order_by'] : false;
$order = (isset($module['order'])) ? $module['order'] : false;

?>

<div id="casinos-list" class="section casinos-list">
    <?php if ( $heading ) { ?>
        <h2 class="casinos-list-heading">
            <?php echo $heading; ?>
        </h2>
    <?php } ?>
    <div class="block-container">
        <?php
        // Custom query to fetch all posts from the custom post type 'review'
        $args = array(
            'post_type' => 'review', // The custom post type slug
            'posts_per_page' => $posts_per_page,  // Fetch all posts
            'post_status' => 'publish', // Only show published posts
            'orderby' => $order_by,    // Order by latest date
            'order' => $order,       // Show the latest reviews first
            'meta_query'     => array(
                    'relation' => 'OR',  // Use OR to check if the field doesn't exist or is 0
                    array(
                        'key'     => 'hide_review',  // The ACF true/false field name
                        'value'   => '0',            // Only show posts where the field is false (unchecked)
                        'compare' => '=',            // Must be equal to 0
                        'type'    => 'NUMERIC'       // Ensure it's treated as a numeric value
                    ),
                    array(
                        'key'     => 'hide_review',  // The ACF true/false field name
                        'compare' => 'NOT EXISTS'    // Include posts where the field doesn't exist
                    )
                ),
            );

        $review_query = new WP_Query( $args ); // Execute the query

        if ( $review_query->have_posts() ) : ?>
            <div class="review-posts-wrapper">
                <?php while ( $review_query->have_posts() ) : $review_query->the_post(); ?>
                <?php
                    $review_bonus_text = get_field('review_bonus_text'); // Example ACF field: review summary
                    $review_affilate_link = get_field('review_affilate_link'); // Example ACF field: pros and cons
                    $rating = get_field('review_rating') != null ? get_field('review_rating') : false;
                    
                    $bullets = get_field('bullets');
                ?>
                    <div class="review-post-item">
                        <!-- Display the Featured Image -->
                        <?php if ( has_post_thumbnail() ): ?>
                            <div class="review-featured-image">
                                <?php if ($review_affilate_link) { ?>
                                    <a href="<?php echo $review_affilate_link['url']; ?>">
                                        <?php the_post_thumbnail( 'large' ); ?>
                                    </a>
                                <?php } else { ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'large' ); ?>
                                    </a>
                                <?php } ?>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="first-block">
                                <?php if ( has_post_thumbnail() ): ?>
                                    <div class="mobile-review-featured-image">
                                        <?php if ($review_affilate_link) { ?>
                                            <a href="<?php echo $review_affilate_link['url']; ?>">
                                                <?php the_post_thumbnail( 'small' ); ?>
                                            </a>
                                        <?php } else { ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail( 'small' ); ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                <?php endif; ?>
                                <div class="title-wrapper">
                                    <div class="review-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </div>

                                    <?php if( $rating ): ?>
                                            <?php 
                                                if ( $rating ) {
                                                    $average_stars = round( $rating * 2 ) / 2;
                                                
                                                    $drawn = 5;
                                            
                                                    echo '<div class="star-rating">';
                                                    
                                                    // full chillies.
                                                    for ( $i = 0; $i < floor( $average_stars ); $i++ ) {
                                                        $drawn--;
                                                        echo '<img src="/wp-content/themes/101guru/assets/icons/star.svg">';
                                                    }
                                            
                                                    // half chillies.
                                                    if ( $rating - floor( $average_stars ) === 0.5 ) {
                                                        $drawn--;
                                                        echo '<img src="/wp-content/themes/101guru/assets/icons/half-star.svg">';
                                                    }
                                            
                                                    // empty chillies.
                                                    for ( $i = 0; $i < $drawn; $i++ ) {
                                                        echo '<img src="/wp-content/themes/101guru/assets/icons/empty-star.svg">';
                                                    }
                                            
                                                    echo '</div>';
                                                }
                                            ?>
                                    <?php endif; ?>
                                </div> 
                                <div class="bullets-wrapper">
                                    <?php if ($bullets) {?>
                                    <ul class="custon-list">
                                        <?php foreach ( $bullets as $single_bullet) { ?>
                                            <li>
                                                <?php echo $single_bullet['item']; ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="second-block">                                
                                <?php if( $review_bonus_text ): ?>
                                    <div class="review-summary">
                                        <p><?php echo esc_html( $review_bonus_text ); ?></p>
                                    </div>
                                <?php endif; ?>

                                <div class="buttons-container">
                                    <a href="<?php the_permalink(); ?>" class="btn trans-btn"><?php echo __('Read Review', '101guru' ); ?></a>
                                    <?php if( $review_affilate_link ): ?>
                                        <?php echo generate_acf_link($review_affilate_link, 'btn green-btn btn-left'); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php
        else :
            echo '<p>No reviews found.</p>'; // Message if no posts are found
        endif;

        // Reset post data to avoid conflicts with other queries
        wp_reset_postdata();
        ?>
    </div>
</div>

<?php }