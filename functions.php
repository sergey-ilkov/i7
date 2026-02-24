<?php

/**
 * Функции и настройки темы
 */

function my_theme_scripts()
{
    // 1. Подключаем стили
    // get_template_directory_uri() выдает путь до папки твоей темы

    wp_enqueue_style('swiper-style', get_template_directory_uri() . '/assets/libs/swiper-bundle.min.css', array(), '12.1.2');

    wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/main.css', array('swiper-style'), '1.0.0');

    // 2. Подключаем сторонние библиотеки (libs)
    // Важно: указываем 'gsap' как имя, чтобы потом использовать его как зависимость
    wp_enqueue_script('gsap', get_template_directory_uri() . '/assets/libs/gsap.min.js', array(), null, true);
    wp_enqueue_script('gsap-scroll-trigger', get_template_directory_uri() . '/assets/libs/ScrollTrigger.min.js', array('gsap'), null, true);
    wp_enqueue_script('gsap-scroll-to', get_template_directory_uri() . '/assets/libs/ScrollToPlugin.min.js', array('gsap'), null, true);
    wp_enqueue_script('gsap-split-text', get_template_directory_uri() . '/assets/libs/SplitText.min.js', array('gsap'), null, true);
    // wp_enqueue_script('gsap-motion-path', get_template_directory_uri() . '/assets/libs/MotionPathPlugin.min.js', array('gsap'), null, true);


    wp_enqueue_script('lenis', get_template_directory_uri() . '/assets/libs/lenis.min.js', array('gsap'), null, true);

    // Если есть Swiper или другие
    wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/libs/swiper-bundle.min.js', array(), null, true);

    // wp_enqueue_script('lottie', get_template_directory_uri() . '/assets/libs/lottie.min.js', array(), null, true);


    // Подключаем Lottie только там, где нужен
    if (is_page_template(array('page-templates/tpl-branding.php', 'page-templates/tpl-solutions.php'))) {
        wp_enqueue_script('lottie', get_template_directory_uri() . '/assets/libs/lottie.min.js', array(), null, true);
    }

    // Подключаем MotionPathPlugin только там, где нужен
    if (is_page_template(array('page-templates/tpl-solutions.php'))) {
        wp_enqueue_script('gsap-motion-path', get_template_directory_uri() . '/assets/libs/MotionPathPlugin.min.js', array('gsap'), null, true);
    }

    // 3. Твой основной файл скриптов (main.js)
    // В массиве array('gsap', 'gsap-scroll-trigger', 'gsap-scroll-to', 'gsap-split-text', 'gsap-motion-path', 'lenis', 'swiper', 'lottie') 
    // мы говорим: "Не загружай этот файл, пока не загрузятся GSAP Plugins Swiper Lottie Lenis"
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
    // wp_enqueue_script(
    //     'main-js',
    //     get_template_directory_uri() . '/assets/js/main.js',
    //     array('gsap', 'gsap-scroll-trigger', 'gsap-scroll-to', 'gsap-split-text', 'gsap-motion-path', 'lenis', 'swiper', 'lottie'),
    //     '1.0.0',
    //     true
    // );

    wp_localize_script('main-js', 'themeData', array(
        'templateUrl' => get_template_directory_uri()
    ));
}

// Привязываем функцию к "крючку" wp_enqueue_scripts
add_action('wp_enqueue_scripts', 'my_theme_scripts');


function add_defer_attribute($tag, $handle)
{

    // Список скриптов, которым нужен defer
    $scripts_to_defer = array('gsap', 'gsap-scroll-trigger', 'gsap-scroll-to', 'gsap-split-text', 'gsap-motion-path', 'lenis', 'swiper', 'lottie', 'main-js');

    foreach ($scripts_to_defer as $defer_script) {
        if ($defer_script === $handle) {
            return str_replace(' src', ' defer src', $tag);
        }
    }
    return $tag;
}
add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);



// ? remove head link shortlink
remove_action('wp_head', 'wp_shortlink_wp_head');
// ? remove head meta generator
remove_action('wp_head', 'wp_generator');


// ? Custom Post Type Hero sliders
function register_hero_slides_cpt()
{
    $labels = array(
        'name' => 'Слайды Hero',
        'singular_name' => 'Слайд (hero_slides)',
        'add_new' => 'Добавить слайд',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-images-alt2', // Иконка в меню
        'supports' => array('title'), // Нам нужно только название для удобства
    );
    register_post_type('hero_slides', $args);
}
add_action('init', 'register_hero_slides_cpt');