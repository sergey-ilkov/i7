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
        'menu_position' => 20,
        'menu_icon' => 'dashicons-images-alt2', // Иконка в меню
        'supports' => array('title'), // Нам нужно только название для удобства
    );
    register_post_type('hero_slides', $args);
}
add_action('init', 'register_hero_slides_cpt');



// ? CPT slider specialist
function register_specialist_slides_cpt()
{
    $labels = array(
        'name' => 'Слайды Specialist',
        'singular_name' => 'Слайд (specialist_slides)',
        'add_new' => 'Добавить слайд',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-groups', // Иконка в меню
        'supports' => array('title'), // Нам нужно только название для удобства
    );
    register_post_type('specialist_slides', $args);
}
add_action('init', 'register_specialist_slides_cpt');

// ? unique value direction_id
function validate_unique_direction_id($valid, $value, $field, $input)
{
    // Если значение уже невалидно, выходим
    if (!$valid) return $valid;

    // Получаем ID текущего поста, который редактируем
    $post_id = isset($_POST['post_ID']) ? $_POST['post_ID'] : 0;

    // Ищем другие посты этого же типа с таким же значением поля direction_id
    $args = array(
        'post_type'  => 'specialist_slides', // Твой CPT специалистов
        'post_status' => array('publish', 'draft', 'pending'),
        'post__not_in' => array($post_id), // Исключаем текущий пост из поиска
        'meta_query' => array(
            array(
                'key'     => 'direction_id', // Имя поля в ACF
                'value'   => $value,
                'compare' => '=',
            )
        )
    );

    $query = new \WP_Query($args);

    if ($query->have_posts()) {
        $valid = 'Этот ID уже используется у другого специалиста. Пожалуйста, введите уникальный номер.';
    }

    return $valid;
}

// Привязываем валидацию к конкретному полю по его имени
add_filter('acf/validate_value/name=direction_id', 'validate_unique_direction_id', 10, 4);


// ? CPT для глобальных настроек 

function register_site_settings_cpt()
{

    $labels = array(
        'name' => 'Настройки сайта',
        'singular_name' => 'Настройки сайта',
        'add_new' => 'Добавить настройки',
    );

    $args = array(
        'labels' => $labels,

        'public' => true,      // Делаем публичным, чтобы Polylang его увидел
        'publicly_queryable' => false, // Но нельзя открыть по прямой ссылке
        'exclude_from_search' => true,  // И не будет в поиске по сайту
        'show_in_nav_menus'  => false, // И нельзя добавить в меню
        'show_ui' => true,      // Показать в админке
        'has_archive' => false,
        'menu_position' => 24,
        'menu_icon' => 'dashicons-admin-generic',
        'supports' => array('title'), // Нам нужно только поле заголовка
        'show_in_rest' => false,
    );
    register_post_type('site_settings', $args);
}
add_action('init', 'register_site_settings_cpt');

// 1. Удаляем пункт "Добавить" из бокового меню и из верхнего админ-бара
function remove_site_settings_add_menus()
{
    // Удаляем из бокового меню
    remove_submenu_page('edit.php?post_type=site_settings', 'post-new.php?post_type=site_settings');
}
add_action('admin_menu', 'remove_site_settings_add_menus', 999);

// 2. Удаляем из кнопки "+ Добавить" в верхней панели
function remove_site_settings_admin_bar($wp_admin_bar)
{
    $wp_admin_bar->remove_node('new-site_settings');
}
add_action('admin_bar_menu', 'remove_site_settings_admin_bar', 999);

// 3. Скрываем кнопку внутри самого списка и в редакторе (через CSS для надежности)
function hide_add_new_completely()
{
    global $pagenow;
    if (get_post_type() == 'site_settings') {
        // Проверяем количество постов. 
        // Мы разрешаем добавление, только если постов МЕНЬШЕ, чем количество языков.
        $count_posts = wp_count_posts('site_settings')->publish;
        $languages = (function_exists('pll_languages_list')) ? count(pll_languages_list()) : 1;

        if ($count_posts >= $languages) {
            echo '<style>
                .page-title-action, /* Кнопка Добавить в списке */
                #split-page-title-action, /* Еще вариант кнопки */
                .wrap .add-new-h2, 
                #adminmenu .menu-posts-site_settings .wp-first-item + li /* Скрываем "Добавить" в меню, если вдруг осталось */
                { display:none !important; }
            </style>';
        }
    }
}
add_action('admin_head', 'hide_add_new_completely');



// Скрываем кнопку "Добавить новую" для Настроек сайта
function hide_add_new_settings_button()
{
    global $pagenow;
    if (($pagenow == 'edit.php' || $pagenow == 'post.php' || $pagenow == 'post-new.php') && get_post_type() == 'site_settings') {
        // Считаем количество записей (без учета языка пока что)
        $count_posts = wp_count_posts('site_settings');
        $published_posts = $count_posts->publish;

        // Если есть хотя бы одна запись, скрываем кнопку добавления через CSS
        if ($published_posts >= 1 && $pagenow != 'post.php') {
            echo '<style>.page-title-action { display:none !important; }</style>';
        }
    }
}
add_action('admin_head', 'hide_add_new_settings_button');

