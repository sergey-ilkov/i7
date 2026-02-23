<?php
/*
Template Name: Contacts Page
*/
?>


<?php

add_filter('body_class', function ($classes) {
    $classes[] = 'page-contacts';
    return $classes;
});


get_header();

?>

<main>



    <section class="contacts section-bg" style="--section-bg: #fff;">

        <span class="contacts-decor-1"></span>
        <span class="contacts-decor-2"></span>



        <div class="contacts__items">

            <div class="contacts__item">
                <div class="contacts-content">

                    <h1 class="contacts__title">Есть вопросы? Обращайтесь!</h1>
                    <p class="contacts__desc">
                        цифровизация вашего бизнеса
                    </p>
                </div>
            </div>
            <div class="contacts__item">
                <div id="real-clock" class="real-clock contacts-clock">
                    <span id="real-time" class="real-time"></span>
                    <span id="real-date" class="real-date"></span>
                </div>
            </div>

            <div class="contacts__item">



                <div id="contacts-slider" class="swiper contacts-slider">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="contacts-slide image-right" style="--color-contacts: #0088ff;" data-direction="1">
                                <div class="contacts-slide-images">
                                    <img width="290" height="290" class="contacts-slide__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/appointment/01.png" alt="">
                                    <img width="290" height="290" class="contacts-slide__img-face" src="<?php echo get_template_directory_uri(); ?>/assets/images/appointment/01-face.png" alt="">
                                </div>
                                <span class="contacts-slide__title">App, Web, CRM, Брендинг</span>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="contacts-slide active" style="--color-contacts: #e5c100;" data-direction="2">
                                <div class="contacts-slide-images">
                                    <img width="290" height="290" class="contacts-slide__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/appointment/02.png" alt="">
                                    <img width="290" height="290" class="contacts-slide__img-face" src="<?php echo get_template_directory_uri(); ?>/assets/images/appointment/02-face.png" alt="">
                                </div>
                                <span class="contacts-slide__title">Поставка оборудовани</span>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="contacts-slide image-left" style="--color-contacts: #8e5aac;" data-direction="3">
                                <div class="contacts-slide-images">
                                    <img width="290" height="290" class="contacts-slide__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/appointment/03.png" alt="">
                                    <img width="290" height="290" class="contacts-slide__img-face" src="<?php echo get_template_directory_uri(); ?>/assets/images/appointment/03-face.png" alt="">
                                </div>
                                <span class="contacts-slide__title">Вакансия</span>
                            </div>
                        </div>



                    </div>

                </div>

            </div>
            <div class="contacts__item">


                <form id="contacts-form" class="contacts-form" action="#" style="--form-bg: #e5c100;">

                    <input id="direction_id" type="hidden" name="direction_id" value="2">

                    <div class="form-row">
                        <div class="form-group">
                            <label class="required-star" for="firstName">Имя</label>
                            <input type="text" id="firstName" name="firstName" class="field" autocomplete="off" data-required="true" />
                            <span class="error-msg" data-for="firstName"></span>
                        </div>

                        <div class="form-group">
                            <label for="lastName">Фамилия</label>
                            <input type="text" id="lastName" name="lastName" class="field" autocomplete="off" data-required="false" />
                            <span class="error-msg" data-for="lastName"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="required-star" for="phone">Телефон</label>
                            <input type="tel" id="phone" name="phone" class="field" autocomplete="off" data-required="true" />
                            <span class="error-msg" data-for="phone"></span>
                        </div>
                        <div class="form-group">
                            <label class="required-star" for="email">Почта</label>
                            <input type="email" id="email" name="email" class="field" autocomplete="off" data-required="true" />
                            <span class="error-msg" data-for="email"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="company">Название компании</label>
                            <input type="text" id="company" name="company" class="field" autocomplete="off" data-required="false" />
                            <span class="error-msg" data-for="company"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="required-star" for="message">Сообщение</label>
                            <input type="text" id="message" name="message" class="field" autocomplete="off" data-required="true" />
                            <span class="error-msg" data-for="message"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="required-star" for="source">Как вы узнали о нас</label>
                            <input type="text" id="source" name="source" class="field" autocomplete="off" data-required="true" />
                            <span class="error-msg" data-for="source"></span>
                        </div>
                    </div>

                    <div class="form-text">
                        <p>
                            Студии beam нужны контактные данные, которые вы нам предоставляете, чтобы связаться с вами по поводу наших продуктов и услуг. Вы можете отписаться от этих сообщений в любое время. Для получения информации о том, как отписаться, а также о наших правилах конфиденциальности и обязательствах по защите вашей конфиденциальности, пожалуйста, ознакомьтесь с нашей Политикой конфиденциальности.
                        </p>
                    </div>



                    <button id="submitBtn" type="button" class="contacts-form-btn">Отправить</button>

                </form>
            </div>



        </div>



    </section>






</main>



<?php get_footer(); ?>