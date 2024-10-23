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
 * Including Header JavaScript and Accordion JavaScript
 */
function enqueue_theme_scripts() {
  // Enqueue the header script
  wp_enqueue_script( 'theme-header-js', get_template_directory_uri() . '/assets/js/header.js', array(), '1.0', true );
  
  // Enqueue the accordion script
  wp_enqueue_script( 'theme-accordion-js', get_template_directory_uri() . '/assets/js/module_accordion.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_theme_scripts' );

  