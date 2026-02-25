<?php
/*
Template Name: Branding Page
*/
?>


<?php

add_filter('body_class', function ($classes) {
    $classes[] = 'page-branding';
    return $classes;
});

get_header();

?>

<main>



    <section id="hero-branding" class="hero-branding section-bg" style="--section-bg: #0088ff;">

        <video id="mainVideo" class="main-video track-visibility" playsinline muted autoplay loop poster="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg/branding-bg.jpg" data-src="<?php echo get_template_directory_uri(); ?>/assets/video/branding.mp4"></video>



        <div class="hero-card-wrap">
            <div class="hero-card-box">
                <div class="hero-card-content">
                    <h1 class="hero-card__title">
                        Брендинг и цифровой дизайн
                    </h1>
                    <div class="hero-card-desc">
                        <p>
                            Мы помогаем компаниям проектировать, разрабатывать и позиционировать свою продукцию как впечатляющие решения, которые вдохновляют.
                        </p>
                        <p>
                            Тщательно отобранная команда экспертов, движимая стремлением решать проблемы и глубоко укоренившимся презрением к посредственности.
                        </p>
                        <p>
                            Мы сочетаем стратегические идеи с безграничной креативностью, чтобы раскрыть уникальную суть вашего бренда и подчеркнуть то, что делает его особенным. Мы расширяем границы и всегда ищем способы сделать всё лучше.
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




        <div class="hero-message-box">
            <div class="hero-message">
                <span class="hero-message__icon"></span>
                <span class="hero-message__text">Здравствуйте ))</span>
            </div>
            <div class="hero-message">
                <span class="hero-message__icon"></span>
                <span class="hero-message__text">Приветствую)), чем могу помочь</span>
            </div>
            <div class="hero-message">
                <span class="hero-message__icon"></span>
                <span class="hero-message__text">Хотел бы проконсультироваться</span>
            </div>


        </div>

    </section>





    <section id="branding" class="branding section-bg" style="--section-bg: #0088ff;">
        <!-- container-max -->
        <div class="container">

            <div class="branding-wrap">
                <div class="branding-box">

                    <div class="branding-lottie"></div>

                    <div class="branding-content">
                        <h2 class="branding-content__title">
                            Время работает на вас
                        </h2>
                        <p class="branding-content__text">
                            Наша команда обеспечит бесперебойную работу: от разработки фирменного стиля до электронных писем, лендингов, сценографии, видеороликов и даже публикации печатных материалов.
                        </p>

                    </div>

                </div>
                <div class="branding-box">
                    <div class="branding-lottie"></div>
                    <div class="branding-content">
                        <h2 class="branding-content__title">
                            Создание цифрового бренда
                        </h2>
                        <p class="branding-content__text">
                            Мы разрабатываем готовые веб-сайты и веб-приложения, которые преобразуют и усиливают послания бренда.
                        </p>

                    </div>

                </div>
                <div class="branding-box">
                    <div class="branding-lottie"></div>
                    <div class="branding-content">
                        <h2 class="branding-content__title">
                            Индивидуальный подход
                        </h2>
                        <p class="branding-content__text">
                            Мы объединяем стратегию, креативность и цифровые технологии, чтобы воплотить ваше видение, поддержать ваш успех и максимизировать его влияние.
                        </p>

                    </div>

                </div>
                <div class="branding-box">
                    <div class="branding-lottie"></div>
                    <div class="branding-content">
                        <h2 class="branding-content__title">
                            Брендинг с вашими целями развития
                        </h2>
                        <p class="branding-content__text">
                            Каждый бизнес уникален, но все они развиваются постепенно. Наши решения адаптируются к этапу вашего развития, чтобы бережно поддерживать ваши амбиции.
                        </p>

                    </div>

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