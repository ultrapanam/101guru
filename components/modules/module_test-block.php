<?php

/**
 * Module -- Test Block
 */

if (isset($module)) {
    $text = (isset($module['text'])) ? $module['text'] : false;
    $image = (isset($module['image'])) ? $module['image'] : false;
    ?>

    <div class="section">
        <div class="block-container">
            <div class="text-test">
                <h2><?php echo $text; ?></h2>

                <div class="img">
                    <?php echo generate_acf_image($image, true); ?>
                </div>
            </div>
        </div>

        <div class="block-container border blue-border">
            <h3>block-container with border</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad officiis enim fuga magni itaque ratione, <b>I'm bold text with tag b</b> and <strong>I'm bold text with tag strong</strong> ipsa, explicabo aperiam vitae eius sapiente iure esse totam!</p>
        </div>

        <div class="block-container border blue-border-left">
            <h3>Left border block-container</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad officiis enim fuga magni itaque ratione, nulla repellat unde quaerat deleniti aliquam ipsa, explicabo aperiam vitae eius sapiente iure esse totam!</p>
        </div>

        <div class="block-container">
            <div class="buttons">
                <div class="row">
                    <a href="" class="btn">
                        Visit Casino
                    </a>
                </div>
                <div class="row">
                    <a class="btn blue-btn">
                        Visit Casino
                    </a>
                </div>
                <div class="row">
                    <a class="btn green-btn">
                        Visit Casino
                    </a>
                </div>
                <div class="row">
                    <a class="btn trans-btn">
                        Visit Casino
                    </a>
                </div>
            </div>
        </div>

        <div class="block-container">
            <div class="ordered-list">
                <h3>Ordered list</h3>
                <ol class="styled">
                    <li>Popularity</li>
                    <li>Gambling</li>
                    <li>Casino</li>
                </ol>
            </div>
            <div class="unordered-list">
                <h3>Unordered list</h3>
                <ul class="styled">
                    <li>Popularity</li>
                    <li>Gambling</li>
                    <li>Casino</li>
                </ul>
            </div>
        </div>
    </div>

    <?php 
}
?>

<style>
.text-test .img img {
    object-fit: cover;
    height: 215px !important;
    border-radius: 12px;
    margin-bottom: 28px;
}

.buttons {
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    justify-content: space-evenly;
}

.row {
    height: 100px;
}
</style>