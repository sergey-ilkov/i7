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


<!-- 
// ? All Fields
<section class="query" style="color:#000;">

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




    <section id="hero-branding" class="hero-branding section-bg" style="--section-bg: #0088ff;">





        <video id="mainVideo" class="main-video track-visibility" playsinline muted autoplay loop poster="<?php echo $fields['branding_poster'] ? esc_url($fields['branding_poster']) : ''; ?>" data-src="<?php echo $fields['branding_video'] ? esc_url($fields['branding_video']) : '';  ?>"></video>



        <div class="hero-card-wrap">
            <div class="hero-card-box">
                <div class="hero-card-content">
                    <h1 class="hero-card__title">
                        <?php echo $fields['branding_title'] ?  esc_html($fields['branding_title']) : ''; ?>

                    </h1>
                    <div class="hero-card-desc">
                        <?php echo $fields['branding_desc'] ?  wp_kses_post($fields['branding_desc']) : ''; ?>


                    </div>
                </div>



            </div>

        </div>




        <?php get_template_part('template-parts/hero', 'messages'); ?>



    </section>



    <?php



    $branding_card_1 = $fields['branding_card_1'];
    $branding_card_2 = $fields['branding_card_2'];
    $branding_card_3 = $fields['branding_card_3'];
    $branding_card_4 = $fields['branding_card_4'];







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