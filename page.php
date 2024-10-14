<?php

/**
 * Default Page Template
 */

get_header();

$page_id = get_the_ID();
$modules = get_field('module_content', $page_id);

?>

<div id="main">
    
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

<?php

get_footer();