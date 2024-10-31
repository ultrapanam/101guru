<?php

$footer_images = get_field('footer_images', 'options') != null ? get_field('footer_images', 'options')  : false;

//print_r($footer_images);

?>
<footer class="site-footer">
        <div class="footer-container">
            <div class="footer-images">
                <?php foreach ($footer_images as $image ) { ?>
                <?php 
                    $image_link = $image['link'] != null ? $image['link']  : false;    
                ?>            
                    <?php if ($image_link != false) { ?>
                        <a href="<?php echo $image_link['url']; ?>">
                            <div class="single-image">
                                <?php echo generate_acf_image($image['image'] , true); ?>                        
                            </div>
                        </a>
                    <?php } else { ?>
                        <div class="single-image">
                            <?php echo generate_acf_image($image['image'] , true); ?>                        
                        </div>
                    <?php } ?>
                <?php } ?>         
            </div>
            <div class="footer-widgets">
                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                    <div class="widget-area">
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="footer-info">
                <nav class="footer-navigation">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'footer-menu',
                        'container'      => false,
                        'menu_class'     => 'footer-menu',
                        'fallback_cb'    => false,
                    ) ); ?>
                </nav>
            </div>
            <p class="copyright">&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
        </div>
    </footer>

    <?php wp_footer(); ?>

</body>
</html>
