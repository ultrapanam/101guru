<?php

/**
 * Module -- Paragraph Block
 */

if (isset($module)) {
    $heading = (isset($module['heading'])) ? $module['heading'] : false;
    $paragraph = (isset($module['paragraph'])) ? $module['paragraph'] : false;
    $border = (isset($module['border'])) ? $module['border'] : false;
?>

<div class="section">
    <div class="block-container <?php echo $border; ?>">
        <div class="heading-text">
            <h2><?php echo $heading; ?></h2>
        </div>
        <div class="paragraph">
            <?php echo $paragraph; ?>
        </div>
    </div>
</div>

<?php }?>