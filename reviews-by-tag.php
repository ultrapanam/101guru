<?php
/**
 * Template Name: Reviews by Tag
 */

get_header(); ?>

<div id="main">
    <div class="section reviews-by-tag">
        <div class="block-container">
            <div class="heading-text">
                <h2>
                    <?php 
                    // Get the tags from the URL as a comma-separated string
                    $current_tags_string = get_query_var('tag'); // This gets 'poker,paypal' from the URL

                    // Convert the comma-separated string into an array of tags
                    $current_tags = explode(',', $current_tags_string);

                    // Display the tags
                    echo 'Reviews Tagged: ' . esc_html( implode(', ', array_map('ucfirst', $current_tags)) );
                    ?>
                </h2>
            </div>

            <?php
            // Check if the tags array exists and contains content
            if ( !empty($current_tags) ) {
                // Query to get posts from the 'review' custom post type with the current tags
                $args = array(
                    'post_type' => 'review',
                    'posts_per_page' => -1, // Adjust as needed
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'post_tag',
                            'field'    => 'name',
                            'terms'    => $current_tags, // Match multiple tags
                            'operator' => 'AND', // Ensure the reviews have all the specified tags
                        ),
                    ),
                );

                $reviews_query = new WP_Query( $args );

                if ( $reviews_query->have_posts() ) :
                    echo '<div class="reviews-list">';
                     while ( $reviews_query->have_posts() ) : $reviews_query->the_post(); ?>
                    <!-- Display ACF fields -->
                    <?php 
                        $review_bonus_text = get_field('review_bonus_text');
                        $review_affilate_link = get_field('review_affilate_link') != null ? get_field('review_affilate_link') : false;
                    ?>
                    <div class="review-item grey-bg">
                        <!-- Display the post thumbnail -->
                        <div class="casino-logo-wrapper">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="thumbnail">
                                    <?php if ($review_affilate_link) { ?>
                                    <a href="<?php echo $review_affilate_link['url']; ?>">
                                        <?php the_post_thumbnail('medium'); // Adjust the size as needed ?>
                                    </a>
                                    <?php } else { ?>
                                        <?php the_post_thumbnail('medium'); // Adjust the size as needed ?>
                                    <?php } ?>
                                </div>
                            <?php endif; ?>
                            <?php if ( $review_affilate_link ) : ?>
                                <div class="affiliate-casino-link">
                                    <?php echo generate_acf_link($review_affilate_link, 'btn green-btn btn-left'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                
                        <div class="content">
                            <div class="subheading">
                                <h2>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                            </div>
                
                            <div class="paragraph">
                                <?php the_excerpt(); ?>
                            </div>
                
                            <div class="additional-fields">
                                <?php if ( $review_bonus_text ) : ?>
                                    <div class="bonus-text blue-border">
                                        <strong>Bonus: </strong><?php echo esc_html($review_bonus_text); ?>
                                    </div>
                                <?php endif; ?>   
                                <div class="affiliate-casino-link">
                                    <a href="<?php the_permalink(); ?>" class="btn blue-btn btn-left">
                                        Reed review
                                    </a>
                                </div>      
                            </div>
                        </div>
                    </div>
                <?php endwhile; 
                    echo '</div>';

                    // Pagination if needed
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => __( '&laquo; Previous', 'your-theme-text-domain' ),
                        'next_text' => __( 'Next &raquo;', 'your-theme-text-domain' ),
                    ) );
                else : ?>
                    <div class="no-results">
                        <h3><?php esc_html_e( 'No Reviews Found', 'your-theme-text-domain' ); ?></h3>
                        <p><?php esc_html_e( 'Sorry, but no reviews matched these tags.', 'your-theme-text-domain' ); ?></p>
                    </div>
                <?php endif;
                wp_reset_postdata();
            } else { ?>
                <div class="no-results">
                    <h3><?php esc_html_e( 'Invalid Tags', 'your-theme-text-domain' ); ?></h3>
                    <p><?php esc_html_e( 'Sorry, but no valid tags were provided.', 'your-theme-text-domain' ); ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
