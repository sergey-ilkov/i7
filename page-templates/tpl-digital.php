<?php
/*
Template Name: Digital Page
*/
?>


<?php

add_filter('body_class', function ($classes) {
    $classes[] = 'page-digital';
    return $classes;
});


get_header();

?>



<?php
// ? sliders and slides
// 1. Получаем все проекты
$projects_posts = get_posts([
    'post_type'      => 'projects',
    'posts_per_page' => -1,
    'suppress_filters' => false, // Чтобы Polylang отфильтровал по языку
    'meta_key'       => 'project_sort', // Ключ поля, по которому сортируем
    // Сортируем как числа (а не как текст!)
    'orderby'        => [
        'meta_value_num' => 'ASC',
        'title'          => 'ASC' // Если цифры равны, сортируй по алфавиту
    ],
    'order'          => 'ASC',            // От меньшего к большему (1, 2, 3...)
]);

// 2. Получаем ВСЕ слайды одним махом
$all_slides_posts = get_posts([
    'post_type'      => 'project_slides',
    'posts_per_page' => -1,
    'suppress_filters' => false,
    'meta_key'       => 'slide_sort',
    'orderby'        => [
        'meta_value_num' => 'ASC',
        'title'          => 'ASC' // Если цифры равны, сортируй по алфавиту
    ],
    'order'          => 'ASC',
]);

// Группируем слайды по ID родительского проекта для быстрого доступа
$slides_by_project = [];
foreach ($all_slides_posts as $slide) {
    $parent_id = get_field('parent_project', $slide->ID);
    if ($parent_id) {
        $slides_by_project[$parent_id][] = $slide;
    }
}

// 3. Собираем финальный массив только с теми проектами, у которых есть слайды
$prepared_projects = [];
foreach ($projects_posts as $project) {
    $p_id = $project->ID;

    // Проверка: есть ли у этого проекта слайды?
    if (isset($slides_by_project[$p_id]) && !empty($slides_by_project[$p_id])) {

        $slider = get_field('portfolio_slider', $p_id);
        $prepared_projects[] = [
            'id'       => $p_id,
            'color'     => $slider['color'],
            'logo_light'     => $slider['logo_light'],
            'logo_dark'     => $slider['logo_dark'],
            'link_ios'     => $slider['link_ios'],
            'qr_ios'     => $slider['qr_ios'],
            'link_android'     => $slider['link_android'],
            'qr_android'     => $slider['qr_android'],

            'slides'   => $slides_by_project[$p_id]
        ];
    }
}

$color_def = '#1b1b1b';

?>




