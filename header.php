<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <!-- <div class="preloader"></div> -->

    <!-- <div id="preloader" class="preloader">
        <div class="preloader-logo">
            <svg width="256" height="70" viewBox="0 0 256 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M191.203 69.4627V38.1331C191.203 18.0402 213.887 14.1019 223.537 25.5268C233.11 13.9074 256.001 18.3768 256.001 38.1331V69.4627C256.001 69.7589 255.758 69.9991 255.457 69.9991H247.562C247.262 69.9991 247.018 69.7589 247.018 69.4627V37.6465C247.018 25.0898 227.841 25.3599 227.841 37.6465V69.4627C227.841 69.7589 227.596 69.9991 227.295 69.9991H227.255H219.949H219.773C219.472 69.9991 219.227 69.7589 219.227 69.4627V37.6465C219.227 25.0898 200.297 25.3599 200.297 37.6465V69.4627C200.297 69.7589 200.053 69.9991 199.753 69.9991H191.747C191.447 69.9991 191.203 69.7589 191.203 69.4627Z" fill="white" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M181.889 44.6182C181.889 44.6301 181.889 44.6421 181.888 44.6542V69.9479H172.767V63.9444C168.282 67.6881 162.479 69.9455 156.142 69.9455C141.922 69.9455 130.395 58.5819 130.395 44.564C130.395 30.5462 141.922 19.1826 156.142 19.1826C170.362 19.1826 181.889 30.5462 181.889 44.564C181.889 44.5821 181.889 44.6001 181.889 44.6182ZM156.041 61.1618C165.277 61.1618 172.764 53.7806 172.764 44.6756C172.764 35.5705 165.277 28.1894 156.041 28.1894C146.804 28.1894 139.317 35.5705 139.317 44.6756C139.317 53.7806 146.804 61.1618 156.041 61.1618Z" fill="white" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M122.927 48.0909C123.098 46.8918 123.187 45.6656 123.187 44.4181C123.187 30.3973 111.961 19.0312 98.112 19.0312C84.2636 19.0312 73.0371 30.3973 73.0371 44.4181C73.0371 55.0615 79.5061 64.175 88.6807 67.9481C98.5074 71.9896 113.642 69.5852 120.25 60.2849C120.287 60.2331 120.323 60.1808 120.358 60.1279L112.909 55.8852C104.233 63.8601 86.9419 63.4464 82.2429 48.0909H122.927ZM114.264 39.2856H82.1301C82.1301 39.2856 84.3866 27.9496 98.3385 27.9496C112.29 27.9496 114.264 39.2856 114.264 39.2856Z" fill="white" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M40.7286 19.199C34.3173 19.199 28.4532 21.5092 23.9463 25.3311V7.72852e-07L14.9785 0V45.5962H15.0018C15.5426 59.1431 26.8539 69.9619 40.7286 69.9619C54.9483 69.9619 66.4756 58.5983 66.4756 44.5805C66.4756 30.5628 54.9483 19.199 40.7286 19.199ZM40.6663 28.1972C31.4301 28.1972 23.9426 35.5784 23.9426 44.6834C23.9426 53.7884 31.4301 61.1696 40.6663 61.1696C49.9027 61.1696 57.39 53.7884 57.39 44.6834C57.39 35.5784 49.9027 28.1972 40.6663 28.1972Z" fill="white" />
                <path d="M5.44129 70C8.44643 70 10.8826 67.5984 10.8826 64.636C10.8826 61.6735 8.44643 59.272 5.44129 59.272C2.43615 59.272 0 61.6735 0 64.636C0 67.5984 2.43615 70 5.44129 70Z" fill="white" />
            </svg>

        </div>
        <span class="preloader-text">
            Добро пожаловать в beam студию
        </span>
    </div> -->


    <div class="wrapper">

        <header id="header" class="header">

            <div class="container-max">

                <div class="header-inner">

                    <div class="header-logo">
                        <svg class="hero-logo-svg" width="84" height="24" viewBox="0 0 84 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M62.7383 23.8157V13.0742C62.7383 6.1852 70.1816 4.83493 73.3477 8.75203C76.4891 4.76823 84.0001 6.30061 84.0001 13.0742V23.8157C84.0001 23.9173 83.9202 23.9996 83.8216 23.9996H81.2311C81.1325 23.9996 81.0526 23.9173 81.0526 23.8157V12.9073C81.0526 8.60218 74.76 8.69478 74.76 12.9073V23.8157C74.76 23.9173 74.6796 23.9996 74.581 23.9996H74.5678H72.1706H72.1128C72.0142 23.9996 71.9337 23.9173 71.9337 23.8157V12.9073C71.9337 8.60218 65.7221 8.69478 65.7221 12.9073V23.8157C65.7221 23.9173 65.6422 23.9996 65.5436 23.9996H62.9167C62.8182 23.9996 62.7383 23.9173 62.7383 23.8157Z" fill="currentColor" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M59.6829 15.2979C59.6829 15.302 59.6829 15.3061 59.6823 15.3103V23.9824H56.6897V21.924C55.2179 23.2076 53.3139 23.9815 51.2344 23.9815C46.5685 23.9815 42.7861 20.0854 42.7861 15.2793C42.7861 10.4732 46.5685 6.57715 51.2344 6.57715C55.9004 6.57715 59.6829 10.4732 59.6829 15.2793C59.6829 15.2855 59.6829 15.2917 59.6829 15.2979ZM51.2014 20.97C54.232 20.97 56.6886 18.4393 56.6886 15.3176C56.6886 12.1959 54.232 9.66517 51.2014 9.66517C48.1707 9.66517 45.7139 12.1959 45.7139 15.3176C45.7139 18.4393 48.1707 20.97 51.2014 20.97Z" fill="currentColor" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M40.3348 16.4882C40.3911 16.0771 40.4203 15.6567 40.4203 15.229C40.4203 10.4218 36.7366 6.5249 32.1926 6.5249C27.6485 6.5249 23.9648 10.4218 23.9648 15.229C23.9648 18.8781 26.0875 22.0027 29.0979 23.2964C32.3223 24.682 37.2884 23.8577 39.4567 20.669C39.4688 20.6512 39.4806 20.6333 39.492 20.6152L37.0478 19.1605C34.2009 21.8948 28.5274 21.7529 26.9855 16.4882H40.3348ZM37.4926 13.4692H26.9485C26.9485 13.4692 27.6889 9.58263 32.2669 9.58263C36.8448 9.58263 37.4926 13.4692 37.4926 13.4692Z" fill="currentColor" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.3643 6.58252C11.2606 6.58252 9.33644 7.37458 7.85759 8.68495V2.64978e-07L4.91504 0V15.633H4.92267C5.10014 20.2776 8.81167 23.9869 13.3643 23.9869C18.0302 23.9869 21.8126 20.0908 21.8126 15.2847C21.8126 10.4787 18.0302 6.58252 13.3643 6.58252ZM13.3439 9.66759C10.3132 9.66759 7.85637 12.1983 7.85637 15.32C7.85637 18.4417 10.3132 20.9724 13.3439 20.9724C16.3745 20.9724 18.8313 18.4417 18.8313 15.32C18.8313 12.1983 16.3745 9.66759 13.3439 9.66759Z" fill="currentColor" />
                            <path d="M1.78543 24C2.77149 24 3.57085 23.1766 3.57085 22.1609C3.57085 21.1452 2.77149 20.3218 1.78543 20.3218C0.799362 20.3218 0 21.1452 0 22.1609C0 23.1766 0.799362 24 1.78543 24Z" fill="currentColor" />
                        </svg>
                    </div>


                    <div class="header-box">
                        <div class="lang-box">
                            <span class="lang">RU</span>
                            <a class="lang lang-link" href="#">EN</a>
                        </div>

                        <button id="burger-menu" class="burger-menu" type="button" aria-label="Open menu">
                            <span></span>
                            <span></span>
                        </button>
                    </div>




                    <!-- ? header-menu -->
                    <div id="header-menu" class="header-menu">

                        <div class="header-menu-body">
                            <button class="btn-close">
                                <svg viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="120" height="120" rx="60" fill="white" />
                                    <path d="M43.0293 43.0293L76.9704 76.9704" stroke="currentColor" stroke-linecap="round" />
                                    <path d="M76.9707 43.0293L43.0296 76.9704" stroke="currentColor" stroke-linecap="round" />
                                </svg>
                            </button>



                            <span class="header-menu-circle"></span>

                            <nav class="nav-menu">
                                <ul class="header-menu-list">

                                    <li class="header-menu__item">
                                        <a class="header-menu__link" href="#">О нас</a>
                                    </li>
                                    <li class="header-menu__item">
                                        <a class="header-menu__link link-anchor" href="./#home-portfolio">Портфолио</a>
                                    </li>
                                    <li class="header-menu__item">
                                        <a class="header-menu__link" href="#">Информационные продукты</a>
                                    </li>
                                    <li class="header-menu__item">
                                        <a class="header-menu__link" href="#">Брендинг</a>
                                    </li>
                                    <li class="header-menu__item">
                                        <a class="header-menu__link" href="#">Инженерные решения</a>
                                    </li>
                                    <li class="header-menu__item">
                                        <a class="header-menu__link" href="#">Поставка оборудования</a>
                                    </li>
                                </ul>
                            </nav>





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
                                                    <img width="290" height="290" class="appointment-slide__img" src="./images/appointment/01.png" alt="">
                                                    <img width="290" height="290" class="appointment-slide__img-face" src="./images/appointment/01-face.png" alt="">
                                                </div>
                                                <a class="appointment-slide__link" href="./contacts.html?direction=1">App, Web, CRM, Брендинг</a>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="appointment-slide">
                                                <div class="appointment-slide-images">
                                                    <img width="290" height="290" class="appointment-slide__img" src="./images/appointment/02.png" alt="">
                                                    <img width="290" height="290" class="appointment-slide__img-face" src="./images/appointment/02-face.png" alt="">
                                                </div>
                                                <a class="appointment-slide__link" href="./contacts.html?direction=2">Поставка оборудовани</a>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="appointment-slide">
                                                <div class="appointment-slide-images">
                                                    <img width="290" height="290" class="appointment-slide__img" src="./images/appointment/03.png" alt="">
                                                    <img width="290" height="290" class="appointment-slide__img-face" src="./images/appointment/03-face.png" alt="">
                                                </div>
                                                <a class="appointment-slide__link" href="./contacts.html?direction=3">Вакансия</a>
                                            </div>
                                        </div>



                                    </div>

                                </div>

                            </div>




                        </div>

                    </div>


                </div>
            </div>

        </header>