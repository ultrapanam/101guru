<?php

/**
 * Module -- Horizontal Accordion
 */
if (isset($module)) {
    $heading = (isset($module['heading'])) ? $module['heading'] : false;
    $horizontal_accordion = (isset($module['horizontal_accordion_items'])) ? $module['horizontal_accordion_items'] : false;

?>
<div class="section horizontal-accordion">
    <div class="block-container">
        <?php if ( $heading ) { ?>
            <h2><?php echo $heading; ?></h2>
        <?php } ?>
        <div class="horizontal-accordion-wrapper">
            <div class="accordion-tabs">
                <?php foreach ( $horizontal_accordion as $index => $item ) { ?>
                    <div class="accordion-tab <?php echo $index === 0 ? 'active-tab' : ''; ?>" data-index="<?php echo $index; ?>">
                        <?php echo $item['heading']; ?>
                    </div>
                <?php } ?>
            </div>
            <div class="accordion-body">
                <?php foreach ( $horizontal_accordion as $index => $item ) { ?>
                    <div class="accordion-content <?php echo $index === 0 ? 'active-tab' : ''; ?>" data-index="<?php echo $index; ?>">
                        <?php echo $item['text']; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.accordion-tab');
    const contents = document.querySelectorAll('.accordion-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const index = this.getAttribute('data-index');

            // Remove active class from all tabs and contents
            tabs.forEach(tab => tab.classList.remove('active-tab'));
            contents.forEach(content => content.classList.remove('active-tab'));

            // Add active class to the clicked tab and corresponding content
            this.classList.add('active-tab');
            document.querySelector(`.accordion-content[data-index="${index}"]`).classList.add('active-tab');
        });
    });
});

</script>