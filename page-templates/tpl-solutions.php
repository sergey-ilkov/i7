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

<?php

// $solutions_title = get_field('solutions_title');
// $solutions_desc = get_field('solutions_desc');
// $solutions_poster = get_field('solutions_poster');
// $solutions_video  = get_field('solutions_video');





global $post;
$post_id = $post->ID;
$fields = get_fields($post_id); // вернёт ассоц. массив полей ACF для указанного поста

?>



<!-- <section class="query" style="color:#000;">

    <?php

    echo '<br><br>';
    echo '<pre>';

    var_dump($fields);

    echo '</pre>';
    echo '<br><br>';

    ?>

</section> -->




<main>




    <section id="hero-solutions" class="hero-solutions section-bg" style="--section-bg: #0088ff;">


        <video id="mainVideo" class="main-video track-visibility" playsinline muted autoplay loop poster="<?php echo  $fields['solutions_poster'] ? esc_url($fields['solutions_poster']) : ''; ?>" data-src="<?php echo $fields['solutions_video'] ? esc_url($fields['solutions_video']) : '';  ?>"></video>

        <div class="hero-card-wrap">
            <div class="hero-card-box">
                <div class="hero-card-content">
                    <h1 class="hero-card__title">

                        <?php echo $fields['solutions_title'] ?  esc_html($fields['solutions_title']) : ''; ?>


                    </h1>
                    <div class="hero-card-desc">

                        <?php echo $fields['solutions_desc'] ?  wp_kses_post($fields['solutions_desc']) : ''; ?>


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


                <h2 class="solutions-camera__title">
                    <?php echo $fields['solutions_camera_title'] ?  esc_html($fields['solutions_camera_title']) : ''; ?>
                </h2>

                <?php

                $camera_card_1 = $fields['solutions_camera_card_1'];
                $camera_card_2 = $fields['solutions_camera_card_2'];
                $camera_card_3 = $fields['solutions_camera_card_3'];
                $camera_card_4 = $fields['solutions_camera_card_4'];
                $camera_card_5 = $fields['solutions_camera_card_5'];

                ?>

                <div class="solutions-camera-circle-wrap">
                    <button class="solutions-camera-circle__btn active" style="--card-bg: <?php echo $camera_card_1 ? esc_attr($camera_card_1['color']) : '#00ce1f';  ?>;"></button>
                    <button class="solutions-camera-circle__btn" style="--card-bg: <?php echo $camera_card_2 ? esc_attr($camera_card_2['color']) : '#00ce1f';  ?>;"></button>
                    <button class="solutions-camera-circle__btn" style="--card-bg: <?php echo $camera_card_3 ? esc_attr($camera_card_3['color']) : '#00ce1f';  ?>;"></button>
                    <button class="solutions-camera-circle__btn" style="--card-bg: <?php echo $camera_card_4 ? esc_attr($camera_card_4['color']) : '#00ce1f';  ?>;"></button>
                    <button class="solutions-camera-circle__btn" style="--card-bg: <?php echo $camera_card_5 ? esc_attr($camera_card_5['color']) : '#00ce1f';  ?>;"></button>
                </div>

                <div class="solutions-camera__cards">

                    <div class="solutions-camera__card active" style="--card-bg: <?php echo $camera_card_1 ? esc_attr($camera_card_1['color']) : '#00ce1f';  ?>;">
                        <button class="solutions-camera__card-btn">

                            <?php echo $camera_card_1 ? esc_html($camera_card_1['title']) : '';  ?>

                        </button>
                        <div class="solutions-camera__card-body">
                            <div class="solutions-camera__card-items">
                                <div class="solutions-camera__card-item">
                                    <div class="solutions-camera__card-content">
                                        <span class="solutions-camera__card-num">01</span>
                                        <h3 class="solutions-camera__card-title">

                                            <?php echo $camera_card_1 ? esc_html($camera_card_1['title']) : '';  ?>

                                        </h3>
                                        <span class="solutions-camera-card-decor-1"></span>
                                        <span class="solutions-camera-card-decor-2"></span>
                                    </div>
                                </div>
                                <div class="solutions-camera__card-item">

                                    <?php echo $camera_card_1['image'] ? wp_get_attachment_image($camera_card_1['image'], 'full', false, array('loading' => 'lazy')) : ''; ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="solutions-camera__card" style="--card-bg: <?php echo $camera_card_2 ? esc_attr($camera_card_2['color']) : '#00ce1f';  ?>;">
                        <button class="solutions-camera__card-btn">

                            <?php echo $camera_card_2 ? esc_html($camera_card_2['title']) : '';  ?>

                        </button>
                        <div class="solutions-camera__card-body">
                            <div class="solutions-camera__card-items">
                                <div class="solutions-camera__card-item">
                                    <div class="solutions-camera__card-content">
                                        <span class="solutions-camera__card-num">02</span>
                                        <h3 class="solutions-camera__card-title">

                                            <?php echo $camera_card_2 ? esc_html($camera_card_2['title']) : '';  ?>

                                        </h3>
                                        <span class="solutions-camera-card-decor-1"></span>
                                        <span class="solutions-camera-card-decor-2"></span>
                                    </div>
                                </div>
                                <div class="solutions-camera__card-item">

                                    <?php echo $camera_card_2['image'] ? wp_get_attachment_image($camera_card_2['image'], 'full', false, array('loading' => 'lazy')) : ''; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="solutions-camera__card" style="--card-bg: <?php echo $camera_card_3 ? esc_attr($camera_card_3['color']) : '#00ce1f';  ?>;">
                        <button class="solutions-camera__card-btn">

                            <?php echo $camera_card_3 ? esc_html($camera_card_3['title']) : '';  ?>

                        </button>
                        <div class="solutions-camera__card-body">
                            <div class="solutions-camera__card-items">
                                <div class="solutions-camera__card-item">
                                    <div class="solutions-camera__card-content">
                                        <span class="solutions-camera__card-num">03</span>
                                        <h3 class="solutions-camera__card-title">

                                            <?php echo $camera_card_3 ? esc_html($camera_card_3['title']) : '';  ?>

                                        </h3>
                                        <span class="solutions-camera-card-decor-1"></span>
                                        <span class="solutions-camera-card-decor-2"></span>
                                    </div>
                                </div>
                                <div class="solutions-camera__card-item">

                                    <?php echo $camera_card_3['image'] ? wp_get_attachment_image($camera_card_3['image'], 'full', false, array('loading' => 'lazy')) : ''; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="solutions-camera__card" style="--card-bg: <?php echo $camera_card_4 ? esc_attr($camera_card_4['color']) : '#00ce1f';  ?>;">
                        <button class="solutions-camera__card-btn">

                            <?php echo $camera_card_4 ? esc_html($camera_card_4['title']) : '';  ?>

                        </button>
                        <div class="solutions-camera__card-body">
                            <div class="solutions-camera__card-items">
                                <div class="solutions-camera__card-item">
                                    <div class="solutions-camera__card-content">
                                        <span class="solutions-camera__card-num">04</span>
                                        <h3 class="solutions-camera__card-title">

                                            <?php echo $camera_card_4 ? esc_html($camera_card_4['title']) : '';  ?>

                                        </h3>
                                        <span class="solutions-camera-card-decor-1"></span>
                                        <span class="solutions-camera-card-decor-2"></span>
                                    </div>
                                </div>
                                <div class="solutions-camera__card-item">

                                    <?php echo $camera_card_4['image'] ? wp_get_attachment_image($camera_card_4['image'], 'full', false, array('loading' => 'lazy')) : ''; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="solutions-camera__card" style="--card-bg: <?php echo $camera_card_5 ? esc_attr($camera_card_5['color']) : '#00ce1f';  ?>;">
                        <button class="solutions-camera__card-btn">

                            <?php echo $camera_card_5 ? esc_html($camera_card_5['title']) : '';  ?>

                        </button>
                        <div class="solutions-camera__card-body">
                            <div class="solutions-camera__card-items">
                                <div class="solutions-camera__card-item">
                                    <div class="solutions-camera__card-content">
                                        <span class="solutions-camera__card-num">05</span>
                                        <h3 class="solutions-camera__card-title">

                                            <?php echo $camera_card_5 ? esc_html($camera_card_5['title']) : '';  ?>

                                        </h3>
                                        <span class="solutions-camera-card-decor-1"></span>
                                        <span class="solutions-camera-card-decor-2"></span>
                                    </div>
                                </div>
                                <div class="solutions-camera__card-item">

                                    <?php echo $camera_card_5['image'] ? wp_get_attachment_image($camera_card_5['image'], 'full', false, array('loading' => 'lazy')) : ''; ?>

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

        <div class="solutions-network-btn-wrap">
            <button class="solutions-network__btn">
                <svg width="37" height="42" viewBox="0 0 37 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.1056 1.39258V19.5004M12.5339 7.91697C8.81646 9.23129 5.6833 11.8175 3.68823 15.2185C1.69315 18.6195 0.964613 22.6163 1.63138 26.5025C2.29814 30.3887 4.31728 33.914 7.33192 36.4555C10.3466 38.997 14.1626 40.3909 18.1056 40.3909C22.0486 40.3909 25.8646 38.997 28.8792 36.4555C31.8939 33.914 33.913 30.3887 34.5798 26.5025C35.2465 22.6163 34.518 18.6195 32.5229 15.2185C30.5278 11.8175 27.3947 9.23129 23.6772 7.91697" stroke="currentColor" stroke-width="2.78582" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        <div class="solutions-network-content-wrap">
            <div class="solutions-network-content">
                <h2 class="solutions-network__title">

                    <?php echo $fields['solutions_network_title'] ?  esc_html($fields['solutions_network_title']) : ''; ?>

                </h2>
                <div class="solutions-network__desc">

                    <?php echo $fields['solutions_network_subtitle'] ?  esc_html($fields['solutions_network_subtitle']) : ''; ?>

                </div>
            </div>
        </div>


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

        <?php

        $network_card_1 = $fields['solutions_network_card_1'];
        $network_card_2 = $fields['solutions_network_card_2'];
        $network_card_3 = $fields['solutions_network_card_3'];
        $network_card_4 = $fields['solutions_network_card_4'];
        $network_card_5 = $fields['solutions_network_card_5'];

        ?>


        <div class="solutions-network-cards">

            <div class="solutions-network-card-wrap">
                <div class="solutions-network-card">
                    <h3 class="solutions-network-card__title">

                        <?php echo $network_card_1 ? esc_html($network_card_1['title']) : '';  ?>

                    </h3>
                    <div class="solutions-network-card-body">
                        <p class="solutions-network-card__text">

                            <?php echo $network_card_1 ? esc_html($network_card_1['desc']) : '';  ?>

                        </p>
                    </div>
                </div>
            </div>

            <div class="solutions-network-card-wrap">
                <div class="solutions-network-card">
                    <h3 class="solutions-network-card__title">

                        <?php echo $network_card_2 ? esc_html($network_card_2['title']) : '';  ?>

                    </h3>
                    <div class="solutions-network-card-body">
                        <p class="solutions-network-card__text">

                            <?php echo $network_card_2 ? esc_html($network_card_2['desc']) : '';  ?>

                        </p>
                    </div>
                </div>
            </div>
            <div class="solutions-network-card-wrap">
                <div class="solutions-network-card">
                    <h3 class="solutions-network-card__title">

                        <?php echo $network_card_3 ? esc_html($network_card_3['title']) : '';  ?>

                    </h3>
                    <div class="solutions-network-card-body">
                        <p class="solutions-network-card__text">

                            <?php echo $network_card_3 ? esc_html($network_card_3['desc']) : '';  ?>

                        </p>
                    </div>
                </div>
            </div>
            <div class="solutions-network-card-wrap">
                <div class="solutions-network-card">
                    <h3 class="solutions-network-card__title">

                        <?php echo $network_card_4 ? esc_html($network_card_4['title']) : '';  ?>

                    </h3>
                    <div class="solutions-network-card-body">
                        <p class="solutions-network-card__text">

                            <?php echo $network_card_4 ? esc_html($network_card_4['desc']) : '';  ?>

                        </p>
                    </div>
                </div>
            </div>
            <div class="solutions-network-card-wrap">
                <div class="solutions-network-card">
                    <h3 class="solutions-network-card__title">

                        <?php echo $network_card_5 ? esc_html($network_card_5['title']) : '';  ?>

                    </h3>
                    <div class="solutions-network-card-body">
                        <p class="solutions-network-card__text">

                            <?php echo $network_card_5 ? esc_html($network_card_5['desc']) : '';  ?>

                        </p>
                    </div>
                </div>
            </div>


        </div>






    </section>











    <!-- ? solutions-automation -->



    <section class="solutions-automation section-pin section-bg" style="--section-bg: #000000;">



        <div class="solutions-automation-wrap">

            <div class="solutions-automation-content-wrap">


                <div class="solutions-automation-content">

                    <div class="solutions-automation-lottie"></div>

                    <h1 class="solutions-automation__title">

                        <?php echo $fields['solutions_automation_title'] ?  esc_html($fields['solutions_automation_title']) : ''; ?>

                    </h1>

                    <button class="solutions-automation__btn"></button>

                    <p class="solutions-automation__desc">

                        <?php echo $fields['solutions_automation_subtitle'] ?  esc_html($fields['solutions_automation_subtitle']) : ''; ?>

                    </p>
                </div>
            </div>

        </div>

        <div class="container">


            <div class="solutions-automation-inner">


                <?php

                $automation_card_1 = $fields['solutions_automation_card_1'];
                $automation_card_2 = $fields['solutions_automation_card_2'];
                $automation_card_3 = $fields['solutions_automation_card_3'];
                $automation_card_4 = $fields['solutions_automation_card_4'];

                ?>


                <div class="solutions-automation__cards">


                    <div class="solutions-automation__card">

                        <div class="solutions-automation__card-wrap">

                            <h2 class="solutions-automation__card-title">

                                <?php echo $automation_card_1 ? esc_html($automation_card_1['title']) : '';  ?>

                            </h2>

                            <div class="solutions-automation__card-content-wrap">

                                <div class="solutions-automation__card-content">

                                    <?php echo $automation_card_1 ? wp_kses_post($automation_card_1['desc']) : '';  ?>


                                </div>
                            </div>

                        </div>


                    </div>




                    <div class="solutions-automation__card">


                        <div class="solutions-automation__card-wrap">
                            <img width="80" height="80" class="solutions-automation__card-icon lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/solutions/icon2.svg" alt="">

                            <h2 class="solutions-automation__card-title">

                                <?php echo $automation_card_2 ? esc_html($automation_card_2['title']) : '';  ?>

                            </h2>

                            <div class="solutions-automation__card-content-wrap">

                                <div class="solutions-automation__card-content">

                                    <?php echo $automation_card_2 ? wp_kses_post($automation_card_2['desc']) : '';  ?>

                                </div>
                            </div>

                        </div>



                    </div>




                    <div class="solutions-automation__card">

                        <div class="solutions-automation__card-wrap">

                            <img width="80" height="80" class="solutions-automation__card-icon lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/solutions/icon3.svg" alt="">

                            <h2 class="solutions-automation__card-title">


                                <?php echo $automation_card_3 ? esc_html($automation_card_3['title']) : '';  ?>
                            </h2>

                            <div class="solutions-automation__card-content-wrap">

                                <div class="solutions-automation__card-content">

                                    <?php echo $automation_card_3 ? wp_kses_post($automation_card_3['desc']) : '';  ?>

                                </div>
                            </div>
                        </div>


                    </div>



                    <div class="solutions-automation__card">

                        <div class="solutions-automation__card-wrap">

                            <img width="80" height="80" class="solutions-automation__card-icon lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/solutions/icon4.svg" alt="">

                            <h2 class="solutions-automation__card-title">

                                <?php echo $automation_card_4 ? esc_html($automation_card_4['title']) : '';  ?>

                            </h2>

                            <div class="solutions-automation__card-content-wrap">

                                <div class="solutions-automation__card-content">

                                    <?php echo $automation_card_4 ? wp_kses_post($automation_card_4['desc']) : '';  ?>

                                </div>
                            </div>


                        </div>

                    </div>





                </div>


            </div>

        </div>





    </section>




    <!-- ? fire-systems -->
    <section class="fire-systems section-bg" style="--section-bg: #0088ff;">


        <div class="container">

            <h1 class="fire-systems__title">

                <?php echo $fields['solutions_fire_title'] ?  esc_html($fields['solutions_fire_title']) : ''; ?>

            </h1>
        </div>


        <!-- ? fire-systems-wrap -->
        <div class="fire-systems-scroll">

            <div class="fire-systems-sticky-wrap">

                <div class="fire-svg-stage">

                    <div id="human" class="fire-human">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/solutions/svg-animation/human.svg" style="width: 100%; height: 100%;" alt="person">
                    </div>


                    <?php

                    $scroll_down = $fields['solutions_fire_scroll'] ?  $fields['solutions_fire_scroll'] : '';

                    $fire_card_1 = $fields['solutions_fire_card_1'];
                    $fire_card_2 = $fields['solutions_fire_card_2'];
                    $fire_card_3 = $fields['solutions_fire_card_3'];
                    $fire_card_4 = $fields['solutions_fire_card_4'];

                    ?>

                    <div class="fire-overlays">

                        <div id="desktop-scroll-hints" class="desktop-scroll-hints">
                            <div class="scroll-hint"><span class="scroll-hint-text"><?php echo esc_html($scroll_down); ?></span><span class="scroll-hint-arrow"></span></div>
                            <div class="scroll-hint"><span class="scroll-hint-text"><?php echo esc_html($scroll_down); ?></span><span class="scroll-hint-arrow"></span></div>
                            <div class="scroll-hint"><span class="scroll-hint-text"><?php echo esc_html($scroll_down); ?></span><span class="scroll-hint-arrow"></span></div>
                            <div class="scroll-hint"><span class="scroll-hint-text"><?php echo esc_html($scroll_down); ?></span><span class="scroll-hint-arrow"></span></div>
                        </div>

                        <div id="mobile-scroll-hints" class="mobile-scroll-hints">
                            <div class="scroll-hint"><span class="scroll-hint-text"><?php echo esc_html($scroll_down); ?></span><span class="scroll-hint-arrow"></span></div>
                            <div class="scroll-hint"><span class="scroll-hint-text"><?php echo esc_html($scroll_down); ?></span><span class="scroll-hint-arrow"></span></div>
                            <div class="scroll-hint"><span class="scroll-hint-text"><?php echo esc_html($scroll_down); ?></span><span class="scroll-hint-arrow"></span></div>
                            <div class="scroll-hint"><span class="scroll-hint-text"><?php echo esc_html($scroll_down); ?></span><span class="scroll-hint-arrow"></span></div>
                            <div class="scroll-hint"><span class="scroll-hint-text"><?php echo esc_html($scroll_down); ?></span><span class="scroll-hint-arrow"></span></div>
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

                                    <?php echo $fire_card_1 ? esc_html($fire_card_1['title']) : '';  ?>

                                </h2>

                                <div class="fire-systems__card-content">
                                    <p>

                                        <?php echo $fire_card_1 ? esc_html($fire_card_1['desc']) : '';  ?>

                                    </p>
                                </div>
                            </div>

                            <div class="fire-systems__card">
                                <svg class="svg-fire-card" viewBox="0 0 683 553" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M67.1279 551.906H615.372C652.17 551.906 682 522.076 682 485.278V67.127C682 30.3296 652.17 0.499023 615.372 0.499023H216.538C183.343 0.499023 156.433 27.4093 156.433 60.6045C156.433 113.528 113.529 156.432 60.6055 156.432C27.4102 156.432 0.500099 183.342 0.5 216.537V485.278C0.5 522.076 30.3303 551.906 67.1279 551.906Z" stroke="white" />
                                </svg>

                                <h2 class="fire-systems__card-title">

                                    <?php echo $fire_card_2 ? esc_html($fire_card_2['title']) : '';  ?>

                                </h2>

                                <div class="fire-systems__card-content">
                                    <p>

                                        <?php echo $fire_card_2 ? esc_html($fire_card_2['desc']) : '';  ?>

                                    </p>
                                </div>
                            </div>
                            <div class="fire-systems__card">
                                <svg class="svg-fire-card" viewBox="0 0 683 553" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M67.1279 551.906H615.372C652.17 551.906 682 522.076 682 485.278V67.127C682 30.3296 652.17 0.499023 615.372 0.499023H216.538C183.343 0.499023 156.433 27.4093 156.433 60.6045C156.433 113.528 113.529 156.432 60.6055 156.432C27.4102 156.432 0.500099 183.342 0.5 216.537V485.278C0.5 522.076 30.3303 551.906 67.1279 551.906Z" stroke="white" />
                                </svg>

                                <h2 class="fire-systems__card-title">

                                    <?php echo $fire_card_3 ? esc_html($fire_card_3['title']) : '';  ?>

                                </h2>
                                <div class="fire-systems__card-content">
                                    <p>

                                        <?php echo $fire_card_3 ? esc_html($fire_card_3['desc']) : '';  ?>

                                    </p>
                                </div>
                            </div>
                            <div class="fire-systems__card">
                                <svg class="svg-fire-card" viewBox="0 0 683 553" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M67.1279 551.906H615.372C652.17 551.906 682 522.076 682 485.278V67.127C682 30.3296 652.17 0.499023 615.372 0.499023H216.538C183.343 0.499023 156.433 27.4093 156.433 60.6045C156.433 113.528 113.529 156.432 60.6055 156.432C27.4102 156.432 0.500099 183.342 0.5 216.537V485.278C0.5 522.076 30.3303 551.906 67.1279 551.906Z" stroke="white" />
                                </svg>

                                <h2 class="fire-systems__card-title">

                                    <?php echo $fire_card_4 ? esc_html($fire_card_4['title']) : '';  ?>

                                </h2>
                                <div class="fire-systems__card-content">
                                    <p>

                                        <?php echo $fire_card_4 ? esc_html($fire_card_4['desc']) : '';  ?>

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