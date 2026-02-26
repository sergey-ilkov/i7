<?php
/*
Template Name: Solutions Page
*/
?>


<?php

add_filter('body_class', function ($classes) {
    $classes[] = 'page-solutions';
    return $classes;
});


get_header();

?>

<main>


    <section id="hero-solutions" class="hero-solutions section-bg" style="--section-bg: #0088ff;">

        <video id="mainVideo" class="main-video track-visibility" playsinline muted autoplay loop poster="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg/engineering-bg.jpg" data-src="<?php echo get_template_directory_uri(); ?>/assets/video/engineering.mp4"></video>



        <div class="hero-card-wrap">
            <div class="hero-card-box">
                <div class="hero-card-content">
                    <h1 class="hero-card__title">
                        Инженерные решения
                    </h1>
                    <div class="hero-card-desc">
                        <p>
                            Благодаря такой консолидации мы обеспечиваем единую точку доступа ко всем системам управления, включая мониторинг сигнализации, видеонаблюдение, аварийное реагирование, пожарную безопасность, энергоснабжение здания и коммунальные системы. 
                        </p>
                        <p>
                            Отображая данные со всех этих систем, мы упрощаем работу управляющих объектами и помогаем им экономить на расходах на электроэнергию и коммунальные услуги, сокращать штат сотрудников, повышать безопасность, эффективнее реагировать на чрезвычайные ситуации и повышать комфорт жильцов.
                        </p>

                    </div>
                </div>

                <div id="hero-card-scroll-wrap" class="hero-card-scroll-wrap">
                    <div class="hero-card-scroll-content">
                        <span class="hero-card-scroll-item">WEB DESIGN APP CRM</span>
                    </div>
                </div>

            </div>

        </div>




        <?php get_template_part('template-parts/hero', 'messages'); ?>



    </section>



    <section class="solutions-camera section-bg" style="--section-bg: #0088ff;">

        <div class="container">
            <div class="solutions-camera-inner">


                <div class="canvas-wrapper">
                    <canvas id="camera-canvas" class="camera-canvas"></canvas>
                </div>

                <div id="camera-preloader">
                    <div class="loader-track">
                        <div id="loader-bar"></div>
                    </div>
                    <div id="loader-text">0%</div>
                </div>


                <h2 class="solutions-camera__title">[ Система видеонаблюдения ]</h2>

                <div class="solutions-camera-circle-wrap">
                    <button class="solutions-camera-circle__btn active" style="--card-bg: #00ce1f;"></button>
                    <button class="solutions-camera-circle__btn" style="--card-bg: #ff9d00;"></button>
                    <button class="solutions-camera-circle__btn" style="--card-bg: #DD00FF;"></button>
                    <button class="solutions-camera-circle__btn" style="--card-bg: #0081f2;"></button>
                    <button class="solutions-camera-circle__btn" style="--card-bg: #8023c8;"></button>
                </div>

                <div class="solutions-camera__cards">

                    <div class="solutions-camera__card active" style="--card-bg: #00ce1f;">
                        <button class="solutions-camera__card-btn">Наши партнеры</button>
                        <div class="solutions-camera__card-body">
                            <div class="solutions-camera__card-items">
                                <div class="solutions-camera__card-item">
                                    <div class="solutions-camera__card-content">
                                        <span class="solutions-camera__card-num">01</span>
                                        <h3 class="solutions-camera__card-title">Наши партнеры</h3>
                                        <span class="solutions-camera-card-decor-1"></span>
                                        <span class="solutions-camera-card-decor-2"></span>
                                    </div>
                                </div>
                                <div class="solutions-camera__card-item">
                                    <img width="270" height="230" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/solutions/card-1.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="solutions-camera__card" style="--card-bg: #ff9d00;">
                        <button class="solutions-camera__card-btn">Распознавание лиц</button>
                        <div class="solutions-camera__card-body">
                            <div class="solutions-camera__card-items">
                                <div class="solutions-camera__card-item">
                                    <div class="solutions-camera__card-content">
                                        <span class="solutions-camera__card-num">02</span>
                                        <h3 class="solutions-camera__card-title">Распознавание лиц</h3>
                                        <span class="solutions-camera-card-decor-1"></span>
                                        <span class="solutions-camera-card-decor-2"></span>
                                    </div>
                                </div>
                                <div class="solutions-camera__card-item">
                                    <img width="270" height="230" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/solutions/card-2.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="solutions-camera__card" style="--card-bg: #DD00FF;">
                        <button class="solutions-camera__card-btn">Удалённый доступ к просмотру</button>
                        <div class="solutions-camera__card-body">
                            <div class="solutions-camera__card-items">
                                <div class="solutions-camera__card-item">
                                    <div class="solutions-camera__card-content">
                                        <span class="solutions-camera__card-num">03</span>
                                        <h3 class="solutions-camera__card-title">Удалённый доступ к просмотру</h3>
                                        <span class="solutions-camera-card-decor-1"></span>
                                        <span class="solutions-camera-card-decor-2"></span>
                                    </div>
                                </div>
                                <div class="solutions-camera__card-item">
                                    <img width="270" height="230" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/solutions/card-3.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="solutions-camera__card" style="--card-bg: #0081f2;">
                        <button class="solutions-camera__card-btn">Мониторинг доступа по зонам</button>
                        <div class="solutions-camera__card-body">
                            <div class="solutions-camera__card-items">
                                <div class="solutions-camera__card-item">
                                    <div class="solutions-camera__card-content">
                                        <span class="solutions-camera__card-num">04</span>
                                        <h3 class="solutions-camera__card-title">Мониторинг доступа по зонам</h3>
                                        <span class="solutions-camera-card-decor-1"></span>
                                        <span class="solutions-camera-card-decor-2"></span>
                                    </div>
                                </div>
                                <div class="solutions-camera__card-item">
                                    <img width="270" height="230" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/solutions/card-4.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="solutions-camera__card" style="--card-bg: #8023c8;">
                        <button class="solutions-camera__card-btn">Распознавание номеров машин</button>
                        <div class="solutions-camera__card-body">
                            <div class="solutions-camera__card-items">
                                <div class="solutions-camera__card-item">
                                    <div class="solutions-camera__card-content">
                                        <span class="solutions-camera__card-num">05</span>
                                        <h3 class="solutions-camera__card-title">Распознавание номеров машин</h3>
                                        <span class="solutions-camera-card-decor-1"></span>
                                        <span class="solutions-camera-card-decor-2"></span>
                                    </div>
                                </div>
                                <div class="solutions-camera__card-item">
                                    <img width="270" height="230" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/solutions/card-5.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>

        <span class="solutions-camera-decor"></span>


    </section>


    <!-- ? Network solutions -->
    <section class="solutions-network section-pin section-bg" style="--section-bg: #252526;">




        <div class="solutions-network-coordinate-wrap">
            <!-- ? video -->
            <video id="solutions-network-video" class="solutions-network-video" playsinline webkit-playsinline muted data-src="<?php echo get_template_directory_uri(); ?>/assets/animations/network.mp4"></video>
            <!-- ? lottie -->
            <div id="solutions-network-lottie" class="solutions-network-lottie"></div>

            <div class="solutions-network-dots">
                <span class="solutions-network-dot"></span>
                <span class="solutions-network-dot"></span>
                <span class="solutions-network-dot"></span>
                <span class="solutions-network-dot"></span>
                <span class="solutions-network-dot"></span>
            </div>

        </div>




        <div class="solutions-network-cards">

            <div class="solutions-network-card-wrap">
                <div class="solutions-network-card">
                    <h3 class="solutions-network-card__title">АТС</h3>
                    <div class="solutions-network-card-body">
                        <p class="solutions-network-card__text">
                            Повышаем эффективность бизнеса с помощью современных IP-АТС: стабильная связь, гибкая маршрутизация и экономия затрат.
                        </p>
                    </div>
                </div>
            </div>

            <div class="solutions-network-card-wrap">
                <div class="solutions-network-card">
                    <h3 class="solutions-network-card__title">VPN</h3>
                    <div class="solutions-network-card-body">
                        <p class="solutions-network-card__text">
                            Защитите свой бизнес с надёжным VPN — безопасное подключение, защита данных и доступ из любой точки мира.
                        </p>
                    </div>
                </div>
            </div>
            <div class="solutions-network-card-wrap">
                <div class="solutions-network-card">
                    <h3 class="solutions-network-card__title">WiFi</h3>
                    <div class="solutions-network-card-body">
                        <p class="solutions-network-card__text">
                            Настроим надёжную Wi-Fi сеть — стабильное покрытие, высокая скорость и защита ваших данных.
                        </p>
                    </div>
                </div>
            </div>
            <div class="solutions-network-card-wrap">
                <div class="solutions-network-card">
                    <h3 class="solutions-network-card__title">Terminal Server</h3>
                    <div class="solutions-network-card-body">
                        <p class="solutions-network-card__text">
                            Организуем Terminal Server — удалённый доступ к рабочим приложениям, безопасность и централизованное управление.
                        </p>
                    </div>
                </div>
            </div>
            <div class="solutions-network-card-wrap">
                <div class="solutions-network-card">
                    <h3 class="solutions-network-card__title">СКС</h3>
                    <div class="solutions-network-card-body">
                        <p class="solutions-network-card__text">
                            Проектируем и устанавливаем СКС — надёжная передача данных, порядок в инфраструктуре и стабильная работа сети.
                        </p>
                    </div>
                </div>
            </div>


        </div>

        <div class="solutions-network-btn-wrap">
            <button class="solutions-network__btn">
                <svg width="37" height="42" viewBox="0 0 37 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.1056 1.39258V19.5004M12.5339 7.91697C8.81646 9.23129 5.6833 11.8175 3.68823 15.2185C1.69315 18.6195 0.964613 22.6163 1.63138 26.5025C2.29814 30.3887 4.31728 33.914 7.33192 36.4555C10.3466 38.997 14.1626 40.3909 18.1056 40.3909C22.0486 40.3909 25.8646 38.997 28.8792 36.4555C31.8939 33.914 33.913 30.3887 34.5798 26.5025C35.2465 22.6163 34.518 18.6195 32.5229 15.2185C30.5278 11.8175 27.3947 9.23129 23.6772 7.91697" stroke="currentColor" stroke-width="2.78582" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        <div class="solutions-network-content-wrap">
            <div class="solutions-network-content">
                <h2 class="solutions-network__title">Сетевые решения</h2>
                <div class="solutions-network__desc">[ Запусти сеть ]</div>
            </div>
        </div>




    </section>











    <!-- ? solutions-automation -->



    <section class="solutions-automation section-pin section-bg" style="--section-bg: #000000;">

        <div class="container">

            <div class="solutions-automation-inner">


                <div class="solutions-automation__cards">


                    <div class="solutions-automation__card">

                        <div class="solutions-automation__card-wrap">

                            <h2 class="solutions-automation__card-title">
                                Время работает на вас
                            </h2>

                            <div class="solutions-automation__card-content-wrap">

                                <div class="solutions-automation__card-content">
                                    <p class="solutions-automation__card-text">
                                        Наша команда обеспечит бесперебойную работу: от разработки фирменного стиля до электронных писем, лендингов, сценографии, видеороликов и даже публикации печатных материалов.
                                    </p>
                                </div>
                            </div>

                        </div>


                    </div>





                    <div class="solutions-automation__card">



                        <div class="solutions-automation__card-wrap">
                            <img width="80" height="80" class="solutions-automation__card-icon lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/solutions/icon2.svg" alt="">

                            <h2 class="solutions-automation__card-title">
                                Cистемы контроля и управления доступом
                            </h2>

                            <div class="solutions-automation__card-content-wrap">

                                <div class="solutions-automation__card-content">
                                    <p class="solutions-automation__card-text">
                                        Проектируем и внедряем современные системы контроля и управления доступом (СКУД).
                                    </p>
                                    <p class="solutions-automation__card-text">
                                        Обеспечиваем безопасность помещений, автоматизируем пропуск сотрудников и посетителей, интегрируем оборудование с видеонаблюдением и пожарной сигнализацией.
                                    </p>
                                    <p class="solutions-automation__card-text">
                                        Надёжность, контроль и удобство в одном решении.

                                    </p>
                                </div>
                            </div>

                        </div>



                    </div>




                    <div class="solutions-automation__card">

                        <div class="solutions-automation__card-wrap">

                            <img width="80" height="80" class="solutions-automation__card-icon lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/solutions/icon3.svg" alt="">

                            <h2 class="solutions-automation__card-title">
                                Домофония
                            </h2>

                            <div class="solutions-automation__card-content-wrap">

                                <div class="solutions-automation__card-content">
                                    <p class="solutions-automation__card-text">
                                        Устанавливаем современные системы домофонии для жилых и коммерческих объектов.
                                    </p>
                                    <p class="solutions-automation__card-text">

                                        Обеспечиваем удобный и безопасный доступ, интеграцию с видеонаблюдением и СКУД, а также возможность удалённого управления через смартфон.
                                    </p>
                                    <p class="solutions-automation__card-text">
                                        Надёжность, комфорт и защита каждый день.

                                    </p>
                                </div>
                            </div>
                        </div>


                    </div>



                    <div class="solutions-automation__card">

                        <div class="solutions-automation__card-wrap">

                            <img width="80" height="80" class="solutions-automation__card-icon lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/solutions/icon4.svg" alt="">

                            <h2 class="solutions-automation__card-title">
                                Дверная автоматика
                            </h2>

                            <div class="solutions-automation__card-content-wrap">

                                <div class="solutions-automation__card-content">
                                    <p class="solutions-automation__card-text">
                                        Наша компания предоставляет комплексные услуги в сфере дверной автоматики: профессиональная установка автоматических и раздвижных дверей, настройка сенсорных и магнитных систем, ремонт и замена механизмов, техническое обслуживание, интеграция с системами контроля доступа и безопасности.

                                    </p>
                                    <p class="solutions-automation__card-text">
                                        Мы гарантируем надежную работу, комфорт и безопасность для офисов, торговых центров, жилых комплексов и промышленных объектов любой сложности.

                                    </p>
                                </div>
                            </div>


                        </div>

                    </div>





                </div>


            </div>

        </div>


        <div class="solutions-automation-wrap">

            <div class="solutions-automation-content-wrap">


                <div class="solutions-automation-content">

                    <div class="solutions-automation-lottie"></div>

                    <h1 class="solutions-automation__title">Автоматизация доступа</h1>

                    <button class="solutions-automation__btn"></button>

                    <p class="solutions-automation__desc">[ Открой доступ ]</p>
                </div>
            </div>

        </div>


    </section>




    <!-- ? fire-systems -->
    <section class="fire-systems section-bg" style="--section-bg: #0088ff;">


        <div class="container">

            <h1 class="fire-systems__title">
                Системы пожарной безопасности
                для всех областей применения
            </h1>
        </div>


        <!-- ? fire-systems-wrap -->
        <div class="fire-systems-scroll">

            <div class="fire-systems-sticky-wrap">

                <div class="fire-svg-stage">

                    <div id="human" class="fire-human">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/solutions/svg-animation/human.svg" style="width: 100%; height: 100%;" alt="person">
                    </div>




                    <div class="fire-overlays">

                        <div id="desktop-scroll-hints" class="desktop-scroll-hints">
                            <div class="scroll-hint"><span class="scroll-hint-text">скролл вниз</span><span class="scroll-hint-arrow"></span></div>
                            <div class="scroll-hint"><span class="scroll-hint-text">скролл вниз</span><span class="scroll-hint-arrow"></span></div>
                            <div class="scroll-hint"><span class="scroll-hint-text">скролл вниз</span><span class="scroll-hint-arrow"></span></div>
                            <div class="scroll-hint"><span class="scroll-hint-text">скролл вниз</span><span class="scroll-hint-arrow"></span></div>
                        </div>

                        <div id="mobile-scroll-hints" class="mobile-scroll-hints">
                            <div class="scroll-hint"><span class="scroll-hint-text">скролл вниз</span><span class="scroll-hint-arrow"></span></div>
                            <div class="scroll-hint"><span class="scroll-hint-text">скролл вниз</span><span class="scroll-hint-arrow"></span></div>
                            <div class="scroll-hint"><span class="scroll-hint-text">скролл вниз</span><span class="scroll-hint-arrow"></span></div>
                            <div class="scroll-hint"><span class="scroll-hint-text">скролл вниз</span><span class="scroll-hint-arrow"></span></div>
                            <div class="scroll-hint"><span class="scroll-hint-text">скролл вниз</span><span class="scroll-hint-arrow"></span></div>
                        </div>

                        <div id="desktop-icon-points" class="desktop-icon-points">
                            <span class="desktop-icon-point"></span>
                            <span class="desktop-icon-point"></span>
                            <span class="desktop-icon-point"></span>
                            <span class="desktop-icon-point"></span>
                            <span class="desktop-icon-point"></span>
                            <span class="desktop-icon-point"></span>
                        </div>
                        <div id="mobile-icon-points" class="mobile-icon-points">
                            <span class="mobile-icon-point"></span>
                            <span class="mobile-icon-point"></span>
                            <span class="mobile-icon-point"></span>
                            <span class="mobile-icon-point"></span>
                        </div>


                        <div id="desktop-anchor-icon-points" class="desktop-anchor-icon-points">
                            <span class="desktop-anchor-icon-point"></span>
                            <span class="desktop-anchor-icon-point"></span>
                            <span class="desktop-anchor-icon-point"></span>
                            <span class="desktop-anchor-icon-point"></span>
                        </div>
                        <div id="mobile-anchor-icon-points" class="mobile-anchor-icon-points">
                            <span class="mobile-anchor-icon-point"></span>
                            <span class="mobile-anchor-icon-point"></span>
                            <span class="mobile-anchor-icon-point"></span>
                            <span class="mobile-anchor-icon-point"></span>
                        </div>


                        <div class="fire-systems__cards">
                            <div class="fire-systems__card">
                                <svg class="svg-fire-card" viewBox="0 0 683 553" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M67.1279 551.906H615.372C652.17 551.906 682 522.076 682 485.278V67.127C682 30.3296 652.17 0.499023 615.372 0.499023H216.538C183.343 0.499023 156.433 27.4093 156.433 60.6045C156.433 113.528 113.529 156.432 60.6055 156.432C27.4102 156.432 0.500099 183.342 0.5 216.537V485.278C0.5 522.076 30.3303 551.906 67.1279 551.906Z" stroke="white" />
                                </svg>

                                <h2 class="fire-systems__card-title">
                                    Обнаружение пожара
                                </h2>

                                <div class="fire-systems__card-content">
                                    <p>
                                        Предлагаем широкий спектр систем пожарной сигнализации, отвечающих самым высоким требованиям. Локальные, линейные, аспирационные, адресные или традиционные, проводные или радиопоглощающие: каждый оператор найдет в beam решение, соответствующее ограничениям его объекта.
                                    </p>
                                </div>
                            </div>

                            <div class="fire-systems__card">
                                <svg class="svg-fire-card" viewBox="0 0 683 553" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M67.1279 551.906H615.372C652.17 551.906 682 522.076 682 485.278V67.127C682 30.3296 652.17 0.499023 615.372 0.499023H216.538C183.343 0.499023 156.433 27.4093 156.433 60.6045C156.433 113.528 113.529 156.432 60.6055 156.432C27.4102 156.432 0.500099 183.342 0.5 216.537V485.278C0.5 522.076 30.3303 551.906 67.1279 551.906Z" stroke="white" />
                                </svg>

                                <h2 class="fire-systems__card-title">
                                    Временное обнаружение
                                </h2>

                                <div class="fire-systems__card-content">
                                    <p>
                                        Набор услуг, гарантирующих уровень функциональности системы на протяжении всего проекта (управление неисправностями оборудования и загрязнениями).Гибкое решение в виде ежемесячного контракта на обслуживание, позволяющее обеспечить безопасность объекта только в течение целевых периодов.
                                    </p>
                                </div>
                            </div>
                            <div class="fire-systems__card">
                                <svg class="svg-fire-card" viewBox="0 0 683 553" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M67.1279 551.906H615.372C652.17 551.906 682 522.076 682 485.278V67.127C682 30.3296 652.17 0.499023 615.372 0.499023H216.538C183.343 0.499023 156.433 27.4093 156.433 60.6045C156.433 113.528 113.529 156.432 60.6055 156.432C27.4102 156.432 0.500099 183.342 0.5 216.537V485.278C0.5 522.076 30.3303 551.906 67.1279 551.906Z" stroke="white" />
                                </svg>

                                <h2 class="fire-systems__card-title">
                                    Видеодетектирование
                                </h2>
                                <div class="fire-systems__card-content">
                                    <p>
                                        .beam представляет собой успешное сочетание технологических достижений в области обнаружения объектов и обнаружения пожара и представляет собой систему, состоящую из интеллектуальных камер со встроенными алгоритмами для обнаружения дыма и пламени.
                                    </p>
                                </div>
                            </div>
                            <div class="fire-systems__card">
                                <svg class="svg-fire-card" viewBox="0 0 683 553" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M67.1279 551.906H615.372C652.17 551.906 682 522.076 682 485.278V67.127C682 30.3296 652.17 0.499023 615.372 0.499023H216.538C183.343 0.499023 156.433 27.4093 156.433 60.6045C156.433 113.528 113.529 156.432 60.6055 156.432C27.4102 156.432 0.500099 183.342 0.5 216.537V485.278C0.5 522.076 30.3303 551.906 67.1279 551.906Z" stroke="white" />
                                </svg>

                                <h2 class="fire-systems__card-title">
                                    Система оповещения безопасности
                                </h2>
                                <div class="fire-systems__card-content">
                                    <p>
                                        Индивидуальный план безопасности (PPMS) – В связи с объявленным правительством чрезвычайным положением школы обязаны разработать план оповещения. Система оповещения SSS, предлагаемая beam, включает функцию PPMS, которая включает в себя четыре настраиваемых сообщения: атака, стихийное бедствие, сдерживание и эвакуация.
                                    </p>
                                </div>
                            </div>


                        </div>





                    </div>



                    <svg id="fire-svg-desktop" class="fire-svg-desktop" width="1920" height="4300" viewBox="0 0 1920 4300" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="desktop-path">
                            <path id="Vector 4817" d="M1116 4287L967 4287" stroke="#303030" />
                            <path id="main-path-desktop" d="M967 12V741H378V1123H1542V2163H378V3267H1542V4287H1114.5" stroke="#303030" />
                            <g class="anchor-icon-points">
                                <path class="line" d="M518 936H378" stroke="#303030" />
                                <path class="line" d="M1542 1833H1402" stroke="#303030" />
                                <path class="line" d="M518 3085H378" stroke="#303030" />
                                <circle class="anchor-icon-point" cx="518" cy="936" r="3" fill="none" />
                                <circle class="anchor-icon-point" cx="1402" cy="1833" r="3" fill="none" />
                                <circle class="anchor-icon-point" cx="518" cy="3085" r="3" fill="none" />
                                <circle class="anchor-icon-point" cx="967" cy="4287" r="3" fill="none" />
                            </g>
                            <g class="anchor-points">
                                <circle class="anchor-point" cx="378" cy="936" r="5" fill="none" />
                                <circle class="anchor-point" cx="1542" cy="1833" r="5" fill="none" />
                                <circle class="anchor-point" cx="378" cy="3085" r="5" fill="none" />
                                <circle class="anchor-point" cx="1116" cy="4287" r="5" fill="none" />
                            </g>
                            <g class="icon-points">
                                <circle class="icon-point" cx="967" cy="741" r="8" fill="#303030" />
                                <circle class="icon-point" cx="1542" cy="1123" r="8" fill="#303030" />
                                <circle class="icon-point" cx="1542" cy="2163" r="8" fill="#303030" />
                                <circle class="icon-point" cx="378" cy="2163" r="8" fill="#303030" />
                                <circle class="icon-point" cx="1542" cy="3267" r="8" fill="#303030" />
                                <circle class="icon-point" cx="1542" cy="4287" r="8" fill="#303030" />
                            </g>
                            <g class="anchor-scroll-texts">
                                <circle class="anchor-scroll-text" cx="993" cy="342" r="2" fill="none" />
                                <circle class="anchor-scroll-text" cx="1516" cy="1417" r="2" fill="none" />
                                <circle class="anchor-scroll-text" cx="404" cy="2491" r="2" fill="none" />
                                <circle class="anchor-scroll-text" cx="1516" cy="3566" r="2" fill="none" />
                            </g>
                        </g>
                    </svg>






                    <svg id="fire-svg-mobile" class="fire-svg-mobile" width="375" height="3600" viewBox="0 0 375 3600" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="mobile-path">
                            <path id="main-path-mobile" d="M45 0V3156.5" stroke="#303030" />
                            <g class="anchor-icon-points">
                                <path class="line-1" d="M45 720H155" stroke="#303030" />
                                <path class="line-2" d="M45 1532H155" stroke="#303030" />
                                <path class="line-3" d="M45 2344H155" stroke="#303030" />
                                <path class="line-4" d="M45 3156H155" stroke="#303030" />
                                <circle class="anchor-icon-point" cx="155" cy="720" r="3" fill="none" />
                                <circle class="anchor-icon-point" cx="155" cy="1532" r="3" fill="none" />
                                <circle class="anchor-icon-point" cx="155" cy="2344" r="3" fill="none" />
                                <circle class="anchor-icon-point" cx="155" cy="3156" r="3" fill="none" />
                                <path class="Vector 4818" d="M45 3156V3600" stroke="black" />
                            </g>
                            <g class="anchor-points">
                                <circle class="anchor-point" cx="45" cy="705" r="5" fill="none" />
                                <circle class="anchor-point" cx="45" cy="1516" r="5" fill="none" />
                                <circle class="anchor-point" cx="45" cy="2329" r="5" fill="none" />
                                <circle class="anchor-point" cx="45" cy="3141" r="5" fill="none" />
                            </g>
                            <g class="icon-points">
                                <path class="line-1_2" d="M45 478H180" stroke="#303030" />
                                <path class="line-2_2" d="M45 1291H180" stroke="#303030" />
                                <path class="line-3_2" d="M45 2103H180" stroke="#303030" />
                                <path class="line-4_2" d="M45 2914L180 2914" stroke="#303030" />
                                <circle class="icon-point" cx="180" cy="478" r="8" fill="#303030" />
                                <circle class="icon-point" cx="180" cy="1291" r="8" fill="#303030" />
                                <circle class="icon-point" cx="180" cy="2103" r="8" fill="#303030" />
                                <circle class="icon-point" cx="180" cy="2914" r="8" fill="#303030" />
                            </g>
                            <g class="anchor-scroll-texts">
                                <circle class="anchor-scroll-text" cx="61" cy="130" r="2" fill="none" />
                                <circle class="anchor-scroll-text" cx="61" cy="942" r="2" fill="none" />
                                <circle class="anchor-scroll-text" cx="61" cy="1754" r="2" fill="none" />
                                <circle class="anchor-scroll-text" cx="61" cy="2566" r="2" fill="none" />
                                <circle class="anchor-scroll-text" cx="61" cy="3378" r="2" fill="none" />
                            </g>
                        </g>
                    </svg>


                </div>





            </div>



        </div>


    </section>





    <!-- ? appointment -->
    <section class="appointment section-bg" style="--section-bg: #fff;">


        <?php get_template_part('template-parts/section', 'specialists'); ?>

    </section>





</main>



<?php get_footer(); ?>