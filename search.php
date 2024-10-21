<?php get_header(); ?>

<div id="main">
    <div class="section search-results">
        <div class="block-container grey-bg">
            <div class="heading-text">
                <h2>
                    <?php printf( esc_html__( 'Search Results for: %s', '101guru' ), '<span>' . get_search_query() . '</span>' ); ?>
                </h2>
            </div>
            
            <?php if ( have_posts() ) : ?>
                <div class="search-results-list">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="search-result-item">
                            <div class="subheading">
                                <h4>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h4>
                            </div>
                            <div class="paragraph">
                                <?php the_excerpt(); ?>
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
