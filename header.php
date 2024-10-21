<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php wp_head(); ?>

    <?php
        $logo = get_field( 'site_logo', 'option' );
    ?>
</head>
<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="header-container">
            <div class="logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php if ( $logo ) { 
                    echo generate_acf_image($logo, true);
                } else { ?>
                <p><?php bloginfo( 'name' ); ?></p>
                <?php } ?>
            </a>
            </div>
            <nav class="main-navigation">
                <?php wp_nav_menu( array(
                    'theme_location' => 'header-menu',
                    'container'      => false,
                    'menu_class'     => 'nav-menu',
                    'fallback_cb'    => false,
                ) ); ?>

            <!-- Add the search form here -->
            <div class="header-search">
                <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Search..." autocomplete="off">
                    <button type="submit" id="searchsubmit">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/search.svg" alt="Search Icon" class="search-icon">
                    </button>
                </form>
                <div id="ajax-search-results"></div> <!-- Ensure this element exists -->

                <!-- Add the spinner -->
                <div id="loading-spinner" style="display: none;">
                    <div class="spinner"></div>
                </div>
            </div>
            <div class="burger-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            </nav>
        </div>
    </header>

<script>

</script>