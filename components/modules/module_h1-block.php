<?php

/**
 * Module -- H1 Block
 */

if (isset($module)) {
    $heading = (isset($module['heading'])) ? $module['heading'] : false;
    $border = (isset($module['border'])) ? $module['border'] : false;
    $greybg = (isset($module['greybg']) && $module['greybg'] == 1 ) ? 'grey-bg' : '';
?>

<div class="section h1-block">
    <div class="block-container <?php echo $border; ?> <?php echo $greybg; ?>">
        <?php if ( $heading ) { ?>
            <div class="heading-text">
                <h1><?php echo $heading; ?></h1>
            </div>
        <?php } ?>
    </div>
</div>

<?php }?>