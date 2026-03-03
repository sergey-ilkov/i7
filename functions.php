<?php

/**
 * Функции и настройки темы
 */

function my_theme_scripts()
{

    wp_enqueue_style('swiper-style', get_template_directory_uri() . '/assets/libs/swiper-bundle.min.css', array(), '12.1.2');

    wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/main.css', array('swiper-style'), '1.0.0');


    wp_enqueue_script('gsap', get_template_directory_uri() . '/assets/libs/gsap.min.js', array(), null, true);
    wp_enqueue_script('gsap-scroll-trigger', get_template_directory_uri() . '/assets/libs/ScrollTrigger.min.js', array('gsap'), null, true);
    wp_enqueue_script('gsap-scroll-to', get_template_directory_uri() . '/assets/libs/ScrollToPlugin.min.js', array('gsap'), null, true);
    wp_enqueue_script('gsap-split-text', get_template_directory_uri() . '/assets/libs/SplitText.min.js', array('gsap'), null, true);


    wp_enqueue_script('lenis', get_template_directory_uri() . '/assets/libs/lenis.min.js', array('gsap'), null, true);


    wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/libs/swiper-bundle.min.js', array(), null, true);


    if (is_page_template(array('page-templates/tpl-branding.php', 'page-templates/tpl-solutions.php'))) {
        wp_enqueue_script('lottie', get_template_directory_uri() . '/assets/libs/lottie.min.js', array(), null, true);
    }


    if (is_page_template(array('page-templates/tpl-solutions.php'))) {
        wp_enqueue_script('gsap-motion-path', get_template_directory_uri() . '/assets/libs/MotionPathPlugin.min.js', array('gsap'), null, true);
    }


    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);


    wp_localize_script('main-js', 'themeData', array(
        'templateUrl' => get_template_directory_uri()
    ));
}


add_action('wp_enqueue_scripts', 'my_theme_scripts');


function add_defer_attribute($tag, $handle)
{

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


// ? acf-json
add_filter('acf/settings/save_json', function ($path) {

    return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function ($paths) {
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});



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
        'public'              => true,
        'publicly_queryable'  => false,
        'exclude_from_search' => true,
        'has_archive'         => false,
        'show_in_nav_menus'   => false,
        'show_ui'             => true,
        'menu_position' => 25,
        'menu_icon' => 'dashicons-images-alt2',
        'supports' => array('title'),
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
        'public'              => true,
        'publicly_queryable'  => false,
        'exclude_from_search' => true,
        'has_archive'         => false,
        'show_in_nav_menus'   => false,
        'show_ui'             => true,

        'menu_position' => 25,
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title'),
    );

    register_post_type('specialist_slides', $args);
}
add_action('init', 'register_specialist_slides_cpt');


// ? CPT Portfolio and Portfolio slide
function register_portfolio_cpt()
{
    // 1. Сам Проект (Приложение)
    register_post_type('projects', array(
        'labels' => array('name' => 'Портфолио', 'singular_name' => 'Проект (projects)'),
        'public'              => true,
        'publicly_queryable'  => false,
        'exclude_from_search' => true,
        'has_archive'         => false,
        'show_in_nav_menus'   => false,
        'show_ui'             => true,
        'menu_position' => 25,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => array('title'),
    ));
    // 2. Слайды для проектов
    register_post_type('project_slides', array(
        'labels' => array('name' => 'Слайды портфолио', 'singular_name' => 'Слайд (project_slides)'),
        'public'              => true,
        'publicly_queryable'  => false,
        'exclude_from_search' => true,
        'has_archive'         => false,
        'show_in_nav_menus'   => false,
        'show_ui'             => true,
        'menu_position' => 25,
        'menu_icon' => 'dashicons-images-alt2',
        'supports' => array('title'),
    ));
}
add_action('init', 'register_portfolio_cpt');



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

        'public' => true,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'show_in_nav_menus'  => false,
        'show_ui' => true,
        'has_archive' => false,
        'menu_position' => 25,
        'menu_icon' => 'dashicons-admin-generic',
        'supports' => array('title'),
        'show_in_rest' => false,
    );
    register_post_type('site_settings', $args);
}
add_action('init', 'register_site_settings_cpt');



