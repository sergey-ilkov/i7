<?php

// use \WP_Query;

add_filter('body_class', function ($classes) {
    $classes[] = 'page-home';
    return $classes;
});


get_header();


?>




<!-- 
// ? All Fields
<section class="query" style="color:#000; ">

    <?php

    global $post;
    $post_id = $post->ID;
    $fields = get_fields($post_id); // вернёт ассоц. массив полей ACF для указанного поста

    echo '<br><br>';
    echo '<pre>';

    var_dump($fields);

    echo '</pre>';
    echo '<br><br>';

    ?>

</section>
 -->






<main>

    <?php


    // Запрашиваем слайды
    $slides_query = new \WP_Query(array(
        'post_type' => 'hero_slides',
        'posts_per_page' => 4, // Ограничим четырьмя
        'order' => 'ASC'
    ));



    ?>


    <section class="hero">



        <video id="mainVideo" class="main-video track-visibility" playsinline muted autoplay loop poster="<?php echo $fields['hero_poster'] ? esc_url($fields['hero_poster']) : ''; ?>" data-src="<?php echo $fields['hero_video'] ? esc_url($fields['hero_video']) : '';  ?>"></video>


        <div class="container-max">

            <div class="hero-inner">

                <div class="hero-content-box">

                    <div id="real-clock" class="real-clock">
                        <span id="real-time" class="real-time"></span>
                        <span id="real-date" class="real-date"></span>
                    </div>

                    <div class="hero-content">
                        <h1 class="hero__title">

                            <?php echo $fields['hero_title'] ?  esc_html($fields['hero_title']) : ''; ?>

                        </h1>
                        <p class="hero__desc">

                            <?php echo $fields['hero_desc'] ?  wp_kses_post($fields['hero_desc']) : ''; ?>

                        </p>
                    </div>

                </div>

                <div class="hero-thumbs-wrap">

                    <div id="hero-thumbs" class="hero-thumbs" role="list">


                        <?php if ($slides_query->have_posts()) : while ($slides_query->have_posts()) : $slides_query->the_post();
                                $link_url = get_field('slide_link');
                                $slide_video = get_field('slide_video');
                                $slide_poster = get_field('slide_poster');

                                $slide_thumb_id = get_field('slide_thumb');

                                $image_url = null;
                                $width = 130;
                                $height = 130;
                                $image_alt = null;

                                if ($slide_thumb_id) {
                                    $image_url = wp_get_attachment_url($slide_thumb_id);
                                    $image_alt = get_post_meta($slide_thumb_id, '_wp_attachment_image_alt', true);

                                    $image_meta = wp_get_attachment_metadata($slide_thumb_id);
                                    $width  = isset($image_meta['width']) ? $image_meta['width'] : null;
                                    $height = isset($image_meta['height']) ? $image_meta['height'] : null;
                                }


                        ?>


                        <a class="hero-thumb" href="<?php echo esc_url($link_url); ?>" data-video="<?php echo esc_url($slide_video); ?>" data-poster="<?php echo esc_url($slide_poster); ?>">
                            <img width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height); ?>" src="<?php echo  $image_url ? esc_url($image_url) : ''; ?>" alt="<?php echo $image_alt ? esc_attr($image_alt) : ''; ?>">
                        </a>


                        <?php endwhile;
                            wp_reset_postdata();
                        endif; ?>



                    </div>

                </div>



            </div>


        </div>












        <div id="hero-slider" class="hero-slider">


            <div class="hero-slider-wrapper">


                <?php if ($slides_query->have_posts()) : while ($slides_query->have_posts()) : $slides_query->the_post();

                        $slide_title = get_field('slide_title');
                        $slide_desc = get_field('slide_desc');
                ?>


                <div class="hero-slide">
                    <div class="hero-slide-video" aria-hidden="true"></div>

                    <div class="hero-slide-content">
                        <h2 class="hero-slide__title">
                            <?php echo esc_html($slide_title); ?>
                        </h2>
                        <p class="hero-slide__desc">
                            <?php echo esc_html($slide_desc); ?>
                        </p>
                    </div>
                </div>

                <?php endwhile;
                    wp_reset_postdata();
                endif; ?>



            </div>


        </div>









    </section>




    <section class="home-bg-wrap">

        <span class="home-bg-wrap-decor-1"></span>
        <span class="home-bg-wrap-decor-2"></span>





        <?php

        $card1 = $fields['card_1'];
        $card2 = $fields['card_2'];
        $card3 = $fields['card_3'];


        $card1_image_desktop_url = null;
        $card1_image_mobile_url = null;
        $card1_width = 466;
        $card1_height = 300;
        $card1_image_alt = null;

        $card1_image_desktop_id = $card1 ? $card1['image_desktop'] : null;
        $card1_image_mobile_id = $card1 ? $card1['image_mobile'] : null;

        if ($card1_image_desktop_id) {
            $card1_image_desktop_url = wp_get_attachment_url($card1_image_desktop_id);
            $card1_image_alt = get_post_meta($card1_image_desktop_id, '_wp_attachment_image_alt', true);

            $card1_image_meta = wp_get_attachment_metadata($card1_image_desktop_id);
            $card1_width  = isset($card1_image_meta['width']) ? $card1_image_meta['width'] : null;
            $card1_height = isset($card1_image_meta['height']) ? $card1_image_meta['height'] : null;
        }
        if ($card1_image_mobile_id) {
            $card1_image_mobile_url = wp_get_attachment_url($card1_image_desktop_id);
        }

        $card2_image_desktop_url = null;
        $card2_image_mobile_url = null;
        $card2_width = 466;
        $card2_height = 300;
        $card2_image_alt = null;

        $card2_image_desktop_id = $card2 ? $card2['image_desktop'] : null;
        $card2_image_mobile_id = $card2 ? $card2['image_mobile'] : null;

        if ($card2_image_desktop_id) {
            $card2_image_desktop_url = wp_get_attachment_url($card2_image_desktop_id);
            $card2_image_alt = get_post_meta($card2_image_desktop_id, '_wp_attachment_image_alt', true);

            $card2_image_meta = wp_get_attachment_metadata($card2_image_desktop_id);
            $card2_width  = isset($card2_image_meta['width']) ? $card2_image_meta['width'] : null;
            $card2_height = isset($card2_image_meta['height']) ? $card2_image_meta['height'] : null;
        }
        if ($card2_image_mobile_id) {
            $card2_image_mobile_url = wp_get_attachment_url($card2_image_desktop_id);
        }

        $card3_image_desktop_url = null;
        $card3_image_mobile_url = null;
        $card3_width = 466;
        $card3_height = 300;
        $card3_image_alt = null;

        $card3_image_desktop_id = $card3 ? $card3['image_desktop'] : null;
        $card3_image_mobile_id = $card3 ? $card3['image_mobile'] : null;

        if ($card3_image_desktop_id) {
            $card3_image_desktop_url = wp_get_attachment_url($card3_image_desktop_id);
            $card3_image_alt = get_post_meta($card3_image_desktop_id, '_wp_attachment_image_alt', true);

            $card3_image_meta = wp_get_attachment_metadata($card3_image_desktop_id);
            $card3_width  = isset($card3_image_meta['width']) ? $card3_image_meta['width'] : null;
            $card3_height = isset($card3_image_meta['height']) ? $card3_image_meta['height'] : null;
        }
        if ($card3_image_mobile_id) {
            $card3_image_mobile_url = wp_get_attachment_url($card3_image_desktop_id);
        }



        ?>

        <!-- ? recommendations -->
        <div class="recommendations">


            <div class="recommendations-cards">


                <div class="recommendations-card ">

                    <div class="recommendations-card-content">
                        <div class="recommendations-card-image">

                            <picture>
                                <source media="(max-width: 800px)" srcset="<?php echo  $card1_image_mobile_url ? esc_url($card1_image_mobile_url) : ''; ?>" />
                                <img width="<?php echo esc_attr($card1_width); ?>" height="<?php echo esc_attr($card1_height); ?>" class="recommendations-card__img lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo  $card1_image_desktop_url ? esc_url($card1_image_desktop_url) : ''; ?>" alt="<?php echo $card1_image_alt ? esc_attr($card1_image_alt) : ''; ?>" />
                            </picture>

                        </div>


                        <p class="recommendations-card__text">

                            <?php echo $card1 ? esc_html($card1['desc']) : ''; ?>

                        </p>

                    </div>

                    <div class="recommendations-card-btn">
                        <div class="recommendations-card__btn-icon">
                            <svg class="card-svg-icon" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M49 49L49 2L2 2M11 16.5L11 40L35 40" stroke="currentColor" stroke-width="4" stroke-linecap="round" />
                            </svg>
                            <svg class="card-svg-icon-hidden" width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M38.4141 39L38.4141 2M38.4141 2L1.41406 2M38.4141 2L1.41406 39" stroke="currentColor" stroke-width="4" />
                            </svg>
                        </div>
                        <div class="recommendations-card__btn-wrap">

                            <div class="recommendations-card__btn-text">

                                <?php echo $card1 ? esc_html($card1['title']) : ''; ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="recommendations-card ">


                    <div class="recommendations-card-content">
                        <div class="recommendations-card-image">



                            <picture>
                                <source media="(max-width: 800px)" srcset="<?php echo  $card2_image_mobile_url ? esc_url($card2_image_mobile_url) : ''; ?>" />
                                <img width="<?php echo esc_attr($card2_width); ?>" height="<?php echo esc_attr($card2_height); ?>" class="recommendations-card__img lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo  $card2_image_desktop_url ? esc_url($card2_image_desktop_url) : ''; ?>" alt="<?php echo $card2_image_alt ? esc_attr($card2_image_alt) : ''; ?>" />
                            </picture>


                        </div>



                        <p class="recommendations-card__text">

                            <?php echo $card1 ? esc_html($card1['desc']) : ''; ?>

                        </p>
                    </div>

                    <div class="recommendations-card-btn">
                        <div class="recommendations-card__btn-icon">
                            <svg class="card-svg-icon" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M49 49L49 2L2 2M11 16.5L11 40L35 40" stroke="currentColor" stroke-width="4" stroke-linecap="round" />
                            </svg>
                            <svg class="card-svg-icon-hidden" width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M38.4141 39L38.4141 2M38.4141 2L1.41406 2M38.4141 2L1.41406 39" stroke="currentColor" stroke-width="4" />
                            </svg>
                        </div>
                        <div class="recommendations-card__btn-wrap">
                            <div class="recommendations-card__btn-text">

                                <?php echo $card2 ? esc_html($card2['title']) : ''; ?>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="recommendations-card">


                    <div class="recommendations-card-content">
                        <div class="recommendations-card-image">



                            <picture>
                                <source media="(max-width: 800px)" srcset="<?php echo  $card3_image_mobile_url ? esc_url($card3_image_mobile_url) : ''; ?>" />
                                <img width="<?php echo esc_attr($card3_width); ?>" height="<?php echo esc_attr($card3_height); ?>" class="recommendations-card__img lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo  $card3_image_desktop_url ? esc_url($card3_image_desktop_url) : ''; ?>" alt="<?php echo $card3_image_alt ? esc_attr($card3_image_alt) : ''; ?>" />
                            </picture>


                        </div>

                        <p class="recommendations-card__text">

                            <?php echo $card1 ? esc_html($card1['desc']) : ''; ?>

                        </p>
                    </div>

                    <div class="recommendations-card-btn">
                        <div class="recommendations-card__btn-icon">
                            <svg class="card-svg-icon" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M49 49L49 2L2 2M11 16.5L11 40L35 40" stroke="currentColor" stroke-width="4" stroke-linecap="round" />
                            </svg>
                            <svg class="card-svg-icon-hidden" width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M38.4141 39L38.4141 2M38.4141 2L1.41406 2M38.4141 2L1.41406 39" stroke="currentColor" stroke-width="4" />
                            </svg>
                        </div>
                        <div class="recommendations-card__btn-wrap">

                            <div class="recommendations-card__btn-text">

                                <?php echo $card3 ? esc_html($card3['title']) : ''; ?>

                            </div>
                        </div>
                    </div>
                </div>



            </div>




        </div>




        <?php

        $service1 = $fields['service_1'];
        $service2 = $fields['service_2'];
        $service3 = $fields['service_3'];
        $service4 = $fields['service_4'];

        $home_portfolio_title = $fields['home_portfolio_title'];
        $home_portfolio_desc =  $fields['home_portfolio_desc'];

        ?>


        <!-- ? GSAP Pin -->
        <div class="services-portfolio-wrap">


            <div class="home-portfolio">



                <div class="services container">

                    <div class="services__items">
                        <div class="services__item">
                            <h3 class="services__item-title">

                                <?php echo $service1 ? esc_html($service1['title']) : ''; ?>

                            </h3>

                            <p class="services__item-desc">

                                <?php echo $service1 ? esc_html($service1['desc']) : ''; ?>

                            </p>
                        </div>
                        <div class="services__item">
                            <h3 class="services__item-title">

                                <?php echo $service2 ? esc_html($service2['title']) : ''; ?>

                            </h3>

                            <p class="services__item-desc">

                                <?php echo $service2 ? esc_html($service2['desc']) : ''; ?>

                            </p>
                        </div>
                        <div class="services__item">
                            <h3 class="services__item-title">

                                <?php echo $service3 ? esc_html($service3['title']) : ''; ?>

                            </h3>

                            <p class="services__item-desc">

                                <?php echo $service3 ? esc_html($service3['desc']) : ''; ?>

                            </p>
                        </div>
                        <div class="services__item">
                            <h3 class="services__item-title">

                                <?php echo $service4 ? esc_html($service4['title']) : ''; ?>

                            </h3>

                            <p class="services__item-desc">

                                <?php echo $service4 ? esc_html($service4['desc']) : ''; ?>

                            </p>
                        </div>


                    </div>



                    <div class="home-portfolio-circle-wrap">
                        <span class="home-portfolio-title-circle"></span>

                        <div class="home-portfolio-circle-content">
                            <h2 class="home-portfolio__title">

                                <?php echo esc_html($home_portfolio_title); ?>

                            </h2>

                            <p class="home-portfolio__desc">

                                <?php echo esc_html($home_portfolio_desc); ?>



                            </p>
                        </div>

                    </div>

                    <span class="home-bg-wrap-decor-3"></span>
                    <span class="home-bg-wrap-decor-4"></span>

                </div>




                <div class="home-portfolio-bg">

                    <div id="home-portfolio" class="home-portfolio-wrap container">



                        <?php
                        // ? sliders and slides
                        // 1. Получаем все проекты
                        $projects_posts = get_posts([
                            'post_type'      => 'projects',
                            'posts_per_page' => -1,
                            'suppress_filters' => false, // Чтобы Polylang отфильтровал по языку

                            // 'meta_key'       => 'project_sort', // Ключ поля, по которому сортируем
                            // 'orderby'        => 'meta_value_num', // Сортируем как числа (а не как текст!)
                            // 'order'          => 'ASC',            // От меньшего к большему (1, 2, 3...)

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
                                    'preview_id'     => $slider['preview'],

                                ];
                            }
                        }


                        // echo '<pre>';
                        // var_dump(get_field('project_sort', $projects_posts[0]->ID));
                        // var_dump($projects_posts);
                        // var_dump(get_field('portfolio_slider', $projects_posts[0]->ID));
                        // var_dump($all_slides_posts);
                        // echo '</pre>';

                        ?>


                        <div id="home-portfolio-slider" class="swiper home-portfolio-slider">

                            <div class="swiper-wrapper">

                                <?php
                                $i = 0;
                                foreach ($prepared_projects as $item) :


                                    $digital_url = get_url_by_page_template('tpl-digital.php');
                                    if (!$digital_url) {
                                        $digital_url = home_url('/');
                                    }

                                    $image = wp_get_attachment_image($item['preview_id'], 'full', false, array('loading' => 'lazy')) ?? null;

                                    $index = $i;
                                    $i++;
                                ?>


                                <div class="swiper-slide">
                                    <div class="home-portfolio__slide">
                                        <a class="home-portfolio__link" href="<?php echo esc_url($digital_url); ?>" data-slider-id="<?php echo $index; ?>">

                                            <?php echo $image ? $image : '' ?>

                                        </a>
                                    </div>

                                </div>




                                <?php endforeach; ?>



                            </div>

                            <div class="home-portfolio-btns-wrap">
                                <button class="home-portfolio-btn-prev">
                                    <svg width="16" height="29" viewBox="0 0 16 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.8477 0.353516L0.705521 14.4957L14.8477 28.6378" stroke="currentColor" />
                                    </svg>
                                </button>

                                <button class="home-portfolio-btn-next">
                                    <svg width="16" height="29" viewBox="0 0 16 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.355469 0.353516L14.4976 14.4957L0.355469 28.6378" stroke="currentColor" />
                                    </svg>
                                </button>
                            </div>

                        </div>







                    </div>



                </div>

            </div>


        </div>







    </section>


    // ? appointment section

    <section class="appointment section-bg" style="--section-bg: #fff;">

        <?php get_template_part('template-parts/section', 'specialists'); ?>

    </section>


</main>



<?php get_footer(); ?>