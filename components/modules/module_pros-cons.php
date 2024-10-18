<?php

/**
 * Module -- Pros and Cons
 */

 if (isset($module)) {
    $pros_cons_heading = (isset($module['pros-cons-heading'])) ? $module['pros-cons-heading'] : false;
    $pros = (isset($module['pros'])) ? $module['pros'] : false;
    $cons = (isset($module['cons'])) ? $module['cons'] : false;

?>
<div class="section pros-cons">
    <div class="block-container">
        <h2><?php echo $pros_cons_heading; ?></h2>
        <div class="pros-cons-wrapper">
            <div class="pros blue-border">
                <ul class="proscons-list">
                    <?php foreach ($pros as $item) { ?>
                        <li><?php echo $item['item']; ?></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="cons blue-border">
                <ul class="proscons-list">
                    <?php foreach ($cons as $item) { ?>
                        <li><?php echo $item['item']; ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php } ?>