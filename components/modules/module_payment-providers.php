<?php

/**
 * Module -- Payment Providers
 */
 // Get the selected payment method names from the post/page

 if (isset($module)) {
    $heading = (isset($module['payment_providers_heading'])) ? $module['payment_providers_heading'] : false;
    $selected_payment_providers = (isset($module['payment_providers'])) ? $module['payment_providers'] : false;

?>

<div class="section">
    <div class="block-container">
        <div class="heading-text">
            <h2><?php echo $heading; ?></h2>
        </div>
        <div class="payment-providers">
            <?php 
            if ($selected_payment_providers) {
                // Loop through each selected payment method name
                foreach ($selected_payment_providers as $selected_method) {
                    // Loop through the repeater field on the Theme Settings options page to match the name and get the image
                    if ( have_rows('payment_providers_repeater', 'option') ) {
                        while ( have_rows('payment_providers_repeater', 'option') ) {
                            the_row();                        
                            $payment_method_name = get_sub_field('name'); // The name in the repeater
                            $payment_method_image = get_sub_field('image'); // The image in the repeater
                            $payment_method_casinos = get_sub_field('pyament_providers_casinos'); // The image in the repeater
            
                            // Check if the current repeater row matches the selected payment method name
                            if ($payment_method_name == $selected_method) {
                                // Output the name and image (or just the image as per your needs)
                                ?>
                                <?php if ($payment_method_casinos) { ?>
                                    <a href="<?php echo $payment_method_casinos; ?>">
                                        <div class="payment-provider">
                                            <img src="<?php echo esc_url($payment_method_image['url']) ?>" alt="<?php echo esc_attr($payment_method_name) ?>">
                                            <p> <?php echo esc_html($payment_method_name) ?> </p>
                                        </div>
                                    </a>
                                <?php } else { ?>
                                    <div class="payment-provider">
                                        <img src="<?php echo esc_url($payment_method_image['url']) ?>" alt="<?php echo esc_attr($payment_method_name) ?>">
                                        <p> <?php echo esc_html($payment_method_name) ?> </p>
                                    </div>
                               <?php } 
                            }
                        }
                    }
                }
            }
            ?>
        </div>
    </div>
</div>

<?php }?>