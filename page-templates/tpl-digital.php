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

                    <!-- ? slider 1 -->
                    <div class="portfolio-slider-wrap" style="--slider-bg: #1b1b1b;">
                        <div class="swiper portfolio-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="portfolio-slide">
                                        <picture>
                                            <source media="(max-width: 500px)" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/01/01-min.png" />
                                            <img width="1920" height="1080" class="lazy portfolio-slide__img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/01/01.png" alt="" />
                                        </picture>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="portfolio-slide">
                                        <picture>
                                            <source media="(max-width: 500px)" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/01/02-min.png" />
                                            <img width="1920" height="1080" class="lazy portfolio-slide__img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/01/02.png" alt="" />
                                        </picture>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- ? portfolio-slider-control -->
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
                        <!-- ?  portfolio-slider-links -->
                        <div class="portfolio-slider-links">

                            <a class="portfolio-slider-link" href="#">
                                <svg class="portfolio-link-svg" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.19444 0.75H13.8611C14.1066 0.75 14.3056 0.948985 14.3056 1.19444V6.97222M10.0833 4.30556V9.63889C10.0833 9.88435 9.88435 10.0833 9.63889 10.0833H1.19444C0.948985 10.0833 0.75 10.2823 0.75 10.5278V15.4167M3.86111 14.3056H6.97222M18.5278 13.1944V10.5278C18.5278 10.2823 18.3288 10.0833 18.0833 10.0833H14.75C14.5045 10.0833 14.3056 10.2823 14.3056 10.5278V13.8611C14.3056 14.1066 14.1066 14.3056 13.8611 14.3056H10.5278C10.2823 14.3056 10.0833 14.5045 10.0833 14.75V18.0833C10.0833 18.3288 10.2823 18.5278 10.5278 18.5278H13.8611C14.1066 18.5278 14.3056 18.7268 14.3056 18.9722V24.75M23.6389 9.19444V15.8611C23.6389 16.1066 23.4399 16.3056 23.1944 16.3056H17.6389M10.0833 21.8611V24.75M23.6389 23.1944V18.9722C23.6389 18.7268 23.4399 18.5278 23.1944 18.5278H18.9722C18.7268 18.5278 18.5278 18.7268 18.5278 18.9722V23.1944C18.5278 23.4399 18.7268 23.6389 18.9722 23.6389H23.1944C23.4399 23.6389 23.6389 23.4399 23.6389 23.1944ZM5.86111 23.1944V18.9722C5.86111 18.7268 5.66213 18.5278 5.41667 18.5278H1.19444C0.948985 18.5278 0.75 18.7268 0.75 18.9722V23.1944C0.75 23.4399 0.948984 23.6389 1.19444 23.6389H5.41667C5.66213 23.6389 5.86111 23.4399 5.86111 23.1944ZM23.6389 5.41667V1.19444C23.6389 0.948985 23.4399 0.75 23.1944 0.75H18.9722C18.7268 0.75 18.5278 0.948984 18.5278 1.19444V5.41667C18.5278 5.66213 18.7268 5.86111 18.9722 5.86111H23.1944C23.4399 5.86111 23.6389 5.66213 23.6389 5.41667ZM5.86111 5.41667V1.19444C5.86111 0.948985 5.66213 0.75 5.41667 0.75H1.19444C0.948985 0.75 0.75 0.948984 0.75 1.19444V5.41667C0.75 5.66213 0.948984 5.86111 1.19444 5.86111H5.41667C5.66213 5.86111 5.86111 5.66213 5.86111 5.41667Z" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                                <span class="portfolio-link-text">IOS</span>
                                <span class="portfolio-link-icon-ios">
                                    <span class="portfolio-link-icon-light"></span>
                                    <span class="portfolio-link-icon-dark"></span>
                                </span>
                                <img width="180" height="180" class="lazy portfolio-slider-qr" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/01/qr-ios.png" alt="" />
                            </a>

                            <a class="portfolio-slider-link" href="#">
                                <svg class="portfolio-link-svg" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.19444 0.75H13.8611C14.1066 0.75 14.3056 0.948985 14.3056 1.19444V6.97222M10.0833 4.30556V9.63889C10.0833 9.88435 9.88435 10.0833 9.63889 10.0833H1.19444C0.948985 10.0833 0.75 10.2823 0.75 10.5278V15.4167M3.86111 14.3056H6.97222M18.5278 13.1944V10.5278C18.5278 10.2823 18.3288 10.0833 18.0833 10.0833H14.75C14.5045 10.0833 14.3056 10.2823 14.3056 10.5278V13.8611C14.3056 14.1066 14.1066 14.3056 13.8611 14.3056H10.5278C10.2823 14.3056 10.0833 14.5045 10.0833 14.75V18.0833C10.0833 18.3288 10.2823 18.5278 10.5278 18.5278H13.8611C14.1066 18.5278 14.3056 18.7268 14.3056 18.9722V24.75M23.6389 9.19444V15.8611C23.6389 16.1066 23.4399 16.3056 23.1944 16.3056H17.6389M10.0833 21.8611V24.75M23.6389 23.1944V18.9722C23.6389 18.7268 23.4399 18.5278 23.1944 18.5278H18.9722C18.7268 18.5278 18.5278 18.7268 18.5278 18.9722V23.1944C18.5278 23.4399 18.7268 23.6389 18.9722 23.6389H23.1944C23.4399 23.6389 23.6389 23.4399 23.6389 23.1944ZM5.86111 23.1944V18.9722C5.86111 18.7268 5.66213 18.5278 5.41667 18.5278H1.19444C0.948985 18.5278 0.75 18.7268 0.75 18.9722V23.1944C0.75 23.4399 0.948984 23.6389 1.19444 23.6389H5.41667C5.66213 23.6389 5.86111 23.4399 5.86111 23.1944ZM23.6389 5.41667V1.19444C23.6389 0.948985 23.4399 0.75 23.1944 0.75H18.9722C18.7268 0.75 18.5278 0.948984 18.5278 1.19444V5.41667C18.5278 5.66213 18.7268 5.86111 18.9722 5.86111H23.1944C23.4399 5.86111 23.6389 5.66213 23.6389 5.41667ZM5.86111 5.41667V1.19444C5.86111 0.948985 5.66213 0.75 5.41667 0.75H1.19444C0.948985 0.75 0.75 0.948984 0.75 1.19444V5.41667C0.75 5.66213 0.948984 5.86111 1.19444 5.86111H5.41667C5.66213 5.86111 5.86111 5.66213 5.86111 5.41667Z" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                                <span class="portfolio-link-text">Android</span>

                                <span class="portfolio-link-icon-android">
                                    <span class="portfolio-link-icon-light"></span>
                                    <span class="portfolio-link-icon-dark"></span>
                                </span>
                                <img width="180" height="180" class="lazy portfolio-slider-qr" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/01/qr-android.png" alt="" />
                            </a>
                        </div>
                    </div>
                    <!-- ? slider 2 -->
                    <div class="portfolio-slider-wrap" style="--slider-bg: #e0e0e0;">
                        <div class="swiper portfolio-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="portfolio-slide">
                                        <picture>
                                            <source media="(max-width: 500px)" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/02/01-min.png" />
                                            <img width="1920" height="1080" class="lazy portfolio-slide__img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/02/01.png" alt="" />
                                        </picture>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="portfolio-slide">
                                        <picture>
                                            <source media="(max-width: 500px)" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/02/02-min.png" />
                                            <img width="1920" height="1080" class="lazy portfolio-slide__img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/02/02.png" alt="" />
                                        </picture>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ? portfolio-slider-control -->
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
                        <!-- ?  portfolio-slider-links -->
                        <div class="portfolio-slider-links">

                            <a class="portfolio-slider-link" href="#">
                                <svg class="portfolio-link-svg" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.19444 0.75H13.8611C14.1066 0.75 14.3056 0.948985 14.3056 1.19444V6.97222M10.0833 4.30556V9.63889C10.0833 9.88435 9.88435 10.0833 9.63889 10.0833H1.19444C0.948985 10.0833 0.75 10.2823 0.75 10.5278V15.4167M3.86111 14.3056H6.97222M18.5278 13.1944V10.5278C18.5278 10.2823 18.3288 10.0833 18.0833 10.0833H14.75C14.5045 10.0833 14.3056 10.2823 14.3056 10.5278V13.8611C14.3056 14.1066 14.1066 14.3056 13.8611 14.3056H10.5278C10.2823 14.3056 10.0833 14.5045 10.0833 14.75V18.0833C10.0833 18.3288 10.2823 18.5278 10.5278 18.5278H13.8611C14.1066 18.5278 14.3056 18.7268 14.3056 18.9722V24.75M23.6389 9.19444V15.8611C23.6389 16.1066 23.4399 16.3056 23.1944 16.3056H17.6389M10.0833 21.8611V24.75M23.6389 23.1944V18.9722C23.6389 18.7268 23.4399 18.5278 23.1944 18.5278H18.9722C18.7268 18.5278 18.5278 18.7268 18.5278 18.9722V23.1944C18.5278 23.4399 18.7268 23.6389 18.9722 23.6389H23.1944C23.4399 23.6389 23.6389 23.4399 23.6389 23.1944ZM5.86111 23.1944V18.9722C5.86111 18.7268 5.66213 18.5278 5.41667 18.5278H1.19444C0.948985 18.5278 0.75 18.7268 0.75 18.9722V23.1944C0.75 23.4399 0.948984 23.6389 1.19444 23.6389H5.41667C5.66213 23.6389 5.86111 23.4399 5.86111 23.1944ZM23.6389 5.41667V1.19444C23.6389 0.948985 23.4399 0.75 23.1944 0.75H18.9722C18.7268 0.75 18.5278 0.948984 18.5278 1.19444V5.41667C18.5278 5.66213 18.7268 5.86111 18.9722 5.86111H23.1944C23.4399 5.86111 23.6389 5.66213 23.6389 5.41667ZM5.86111 5.41667V1.19444C5.86111 0.948985 5.66213 0.75 5.41667 0.75H1.19444C0.948985 0.75 0.75 0.948984 0.75 1.19444V5.41667C0.75 5.66213 0.948984 5.86111 1.19444 5.86111H5.41667C5.66213 5.86111 5.86111 5.66213 5.86111 5.41667Z" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                                <span class="portfolio-link-text">IOS</span>
                                <span class="portfolio-link-icon-ios">
                                    <span class="portfolio-link-icon-light"></span>
                                    <span class="portfolio-link-icon-dark"></span>
                                </span>
                                <img width="180" height="180" class="lazy portfolio-slider-qr" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/02/qr-ios.png" alt="" />
                            </a>

                            <a class="portfolio-slider-link" href="#">
                                <svg class="portfolio-link-svg" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.19444 0.75H13.8611C14.1066 0.75 14.3056 0.948985 14.3056 1.19444V6.97222M10.0833 4.30556V9.63889C10.0833 9.88435 9.88435 10.0833 9.63889 10.0833H1.19444C0.948985 10.0833 0.75 10.2823 0.75 10.5278V15.4167M3.86111 14.3056H6.97222M18.5278 13.1944V10.5278C18.5278 10.2823 18.3288 10.0833 18.0833 10.0833H14.75C14.5045 10.0833 14.3056 10.2823 14.3056 10.5278V13.8611C14.3056 14.1066 14.1066 14.3056 13.8611 14.3056H10.5278C10.2823 14.3056 10.0833 14.5045 10.0833 14.75V18.0833C10.0833 18.3288 10.2823 18.5278 10.5278 18.5278H13.8611C14.1066 18.5278 14.3056 18.7268 14.3056 18.9722V24.75M23.6389 9.19444V15.8611C23.6389 16.1066 23.4399 16.3056 23.1944 16.3056H17.6389M10.0833 21.8611V24.75M23.6389 23.1944V18.9722C23.6389 18.7268 23.4399 18.5278 23.1944 18.5278H18.9722C18.7268 18.5278 18.5278 18.7268 18.5278 18.9722V23.1944C18.5278 23.4399 18.7268 23.6389 18.9722 23.6389H23.1944C23.4399 23.6389 23.6389 23.4399 23.6389 23.1944ZM5.86111 23.1944V18.9722C5.86111 18.7268 5.66213 18.5278 5.41667 18.5278H1.19444C0.948985 18.5278 0.75 18.7268 0.75 18.9722V23.1944C0.75 23.4399 0.948984 23.6389 1.19444 23.6389H5.41667C5.66213 23.6389 5.86111 23.4399 5.86111 23.1944ZM23.6389 5.41667V1.19444C23.6389 0.948985 23.4399 0.75 23.1944 0.75H18.9722C18.7268 0.75 18.5278 0.948984 18.5278 1.19444V5.41667C18.5278 5.66213 18.7268 5.86111 18.9722 5.86111H23.1944C23.4399 5.86111 23.6389 5.66213 23.6389 5.41667ZM5.86111 5.41667V1.19444C5.86111 0.948985 5.66213 0.75 5.41667 0.75H1.19444C0.948985 0.75 0.75 0.948984 0.75 1.19444V5.41667C0.75 5.66213 0.948984 5.86111 1.19444 5.86111H5.41667C5.66213 5.86111 5.86111 5.66213 5.86111 5.41667Z" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                                <span class="portfolio-link-text">Android</span>

                                <span class="portfolio-link-icon-android">
                                    <span class="portfolio-link-icon-light"></span>
                                    <span class="portfolio-link-icon-dark"></span>
                                </span>
                                <img width="180" height="180" class="lazy portfolio-slider-qr" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/02/qr-android.png" alt="" />
                            </a>
                        </div>
                    </div>
                    <!-- ? slider 3 -->
                    <div class="portfolio-slider-wrap" style="--slider-bg: #0d1022;">
                        <div class="swiper portfolio-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="portfolio-slide">
                                        <picture>
                                            <source media="(max-width: 500px)" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/03/01-min.png" />
                                            <img width="1920" height="1080" class="lazy portfolio-slide__img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/03/01.png" alt="" />
                                        </picture>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="portfolio-slide">
                                        <picture>
                                            <source media="(max-width: 500px)" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/03/02-min.png" />
                                            <img width="1920" height="1080" class="lazy portfolio-slide__img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/03/02.png" alt="" />
                                        </picture>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ? portfolio-slider-control -->
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
                        <!-- ?  portfolio-slider-links -->
                        <div class="portfolio-slider-links">

                            <a class="portfolio-slider-link" href="#">
                                <svg class="portfolio-link-svg" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.19444 0.75H13.8611C14.1066 0.75 14.3056 0.948985 14.3056 1.19444V6.97222M10.0833 4.30556V9.63889C10.0833 9.88435 9.88435 10.0833 9.63889 10.0833H1.19444C0.948985 10.0833 0.75 10.2823 0.75 10.5278V15.4167M3.86111 14.3056H6.97222M18.5278 13.1944V10.5278C18.5278 10.2823 18.3288 10.0833 18.0833 10.0833H14.75C14.5045 10.0833 14.3056 10.2823 14.3056 10.5278V13.8611C14.3056 14.1066 14.1066 14.3056 13.8611 14.3056H10.5278C10.2823 14.3056 10.0833 14.5045 10.0833 14.75V18.0833C10.0833 18.3288 10.2823 18.5278 10.5278 18.5278H13.8611C14.1066 18.5278 14.3056 18.7268 14.3056 18.9722V24.75M23.6389 9.19444V15.8611C23.6389 16.1066 23.4399 16.3056 23.1944 16.3056H17.6389M10.0833 21.8611V24.75M23.6389 23.1944V18.9722C23.6389 18.7268 23.4399 18.5278 23.1944 18.5278H18.9722C18.7268 18.5278 18.5278 18.7268 18.5278 18.9722V23.1944C18.5278 23.4399 18.7268 23.6389 18.9722 23.6389H23.1944C23.4399 23.6389 23.6389 23.4399 23.6389 23.1944ZM5.86111 23.1944V18.9722C5.86111 18.7268 5.66213 18.5278 5.41667 18.5278H1.19444C0.948985 18.5278 0.75 18.7268 0.75 18.9722V23.1944C0.75 23.4399 0.948984 23.6389 1.19444 23.6389H5.41667C5.66213 23.6389 5.86111 23.4399 5.86111 23.1944ZM23.6389 5.41667V1.19444C23.6389 0.948985 23.4399 0.75 23.1944 0.75H18.9722C18.7268 0.75 18.5278 0.948984 18.5278 1.19444V5.41667C18.5278 5.66213 18.7268 5.86111 18.9722 5.86111H23.1944C23.4399 5.86111 23.6389 5.66213 23.6389 5.41667ZM5.86111 5.41667V1.19444C5.86111 0.948985 5.66213 0.75 5.41667 0.75H1.19444C0.948985 0.75 0.75 0.948984 0.75 1.19444V5.41667C0.75 5.66213 0.948984 5.86111 1.19444 5.86111H5.41667C5.66213 5.86111 5.86111 5.66213 5.86111 5.41667Z" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                                <span class="portfolio-link-text">IOS</span>
                                <span class="portfolio-link-icon-ios">
                                    <span class="portfolio-link-icon-light"></span>
                                    <span class="portfolio-link-icon-dark"></span>
                                </span>
                                <img width="180" height="180" class="lazy portfolio-slider-qr" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/03/qr-ios.png" alt="" />
                            </a>

                            <a class="portfolio-slider-link" href="#">
                                <svg class="portfolio-link-svg" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.19444 0.75H13.8611C14.1066 0.75 14.3056 0.948985 14.3056 1.19444V6.97222M10.0833 4.30556V9.63889C10.0833 9.88435 9.88435 10.0833 9.63889 10.0833H1.19444C0.948985 10.0833 0.75 10.2823 0.75 10.5278V15.4167M3.86111 14.3056H6.97222M18.5278 13.1944V10.5278C18.5278 10.2823 18.3288 10.0833 18.0833 10.0833H14.75C14.5045 10.0833 14.3056 10.2823 14.3056 10.5278V13.8611C14.3056 14.1066 14.1066 14.3056 13.8611 14.3056H10.5278C10.2823 14.3056 10.0833 14.5045 10.0833 14.75V18.0833C10.0833 18.3288 10.2823 18.5278 10.5278 18.5278H13.8611C14.1066 18.5278 14.3056 18.7268 14.3056 18.9722V24.75M23.6389 9.19444V15.8611C23.6389 16.1066 23.4399 16.3056 23.1944 16.3056H17.6389M10.0833 21.8611V24.75M23.6389 23.1944V18.9722C23.6389 18.7268 23.4399 18.5278 23.1944 18.5278H18.9722C18.7268 18.5278 18.5278 18.7268 18.5278 18.9722V23.1944C18.5278 23.4399 18.7268 23.6389 18.9722 23.6389H23.1944C23.4399 23.6389 23.6389 23.4399 23.6389 23.1944ZM5.86111 23.1944V18.9722C5.86111 18.7268 5.66213 18.5278 5.41667 18.5278H1.19444C0.948985 18.5278 0.75 18.7268 0.75 18.9722V23.1944C0.75 23.4399 0.948984 23.6389 1.19444 23.6389H5.41667C5.66213 23.6389 5.86111 23.4399 5.86111 23.1944ZM23.6389 5.41667V1.19444C23.6389 0.948985 23.4399 0.75 23.1944 0.75H18.9722C18.7268 0.75 18.5278 0.948984 18.5278 1.19444V5.41667C18.5278 5.66213 18.7268 5.86111 18.9722 5.86111H23.1944C23.4399 5.86111 23.6389 5.66213 23.6389 5.41667ZM5.86111 5.41667V1.19444C5.86111 0.948985 5.66213 0.75 5.41667 0.75H1.19444C0.948985 0.75 0.75 0.948984 0.75 1.19444V5.41667C0.75 5.66213 0.948984 5.86111 1.19444 5.86111H5.41667C5.66213 5.86111 5.86111 5.66213 5.86111 5.41667Z" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                                <span class="portfolio-link-text">Android</span>

                                <span class="portfolio-link-icon-android">
                                    <span class="portfolio-link-icon-light"></span>
                                    <span class="portfolio-link-icon-dark"></span>
                                </span>
                                <img width="180" height="180" class="lazy portfolio-slider-qr" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/03/qr-android.png" alt="" />
                            </a>
                        </div>
                    </div>
                    <!-- ? slider 4 -->
                    <div class="portfolio-slider-wrap" style="--slider-bg: #fff;">
                        <div class="swiper portfolio-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="portfolio-slide">
                                        <picture>
                                            <source media="(max-width: 500px)" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/04/01-min.png" />
                                            <img width="1920" height="1080" class="lazy portfolio-slide__img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/04/01.png" alt="" />
                                        </picture>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="portfolio-slide">
                                        <picture>
                                            <source media="(max-width: 500px)" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/04/02-min.png" />
                                            <img width="1920" height="1080" class="lazy portfolio-slide__img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/04/02.png" alt="" />
                                        </picture>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ? portfolio-slider-control -->
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
                        <!-- ?  portfolio-slider-links -->
                        <div class="portfolio-slider-links">

                            <a class="portfolio-slider-link" href="#">
                                <svg class="portfolio-link-svg" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.19444 0.75H13.8611C14.1066 0.75 14.3056 0.948985 14.3056 1.19444V6.97222M10.0833 4.30556V9.63889C10.0833 9.88435 9.88435 10.0833 9.63889 10.0833H1.19444C0.948985 10.0833 0.75 10.2823 0.75 10.5278V15.4167M3.86111 14.3056H6.97222M18.5278 13.1944V10.5278C18.5278 10.2823 18.3288 10.0833 18.0833 10.0833H14.75C14.5045 10.0833 14.3056 10.2823 14.3056 10.5278V13.8611C14.3056 14.1066 14.1066 14.3056 13.8611 14.3056H10.5278C10.2823 14.3056 10.0833 14.5045 10.0833 14.75V18.0833C10.0833 18.3288 10.2823 18.5278 10.5278 18.5278H13.8611C14.1066 18.5278 14.3056 18.7268 14.3056 18.9722V24.75M23.6389 9.19444V15.8611C23.6389 16.1066 23.4399 16.3056 23.1944 16.3056H17.6389M10.0833 21.8611V24.75M23.6389 23.1944V18.9722C23.6389 18.7268 23.4399 18.5278 23.1944 18.5278H18.9722C18.7268 18.5278 18.5278 18.7268 18.5278 18.9722V23.1944C18.5278 23.4399 18.7268 23.6389 18.9722 23.6389H23.1944C23.4399 23.6389 23.6389 23.4399 23.6389 23.1944ZM5.86111 23.1944V18.9722C5.86111 18.7268 5.66213 18.5278 5.41667 18.5278H1.19444C0.948985 18.5278 0.75 18.7268 0.75 18.9722V23.1944C0.75 23.4399 0.948984 23.6389 1.19444 23.6389H5.41667C5.66213 23.6389 5.86111 23.4399 5.86111 23.1944ZM23.6389 5.41667V1.19444C23.6389 0.948985 23.4399 0.75 23.1944 0.75H18.9722C18.7268 0.75 18.5278 0.948984 18.5278 1.19444V5.41667C18.5278 5.66213 18.7268 5.86111 18.9722 5.86111H23.1944C23.4399 5.86111 23.6389 5.66213 23.6389 5.41667ZM5.86111 5.41667V1.19444C5.86111 0.948985 5.66213 0.75 5.41667 0.75H1.19444C0.948985 0.75 0.75 0.948984 0.75 1.19444V5.41667C0.75 5.66213 0.948984 5.86111 1.19444 5.86111H5.41667C5.66213 5.86111 5.86111 5.66213 5.86111 5.41667Z" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                                <span class="portfolio-link-text">IOS</span>
                                <span class="portfolio-link-icon-ios">
                                    <span class="portfolio-link-icon-light"></span>
                                    <span class="portfolio-link-icon-dark"></span>
                                </span>
                                <img width="180" height="180" class="lazy portfolio-slider-qr" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/04/qr-ios.png" alt="" />
                            </a>

                            <a class="portfolio-slider-link" href="#">
                                <svg class="portfolio-link-svg" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.19444 0.75H13.8611C14.1066 0.75 14.3056 0.948985 14.3056 1.19444V6.97222M10.0833 4.30556V9.63889C10.0833 9.88435 9.88435 10.0833 9.63889 10.0833H1.19444C0.948985 10.0833 0.75 10.2823 0.75 10.5278V15.4167M3.86111 14.3056H6.97222M18.5278 13.1944V10.5278C18.5278 10.2823 18.3288 10.0833 18.0833 10.0833H14.75C14.5045 10.0833 14.3056 10.2823 14.3056 10.5278V13.8611C14.3056 14.1066 14.1066 14.3056 13.8611 14.3056H10.5278C10.2823 14.3056 10.0833 14.5045 10.0833 14.75V18.0833C10.0833 18.3288 10.2823 18.5278 10.5278 18.5278H13.8611C14.1066 18.5278 14.3056 18.7268 14.3056 18.9722V24.75M23.6389 9.19444V15.8611C23.6389 16.1066 23.4399 16.3056 23.1944 16.3056H17.6389M10.0833 21.8611V24.75M23.6389 23.1944V18.9722C23.6389 18.7268 23.4399 18.5278 23.1944 18.5278H18.9722C18.7268 18.5278 18.5278 18.7268 18.5278 18.9722V23.1944C18.5278 23.4399 18.7268 23.6389 18.9722 23.6389H23.1944C23.4399 23.6389 23.6389 23.4399 23.6389 23.1944ZM5.86111 23.1944V18.9722C5.86111 18.7268 5.66213 18.5278 5.41667 18.5278H1.19444C0.948985 18.5278 0.75 18.7268 0.75 18.9722V23.1944C0.75 23.4399 0.948984 23.6389 1.19444 23.6389H5.41667C5.66213 23.6389 5.86111 23.4399 5.86111 23.1944ZM23.6389 5.41667V1.19444C23.6389 0.948985 23.4399 0.75 23.1944 0.75H18.9722C18.7268 0.75 18.5278 0.948984 18.5278 1.19444V5.41667C18.5278 5.66213 18.7268 5.86111 18.9722 5.86111H23.1944C23.4399 5.86111 23.6389 5.66213 23.6389 5.41667ZM5.86111 5.41667V1.19444C5.86111 0.948985 5.66213 0.75 5.41667 0.75H1.19444C0.948985 0.75 0.75 0.948984 0.75 1.19444V5.41667C0.75 5.66213 0.948984 5.86111 1.19444 5.86111H5.41667C5.66213 5.86111 5.86111 5.66213 5.86111 5.41667Z" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                                <span class="portfolio-link-text">Android</span>

                                <span class="portfolio-link-icon-android">
                                    <span class="portfolio-link-icon-light"></span>
                                    <span class="portfolio-link-icon-dark"></span>
                                </span>
                                <img width="180" height="180" class="lazy portfolio-slider-qr" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/04/qr-android.png" alt="" />
                            </a>
                        </div>
                    </div>
                    <!-- ? slider 5 -->
                    <div class="portfolio-slider-wrap" style="--slider-bg: #FFECEC;">
                        <div class="swiper portfolio-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="portfolio-slide">
                                        <picture>
                                            <source media="(max-width: 500px)" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/05/01-min.png" />
                                            <img width="1920" height="1080" class="lazy portfolio-slide__img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/05/01.png" alt="" />
                                        </picture>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="portfolio-slide">
                                        <picture>
                                            <source media="(max-width: 500px)" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/05/02-min.png" />
                                            <img width="1920" height="1080" class="lazy portfolio-slide__img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/05/02.png" alt="" />
                                        </picture>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ? portfolio-slider-control -->
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
                        <!-- ?  portfolio-slider-links -->
                        <div class="portfolio-slider-links">

                            <a class="portfolio-slider-link" href="#">
                                <svg class="portfolio-link-svg" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.19444 0.75H13.8611C14.1066 0.75 14.3056 0.948985 14.3056 1.19444V6.97222M10.0833 4.30556V9.63889C10.0833 9.88435 9.88435 10.0833 9.63889 10.0833H1.19444C0.948985 10.0833 0.75 10.2823 0.75 10.5278V15.4167M3.86111 14.3056H6.97222M18.5278 13.1944V10.5278C18.5278 10.2823 18.3288 10.0833 18.0833 10.0833H14.75C14.5045 10.0833 14.3056 10.2823 14.3056 10.5278V13.8611C14.3056 14.1066 14.1066 14.3056 13.8611 14.3056H10.5278C10.2823 14.3056 10.0833 14.5045 10.0833 14.75V18.0833C10.0833 18.3288 10.2823 18.5278 10.5278 18.5278H13.8611C14.1066 18.5278 14.3056 18.7268 14.3056 18.9722V24.75M23.6389 9.19444V15.8611C23.6389 16.1066 23.4399 16.3056 23.1944 16.3056H17.6389M10.0833 21.8611V24.75M23.6389 23.1944V18.9722C23.6389 18.7268 23.4399 18.5278 23.1944 18.5278H18.9722C18.7268 18.5278 18.5278 18.7268 18.5278 18.9722V23.1944C18.5278 23.4399 18.7268 23.6389 18.9722 23.6389H23.1944C23.4399 23.6389 23.6389 23.4399 23.6389 23.1944ZM5.86111 23.1944V18.9722C5.86111 18.7268 5.66213 18.5278 5.41667 18.5278H1.19444C0.948985 18.5278 0.75 18.7268 0.75 18.9722V23.1944C0.75 23.4399 0.948984 23.6389 1.19444 23.6389H5.41667C5.66213 23.6389 5.86111 23.4399 5.86111 23.1944ZM23.6389 5.41667V1.19444C23.6389 0.948985 23.4399 0.75 23.1944 0.75H18.9722C18.7268 0.75 18.5278 0.948984 18.5278 1.19444V5.41667C18.5278 5.66213 18.7268 5.86111 18.9722 5.86111H23.1944C23.4399 5.86111 23.6389 5.66213 23.6389 5.41667ZM5.86111 5.41667V1.19444C5.86111 0.948985 5.66213 0.75 5.41667 0.75H1.19444C0.948985 0.75 0.75 0.948984 0.75 1.19444V5.41667C0.75 5.66213 0.948984 5.86111 1.19444 5.86111H5.41667C5.66213 5.86111 5.86111 5.66213 5.86111 5.41667Z" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                                <span class="portfolio-link-text">IOS</span>
                                <span class="portfolio-link-icon-ios">
                                    <span class="portfolio-link-icon-light"></span>
                                    <span class="portfolio-link-icon-dark"></span>
                                </span>
                                <img width="180" height="180" class="lazy portfolio-slider-qr" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/05/qr-ios.png" alt="" />
                            </a>

                            <a class="portfolio-slider-link" href="#">
                                <svg class="portfolio-link-svg" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.19444 0.75H13.8611C14.1066 0.75 14.3056 0.948985 14.3056 1.19444V6.97222M10.0833 4.30556V9.63889C10.0833 9.88435 9.88435 10.0833 9.63889 10.0833H1.19444C0.948985 10.0833 0.75 10.2823 0.75 10.5278V15.4167M3.86111 14.3056H6.97222M18.5278 13.1944V10.5278C18.5278 10.2823 18.3288 10.0833 18.0833 10.0833H14.75C14.5045 10.0833 14.3056 10.2823 14.3056 10.5278V13.8611C14.3056 14.1066 14.1066 14.3056 13.8611 14.3056H10.5278C10.2823 14.3056 10.0833 14.5045 10.0833 14.75V18.0833C10.0833 18.3288 10.2823 18.5278 10.5278 18.5278H13.8611C14.1066 18.5278 14.3056 18.7268 14.3056 18.9722V24.75M23.6389 9.19444V15.8611C23.6389 16.1066 23.4399 16.3056 23.1944 16.3056H17.6389M10.0833 21.8611V24.75M23.6389 23.1944V18.9722C23.6389 18.7268 23.4399 18.5278 23.1944 18.5278H18.9722C18.7268 18.5278 18.5278 18.7268 18.5278 18.9722V23.1944C18.5278 23.4399 18.7268 23.6389 18.9722 23.6389H23.1944C23.4399 23.6389 23.6389 23.4399 23.6389 23.1944ZM5.86111 23.1944V18.9722C5.86111 18.7268 5.66213 18.5278 5.41667 18.5278H1.19444C0.948985 18.5278 0.75 18.7268 0.75 18.9722V23.1944C0.75 23.4399 0.948984 23.6389 1.19444 23.6389H5.41667C5.66213 23.6389 5.86111 23.4399 5.86111 23.1944ZM23.6389 5.41667V1.19444C23.6389 0.948985 23.4399 0.75 23.1944 0.75H18.9722C18.7268 0.75 18.5278 0.948984 18.5278 1.19444V5.41667C18.5278 5.66213 18.7268 5.86111 18.9722 5.86111H23.1944C23.4399 5.86111 23.6389 5.66213 23.6389 5.41667ZM5.86111 5.41667V1.19444C5.86111 0.948985 5.66213 0.75 5.41667 0.75H1.19444C0.948985 0.75 0.75 0.948984 0.75 1.19444V5.41667C0.75 5.66213 0.948984 5.86111 1.19444 5.86111H5.41667C5.66213 5.86111 5.86111 5.66213 5.86111 5.41667Z" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                                <span class="portfolio-link-text">Android</span>

                                <span class="portfolio-link-icon-android">
                                    <span class="portfolio-link-icon-light"></span>
                                    <span class="portfolio-link-icon-dark"></span>
                                </span>
                                <img width="180" height="180" class="lazy portfolio-slider-qr" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/05/qr-android.png" alt="" />
                            </a>
                        </div>

                    </div>
                    <!-- ? slider 6 -->
                    <div class="portfolio-slider-wrap" style="--slider-bg: #DDE8FF;">
                        <div class="swiper portfolio-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="portfolio-slide">
                                        <picture>
                                            <source media="(max-width: 500px)" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/06/01-min.png" />
                                            <img width="1920" height="1080" class="lazy portfolio-slide__img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/06/01.png" alt="" />
                                        </picture>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="portfolio-slide">
                                        <picture>
                                            <source media="(max-width: 500px)" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/06/02-min.png" />
                                            <img width="1920" height="1080" class="lazy portfolio-slide__img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/06/02.png" alt="" />
                                        </picture>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ? portfolio-slider-control -->
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
                        <!-- ?  portfolio-slider-links -->
                        <div class="portfolio-slider-links">

                            <a class="portfolio-slider-link" href="#">
                                <svg class="portfolio-link-svg" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.19444 0.75H13.8611C14.1066 0.75 14.3056 0.948985 14.3056 1.19444V6.97222M10.0833 4.30556V9.63889C10.0833 9.88435 9.88435 10.0833 9.63889 10.0833H1.19444C0.948985 10.0833 0.75 10.2823 0.75 10.5278V15.4167M3.86111 14.3056H6.97222M18.5278 13.1944V10.5278C18.5278 10.2823 18.3288 10.0833 18.0833 10.0833H14.75C14.5045 10.0833 14.3056 10.2823 14.3056 10.5278V13.8611C14.3056 14.1066 14.1066 14.3056 13.8611 14.3056H10.5278C10.2823 14.3056 10.0833 14.5045 10.0833 14.75V18.0833C10.0833 18.3288 10.2823 18.5278 10.5278 18.5278H13.8611C14.1066 18.5278 14.3056 18.7268 14.3056 18.9722V24.75M23.6389 9.19444V15.8611C23.6389 16.1066 23.4399 16.3056 23.1944 16.3056H17.6389M10.0833 21.8611V24.75M23.6389 23.1944V18.9722C23.6389 18.7268 23.4399 18.5278 23.1944 18.5278H18.9722C18.7268 18.5278 18.5278 18.7268 18.5278 18.9722V23.1944C18.5278 23.4399 18.7268 23.6389 18.9722 23.6389H23.1944C23.4399 23.6389 23.6389 23.4399 23.6389 23.1944ZM5.86111 23.1944V18.9722C5.86111 18.7268 5.66213 18.5278 5.41667 18.5278H1.19444C0.948985 18.5278 0.75 18.7268 0.75 18.9722V23.1944C0.75 23.4399 0.948984 23.6389 1.19444 23.6389H5.41667C5.66213 23.6389 5.86111 23.4399 5.86111 23.1944ZM23.6389 5.41667V1.19444C23.6389 0.948985 23.4399 0.75 23.1944 0.75H18.9722C18.7268 0.75 18.5278 0.948984 18.5278 1.19444V5.41667C18.5278 5.66213 18.7268 5.86111 18.9722 5.86111H23.1944C23.4399 5.86111 23.6389 5.66213 23.6389 5.41667ZM5.86111 5.41667V1.19444C5.86111 0.948985 5.66213 0.75 5.41667 0.75H1.19444C0.948985 0.75 0.75 0.948984 0.75 1.19444V5.41667C0.75 5.66213 0.948984 5.86111 1.19444 5.86111H5.41667C5.66213 5.86111 5.86111 5.66213 5.86111 5.41667Z" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                                <span class="portfolio-link-text">IOS</span>
                                <span class="portfolio-link-icon-ios">
                                    <span class="portfolio-link-icon-light"></span>
                                    <span class="portfolio-link-icon-dark"></span>
                                </span>
                                <img width="180" height="180" class="lazy portfolio-slider-qr" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/06/qr-ios.png" alt="" />
                            </a>

                            <a class="portfolio-slider-link" href="#">
                                <svg class="portfolio-link-svg" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.19444 0.75H13.8611C14.1066 0.75 14.3056 0.948985 14.3056 1.19444V6.97222M10.0833 4.30556V9.63889C10.0833 9.88435 9.88435 10.0833 9.63889 10.0833H1.19444C0.948985 10.0833 0.75 10.2823 0.75 10.5278V15.4167M3.86111 14.3056H6.97222M18.5278 13.1944V10.5278C18.5278 10.2823 18.3288 10.0833 18.0833 10.0833H14.75C14.5045 10.0833 14.3056 10.2823 14.3056 10.5278V13.8611C14.3056 14.1066 14.1066 14.3056 13.8611 14.3056H10.5278C10.2823 14.3056 10.0833 14.5045 10.0833 14.75V18.0833C10.0833 18.3288 10.2823 18.5278 10.5278 18.5278H13.8611C14.1066 18.5278 14.3056 18.7268 14.3056 18.9722V24.75M23.6389 9.19444V15.8611C23.6389 16.1066 23.4399 16.3056 23.1944 16.3056H17.6389M10.0833 21.8611V24.75M23.6389 23.1944V18.9722C23.6389 18.7268 23.4399 18.5278 23.1944 18.5278H18.9722C18.7268 18.5278 18.5278 18.7268 18.5278 18.9722V23.1944C18.5278 23.4399 18.7268 23.6389 18.9722 23.6389H23.1944C23.4399 23.6389 23.6389 23.4399 23.6389 23.1944ZM5.86111 23.1944V18.9722C5.86111 18.7268 5.66213 18.5278 5.41667 18.5278H1.19444C0.948985 18.5278 0.75 18.7268 0.75 18.9722V23.1944C0.75 23.4399 0.948984 23.6389 1.19444 23.6389H5.41667C5.66213 23.6389 5.86111 23.4399 5.86111 23.1944ZM23.6389 5.41667V1.19444C23.6389 0.948985 23.4399 0.75 23.1944 0.75H18.9722C18.7268 0.75 18.5278 0.948984 18.5278 1.19444V5.41667C18.5278 5.66213 18.7268 5.86111 18.9722 5.86111H23.1944C23.4399 5.86111 23.6389 5.66213 23.6389 5.41667ZM5.86111 5.41667V1.19444C5.86111 0.948985 5.66213 0.75 5.41667 0.75H1.19444C0.948985 0.75 0.75 0.948984 0.75 1.19444V5.41667C0.75 5.66213 0.948984 5.86111 1.19444 5.86111H5.41667C5.66213 5.86111 5.86111 5.66213 5.86111 5.41667Z" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                                <span class="portfolio-link-text">Android</span>

                                <span class="portfolio-link-icon-android">
                                    <span class="portfolio-link-icon-light"></span>
                                    <span class="portfolio-link-icon-dark"></span>
                                </span>
                                <img width="180" height="180" class="lazy portfolio-slider-qr" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/06/qr-android.png" alt="" />
                            </a>
                        </div>
                    </div>
                    <!-- ? slider 7 -->
                    <div class="portfolio-slider-wrap" style="--slider-bg: #6875E0;">
                        <div class="swiper portfolio-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="portfolio-slide">
                                        <picture>
                                            <source media="(max-width: 500px)" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/07/01-min.png" />
                                            <img width="1920" height="1080" class="lazy portfolio-slide__img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/07/01.png" alt="" />
                                        </picture>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="portfolio-slide">
                                        <picture>
                                            <source media="(max-width: 500px)" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/07/02-min.png" />
                                            <img width="1920" height="1080" class="lazy portfolio-slide__img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/07/02.png" alt="" />
                                        </picture>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ? portfolio-slider-control -->
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
                        <!-- ?  portfolio-slider-links -->
                        <div class="portfolio-slider-links">

                            <a class="portfolio-slider-link" href="#">
                                <svg class="portfolio-link-svg" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.19444 0.75H13.8611C14.1066 0.75 14.3056 0.948985 14.3056 1.19444V6.97222M10.0833 4.30556V9.63889C10.0833 9.88435 9.88435 10.0833 9.63889 10.0833H1.19444C0.948985 10.0833 0.75 10.2823 0.75 10.5278V15.4167M3.86111 14.3056H6.97222M18.5278 13.1944V10.5278C18.5278 10.2823 18.3288 10.0833 18.0833 10.0833H14.75C14.5045 10.0833 14.3056 10.2823 14.3056 10.5278V13.8611C14.3056 14.1066 14.1066 14.3056 13.8611 14.3056H10.5278C10.2823 14.3056 10.0833 14.5045 10.0833 14.75V18.0833C10.0833 18.3288 10.2823 18.5278 10.5278 18.5278H13.8611C14.1066 18.5278 14.3056 18.7268 14.3056 18.9722V24.75M23.6389 9.19444V15.8611C23.6389 16.1066 23.4399 16.3056 23.1944 16.3056H17.6389M10.0833 21.8611V24.75M23.6389 23.1944V18.9722C23.6389 18.7268 23.4399 18.5278 23.1944 18.5278H18.9722C18.7268 18.5278 18.5278 18.7268 18.5278 18.9722V23.1944C18.5278 23.4399 18.7268 23.6389 18.9722 23.6389H23.1944C23.4399 23.6389 23.6389 23.4399 23.6389 23.1944ZM5.86111 23.1944V18.9722C5.86111 18.7268 5.66213 18.5278 5.41667 18.5278H1.19444C0.948985 18.5278 0.75 18.7268 0.75 18.9722V23.1944C0.75 23.4399 0.948984 23.6389 1.19444 23.6389H5.41667C5.66213 23.6389 5.86111 23.4399 5.86111 23.1944ZM23.6389 5.41667V1.19444C23.6389 0.948985 23.4399 0.75 23.1944 0.75H18.9722C18.7268 0.75 18.5278 0.948984 18.5278 1.19444V5.41667C18.5278 5.66213 18.7268 5.86111 18.9722 5.86111H23.1944C23.4399 5.86111 23.6389 5.66213 23.6389 5.41667ZM5.86111 5.41667V1.19444C5.86111 0.948985 5.66213 0.75 5.41667 0.75H1.19444C0.948985 0.75 0.75 0.948984 0.75 1.19444V5.41667C0.75 5.66213 0.948984 5.86111 1.19444 5.86111H5.41667C5.66213 5.86111 5.86111 5.66213 5.86111 5.41667Z" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                                <span class="portfolio-link-text">IOS</span>
                                <span class="portfolio-link-icon-ios">
                                    <span class="portfolio-link-icon-light"></span>
                                    <span class="portfolio-link-icon-dark"></span>
                                </span>
                                <img width="180" height="180" class="lazy portfolio-slider-qr" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/07/qr-ios.png" alt="" />
                            </a>

                            <a class="portfolio-slider-link" href="#">
                                <svg class="portfolio-link-svg" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.19444 0.75H13.8611C14.1066 0.75 14.3056 0.948985 14.3056 1.19444V6.97222M10.0833 4.30556V9.63889C10.0833 9.88435 9.88435 10.0833 9.63889 10.0833H1.19444C0.948985 10.0833 0.75 10.2823 0.75 10.5278V15.4167M3.86111 14.3056H6.97222M18.5278 13.1944V10.5278C18.5278 10.2823 18.3288 10.0833 18.0833 10.0833H14.75C14.5045 10.0833 14.3056 10.2823 14.3056 10.5278V13.8611C14.3056 14.1066 14.1066 14.3056 13.8611 14.3056H10.5278C10.2823 14.3056 10.0833 14.5045 10.0833 14.75V18.0833C10.0833 18.3288 10.2823 18.5278 10.5278 18.5278H13.8611C14.1066 18.5278 14.3056 18.7268 14.3056 18.9722V24.75M23.6389 9.19444V15.8611C23.6389 16.1066 23.4399 16.3056 23.1944 16.3056H17.6389M10.0833 21.8611V24.75M23.6389 23.1944V18.9722C23.6389 18.7268 23.4399 18.5278 23.1944 18.5278H18.9722C18.7268 18.5278 18.5278 18.7268 18.5278 18.9722V23.1944C18.5278 23.4399 18.7268 23.6389 18.9722 23.6389H23.1944C23.4399 23.6389 23.6389 23.4399 23.6389 23.1944ZM5.86111 23.1944V18.9722C5.86111 18.7268 5.66213 18.5278 5.41667 18.5278H1.19444C0.948985 18.5278 0.75 18.7268 0.75 18.9722V23.1944C0.75 23.4399 0.948984 23.6389 1.19444 23.6389H5.41667C5.66213 23.6389 5.86111 23.4399 5.86111 23.1944ZM23.6389 5.41667V1.19444C23.6389 0.948985 23.4399 0.75 23.1944 0.75H18.9722C18.7268 0.75 18.5278 0.948984 18.5278 1.19444V5.41667C18.5278 5.66213 18.7268 5.86111 18.9722 5.86111H23.1944C23.4399 5.86111 23.6389 5.66213 23.6389 5.41667ZM5.86111 5.41667V1.19444C5.86111 0.948985 5.66213 0.75 5.41667 0.75H1.19444C0.948985 0.75 0.75 0.948984 0.75 1.19444V5.41667C0.75 5.66213 0.948984 5.86111 1.19444 5.86111H5.41667C5.66213 5.86111 5.86111 5.66213 5.86111 5.41667Z" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                                <span class="portfolio-link-text">Android</span>

                                <span class="portfolio-link-icon-android">
                                    <span class="portfolio-link-icon-light"></span>
                                    <span class="portfolio-link-icon-dark"></span>
                                </span>
                                <img width="180" height="180" class="lazy portfolio-slider-qr" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/07/qr-android.png" alt="" />
                            </a>
                        </div>
                    </div>
                    <!-- ? slider 8 -->
                    <div class="portfolio-slider-wrap" style="--slider-bg: #F5F5F6;">
                        <div class="swiper portfolio-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="portfolio-slide">
                                        <picture>
                                            <source media="(max-width: 500px)" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/08/01-min.png" />
                                            <img width="1920" height="1080" class="lazy portfolio-slide__img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/08/01.png" alt="" />
                                        </picture>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="portfolio-slide">
                                        <picture>
                                            <source media="(max-width: 500px)" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/08/02-min.png" />
                                            <img width="1920" height="1080" class="lazy portfolio-slide__img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/08/02.png" alt="" />
                                        </picture>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ? portfolio-slider-control -->
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
                        <!-- ?  portfolio-slider-links -->
                        <div class="portfolio-slider-links">

                            <a class="portfolio-slider-link" href="#">
                                <svg class="portfolio-link-svg" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.19444 0.75H13.8611C14.1066 0.75 14.3056 0.948985 14.3056 1.19444V6.97222M10.0833 4.30556V9.63889C10.0833 9.88435 9.88435 10.0833 9.63889 10.0833H1.19444C0.948985 10.0833 0.75 10.2823 0.75 10.5278V15.4167M3.86111 14.3056H6.97222M18.5278 13.1944V10.5278C18.5278 10.2823 18.3288 10.0833 18.0833 10.0833H14.75C14.5045 10.0833 14.3056 10.2823 14.3056 10.5278V13.8611C14.3056 14.1066 14.1066 14.3056 13.8611 14.3056H10.5278C10.2823 14.3056 10.0833 14.5045 10.0833 14.75V18.0833C10.0833 18.3288 10.2823 18.5278 10.5278 18.5278H13.8611C14.1066 18.5278 14.3056 18.7268 14.3056 18.9722V24.75M23.6389 9.19444V15.8611C23.6389 16.1066 23.4399 16.3056 23.1944 16.3056H17.6389M10.0833 21.8611V24.75M23.6389 23.1944V18.9722C23.6389 18.7268 23.4399 18.5278 23.1944 18.5278H18.9722C18.7268 18.5278 18.5278 18.7268 18.5278 18.9722V23.1944C18.5278 23.4399 18.7268 23.6389 18.9722 23.6389H23.1944C23.4399 23.6389 23.6389 23.4399 23.6389 23.1944ZM5.86111 23.1944V18.9722C5.86111 18.7268 5.66213 18.5278 5.41667 18.5278H1.19444C0.948985 18.5278 0.75 18.7268 0.75 18.9722V23.1944C0.75 23.4399 0.948984 23.6389 1.19444 23.6389H5.41667C5.66213 23.6389 5.86111 23.4399 5.86111 23.1944ZM23.6389 5.41667V1.19444C23.6389 0.948985 23.4399 0.75 23.1944 0.75H18.9722C18.7268 0.75 18.5278 0.948984 18.5278 1.19444V5.41667C18.5278 5.66213 18.7268 5.86111 18.9722 5.86111H23.1944C23.4399 5.86111 23.6389 5.66213 23.6389 5.41667ZM5.86111 5.41667V1.19444C5.86111 0.948985 5.66213 0.75 5.41667 0.75H1.19444C0.948985 0.75 0.75 0.948984 0.75 1.19444V5.41667C0.75 5.66213 0.948984 5.86111 1.19444 5.86111H5.41667C5.66213 5.86111 5.86111 5.66213 5.86111 5.41667Z" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                                <span class="portfolio-link-text">IOS</span>
                                <span class="portfolio-link-icon-ios">
                                    <span class="portfolio-link-icon-light"></span>
                                    <span class="portfolio-link-icon-dark"></span>
                                </span>
                                <img width="180" height="180" class="lazy portfolio-slider-qr" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/08/qr-ios.png" alt="" />
                            </a>

                            <a class="portfolio-slider-link" href="#">
                                <svg class="portfolio-link-svg" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.19444 0.75H13.8611C14.1066 0.75 14.3056 0.948985 14.3056 1.19444V6.97222M10.0833 4.30556V9.63889C10.0833 9.88435 9.88435 10.0833 9.63889 10.0833H1.19444C0.948985 10.0833 0.75 10.2823 0.75 10.5278V15.4167M3.86111 14.3056H6.97222M18.5278 13.1944V10.5278C18.5278 10.2823 18.3288 10.0833 18.0833 10.0833H14.75C14.5045 10.0833 14.3056 10.2823 14.3056 10.5278V13.8611C14.3056 14.1066 14.1066 14.3056 13.8611 14.3056H10.5278C10.2823 14.3056 10.0833 14.5045 10.0833 14.75V18.0833C10.0833 18.3288 10.2823 18.5278 10.5278 18.5278H13.8611C14.1066 18.5278 14.3056 18.7268 14.3056 18.9722V24.75M23.6389 9.19444V15.8611C23.6389 16.1066 23.4399 16.3056 23.1944 16.3056H17.6389M10.0833 21.8611V24.75M23.6389 23.1944V18.9722C23.6389 18.7268 23.4399 18.5278 23.1944 18.5278H18.9722C18.7268 18.5278 18.5278 18.7268 18.5278 18.9722V23.1944C18.5278 23.4399 18.7268 23.6389 18.9722 23.6389H23.1944C23.4399 23.6389 23.6389 23.4399 23.6389 23.1944ZM5.86111 23.1944V18.9722C5.86111 18.7268 5.66213 18.5278 5.41667 18.5278H1.19444C0.948985 18.5278 0.75 18.7268 0.75 18.9722V23.1944C0.75 23.4399 0.948984 23.6389 1.19444 23.6389H5.41667C5.66213 23.6389 5.86111 23.4399 5.86111 23.1944ZM23.6389 5.41667V1.19444C23.6389 0.948985 23.4399 0.75 23.1944 0.75H18.9722C18.7268 0.75 18.5278 0.948984 18.5278 1.19444V5.41667C18.5278 5.66213 18.7268 5.86111 18.9722 5.86111H23.1944C23.4399 5.86111 23.6389 5.66213 23.6389 5.41667ZM5.86111 5.41667V1.19444C5.86111 0.948985 5.66213 0.75 5.41667 0.75H1.19444C0.948985 0.75 0.75 0.948984 0.75 1.19444V5.41667C0.75 5.66213 0.948984 5.86111 1.19444 5.86111H5.41667C5.66213 5.86111 5.86111 5.66213 5.86111 5.41667Z" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                                <span class="portfolio-link-text">Android</span>

                                <span class="portfolio-link-icon-android">
                                    <span class="portfolio-link-icon-light"></span>
                                    <span class="portfolio-link-icon-dark"></span>
                                </span>
                                <img width="180" height="180" class="lazy portfolio-slider-qr" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/08/qr-android.png" alt="" />
                            </a>
                        </div>
                    </div>

                </div>














                <div class="portfolio-content-wrap">

                    <div class="portfolio-slider-contents">
                        <div class="portfolio-slide-content" data-slider="0" data-slide="0">
                            <h3 class="portfolio-slide-title">
                                Интернет-магазин одежды, обуви и аксессуаров
                            </h3>
                            <p class="portfolio-slide-desc">
                                цифровизация вашего бизнеса
                            </p>
                        </div>
                        <div class="portfolio-slide-content" data-slider="0" data-slide="1">
                            <h3 class="portfolio-slide-title">
                                Главная страница
                            </h3>
                            <p class="portfolio-slide-desc">
                                удобная подборка с учетом твоих предпочтений и последних модных тенденций
                            </p>
                        </div>
                    </div>

                    <div class="portfolio-slider-contents">
                        <div class="portfolio-slide-content" data-slider="1" data-slide="0">
                            <h3 class="portfolio-slide-title">
                                Ваш помощник в финансовой грамотности
                            </h3>
                            <p class="portfolio-slide-desc">

                            </p>
                        </div>
                        <div class="portfolio-slide-content" data-slider="1" data-slide="1">
                            <h3 class="portfolio-slide-title">
                                Обучение финансовой грамотности
                            </h3>
                            <p class="portfolio-slide-desc">
                                практические знания для управления финансами, сравнения услуг и уверенных финансовых решений.
                            </p>
                        </div>
                    </div>

                    <div class="portfolio-slider-contents">
                        <div class="portfolio-slide-content" data-slider="2" data-slide="0">
                            <h3 class="portfolio-slide-title">
                                Контроль Никаких бумаг
                            </h3>
                            <p class="portfolio-slide-desc">
                                Информационная система для автоматизации процессов по контролю и надзору за строящимися объектами.

                            </p>
                        </div>
                        <div class="portfolio-slide-content" data-slider="2" data-slide="1">
                            <h3 class="portfolio-slide-title">
                                Обьект
                            </h3>
                            <p class="portfolio-slide-desc">
                                спроектировали простую и удобную детальную страницу обьекта, где можно отследить состояние работ и сформированные отчеты по обьекту
                            </p>
                        </div>
                    </div>

                    <div class="portfolio-slider-contents">
                        <div class="portfolio-slide-content" data-slider="3" data-slide="0">
                            <h3 class="portfolio-slide-title">
                                Slider 4 Title 1
                            </h3>
                            <p class="portfolio-slide-desc">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem assumenda quos architecto.
                            </p>
                        </div>
                        <div class="portfolio-slide-content" data-slider="3" data-slide="1">
                            <h3 class="portfolio-slide-title">
                                Slider 4 Title 2
                            </h3>
                            <p class="portfolio-slide-desc">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem assumenda quos architecto.
                            </p>
                        </div>
                    </div>

                    <div class="portfolio-slider-contents">
                        <div class="portfolio-slide-content" data-slider="4" data-slide="0">
                            <h3 class="portfolio-slide-title">
                                Slider 5 Title 1
                            </h3>
                            <p class="portfolio-slide-desc">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem assumenda quos architecto.
                            </p>
                        </div>
                        <div class="portfolio-slide-content" data-slider="4" data-slide="1">
                            <h3 class="portfolio-slide-title">
                                Slider 5 Title 2
                            </h3>
                            <p class="portfolio-slide-desc">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem assumenda quos architecto.
                            </p>
                        </div>
                    </div>

                    <div class="portfolio-slider-contents">
                        <div class="portfolio-slide-content" data-slider="5" data-slide="0">
                            <h3 class="portfolio-slide-title">
                                Slider 6 Title 1
                            </h3>
                            <p class="portfolio-slide-desc">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem assumenda quos architecto.
                            </p>
                        </div>
                        <div class="portfolio-slide-content" data-slider="5" data-slide="1">
                            <h3 class="portfolio-slide-title">
                                Slider 6 Title 2
                            </h3>
                            <p class="portfolio-slide-desc">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem assumenda quos architecto.
                            </p>
                        </div>
                    </div>

                    <div class="portfolio-slider-contents">
                        <div class="portfolio-slide-content" data-slider="6" data-slide="0">
                            <h3 class="portfolio-slide-title">
                                Slider 7 Title 1
                            </h3>
                            <p class="portfolio-slide-desc">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem assumenda quos architecto.
                            </p>
                        </div>
                        <div class="portfolio-slide-content" data-slider="6" data-slide="1">
                            <h3 class="portfolio-slide-title">
                                Slider 7 Title 2
                            </h3>
                            <p class="portfolio-slide-desc">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem assumenda quos architecto.
                            </p>
                        </div>
                    </div>

                    <div class="portfolio-slider-contents">
                        <div class="portfolio-slide-content" data-slider="7" data-slide="0">
                            <h3 class="portfolio-slide-title">
                                Slider 8 Title 1
                            </h3>
                            <p class="portfolio-slide-desc">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem assumenda quos architecto.
                            </p>
                        </div>
                        <div class="portfolio-slide-content" data-slider="7" data-slide="1">
                            <h3 class="portfolio-slide-title">
                                Slider 8 Title 2
                            </h3>
                            <p class="portfolio-slide-desc">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem assumenda quos architecto.
                            </p>
                        </div>
                    </div>

                </div>












                <div class="portfolio-control-menu">


                    <div class="swiper portfolio-menu-slider">
                        <div class="swiper-wrapper">

                            <div class="swiper-slide">
                                <div class="portfolio-menu-btn" data-index="0">
                                    <img width="218" height="74" class="lazy portfolio-menu-btn-image" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/01.png" alt="">
                                    <img width="218" height="74" class="lazy portfolio-menu-btn-image-dark" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/01-dark.png" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="portfolio-menu-btn" data-index="1">
                                    <img width="218" height="74" class="lazy portfolio-menu-btn-image" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/02.png" alt="">
                                    <img width="218" height="74" class="lazy portfolio-menu-btn-image-dark" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/02-dark.png" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="portfolio-menu-btn" data-index="2">

                                    <img width="218" height="74" class="lazy portfolio-menu-btn-image" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/03.png" alt="">
                                    <img width="218" height="74" class="lazy portfolio-menu-btn-image-dark" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/03-dark.png" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="portfolio-menu-btn" data-index="3">
                                    <img width="218" height="74" class="lazy portfolio-menu-btn-image" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/04.png" alt="">
                                    <img width="218" height="74" class="lazy portfolio-menu-btn-image-dark" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/04-dark.png" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="portfolio-menu-btn" data-index="4">

                                    <img width="218" height="74" class="lazy portfolio-menu-btn-image" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/05.png" alt="">
                                    <img width="218" height="74" class="lazy portfolio-menu-btn-image-dark" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/05-dark.png" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="portfolio-menu-btn" data-index="5">

                                    <img width="218" height="74" class="lazy portfolio-menu-btn-image" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/06.png" alt="">
                                    <img width="218" height="74" class="lazy portfolio-menu-btn-image-dark" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/06-dark.png" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="portfolio-menu-btn" data-index="6">

                                    <img width="218" height="74" class="lazy portfolio-menu-btn-image" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/07.png" alt="">
                                    <img width="218" height="74" class="lazy portfolio-menu-btn-image-dark" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/07-dark.png" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="portfolio-menu-btn" data-index="7">

                                    <img width="218" height="74" class="lazy portfolio-menu-btn-image" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/08.png" alt="">
                                    <img width="218" height="74" class="lazy portfolio-menu-btn-image-dark" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/digital/sliders/08-dark.png" alt="">
                                </div>
                            </div>






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