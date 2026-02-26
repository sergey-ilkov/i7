<?php

// use \WP_Query;

add_filter('body_class', function ($classes) {
    $classes[] = 'page-home';
    return $classes;
});


get_header();


?>



<main>

    <?php

    $hero_title = get_field('hero_title');
    $hero_desc = get_field('hero_desc');
    $hero_poster = get_field('hero_poster');
    $hero_video  = get_field('hero_video');

    // Запрашиваем слайды
    $slides_query = new \WP_Query(array(
        'post_type' => 'hero_slides',
        'posts_per_page' => 4, // Ограничим четырьмя
        'order' => 'ASC'
    ));



    ?>


    <section class="hero">




        <video id="mainVideo" class="main-video track-visibility" playsinline muted autoplay loop poster="<?php echo esc_url($hero_poster); ?>" data-src="<?php echo esc_url($hero_video); ?>"></video>


        <div class="container-max">

            <div class="hero-inner">

                <div class="hero-content-box">

                    <div id="real-clock" class="real-clock">
                        <span id="real-time" class="real-time"></span>
                        <span id="real-date" class="real-date"></span>
                    </div>

                    <div class="hero-content">
                        <h1 class="hero__title">

                            <?php echo esc_html($hero_title); ?>

                        </h1>
                        <p class="hero__desc">

                            <?php echo esc_html($hero_desc); ?>

                        </p>
                    </div>

                </div>

                <div class="hero-thumbs-wrap">

                    <div id="hero-thumbs" class="hero-thumbs" role="list">


                        <?php if ($slides_query->have_posts()) : while ($slides_query->have_posts()) : $slides_query->the_post();
                                $link_url = get_field('slide_link');
                                $slide_thumb = get_field('slide_thumb');
                                $slide_video = get_field('slide_video');
                                $slide_poster = get_field('slide_poster');
                        ?>


                        <a class="hero-thumb" href="<?php echo esc_url($link_url); ?>" data-video="<?php echo esc_url($slide_video); ?>" data-poster="<?php echo esc_url($slide_poster); ?>">
                            <img width="130" height="130" src="<?php echo esc_url($slide_thumb); ?>" alt="digital">
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

        $card1 = get_field('card_1'); // array or null
        $card2 = get_field('card_2'); // array or null
        $card3 = get_field('card_3'); // array or null

        ?>

        <!-- ? recommendations -->
        <div class="recommendations">


            <div class="recommendations-cards">


                <div class="recommendations-card ">

                    <div class="recommendations-card-content">
                        <div class="recommendations-card-image">

                            <picture>
                                <source media="(max-width: 800px)" srcset="<?php echo $card1 ? esc_url($card1['image_mobile']) : ''; ?>" />
                                <img width="466" height="300" class="recommendations-card__img lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo $card1 ? esc_url($card1['image_desktop']) : ''; ?>" alt="Card image" />
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
                                <source media="(max-width: 800px)" srcset="<?php echo $card2 ? esc_url($card2['image_mobile']) : ''; ?>" />
                                <img width="466" height="300" class="recommendations-card__img lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo $card2 ? esc_url($card2['image_desktop']) : ''; ?>" alt="Card image" />
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
                                <source media="(max-width: 800px)" srcset="<?php echo $card3 ? esc_url($card3['image_mobile']) : ''; ?>" />
                                <img width="466" height="300" class="recommendations-card__img lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo $card3 ? esc_url($card3['image_desktop']) : ''; ?>" alt="Card image" />
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

        $service1 = get_field('service_1');
        $service2 = get_field('service_2');
        $service3 = get_field('service_3');
        $service4 = get_field('service_4');

        $home_portfolio_title = get_field('home_portfolio_title');
        $home_portfolio_desc = get_field('home_portfolio_desc');

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

                        <div id="home-portfolio-slider" class="swiper home-portfolio-slider">
                            <div class="swiper-wrapper">

                                <div class="swiper-slide">
                                    <div class="home-portfolio__slide">
                                        <a class="home-portfolio__link" href="./digital.html" data-slider-id="0">
                                            <img width="445" height="445" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/home/portfolio/1.png" alt="">
                                        </a>
                                    </div>

                                </div>
                                <div class="swiper-slide">
                                    <div class="home-portfolio__slide">
                                        <a class="home-portfolio__link" href="./digital.html" data-slider-id="1">

                                            <img width="445" height="445" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/home/portfolio/2.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="home-portfolio__slide">
                                        <a class="home-portfolio__link" href="./digital.html" data-slider-id="2">

                                            <img width="445" height="445" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/home/portfolio/3.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="home-portfolio__slide">
                                        <a class="home-portfolio__link" href="./digital.html" data-slider-id="3">

                                            <img width="445" height="445" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/home/portfolio/4.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="home-portfolio__slide">
                                        <a class="home-portfolio__link" href="./digital.html" data-slider-id="4">

                                            <img width="445" height="445" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/home/portfolio/5.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide">

                                    <div class="home-portfolio__slide">
                                        <a class="home-portfolio__link" href="./digital.html" data-slider-id="5">
                                            <img width="445" height="445" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/home/portfolio/6.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="home-portfolio__slide">
                                        <a class="home-portfolio__link" href="./digital.html" data-slider-id="6">

                                            <img width="445" height="445" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/home/portfolio/7.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="home-portfolio__slide">
                                        <a class="home-portfolio__link" href="./digital.html" data-slider-id="7">
                                            <img width="445" height="445" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/home/portfolio/8.png" alt="">
                                        </a>
                                    </div>
                                </div>

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


    <!-- ? appointment  section-->

    <section class="appointment section-bg" style="--section-bg: #fff;">

        <?php get_template_part('template-parts/section', 'specialists'); ?>

    </section>


</main>



<?php get_footer(); ?>