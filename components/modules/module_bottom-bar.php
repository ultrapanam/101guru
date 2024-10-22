<?php 

/* 
*
*  Template: Bottom affilate bar
*
*/

$bottom_bar_activate = get_field('bottom_bar_activate', 'options');
$bottom_bar_text = get_field('bottom_bar_text', 'options') != null ? get_field('bottom_bar_text', 'options') : false;
$bottom_bar_button_link = get_field('bottom_bar_button_link', 'options') != null ? get_field('bottom_bar_button_link', 'options') : false;

?>
<?php if ($bottom_bar_activate) { ?>
<div class="bottom-bar">
    <div class="container">
        <div class="bottom-bar-wrap">
            <img src="https://au.casinologin.mobi/wp-content/themes/casino/assets/img/header/coin.svg" height="25" width="25" loading="lazy" alt="coin">
            <p class="bottom-bar-text"><?php echo $bottom_bar_text; ?></p>
            <a href="<?php echo $bottom_bar_button_link['url']?>" target="_blank" rel="nofollow" class="bottom-bar-link"><?php echo $bottom_bar_button_link['title']?></a>
        </div>
    </div>
</div>
<style>
    .site-footer {
        margin-bottom: 25px;
    }
</style>
<?php } ?>

