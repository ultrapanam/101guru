<?php 

$usefull_links = get_field('usefull_links', 'option') != null ? get_field('usefull_links', 'option') : false;
$image = get_field('404_image', 'option') != null ? get_field('404_image', 'option') : false;

?>

<?php get_header(); ?>

<div id="main">
    <div class="section error-404">
        <div class="block-container grey-bg">
            <div class="not-found-image">
                <?php echo generate_acf_image($image, true); ?>
            </div>
            <div class="heading-text">
                <h1><?php esc_html_e('Oops! That page can’t be found.', 'your-theme-text-domain'); ?></h1>
            </div>

            <div class="paragraph">
                <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search or explore some of the links below.', 'your-theme-text-domain'); ?></p>
            </div>

            <!-- Optional: Display some useful links -->
            <div class="useful-links">
                <h3><?php esc_html_e('Try those Casinos!', 'your-theme-text-domain'); ?></h3>
                <ul>
                    <?php foreach ($usefull_links as $links) { ?>
                        <?php foreach ($links as $link) { ?>
                            <li>
                                <?php echo generate_acf_link($link); ?>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>

            <!-- Optional: Display recent posts or categories -->
            <div class="recent-posts">
                <h3><?php esc_html_e('New Casinos on Casinologin.guru', 'your-theme-text-domain'); ?></h3>
                <ul>
                    <?php
                    $recent_reviews = new WP_Query(array(
                        'post_type' => 'review', // Custom post type slug
                        'posts_per_page' => 5,    // Adjust the number of reviews
                        'post_status' => 'publish',
                    ));
                    // Loop through the reviews
                    if ( $recent_reviews->have_posts() ) :
                        while ( $recent_reviews->have_posts() ) : $recent_reviews->the_post(); ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile;
                        wp_reset_postdata(); // Reset the post data after the query
                    else : ?>
                        <li><?php esc_html_e( 'No recent reviews available.', 'your-theme-text-domain' ); ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
