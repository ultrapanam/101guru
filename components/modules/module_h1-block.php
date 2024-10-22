<?php

/**
 * Module -- H1 Block
 */

if (isset($module)) {
    $heading_h1 = (isset($module['heading_h1'])) ? $module['heading_h1'] : false;
    $border_h1 = (isset($module['border_h1'])) ? $module['border_h1'] : false;
    $greybg_h1 = (isset($module['greybg_h1']) && $module['greybg_h1'] == 1 ) ? 'grey-bg' : '';
?>

<div class="section h1-block">
    <div class="block-container <?php echo $border_h1; ?> <?php echo $greybg_h1; ?>">
        <?php if ( $heading_h1 ) { ?>
            <div class="heading-text">
                <h1><?php echo $heading_h1; ?></h1>
            </div>
        <?php } ?>
    </div>
</div>

<?php }?>