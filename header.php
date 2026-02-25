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



    <!-- <div id="preloader" class="preloader">
        <div class="preloader-logo">
            <svg width="256" height="70" viewBox="0 0 256 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M191.203 69.4627V38.1331C191.203 18.0402 213.887 14.1019 223.537 25.5268C233.11 13.9074 256.001 18.3768 256.001 38.1331V69.4627C256.001 69.7589 255.758 69.9991 255.457 69.9991H247.562C247.262 69.9991 247.018 69.7589 247.018 69.4627V37.6465C247.018 25.0898 227.841 25.3599 227.841 37.6465V69.4627C227.841 69.7589 227.596 69.9991 227.295 69.9991H227.255H219.949H219.773C219.472 69.9991 219.227 69.7589 219.227 69.4627V37.6465C219.227 25.0898 200.297 25.3599 200.297 37.6465V69.4627C200.297 69.7589 200.053 69.9991 199.753 69.9991H191.747C191.447 69.9991 191.203 69.7589 191.203 69.4627Z" fill="white" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M181.889 44.6182C181.889 44.6301 181.889 44.6421 181.888 44.6542V69.9479H172.767V63.9444C168.282 67.6881 162.479 69.9455 156.142 69.9455C141.922 69.9455 130.395 58.5819 130.395 44.564C130.395 30.5462 141.922 19.1826 156.142 19.1826C170.362 19.1826 181.889 30.5462 181.889 44.564C181.889 44.5821 181.889 44.6001 181.889 44.6182ZM156.041 61.1618C165.277 61.1618 172.764 53.7806 172.764 44.6756C172.764 35.5705 165.277 28.1894 156.041 28.1894C146.804 28.1894 139.317 35.5705 139.317 44.6756C139.317 53.7806 146.804 61.1618 156.041 61.1618Z" fill="white" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M122.927 48.0909C123.098 46.8918 123.187 45.6656 123.187 44.4181C123.187 30.3973 111.961 19.0312 98.112 19.0312C84.2636 19.0312 73.0371 30.3973 73.0371 44.4181C73.0371 55.0615 79.5061 64.175 88.6807 67.9481C98.5074 71.9896 113.642 69.5852 120.25 60.2849C120.287 60.2331 120.323 60.1808 120.358 60.1279L112.909 55.8852C104.233 63.8601 86.9419 63.4464 82.2429 48.0909H122.927ZM114.264 39.2856H82.1301C82.1301 39.2856 84.3866 27.9496 98.3385 27.9496C112.29 27.9496 114.264 39.2856 114.264 39.2856Z" fill="white" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M40.7286 19.199C34.3173 19.199 28.4532 21.5092 23.9463 25.3311V7.72852e-07L14.9785 0V45.5962H15.0018C15.5426 59.1431 26.8539 69.9619 40.7286 69.9619C54.9483 69.9619 66.4756 58.5983 66.4756 44.5805C66.4756 30.5628 54.9483 19.199 40.7286 19.199ZM40.6663 28.1972C31.4301 28.1972 23.9426 35.5784 23.9426 44.6834C23.9426 53.7884 31.4301 61.1696 40.6663 61.1696C49.9027 61.1696 57.39 53.7884 57.39 44.6834C57.39 35.5784 49.9027 28.1972 40.6663 28.1972Z" fill="white" />
                <path d="M5.44129 70C8.44643 70 10.8826 67.5984 10.8826 64.636C10.8826 61.6735 8.44643 59.272 5.44129 59.272C2.43615 59.272 0 61.6735 0 64.636C0 67.5984 2.43615 70 5.44129 70Z" fill="white" />
            </svg>

        </div>
        <span class="preloader-text">
            Добро пожаловать в beam студию
        </span>
    </div> -->


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


                            echo home_url('/');
                            ?>





                            <?php get_template_part('template-parts/section', 'specialists'); ?>




                            <!-- 

                            <div class="appointment-box">
                                <div class="appointment-content">
                                    <h2 class="appointment__title">Запишитесь на прием</h2>
                                    <ul class="appointment__list">
                                        <li class="appointment__item" style="--contact-color: #0088ff">
                                            <a class="appointment__link" href="./contacts.html?direction=1">App, Web, CRM</a>
                                        </li>
                                        <li class="appointment__item" style="--contact-color: #e5c100;">
                                            <a class="appointment__link" href="./contacts.html?direction=2">Поставка оборудования</a>
                                        </li>
                                        <li class="appointment__item" style="--contact-color: #8e5aac;">
                                            <a class="appointment__link" href="./contacts.html?direction=3">Вакансия</a>
                                        </li>
                                    </ul>
                                </div>


                                <div class="swiper appointment-slider">
                                    <div class="swiper-wrapper">

                                        <div class="swiper-slide">
                                            <div class="appointment-slide" style="--contact-color: #0088ff">
                                                <div class="appointment-slide-images">
                                                    <img width="290" height="290" class="appointment-slide__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/appointment/01.png" alt="">
                                                    <img width="290" height="290" class="appointment-slide__img-face" src="<?php echo get_template_directory_uri(); ?>/assets/images/appointment/01-face.png" alt="">
                                                </div>
                                                <a class="appointment-slide__link" href="./contacts.html?direction=1">App, Web, CRM, Брендинг</a>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="appointment-slide" style="--contact-color: #e5c100;">
                                                <div class="appointment-slide-images">
                                                    <img width="290" height="290" class="appointment-slide__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/appointment/02.png" alt="">
                                                    <img width="290" height="290" class="appointment-slide__img-face" src="<?php echo get_template_directory_uri(); ?>/assets/images/appointment/02-face.png" alt="">
                                                </div>
                                                <a class="appointment-slide__link" href="./contacts.html?direction=2">Поставка оборудовани</a>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="appointment-slide" style="--contact-color: #8e5aac;">
                                                <div class="appointment-slide-images">
                                                    <img width="290" height="290" class="appointment-slide__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/appointment/03.png" alt="">
                                                    <img width="290" height="290" class="appointment-slide__img-face" src="<?php echo get_template_directory_uri(); ?>/assets/images/appointment/03-face.png" alt="">
                                                </div>
                                                <a class="appointment-slide__link" href="./contacts.html?direction=3">Вакансия</a>
                                            </div>
                                        </div>



                                    </div>

                                </div>

                            </div>


 -->

                        </div>

                    </div>


                </div>
            </div>

        </header>