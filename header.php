<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Gilroy-Regular.woff2" as="font" type="font/woff2" crossorigin>


    <style>
    <?php // Общий критический CSS (сетка, хедер)
    echo file_get_contents(get_template_directory() . '/assets/css/critical-common.css');

    // Специфический критический CSS для страницы
    if (is_front_page()) {
        echo file_get_contents(get_template_directory() . '/assets/css/critical-home.css');
    }

    // elseif (is_page_template('tpl-digital.php')) {
    //     echo file_get_contents(get_template_directory() . '/assets/css/critical-digital.css');
    // }
    if (is_page_template('page-templates/tpl-digital.php')) {
        echo file_get_contents(get_template_directory() . '/assets/css/critical-digital.css');
    }


    ?>
    </style>


    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>



    <!-- ? Preloader -->
    <!-- ? Preloader -->
    <!-- ? Preloader -->
    <!-- <?php get_template_part('template-parts/header', 'preloader'); ?> -->
    <!-- ? Preloader -->
    <!-- ? Preloader -->
    <!-- ? Preloader -->



    <div class="wrapper">

        <header id="header" class="header">

            <div class="container-max">

                <div class="header-inner">

                    <div class="header-logo">


                        <?php if (is_front_page()) : ?>

                        <?php get_template_part('template-parts/header', 'logo'); ?>

                        <?php else : ?>

                        <a href="<?php echo esc_url(pll_home_url()); ?>">

                            <?php get_template_part('template-parts/header', 'logo'); ?>

                        </a>

                        <?php endif; ?>


                    </div>







                    <div class="header-box">


                        <div class="lang-box">
                            <?php

                            // echo '<pre>';
                            // var_dump($languages['en']);
                            // echo '</pre>';
                            // Получаем массив языков

                            $languages = pll_the_languages(array('raw' => 1));




                            // echo '<pre>';
                            // var_dump(pll_languages_list());
                            // echo '</pre>';

                            if (!empty($languages)) :
                                foreach ($languages as $lang) :

                                    // Проверяем, текущий ли это язык
                                    $is_current = $lang['current_lang'];

                                    // Определяем классы (например, lang-item--active)

                                    // $class = 'lang' . ($is_current ? '' : ' lang-link');
                            ?>


                            <?php if (!$is_current) : ?>

                            <a href="<?php echo esc_url($lang['url']); ?>" class="lang lang-link">
                                <?php echo esc_html($lang['slug']); ?>
                            </a>

                            <?php else : ?>

                            <span class="lang">
                                <?php echo esc_html($lang['slug']); ?>
                            </span>

                            <?php endif; ?>


                            <?php
                                endforeach;
                            endif;

                            ?>


                            <!-- <span class="lang">RU</span>
                            <a class="lang lang-link" href="#">EN</a> -->
                        </div>


                        <!-- <div class="lang-box">
                            <span class="lang">RU</span>
                            <a class="lang lang-link" href="#">EN</a>
                        </div> -->

                        <button id="burger-menu" class="burger-menu" type="button" aria-label="Open menu">
                            <span></span>
                            <span></span>
                        </button>


                    </div>




                    <!-- ? header-menu -->
                    <div id="header-menu" class="header-menu">

                        <div class="header-menu-body">
                            <button class="btn-close">
                                <svg viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="120" height="120" rx="60" fill="white" />
                                    <path d="M43.0293 43.0293L76.9704 76.9704" stroke="currentColor" stroke-linecap="round" />
                                    <path d="M76.9707 43.0293L43.0296 76.9704" stroke="currentColor" stroke-linecap="round" />
                                </svg>
                            </button>

                            <span class="header-menu-circle"></span>


                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'header_menu',
                                'container'      => 'nav',               // Тег-обертка
                                'container_class' => 'nav-menu',       // Класс обертки
                                'menu_class'     => 'header-menu-list', // Класс для <ul>
                                'fallback_cb'    => false                // Если меню не создано, ничего не выводить
                            ));


                            ?>





                            <?php get_template_part('template-parts/section', 'specialists'); ?>



                        </div>

                    </div>


                </div>
            </div>

        </header>