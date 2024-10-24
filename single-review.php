<?php get_header(); ?>

<?php

$page_id = get_the_ID();
$modules = get_field('module_content', $page_id);

$review_bonus_text = get_field('review_bonus_text'); // Example ACF field: review summary
$review_affilate_link = get_field('review_affilate_link');
$review_table = get_field('review_table') != null ? get_field('review_table') : false;
$review_table_bottom = get_field('review_table_bottom') != null ? get_field('review_table_bottom') : false;
$add_fancy_table = get_field('add_fancy_table') != null ? get_field('add_fancy_table') : false;
$rating = get_field('review_rating') != null ? get_field('review_rating') : false;

?>

<div id="main">
    <div class="section review-single">
        <div class="block-container">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="inner-container">
                    <div class="heading-text">
                        <h1><?php the_title(); ?></h1>
                    </div>
                        <div class="summary-row">
                            <div class="image-wrapper">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="image-container">
                                        <?php the_post_thumbnail( 'large' ); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="casino-details">
                                    <div class="buttons-container">
                                        <?php if( $review_affilate_link ): ?>
                                            <?php echo generate_acf_link($review_affilate_link, 'btn green-btn btn-left'); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="summary-wrapper">
                                <div class="summary">
                                    <?php if ( $review_table && $add_fancy_table ) { 
                                        // Count the number of items
                                        $item_count = count($review_table); 
                                        ?>
                                        <ul class="review-list">
                                            <?php foreach ( $review_table as $item ) { ?>
                                                <li class="summary-list-heading grey-bg">
                                                    <p class="summary-list-heading"><?php echo $item['name']; ?></p>
                                                    <p class="summary-list-body"><?php echo $item['value']; ?></p>
                                                </li>
                                            <?php } ?>
                                            
                                            <?php if( $review_bonus_text ): ?>
                                                <li class="summary-list-heading blue-bg last-child" style="padding: 0 !important; padding-left: 25px !important;"
                                                    data-count="<?php echo $item_count; ?>">
                                                    <p><?php echo esc_html( $review_bonus_text ); ?></p>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    <?php }  else { ?>
                                        <?php if( $review_bonus_text ): ?>
                                            <div class="summary-bonus-text blue-bg" style="padding: 0 !important; padding-left: 25px !important;">
                                                <p><?php echo esc_html( $review_bonus_text ); ?></p>
                                        </div>
                                        <?php endif; ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="review-content">
                            <div class="paragraph">                            
                                <?php the_content(); ?>
                            </div>
                        </div>
                    
                    <div class="review-table-wrapper">
                        <?php if ( $review_table_bottom ) { ?>
                            <table class="review-table">
                                <tbody>
                                    <?php foreach ( $review_table_bottom as $item ) { ?>
                                        <tr>
                                            <td><?php echo $item['name']; ?></td>
                                            <td><?php echo $item['value']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
                </div>
            <?php endwhile; else : ?>
                <p><?php esc_html_e( 'Sorry, no reviews found.', '101guru' ); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php 
    /**
     * generate_modules( array $modules ) lives in "inc/theme_functions.php"
     * 
     */

    if (function_exists('generate_modules')) {
        generate_modules($modules);
    }

    ?>
</div>
<?php get_footer(); ?>
