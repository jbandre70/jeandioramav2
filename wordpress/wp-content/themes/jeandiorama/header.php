<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Jean Diorama">
    <meta name="twitter:description" content="Your website description goes here">
    <meta name="twitter:image" content="<?php echo get_template_directory_uri() ?>/img/logo512.png">

    <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/img/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"
          href="<?php echo get_template_directory_uri() ?>/img/logo192.png">
    <link rel="icon" type="image/png" sizes="96x96"
          href="<?php echo get_template_directory_uri() ?>/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16"
          href="<?php echo get_template_directory_uri() ?>/img/favicon16.png">
    <?php wp_head(); ?>
    <script type="text/javascript">
        window.templatedir = "<?php echo get_template_directory_uri(); ?>";
    </script>
</head>
<body <?php echo body_class(); ?>>
<nav class="navbar">
    <div class="navbar-brand">
        <a class="navbar-item logo" href="<?php echo home_url(); ?>">
            <img
                class="dslogo"
                src="<?php echo get_template_directory_uri() ?>/img/logo1.0dbcaa6e.svg"
                alt="Jean Diorama"
            >
        </a>

        <?php
        if(wp_is_mobile()) {
        ?>

            <div class="navbar-end">
        <div class="navbar-item">
            <div class="field is-grouped">
                <a class="navbar-item" href="http://www.distant-shores.com" target="_blank"
                   rel="noopener noreferrer">
                    <span class="icon" style="color: rgb(187, 187, 187);">
                        <img src="<?php echo get_template_directory_uri() ?>/img/ms-icon-150x150.png" alt="">
                    </span>
                </a>
                <a class="navbar-item"
                   href="https://www.facebook.com/jbadiorama"
                   target="_blank"
                   rel="noopener noreferrer">
                    <span class="icon" style="color: rgb(187, 187, 187);">
                        <img src="<?php echo get_template_directory_uri() ?>/img/facebook.svg" alt="">
                    </span>
                </a>
                <a class="navbar-item "
                   href="https://www.instagram.com/jean_diorama/"
                   target="_blank"
                   rel="noopener noreferrer">
                    <span class="icon" style="color: rgb(187, 187, 187);">
                        <img src="<?php echo get_template_directory_uri() ?>/img/instagram.svg" alt="">
                    </span>
                </a>
            </div>
        </div>
    </div>
    <?php }   ?>


        <div class="navbar-burger burger" id="burgerking" data-target="navMenubd-example">
            <span></span><span></span><span></span></div>
    </div>
    <div id="navMenubd-example" class="navbar-menu">
        <?php
            $menuParameters = [
                'theme_location' => 'jeandiorama',
                'container' => 'div',
                'container_class' => 'navbar-start',
                'menu_id ' => '',
                'items_wrap' => '%3$s',
                'echo' => false,
            ];
            echo strip_tags(wp_nav_menu($menuParameters), '<a><div>');
        ?>
    </div>
    <?php
    if(wp_is_mobile() === false) {
    ?>
    <div class="navbar-end">
        <div class="navbar-item">
            <div class="field is-grouped">
                <a class="navbar-item" href="http://www.distant-shores.com" target="_blank"
                   rel="noopener noreferrer">
                    <span class="icon" style="color: rgb(187, 187, 187);">
                        <img src="<?php echo get_template_directory_uri() ?>/img/ms-icon-150x150.png" alt="">
                    </span>
                </a>
                <a class="navbar-item"
                   href="https://www.facebook.com/jbadiorama"
                   target="_blank"
                   rel="noopener noreferrer">
                    <span class="icon" style="color: rgb(187, 187, 187);">
                        <img src="<?php echo get_template_directory_uri() ?>/img/facebook.svg" alt="">
                    </span>
                </a>
                <a class="navbar-item "
                   href="https://www.instagram.com/jean_diorama/"
                   target="_blank"
                   rel="noopener noreferrer">
                    <span class="icon" style="color: rgb(187, 187, 187);">
                        <img src="<?php echo get_template_directory_uri() ?>/img/instagram.svg" alt="">
                    </span>
                </a>
            </div>
        </div>
    </div>
    <?php
    }
    ?>

</nav>
