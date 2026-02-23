<?php get_header(); ?>



<main>



    <section class="hero">




        <video id="mainVideo" class="main-video track-visibility" playsinline muted autoplay loop poster="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg/hero-bg.jpg" data-src="<?php echo get_template_directory_uri(); ?>/assets/video/hero.mp4"></video>


        <div class="container-max">

            <div class="hero-inner">

                <div class="hero-content-box">

                    <div id="real-clock" class="real-clock">
                        <span id="real-time" class="real-time"></span>
                        <span id="real-date" class="real-date"></span>
                    </div>

                    <div class="hero-content">
                        <h1 class="hero__title">
                            Добро пожаловать в beam студию
                        </h1>
                        <p class="hero__desc">
                            цифровизация вашего бизнеса
                        </p>
                    </div>

                </div>

                <div class="hero-thumbs-wrap">

                    <div id="hero-thumbs" class="hero-thumbs" role="list">
                        <a class="hero-thumb" href="#" data-video="<?php echo get_template_directory_uri(); ?>/assets/video/digital.mp4" data-poster="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg/digital-bg.jpg">
                            <img width="130" height="130" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/thumb/digital.webp" alt="digital">
                        </a>
                        <a class="hero-thumb" href="#" data-video="<?php echo get_template_directory_uri(); ?>/assets/video/branding.mp4" data-poster="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg/branding-bg.jpg">
                            <img width="130" height="130" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/thumb/branding.webp" alt="branding">
                        </a>
                        <a class="hero-thumb" href="#" data-video="<?php echo get_template_directory_uri(); ?>/assets/video/engineering.mp4" data-poster="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg/engineering-bg.jpg">
                            <img width="130" height="130" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/thumb/engineering.webp" alt="engineering">
                        </a>
                        <a class="hero-thumb" href="#" data-video="<?php echo get_template_directory_uri(); ?>/assets/video/equipment.mp4" data-poster="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg/equipment-bg.jpg">
                            <img width="130" height="130" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/thumb/equipment.webp" alt="equipment">
                        </a>

                    </div>


                </div>
            </div>


        </div>












        <div id="hero-slider" class="hero-slider">


            <div class="hero-slider-wrapper">
                <div class="hero-slide">
                    <div class="hero-slide-video" aria-hidden="true"></div>

                    <div class="hero-slide-content">
                        <h2 class="hero-slide__title">
                            Цифровые продукты
                        </h2>
                        <p class="hero-slide__desc">
                            мы гарантируем бесперебойную работу вашего сайта — от первого клика до конверсии.
                        </p>
                    </div>
                </div>

                <div class="hero-slide">
                    <div class="hero-slide-video" aria-hidden="true"></div>
                    <div class="hero-slide-content">
                        <h2 class="hero-slide__title">
                            Брендинг
                        </h2>
                        <p class="hero-slide__desc">
                            Мы разрабатываем уникальный дизайн, который отражает ваш бренд, создает узнаваемость и укрепляет доверие.
                        </p>
                    </div>
                </div>

                <div class="hero-slide">
                    <div class="hero-slide-video" aria-hidden="true"></div>
                    <div class="hero-slide-content">
                        <h2 class="hero-slide__title">
                            Инженерные решения
                        </h2>
                        <p class="hero-slide__desc">
                            мы упрощаем работу управляющих объектами и помогаем им экономить на расходах на электроэнергию
                        </p>
                    </div>
                </div>

                <div class="hero-slide">
                    <div class="hero-slide-video" aria-hidden="true"></div>
                    <div class="hero-slide-content">
                        <h2 class="hero-slide__title">
                            Поставка оборудования
                        </h2>
                        <p class="hero-slide__desc">
                            Комплексные решения — от принтеров до систем видеоконференций, всё в одном месте.
                        </p>
                    </div>
                </div>
            </div>

        </div>









    </section>




    <section class="home-bg-wrap">

        <span class="home-bg-wrap-decor-1"></span>
        <span class="home-bg-wrap-decor-2"></span>




        <!-- ? recommendations -->

        <div class="recommendations">


            <div class="recommendations-cards">


                <div class="recommendations-card ">

                    <div class="recommendations-card-content">
                        <div class="recommendations-card-image">

                            <picture>
                                <source media="(max-width: 800px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/home/card-mob.png" />
                                <img width="466" height="300" class="recommendations-card__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/card.webp" alt="" />
                            </picture>
                        </div>


                        <p class="recommendations-card__text">
                            Превращай идеи в реальные действия и добивайся ощутимых результатов.
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

                            <div class="recommendations-card__btn-text">Будь практичным</div>
                        </div>
                    </div>
                </div>

                <div class="recommendations-card ">


                    <div class="recommendations-card-content">
                        <div class="recommendations-card-image">

                            <picture>
                                <source media="(max-width: 800px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/home/card-mob.png" />
                                <img width="466" height="300" class="recommendations-card__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/card.webp" alt="" />
                            </picture>
                        </div>



                        <p class="recommendations-card__text">
                            Упакуй свой бренд чтобы быть на голову выше своих конкурентов
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
                            <div class="recommendations-card__btn-text">Будь лучшим</div>
                        </div>
                    </div>
                </div>


                <div class="recommendations-card">


                    <div class="recommendations-card-content">
                        <div class="recommendations-card-image">

                            <picture>
                                <source media="(max-width: 800px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/home/card-mob.png" />
                                <img width="466" height="300" class="recommendations-card__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/card.webp" alt="" />
                            </picture>
                        </div>

                        <p class="recommendations-card__text">
                            Поддерживай бренд, чтобы он работал на тебя всегда.
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

                            <div class="recommendations-card__btn-text">Будь надёжным</div>
                        </div>
                    </div>
                </div>



            </div>




        </div>








        <!-- ? GSAP Pin -->

        <div class="services-portfolio-wrap">


            <div class="home-portfolio">


                <div class="services container">

                    <div class="services__items">
                        <div class="services__item">
                            <h3 class="services__item-title">IT</h3>
                            <p class="services__item-desc">
                                Мы гарантируем бесперебойную работу вашего сайта — от первого клика до конверсии.
                            </p>


                        </div>
                        <div class="services__item">
                            <h3 class="services__item-title">Branding</h3>
                            <p class="services__item-desc">
                                Мы разрабатываем уникальный дизайн, который отражает ваш бренд, создает узнаваемость и укрепляет доверие.
                            </p>
                        </div>
                        <div class="services__item">
                            <h3 class="services__item-title">инженерные решения</h3>
                            <p class="services__item-desc">
                                Мы упрощаем работу управляющих объектами и помогаем им экономить на расходах на электроэнергию
                            </p>
                        </div>
                        <div class="services__item">
                            <h3 class="services__item-title">поставка оборудования</h3>
                            <p class="services__item-desc">
                                Комплексные решения — от принтеров до систем видеоконференций, всё в одном месте.
                            </p>
                        </div>
                    </div>



                    <div class="home-portfolio-circle-wrap">
                        <span class="home-portfolio-title-circle"></span>

                        <div class="home-portfolio-circle-content">
                            <h2 class="home-portfolio__title">Наш успех</h2>

                            <p class="home-portfolio-desc">
                                Превратите свое видение в выдающийся
                                бренд, веб-сайт или мобильное приложение
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





    <!-- ? appointment -->
    <section class="appointment section-bg" style="--section-bg: #fff;">

        <!-- ? container / container-max -->


        <div class="appointment-box">
            <div class="appointment-content">
                <h2 class="appointment__title">Запишитесь на прием</h2>
                <ul class="appointment__list">
                    <li class="appointment__item">
                        <a class="appointment__link" href="./contacts.html?direction=1">App, Web, CRM</a>
                    </li>
                    <li class="appointment__item">
                        <a class="appointment__link" href="./contacts.html?direction=2">Поставка оборудования</a>
                    </li>
                    <li class="appointment__item">
                        <a class="appointment__link" href="./contacts.html?direction=3">Вакансия</a>
                    </li>
                </ul>
            </div>


            <div class="swiper appointment-slider">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="appointment-slide">
                            <div class="appointment-slide-images">
                                <img width="290" height="290" class="appointment-slide__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/appointment/01.png" alt="">
                                <img width="290" height="290" class="appointment-slide__img-face" src="<?php echo get_template_directory_uri(); ?>/assets/images/appointment/01-face.png" alt="">
                            </div>
                            <a class="appointment-slide__link" href="./contacts.html?direction=1">App, Web, CRM, Брендинг</a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="appointment-slide">
                            <div class="appointment-slide-images">
                                <img width="290" height="290" class="appointment-slide__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/appointment/02.png" alt="">
                                <img width="290" height="290" class="appointment-slide__img-face" src="<?php echo get_template_directory_uri(); ?>/assets/images/appointment/02-face.png" alt="">
                            </div>
                            <a class="appointment-slide__link" href="./contacts.html?direction=2">Поставка оборудовани</a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="appointment-slide">
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


    </section>


</main>



<?php get_footer(); ?>