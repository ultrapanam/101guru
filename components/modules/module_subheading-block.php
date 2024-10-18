<?php

/**
 * Module -- Subheading block
 */

if (isset($module)) {
    $heading = (isset($module['heading'])) ? $module['heading'] : false;
    $subheading = (isset($module['heading'])) ? $module['heading'] : false;
    $paragraph = (isset($module['paragraph'])) ? $module['paragraph'] : false;
    $image = (isset($module['image'])) ? $module['image'] : false;
    $border = (isset($module['border'])) ? $module['border'] : false;
    $greybg = (isset($module['greybg']) && $module['greybg'] == 1 ) ? 'grey-bg' : '';
?>

<div class="section subheading-block">
    <?php if ( $heading ) { ?>
        <div class="heading-text">
            <h2><?php echo $heading; ?></h2>
        </div>
    <?php } ?>
    <div class="block-container <?php echo $border; ?> <?php echo $greybg; ?>">
            <div class="inner-container">
                <div class="image-container">
                    <?php echo generate_acf_image($image, true); ?>
                </div>
            <div class="paragraph-wrapper">
                <?php if ( $subheading ) { ?>
                    <div class="subheading grey-bg">
                        <h4>
                            <?php echo $subheading;  ?>
                        </h4>
                    </div>
                <?php } ?>
                <div class="paragraph grey-bg">
                    <?php echo $paragraph; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php }?>