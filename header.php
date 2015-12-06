<!DOCTYPE html>
<html>
    <head>
        <title><?php bloginfo('name'); ?></title>
    </head>

    <body>

        <header class="header">
            <h1><?php bloginfo('name'); ?></h1>
        </header>

        <nav class="main-nav">
            <ul>
            <?php
                $args = array(
                    'container' => false,
                    'menu_class' => false,
                    'fallback_cb' => 'wp_list_categories',
                    'title_li' => false
                    );

                wp_nav_menu($args);
            ?>
            </ul>
        </nav><!--#global-nav-->


