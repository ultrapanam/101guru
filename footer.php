<footer class="site-footer">
        <div class="container">
            <div class="footer-widgets">
                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                    <div class="widget-area">
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="footer-info">
                <p>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
                <nav class="footer-navigation">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'container' => 'ul',
                        'menu_class' => 'footer-menu',
                    ) ); ?>
                </nav>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
