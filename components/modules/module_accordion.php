<?php

/**
 * Module -- Accordion
 */

if (isset($module)) {
    $accordion = (isset($module['accordion_repeater'])) ? $module['accordion_repeater'] : false;
    $open_first = (isset($module['open_first_tab_by_default'])) ? $module['open_first_tab_by_default'] : false;
    $background_type = (isset($module['gradient_background'])) ? $module['gradient_background'] : false;
    $open_first_tab_by_default = (isset($module['open_first_tab_by_default'])) ? $module['open_first_tab_by_default'] : false;

    $i = 0;
?>
    <div class="custom-accordion">
        <?php foreach ($accordion as $accordion_item ) { ?>
            <div class="accordion-item <?php if ($open_first == 1 && $i == 0) { echo 'active'; } ?>" <?php if ($background_type == 0) { ?> style="background:#353535!important;"<?php } ?>  >
                <h2 class="accordion-header" <?php if ($background_type == 0) { ?> style="background:#353535!important;"<?php } ?>>
                    <button class="accordion-button" type="button" <?php if ($background_type == 0) { ?> style="background:#353535!important;-webkit-text-fill-color: #fff;"<?php } ?>>
                        <?php echo $accordion_item['title']?>
                    </button>
                </h2>
                <div class="accordion-content-faq">
                    <div class="accordion-body-faq">
                        <?php echo $accordion_item['body']?>
                    </div>
                </div>
            </div>
            <?php ++$i;?>
        <?php } ?>
    </div>
<?php } ?>