<main>

    <?php

    $digital_title = get_field('digital_title');
    $digital_desc = get_field('digital_desc');
    $scroll_text  = get_field('scroll_text');
    $digital_poster = get_field('digital_poster');
    $digital_video  = get_field('digital_video');

    $portfolio_title  = get_field('portfolio_title');



    ?>


    <div id="digital-pin-wrap" class="digital-pin-wrap">


        <section id="hero-digital" class="hero-digital container-max" style="--section-bg: #0088ff;">


            <div class="hero-card-wrap">
                <div class="hero-card-box">
                    <div class="hero-card-content">
                        <h1 class="hero-card__title">

                            <?php echo $digital_title ?  esc_html($digital_title) : ''; ?>

                        </h1>
                        <div class="hero-card-desc">
                            <p>



                                <?php echo $digital_desc ?  wp_kses_post($digital_desc) : ''; ?>

                            </p>
                        </div>
                    </div>

                    <div id="hero-card-scroll-wrap" class="hero-card-scroll-wrap">
                        <div class="hero-card-scroll-content">
                            <span class="hero-card-scroll-item">

                                <?php echo $scroll_text ?  esc_html($scroll_text) : ''; ?>

                            </span>
                        </div>
                    </div>

                </div>

            </div>


        </section>



        <div class="hero-digital-wrap">

            <div class="hero-digital-sticky">


                <video id="mainVideo" class="main-video track-visibility" playsinline muted autoplay loop poster="<?php echo $digital_poster ? esc_url($digital_poster) : ''; ?>" data-src="<?php echo $digital_video ? esc_url($digital_video) : '';  ?>"></video>





                <?php get_template_part('template-parts/hero', 'messages'); ?>


            </div>
        </div>






        <section id="portfolio" class="portfolio  section-bg" style="--section-bg: #1b1b1b;">

            <div class="trigger-point" style="position: absolute; top: 50%; height: 1px; width: 100%;"></div>

            <div class="portfolio-preloader-wrap">
                <h2 class="portfolio__title">

                    <?php echo $portfolio_title ?  esc_html($portfolio_title) : ''; ?>

                </h2>
                <div class="portfolio-preloader-bg"></div>
            </div>

            <div class="portfolio-wrap">

                <div class="portfolio-sliders">



                    <?php foreach ($prepared_projects as $item) : ?>


                        <div class="portfolio-slider-wrap" style="--slider-bg: <?php echo $item['color'] ? esc_attr($item['color']) : $color_def; ?>;">
                            <div class="swiper portfolio-slider">
                                <div class="swiper-wrapper">


                                    <?php foreach ($item['slides'] as $slide) :

                                        $image_desktop_id = get_field('image_desktop', $slide->ID);
                                        $image_mobile_id = get_field('image_mobile', $slide->ID);


                                        $image_desktop = null;
                                        $width = 1920;
                                        $height = 1080;
                                        $image_mobile = null;
                                        $image_alt = null;
                                        if ($image_desktop_id && $image_mobile_id) {

                                            $image_desktop = wp_get_attachment_url($image_desktop_id);
                                            $image_alt = get_post_meta($image_desktop_id, '_wp_attachment_image_alt', true);
                                            // Ширина и высота оригинала
                                            $image_meta = wp_get_attachment_metadata($image_desktop_id);
                                            $width  = isset($image_meta['width']) ? $image_meta['width'] : null;
                                            $height = isset($image_meta['height']) ? $image_meta['height'] : null;

                                            $image_mobile = wp_get_attachment_url($image_mobile_id);
                                        }
                                    ?>


                                        <div class="swiper-slide">
                                            <div class="portfolio-slide">

                                                <picture>
                                                    <source media="(max-width: 500px)" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="<?php echo $image_mobile ? esc_url($image_mobile) : ''; ?>" />
                                                    <img width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height); ?>" class="lazy portfolio-slide__img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo $image_desktop ? esc_url($image_desktop) : ''; ?>" alt="<?php echo $image_alt ? esc_attr($image_alt) : ''; ?>" />
                                                </picture>

                                            </div>
                                        </div>


                                    <?php endforeach; ?>





                                </div>
                            </div>

                            <div class="portfolio-slider-control">
                                <button class="portfolio-slider-btn-prev">
                                    <svg width="16" height="29" viewBox="0 0 16 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.8477 0.353516L0.705521 14.4957L14.8477 28.6378" stroke="currentColor" />
                                    </svg>
                                </button>

                                <div class="portfolio-slider-pagination"></div>
                                <button class="portfolio-slider-btn-next">
                                    <svg width="16" height="29" viewBox="0 0 16 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.355469 0.353516L14.4976 14.4957L0.355469 28.6378" stroke="currentColor" />
                                    </svg>
                                </button>
                            </div>


                            <div class="portfolio-slider-links">

                                <a class="portfolio-slider-link" href="<?php echo $item['link_ios'] ? esc_url($item['link_ios']) : '#'; ?>">
                                    <svg class="portfolio-link-svg" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.19444 0.75H13.8611C14.1066 0.75 14.3056 0.948985 14.3056 1.19444V6.97222M10.0833 4.30556V9.63889C10.0833 9.88435 9.88435 10.0833 9.63889 10.0833H1.19444C0.948985 10.0833 0.75 10.2823 0.75 10.5278V15.4167M3.86111 14.3056H6.97222M18.5278 13.1944V10.5278C18.5278 10.2823 18.3288 10.0833 18.0833 10.0833H14.75C14.5045 10.0833 14.3056 10.2823 14.3056 10.5278V13.8611C14.3056 14.1066 14.1066 14.3056 13.8611 14.3056H10.5278C10.2823 14.3056 10.0833 14.5045 10.0833 14.75V18.0833C10.0833 18.3288 10.2823 18.5278 10.5278 18.5278H13.8611C14.1066 18.5278 14.3056 18.7268 14.3056 18.9722V24.75M23.6389 9.19444V15.8611C23.6389 16.1066 23.4399 16.3056 23.1944 16.3056H17.6389M10.0833 21.8611V24.75M23.6389 23.1944V18.9722C23.6389 18.7268 23.4399 18.5278 23.1944 18.5278H18.9722C18.7268 18.5278 18.5278 18.7268 18.5278 18.9722V23.1944C18.5278 23.4399 18.7268 23.6389 18.9722 23.6389H23.1944C23.4399 23.6389 23.6389 23.4399 23.6389 23.1944ZM5.86111 23.1944V18.9722C5.86111 18.7268 5.66213 18.5278 5.41667 18.5278H1.19444C0.948985 18.5278 0.75 18.7268 0.75 18.9722V23.1944C0.75 23.4399 0.948984 23.6389 1.19444 23.6389H5.41667C5.66213 23.6389 5.86111 23.4399 5.86111 23.1944ZM23.6389 5.41667V1.19444C23.6389 0.948985 23.4399 0.75 23.1944 0.75H18.9722C18.7268 0.75 18.5278 0.948984 18.5278 1.19444V5.41667C18.5278 5.66213 18.7268 5.86111 18.9722 5.86111H23.1944C23.4399 5.86111 23.6389 5.66213 23.6389 5.41667ZM5.86111 5.41667V1.19444C5.86111 0.948985 5.66213 0.75 5.41667 0.75H1.19444C0.948985 0.75 0.75 0.948984 0.75 1.19444V5.41667C0.75 5.66213 0.948984 5.86111 1.19444 5.86111H5.41667C5.66213 5.86111 5.86111 5.66213 5.86111 5.41667Z" stroke="currentColor" stroke-width="1.5" />
                                    </svg>
                                    <span class="portfolio-link-text">IOS</span>
                                    <span class="portfolio-link-icon-ios">
                                        <span class="portfolio-link-icon-light"></span>
                                        <span class="portfolio-link-icon-dark"></span>
                                    </span>

                                    <img width="180" height="180" class="lazy portfolio-slider-qr" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo $item['qr_ios'] ? esc_url($item['qr_ios']) : ''; ?>" alt="qr" />

                                </a>

                                <a class="portfolio-slider-link" href="<?php echo $item['link_android'] ? esc_url($item['link_android']) : '#'; ?>">
                                    <svg class="portfolio-link-svg" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.19444 0.75H13.8611C14.1066 0.75 14.3056 0.948985 14.3056 1.19444V6.97222M10.0833 4.30556V9.63889C10.0833 9.88435 9.88435 10.0833 9.63889 10.0833H1.19444C0.948985 10.0833 0.75 10.2823 0.75 10.5278V15.4167M3.86111 14.3056H6.97222M18.5278 13.1944V10.5278C18.5278 10.2823 18.3288 10.0833 18.0833 10.0833H14.75C14.5045 10.0833 14.3056 10.2823 14.3056 10.5278V13.8611C14.3056 14.1066 14.1066 14.3056 13.8611 14.3056H10.5278C10.2823 14.3056 10.0833 14.5045 10.0833 14.75V18.0833C10.0833 18.3288 10.2823 18.5278 10.5278 18.5278H13.8611C14.1066 18.5278 14.3056 18.7268 14.3056 18.9722V24.75M23.6389 9.19444V15.8611C23.6389 16.1066 23.4399 16.3056 23.1944 16.3056H17.6389M10.0833 21.8611V24.75M23.6389 23.1944V18.9722C23.6389 18.7268 23.4399 18.5278 23.1944 18.5278H18.9722C18.7268 18.5278 18.5278 18.7268 18.5278 18.9722V23.1944C18.5278 23.4399 18.7268 23.6389 18.9722 23.6389H23.1944C23.4399 23.6389 23.6389 23.4399 23.6389 23.1944ZM5.86111 23.1944V18.9722C5.86111 18.7268 5.66213 18.5278 5.41667 18.5278H1.19444C0.948985 18.5278 0.75 18.7268 0.75 18.9722V23.1944C0.75 23.4399 0.948984 23.6389 1.19444 23.6389H5.41667C5.66213 23.6389 5.86111 23.4399 5.86111 23.1944ZM23.6389 5.41667V1.19444C23.6389 0.948985 23.4399 0.75 23.1944 0.75H18.9722C18.7268 0.75 18.5278 0.948984 18.5278 1.19444V5.41667C18.5278 5.66213 18.7268 5.86111 18.9722 5.86111H23.1944C23.4399 5.86111 23.6389 5.66213 23.6389 5.41667ZM5.86111 5.41667V1.19444C5.86111 0.948985 5.66213 0.75 5.41667 0.75H1.19444C0.948985 0.75 0.75 0.948984 0.75 1.19444V5.41667C0.75 5.66213 0.948984 5.86111 1.19444 5.86111H5.41667C5.66213 5.86111 5.86111 5.66213 5.86111 5.41667Z" stroke="currentColor" stroke-width="1.5" />
                                    </svg>
                                    <span class="portfolio-link-text">Android</span>

                                    <span class="portfolio-link-icon-android">
                                        <span class="portfolio-link-icon-light"></span>
                                        <span class="portfolio-link-icon-dark"></span>
                                    </span>
                                    <img width="180" height="180" class="lazy portfolio-slider-qr" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo $item['qr_android'] ? esc_url($item['qr_android']) : ''; ?>" alt="qr" />
                                </a>
                            </div>



                        </div>
                    <?php endforeach; ?>

                </div>



                <div class="portfolio-content-wrap">


                    <?php foreach ($prepared_projects as $item) : ?>

                        <div class="portfolio-slider-contents">

                            <?php foreach ($item['slides'] as $slide) : ?>


                                <div class="portfolio-slide-content">
                                    <h3 class="portfolio-slide-title">

                                        <?php echo get_field('slide_title', $slide->ID); ?>
                                        <!-- Интернет-магазин одежды, обуви и аксессуаров -->

                                    </h3>
                                    <p class="portfolio-slide-desc">
                                        <?php echo get_field('slide_desc', $slide->ID); ?>
                                        <!-- цифровизация вашего бизнеса -->
                                    </p>
                                </div>



                            <?php endforeach; ?>


                        </div>

                    <?php endforeach; ?>









                </div>







                <div class="portfolio-control-menu">






                    <div class="swiper portfolio-menu-slider">
                        <div class="swiper-wrapper">


                            <?php
                            $i = 0;
                            foreach ($prepared_projects as $item) :


                                $logo_light_id = $item['logo_light'];
                                $logo_dark_id = $item['logo_dark'];

                                $logo_light_url = null;
                                $logo_light_alt = null;
                                $logo_light_width = 218;
                                $logo_light_height = 74;
                                if ($logo_light_id) {
                                    $logo_light_url = wp_get_attachment_url($logo_light_id);
                                    $logo_light_alt = get_post_meta($logo_light_id, '_wp_attachment_image_alt', true);
                                    $image_meta = wp_get_attachment_metadata($logo_light_id);
                                    $logo_light_width  = isset($image_meta['width']) ? $image_meta['width'] : null;
                                    $logo_light_height = isset($image_meta['height']) ? $image_meta['height'] : null;
                                }
                                $logo_dark_url = null;
                                $logo_dark_alt = null;
                                $logo_dark_width = 218;
                                $logo_dark_height = 74;
                                if ($logo_dark_id) {
                                    $logo_dark_url = wp_get_attachment_url($logo_dark_id);
                                    $logo_dark_alt = get_post_meta($logo_dark_id, '_wp_attachment_image_alt', true);
                                    $image_meta = wp_get_attachment_metadata($logo_dark_id);
                                    $logo_dark_width  = isset($image_meta['width']) ? $image_meta['width'] : null;
                                    $logo_dark_height = isset($image_meta['height']) ? $image_meta['height'] : null;
                                }


                                $index = $i;
                                $i++;

                            ?>




                                <div class="swiper-slide">
                                    <div class="portfolio-menu-btn" data-index="<?php echo $index; ?>">

                                        <img width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height); ?>" class="lazy portfolio-menu-btn-image" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo $logo_light_url ? esc_url($logo_light_url) : ''; ?>" alt="<?php echo $logo_light_alt ? esc_attr($logo_light_alt) : ''; ?>">
                                        <img width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height); ?>" class="lazy portfolio-menu-btn-image-dark" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo $logo_dark_url ? esc_url($logo_dark_url) : ''; ?>" alt="<?php echo $logo_dark_alt ? esc_attr($logo_dark_alt) : ''; ?>">

                                    </div>
                                </div>

                            <?php endforeach; ?>







                        </div>
                    </div>








                </div>

            </div>



        </section>
    </div>











    <!-- ? appointment -->
    <section class="appointment section-bg" style="--section-bg: #fff;">


        <?php get_template_part('template-parts/section', 'specialists'); ?>


    </section>






</main>



<?php get_footer(); ?>