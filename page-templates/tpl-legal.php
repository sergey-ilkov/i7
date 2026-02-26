<?php

/**
 * Template Name: Юридическая страница
 */

get_header(); ?>

<main class="main-legal">
    <section class="legal-content section-bg" style="--section-bg: #fff;">
        <div class="container">

            <?php
            // Это "Цикл WordPress" (The Loop). 
            // Он обязателен, чтобы WP понял, контент КАКОЙ страницы выводить.
            if (have_posts()) :
                while (have_posts()) : the_post(); ?>

            <h1 class="legal-title">
                <?php the_title(); // Выводит заголовок страницы из админки 
                        ?>
            </h1>

            <div class="legal-text-wrapper">
                <?php
                        // Основная функция вывода контента. 
                        // Она сама заботится о безопасности и правильной разметке.
                        the_content();
                        ?>
            </div>

            <?php endwhile;
            endif; ?>

        </div>
    </section>
</main>

<?php get_footer(); ?>