<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="container">
            <div class="logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php if ( has_custom_logo() ) {
                        the_custom_logo();
                    } else { ?>
                        <h1><?php bloginfo( 'name' ); ?></h1>
                    <?php } ?>
                </a>
            </div>
            <nav class="main-navigation">
                <?php wp_nav_menu( array(
                    'theme_location' => 'header-menu',
                    'container' => 'ul',
                    'menu_class' => 'nav-menu',
                ) ); ?>
            </nav>
        </div>
    </header>