// Убираем кнопку «Добавить» внутри самого редактора
function hide_add_new_inside_post()
{
    $screen = get_current_screen();
    // Проверяем, что мы в редакторе нашего CPT
    if ($screen->post_type == 'site_settings') {
        echo '<style>
            /* Скрываем кнопку в обычном редакторе */
            .page-title-action { display:none !important; }
            /* Скрываем кнопку в Gutenberg (блочном редакторе) */
            .edit-post-header__settings a[href*="post-new.php?post_type=site_settings"],
            .edit-post-header-toolbar__left a[href*="post-new.php?post_type=site_settings"] { 
                display: none !important; 
            }
        </style>';
    }
}
add_action('admin_head', 'hide_add_new_inside_post');

// Запрет на удаление (Защитный замок)
function restrict_site_settings_deletion($caps, $cap, $user_id, $args)
{
    // Проверяем, пытаются ли удалить пост
    if ($cap === 'delete_post' || $cap === 'delete_posts') {
        // Если аргументы есть, проверяем тип поста
        if (isset($args[0])) {
            $post = get_post($args[0]);
            if ($post && $post->post_type === 'site_settings') {
                $caps[] = 'do_not_allow'; // Запрещаем действие
            }
        }
    }
    return $caps;
}
add_filter('user_has_cap', 'restrict_site_settings_deletion', 10, 4);

// Также скроем саму ссылку "Удалить" (В корзину) в списке и в редакторе через CSS
function hide_delete_link_css()
{
    if (get_post_type() == 'site_settings') {
        echo '<style>
            .submitdelete, .deletion { display: none !important; }
        </style>';
    }
}
add_action('admin_head', 'hide_delete_link_css');

// ? Get Site Settings
function get_site_settings_id()
{
    $id = get_transient('site_settings_single_id');
    if ($id !== false) return $id;

    $posts = get_posts(array(
        'post_type'   => 'site_settings',
        'post_status' => 'publish',
        'numberposts' => 1, // одна запись настроек
        'fields'      => 'ids',
    ));

    if (empty($posts)) return false;
    $id = $posts[0];
    set_transient('site_settings_single_id', $id, HOUR_IN_SECONDS);
    return $id;
}









/**
 * Получить URL страницы по файлу шаблона в папке page-templates.
 *
 * @param string $template_slug Имя шаблона без папки, например 'tpl-contacts.php' или без 'tpl-' — 'contacts.php'.
 * @return string|false URL страницы или false, если не найдена.
 */
function get_url_by_page_template($template_slug)
{
    // Нормализуем имя файла шаблона
    $template_slug = ltrim($template_slug, '/');
    // Если передали без префикса tpl-, попытка подставить
    $candidates = array($template_slug);
    if (strpos($template_slug, 'tpl-') !== 0) {
        $candidates[] = 'tpl-' . $template_slug;
    }
    // Если передали без .php — добавить
    foreach ($candidates as &$c) {
        if (pathinfo($c, PATHINFO_EXTENSION) === '') {
            $c .= '.php';
        }
    }
    unset($c);

    // Кэш ключ
    $cache_key = 'page_template_url_' . md5(implode('|', $candidates));
    $cached = get_transient($cache_key);
    if ($cached !== false) {
        return $cached;
    }

    $args = array(
        'post_type'   => 'page',
        'post_status' => 'publish',
        'numberposts' => 1,
        'fields'      => 'ids',
        'meta_query'  => array(
            'relation' => 'OR',
        ),
    );

    foreach ($candidates as $candidate) {
        $args['meta_query'][] = array(
            'key'   => '_wp_page_template',
            'value' => 'page-templates/' . $candidate,
        );
        $args['meta_query'][] = array(
            'key'   => '_wp_page_template',
            'value' => $candidate, // на случай, если шаблон сохранён без папки
        );
    }

    $pages = get_posts($args);

    if (empty($pages)) {
        return false;
    }

    $url = get_permalink($pages[0]);
    // Кэшируем на 1 час
    set_transient($cache_key, $url, HOUR_IN_SECONDS);
    return $url;
}

// ? Menu 
function my_theme_menus()
{
    register_nav_menus(array(
        'header_menu' => 'Меню в шапке',
        // 'footer_menu' => 'Меню в подвале',

        'footer_company'  => 'Футер: Компания',
        'footer_services' => 'Футер: Услуги',
        'footer_legal'    => 'Футер: Юридическая инфа (низ)',
    ));
}
add_action('after_setup_theme', 'my_theme_menus');


add_filter('wp_nav_menu_objects', function ($items) {
    foreach ($items as $item) {
        $item->classes[] = 'header-menu__item';
        // if (strpos($item->url, '#') !== false) {
        // }
    }
    return $items;
});


add_filter('nav_menu_link_attributes', function ($atts, $item) {
    $atts['class'] = 'header-menu__link';

    // Проверяем, является ли ссылка якорной (содержит #)
    if (strpos($item->url, '#') !== false) {
        // Получаем домашний URL для текущего языка (или обычный, если плагин отключен)
        $home_url = function_exists('pll_home_url') ? pll_home_url() : home_url('/');

        // Очищаем ссылку от лишних слешей и склеиваем
        // rtrim убирает слеш у home_url, а ltrim у ссылки, чтобы не было //
        $anchor = ltrim($item->url, '/');
        $atts['href'] = rtrim($home_url, '/') . '/' . $anchor;
    }

    return $atts;
}, 10, 2);