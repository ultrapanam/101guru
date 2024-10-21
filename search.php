<?php get_header(); ?>

<div id="main">
    <div class="section search-results">
        <div class="block-container ">
            <div class="heading-text">
                <h2>
                    <?php printf( esc_html__( 'Search Results for: %s', '101guru' ), '<span>' . get_search_query() . '</span>' ); ?>
                </h2>
            </div>
            
            <?php if ( have_posts() ) : ?>
                <div class="search-results-list">
                    <?php while ( have_posts() ) : the_post(); ?>
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
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <?php 
                    // Pagination function
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => __( '&laquo; Previous', '101guru' ),
                        'next_text' => __( 'Next &raquo;', '101guru' ),
                    ) ); 
                    ?>
                </div>

            <?php else : ?>
                <div class="no-results">
                    <h3><?php esc_html_e( 'No Results Found', '101guru' ); ?></h3>
                    <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', '101guru' ); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
