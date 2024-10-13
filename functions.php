<?php

/**
 * Adds all additional theme functionality
 */
require_once('inc/theme-settings.php');

/**
 * Adds ACF helpers
 */
require_once('inc/acf.php');

/**
 * Disable all comments
 */
require_once('inc/disable-comments.php');

/**
 * Optimization tweaks
 */
require_once('inc/optimization.php');

/**
 * Ajax helpers
 */
require_once('inc/ajax.php');

/**
 * Including Header JavaScript
 */
function enqueue_theme_scripts() {
    wp_enqueue_script( 'theme-main-js', get_template_directory_uri() . '/assets/js/header.js', array(), '1.0', true );
  }
add_action( 'wp_enqueue_scripts', 'enqueue_theme_scripts' );

  