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

    <?php

    $branding_title = get_field('branding_title');
    $branding_desc = get_field('branding_desc');
    $branding_poster = get_field('branding_poster');
    $branding_video  = get_field('branding_video');





    ?>


    <section id="hero-branding" class="hero-branding section-bg" style="--section-bg: #0088ff;">





        <video id="mainVideo" class="main-video track-visibility" playsinline muted autoplay loop poster="<?php echo $branding_poster ? esc_url($branding_poster) : ''; ?>" data-src="<?php echo $branding_video ? esc_url($branding_video) : '';  ?>"></video>



        <div class="hero-card-wrap">
            <div class="hero-card-box">
                <div class="hero-card-content">
                    <h1 class="hero-card__title">

                        <?php echo $branding_title ?  esc_html($branding_title) : ''; ?>

                    </h1>
                    <div class="hero-card-desc">

                        <?php echo $branding_desc ?  wp_kses_post($branding_desc) : ''; ?>


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



    <?php

    $branding_cards = get_field('branding_cards');

    $branding_card_1 = null;
    $branding_card_2 = null;
    $branding_card_3 = null;

    if (is_array($branding_cards)) {
        $branding_card_1['title'] = $branding_cards['card_1_title'];
        $branding_card_1['desc'] = $branding_cards['card_1_desc'];

        $branding_card_2['title'] = $branding_cards['card_2_title'];
        $branding_card_2['desc'] = $branding_cards['card_2_desc'];

        $branding_card_3['title'] = $branding_cards['card_3_title'];
        $branding_card_3['desc'] = $branding_cards['card_3_desc'];

        $branding_card_4['title'] = $branding_cards['card_4_title'];
        $branding_card_4['desc'] = $branding_cards['card_4_desc'];
    }








    ?>



    <section id="branding" class="branding section-bg" style="--section-bg: #0088ff;">
        <!-- container-max -->
        <div class="container">

            <div class="branding-wrap">
                <div class="branding-box">

                    <div class="branding-lottie"></div>

                    <div class="branding-content">
                        <h2 class="branding-content__title">

                            <?php echo $branding_card_1 ? esc_html($branding_card_1['title']) : '';  ?>

                        </h2>
                        <p class="branding-content__text">

                            <?php echo $branding_card_1 ?  esc_html($branding_card_1['desc']) : ''; ?>

                        </p>

                    </div>

                </div>
                <div class="branding-box">
                    <div class="branding-lottie"></div>
                    <div class="branding-content">
                        <h2 class="branding-content__title">

                            <?php echo $branding_card_2 ? esc_html($branding_card_2['title']) : '';  ?>

                        </h2>
                        <p class="branding-content__text">

                            <?php echo $branding_card_2 ?  esc_html($branding_card_2['desc']) : ''; ?>

                        </p>

                    </div>

                </div>
                <div class="branding-box">
                    <div class="branding-lottie"></div>
                    <div class="branding-content">
                        <h2 class="branding-content__title">

                            <?php echo $branding_card_3 ? esc_html($branding_card_3['title']) : '';  ?>

                        </h2>
                        <p class="branding-content__text">

                            <?php echo $branding_card_3 ?  esc_html($branding_card_3['desc']) : ''; ?>

                        </p>

                    </div>

                </div>
                <div class="branding-box">
                    <div class="branding-lottie"></div>
                    <div class="branding-content">
                        <h2 class="branding-content__title">

                            <?php echo $branding_card_4 ? esc_html($branding_card_4['title']) : '';  ?>

                        </h2>
                        <p class="branding-content__text">

                            <?php echo $branding_card_4 ?  esc_html($branding_card_4['desc']) : ''; ?>

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