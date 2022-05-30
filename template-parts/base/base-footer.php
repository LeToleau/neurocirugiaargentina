<?php
    //Remember to import this file into the footer.php file for it to work!

    //CONFIG
    //You can create custom menus from the wp-menus.php file found in the path inc/optional/wp-menus.php
    $theme_location_menu = 'main-menu'; //Set your menu from here

    $footerLogo = get_field('footer_logo', 'options');
    $footerMessage = get_field('footer_message', 'options');
?>

<div class="b-footer">

    <div class="b-footer__container container">

        <div class="b-footer__brand">
            <img class="b-footer__brand-logo" src=<?= esc_url($footerLogo['url']); ?>>

        </div>

        <?php //Nav menu 
            wp_nav_menu( array( 
                'theme_location' => $theme_location_menu, //Nav menu selector
                'container_class' => 'menu b-footer__menu') //Nav menu class
            ); 
        ?>

        <div class="b-footer__message">
            <p class="b-footer__message-text" ><?= esc_html($footerMessage); ?></p>
            <div class="g-ytsubscribe" data-channelid="UCJ2bSwtZHCuA2XZmn-NLQyw" data-layout="full"  data-theme="dark" data-count="hidden"></div>
        </div>

    </div>

</div>

<script src="https://apis.google.com/js/plusone.js"></script>