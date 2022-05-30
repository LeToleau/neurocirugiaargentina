<?php
//Remember to import this file into the header.php file for it to work!
//ACF
$navLogo = get_field('c-navbar__logo', 'option');

//CONFIG
//You can create custom menus from the wp-menus.php file found in the path inc/optional/wp-menus.php
$theme_location_menu = 'main-menu'; //Set your menu from here
?>

<div class="b-navbar" navbar-functions>

    <div class="b-navbar__container container">

        <?php //Navbar logo 
        ?>
        <?php if ($navLogo) : ?>
            <a href="/">
                <img src="<?php echo $navLogo['url']; ?>" alt="<?php echo $navLogo['url']; ?>" class="b-navbar__logo">
            </a>
        <?php endif; ?>

        <?php //Toggler button for mobile 
        ?>
        <button class="b-navbar__toggler" aria-expanded="false" toggler-menu>
            <span></span>
            <span></span>
            <span></span>
        </button>

        <?php //Nav menu 
        WPExtendedMenu::printMenu(
            array(
                'wp_nav_menu' => array(
                    'theme_location' => $theme_location_menu,
                    'container_class' => 'menu b-navbar__menu'
                ),
                'parent_menu_icon' => get_svg('assets/img/icons/dropdown.svg')
            )
        );
        ?>

    </div>

</div>