// ? unique value direction_id
function validate_unique_direction_id($valid, $value, $field, $input)
{

    if (!$valid) return $valid;


    $post_id = isset($_POST['post_ID']) ? $_POST['post_ID'] : 0;


    $args = array(
        'post_type'  => 'specialist_slides',
        'post_status' => array('publish', 'draft', 'pending'),
        'post__not_in' => array($post_id),
        'meta_query' => array(
            array(
                'key'     => 'direction_id',
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

add_filter('acf/validate_value/name=direction_id', 'validate_unique_direction_id', 10, 4);




function remove_site_settings_add_menus()
{

    remove_submenu_page('edit.php?post_type=site_settings', 'post-new.php?post_type=site_settings');
}
add_action('admin_menu', 'remove_site_settings_add_menus', 999);


function remove_site_settings_admin_bar($wp_admin_bar)
{
    $wp_admin_bar->remove_node('new-site_settings');
}
add_action('admin_bar_menu', 'remove_site_settings_admin_bar', 999);


function hide_add_new_completely()
{
    global $pagenow;
    if (get_post_type() == 'site_settings') {

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



function hide_add_new_settings_button()
{
    global $pagenow;
    if (($pagenow == 'edit.php' || $pagenow == 'post.php' || $pagenow == 'post-new.php') && get_post_type() == 'site_settings') {

        $count_posts = wp_count_posts('site_settings');
        $published_posts = $count_posts->publish;


        if ($published_posts >= 1 && $pagenow != 'post.php') {
            echo '<style>.page-title-action { display:none !important; }</style>';
        }
    }
}
add_action('admin_head', 'hide_add_new_settings_button');


function hide_add_new_inside_post()
{
    $screen = get_current_screen();

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


function restrict_site_settings_deletion($caps, $cap, $user_id, $args)
{

    if ($cap === 'delete_post' || $cap === 'delete_posts') {

        if (isset($args[0])) {
            $post = get_post($args[0]);
            if ($post && $post->post_type === 'site_settings') {
                $caps[] = 'do_not_allow';
            }
        }
    }
    return $caps;
}
add_filter('user_has_cap', 'restrict_site_settings_deletion', 10, 4);


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

    $settings = get_posts([
        'post_type'      => 'site_settings',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
        'suppress_filters' => false,
    ]);

    if (!empty($settings)) {
        return $settings[0]->ID;
    }

    return null;
}


function get_url_by_template($template_name)
{
    $args = [
        'post_type'  => 'page',
        'fields'     => 'ids',
        'nopaging'   => true,
        'meta_key'   => '_wp_page_template',
        'meta_value' => $template_name,
        'posts_per_page' => 1,
        'suppress_filters' => false,
    ];

    $pages = get_posts($args);

    if (!empty($pages)) {
        return get_permalink($pages[0]);
    }

    return home_url('/');
}


// ? Menu 
function my_theme_menus()
{
    register_nav_menus(array(
        'header_menu' => 'Меню в шапке',

        'footer_company'  => 'Футер: Компания',
        'footer_services' => 'Футер: Услуги',
        'footer_legal'    => 'Футер: Юридическая инфа (низ)',
    ));
}
add_action('after_setup_theme', 'my_theme_menus');


add_filter('wp_nav_menu_objects', function ($items, $args) {
    foreach ($items as $item) {


        if (isset($args->theme_location)) {

            if ($args->theme_location === 'header_menu') {
                $item->classes[] = 'header-menu__item';
            } elseif ($args->theme_location === 'footer_company' || $args->theme_location === 'footer_services') {
                $item->classes[] = 'footer-list__item';
            }
        }
    }


    return $items;
}, 10, 2);


add_filter('nav_menu_link_attributes', function ($atts, $item, $args) {

    if (!isset($args->theme_location)) return $atts;


    if ($args->theme_location === 'header_menu') {
        $atts['class'] = 'header-menu__link';
        if (strpos($item->url, '#') !== false) {

            $home_url = function_exists('pll_home_url') ? pll_home_url() : home_url('/');

            $anchor = ltrim($item->url, '/');
            $atts['href'] = rtrim($home_url, '/') . '/' . $anchor;
        }
    } elseif ($args->theme_location === 'footer_company') {
        $atts['class'] = 'footer-list__item-link';

        if ($item->object === 'page' && $item->object_id) {
            $post = get_post((int) $item->object_id);
            if ($post) {
                $template = get_page_template_slug($post);

                if ($template === 'page-templates/tpl-digital.php') {
                    $atts['data-slider-id'] = '0';
                }
            }
        }
    } elseif ($args->theme_location === 'footer_services') {
        $atts['class'] = 'footer-list__item-link';
    }


    return $atts;
}, 10, 3);




class Walker_No_LI extends \Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = array()) {}
    public function end_lvl(&$output, $depth = 0, $args = array()) {}

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {

        $title = apply_filters('the_title', $item->title, $item->ID);
        $url   = $item->url ? esc_url($item->url) : '';
        $atts  = ' class="footer-bottom__link"';

        $link = '<a href="' . $url . '"' . $atts . '>' . esc_html($title) . '</a>';
        $output .= '<div class="footer-bottom__item">' . $link . '</div>';
    }

    public function end_el(&$output, $item, $depth = 0, $args = array()) {}
}


// ? Contacts form 7
add_filter('wpcf7_load_js', '__return_false');
add_filter('wpcf7_load_css', '__return_false');





add_action('wp_enqueue_scripts', function () {
    $form_messages = get_field('contacts_form_messages');
    $messages = null;
    $validation_phone_min = get_field('validation_phone_min');
    if ($form_messages) {
        $messages = [
            'send' => $form_messages['message_send'],
            'success' => $form_messages['message_success'],
            'error' => $form_messages['message_error'],
            'error_server' => $form_messages['message_server_error'],
            'validation_required' => $form_messages['message_validation_required'],
            'validation_email' => $form_messages['message_validation_email'],
            'validation_phone' => $form_messages['message_validation_phone'],
        ];
    }

    wp_localize_script('main-js', 'wp_data', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'rest_url' => esc_url_raw(rest_url('contact-form-7/v1/contact-forms/642/feedback')),
        'nonce'    => wp_create_nonce('wp_rest'),
        'messages' => $messages,
        'validation_phone_min' => $validation_phone_min,
    ]);
});




add_filter('wpcf7_skip_mail', 'custom_spam_silent_drop', 10, 2);

function custom_spam_silent_drop($skip, $submission)
{

    $submission = \WPCF7_Submission::get_instance();

    $data = $submission->get_posted_data();


    if (!empty($data['email_confirm'])) {
        return true;
    }

    $obfuscated_id = isset($data['form_unique_id']) ? $data['form_unique_id'] : '';

    $timestamp_str = preg_replace('/[^0-9]/', '', $obfuscated_id);
    $submitted_time = intval(substr($timestamp_str, 0, 10));

    $current_time = time();
    $diff = $current_time - $submitted_time;


    if ($diff < 5 || $submitted_time === 0) {
        return true;
    }

    return $skip;
}


// ? 404
add_action('init', function () {
    if (function_exists('pll_register_string')) {

        pll_register_string('404_title', 'Oops! Page not found', 'i7theme 404');
        pll_register_string('404_text', "The link you followed may be broken", 'i7theme 404');
        pll_register_string('404_link', 'Back to home', 'i7theme 404');
    }
});


// ? title tag
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
});