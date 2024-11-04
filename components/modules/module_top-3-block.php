<?php

/**
 * Module -- Top 3 block
 */

 /**
 * ACF Link Helper
 * Generates a link with given ACF array for field type "link"
 *
 * @param array $link - ACF's link array containing entries for
 * url, title and target
 *
 * @param array $additional_classes, defaults to false - All additional classes that need
 * to be printed in the class attribute
 *
 * @param string $id, defaults to false - The id of the link
 *
 * @param array $additional_attr, defaults to false - All the additional attributes
 * that need to be assigned to the link
 *
 * @return string - Preset link tag with all passed attributes
 */
 
if (isset($module)) {
    $heading = (isset($module['heading'])) ? $module['heading'] : false;

    $casino_logo_top_1 = (isset($module['casino_logo_top_1'])) ? $module['casino_logo_top_1'] : false;
    $casino_name_top_1 = (isset($module['casino_name_top_1'])) ? $module['casino_name_top_1'] : false;
    $bonus_text_top_1 = (isset($module['bonus_text_top_1'])) ? $module['bonus_text_top_1'] : false;
    $min_deposit_top_1 = (isset($module['min_deposit_top_1'])) ? $module['min_deposit_top_1'] : false;
    $games_top_1 = (isset($module['games_top_1'])) ? $module['games_top_1'] : false;
    $payment_methods_1 = (isset($module['payment_methods_1'])) ? $module['payment_methods_1'] : false;
    $buttons_top_1 = (isset($module['buttons_top_1'])) ? $module['buttons_top_1'] : false;

    $casino_logo_top_2 = (isset($module['casino_logo_top_2'])) ? $module['casino_logo_top_2'] : false;
    $casino_name_top_2 = (isset($module['casino_name_top_2'])) ? $module['casino_name_top_2'] : false;
    $bonus_text_top_2 = (isset($module['bonus_text_top_2'])) ? $module['bonus_text_top_2'] : false;
    $min_deposit_top_2 = (isset($module['min_deposit_top_2'])) ? $module['min_deposit_top_2'] : false;
    $games_top_2 = (isset($module['games_top_2'])) ? $module['games_top_2'] : false;
    $payment_methods_2 = (isset($module['payment_methods_2'])) ? $module['payment_methods_2'] : false;
    $buttons_top_2 = (isset($module['buttons_top_2'])) ? $module['buttons_top_2'] : false;

    $casino_logo_top_3 = (isset($module['casino_logo_top_3'])) ? $module['casino_logo_top_3'] : false;
    $casino_name_top_3 = (isset($module['casino_name_top_3'])) ? $module['casino_name_top_3'] : false;
    $bonus_text_top_3 = (isset($module['bonus_text_top_3'])) ? $module['bonus_text_top_3'] : false;
    $min_deposit_top_3 = (isset($module['min_deposit_top_3'])) ? $module['min_deposit_top_3'] : false;
    $games_top_3 = (isset($module['games_top_3'])) ? $module['games_top_3'] : false;
    $payment_methods_3 = (isset($module['payment_methods_3'])) ? $module['payment_methods_3'] : false;
    $buttons_top_3 = (isset($module['buttons_top_3'])) ? $module['buttons_top_3'] : false;
?>
<div class="section top-3-block">    
    <div class="block-container">
        <?php if ( $heading ) { ?>
            <h2 class="top-3-heading">
                <?php echo $heading; ?>
            </h2>
        <?php } ?>
        <div class="rank-cards-wrapper">
            <div class="single-card rank-1-item blue-border">
                <div style="display: none!important;"><?php echo $casino_name_top_1; ?></div>
                <div class="casino-logo">
                    <?php echo generate_acf_image($casino_logo_top_1, true); ?>
                </div>
                <div class="card-body">
                    <div class="bonus-block">
                        <div class="bonus-heading">
                            <span class="bonus-sign">BONUS</span>
                            <div>
                                <?php echo $bonus_text_top_1; ?>
                            </div>
                        </div>
                        <div class="bonus-text">
                        <div class="min-deposit">
                                <span class="min-deposit-label">Min deposit</span>
                                <span class="min-deposit-body">
                                    <?php echo $min_deposit_top_1; ?>
                                </span>
                            </div>
                            <div class="slots">
                                <span class="slots-label">Slots</span>
                                <span class="slots-counter">
                                    <?php echo $games_top_1; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php if ($payment_methods_1) { ?>
                        <div class="payment-methods">
                            <?php foreach ( $payment_methods_1 as $payment_logo) { ?>
                                <div class="single-method">
                                    <img src="<?php echo  $payment_logo['image']; ?>" alt="">
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <div class="buttons-container">
                        <?php echo generate_acf_link($buttons_top_1['visit_casino'], 'btn blue-btn btn-left'); ?>
                        <?php echo generate_acf_link($buttons_top_1['read_review'], 'btn trans-btn'); ?>
                    </div>
                </div>
            </div>
            <div class="single-card rank-2-item blue-border">
                <div style="display: none!important;"><?php echo $casino_name_top_2; ?></div>
                <div class="casino-logo">
                    <?php echo generate_acf_image($casino_logo_top_2, true); ?>
                </div>
                <div class="card-body">
                    <div class="bonus-block">
                        <div class="bonus-heading">
                            <span class="bonus-sign">BONUS</span>
                            <div>
                                <?php echo $bonus_text_top_2; ?>
                            </div>
                        </div>
                        <div class="bonus-text">
                        <div class="min-deposit">
                                <span class="min-deposit-label">Min deposit</span>
                                <span class="min-deposit-body">
                                    <?php echo $min_deposit_top_2; ?>
                                </span>
                            </div>
                            <div class="slots">
                                <span class="slots-label">Slots</span>
                                <span class="slots-counter">
                                    <?php echo $games_top_2; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php if ($payment_methods_2) { ?>
                    <div class="payment-methods">
                        <?php foreach ( $payment_methods_2 as $payment_logo) { ?>
                            <div class="single-method">
                                <img src="<?php echo  $payment_logo['image']; ?>" alt="">
                            </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <div class="buttons-container">
                        <?php echo generate_acf_link($buttons_top_2['visit_casino'], 'btn blue-btn btn-left'); ?>
                        <?php echo generate_acf_link($buttons_top_2['read_review'], 'btn trans-btn'); ?>
                    </div> 
                </div>
            </div>
            <div class="single-card rank-3-item blue-border">
                <div style="display: none!important;"><?php echo $casino_name_top_3; ?></div>
                <div class="casino-logo">
                    <?php echo generate_acf_image($casino_logo_top_3, true); ?>
                </div>
                <div class="card-body">
                    <div class="bonus-block">
                        <div class="bonus-heading">
                            <span class="bonus-sign">BONUS</span>
                            <div>
                                <?php echo $bonus_text_top_3; ?>
                            </div>
                        </div>
                        <div class="bonus-text">
                            <div class="min-deposit">
                                <span class="min-deposit-label">Min deposit</span>
                                <span class="min-deposit-body">
                                    <?php echo $min_deposit_top_3; ?>
                                </span>
                            </div>
                            <div class="slots">
                                <span class="slots-label">Slots</span>
                                <span class="slots-counter">
                                    <?php echo $games_top_3; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php if ($payment_methods_3) { ?>
                    <div class="payment-methods">
                        <?php foreach ( $payment_methods_3 as $payment_logo) { ?>
                            <div class="single-method">
                                <img src="<?php echo  $payment_logo['image']; ?>" alt="">
                            </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <div class="buttons-container">
                        <?php echo generate_acf_link($buttons_top_3['visit_casino'], 'btn blue-btn btn-left'); ?>
                        <?php echo generate_acf_link($buttons_top_3['read_review'], 'btn trans-btn'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php }