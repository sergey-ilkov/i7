<?php
/*
Template Name: Equipment Page
*/
?>


<?php


add_filter('body_class', function ($classes) {
    $classes[] = 'page-equipment';
    return $classes;
});



get_header();

?>








// ? All Fields
<!-- <section class="query" style="color:#000;">

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

</section> -->





<main>



    <!-- ? equipment-pin-wrap -->
    <div class="equipment-pin-wrap section-bg" style="--section-bg: #0088ff;">

        <div class="video-sticky-wrap">
            <video id="equipment-video" class="equipment-video" playsinline webkit-playsinline muted poster="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg/equipment-bg.jpg" data-src="<?php echo get_template_directory_uri(); ?>/assets/animations/equipment.mp4"></video>
        </div>

        <div class="container-max">

            <section id="hero-equipment" class="hero-equipment section-bg" style="--section-bg: #0088ff;">

                <?php

                $equipment_general_text = $fields['equipment_general_text'];

                $equipment_slide_0 = $fields['equipment_slide_0'];
                $equipment_slide_1 = $fields['equipment_slide_1'];
                $equipment_slide_2 = $fields['equipment_slide_2'];
                $equipment_slide_3 = $fields['equipment_slide_3'];
                $equipment_slide_4 = $fields['equipment_slide_4'];


                ?>

                <div class="equipment-slider">

                    <div class="equipment-slider-wrap">

                        <div class="equipment-slides">

                            <div class="equipment-slide">
                                <span class="equipment-slide-num">#00</span>
                                <p class="equipment-slide-text">

                                    <?php echo $equipment_slide_0 ? esc_html($equipment_slide_0['text']) : ''; ?>

                                </p>
                            </div>
                            <div class="equipment-slide">
                                <span class="equipment-slide-num">#01</span>
                                <p class="equipment-slide-text">

                                    <?php echo $equipment_slide_1 ? esc_html($equipment_slide_1['text']) : ''; ?>

                                </p>
                            </div>
                            <div class="equipment-slide">
                                <span class="equipment-slide-num">#02</span>
                                <p class="equipment-slide-text">

                                    <?php echo $equipment_slide_2 ? esc_html($equipment_slide_2['text']) : ''; ?>

                                </p>
                            </div>
                            <div class="equipment-slide">
                                <span class="equipment-slide-num">#03</span>
                                <p class="equipment-slide-text">

                                    <?php echo $equipment_slide_3 ? esc_html($equipment_slide_3['text']) : ''; ?>

                                </p>
                            </div>
                            <div class="equipment-slide">
                                <span class="equipment-slide-num">#04</span>
                                <p class="equipment-slide-text">

                                    <?php echo $equipment_slide_4 ? esc_html($equipment_slide_4['text']) : ''; ?>

                                </p>
                            </div>


                        </div>




                        <div class="equipment-slide-general-content">

                            <div id="equipment-barcode" class="equipment-barcode">
                                <svg class="svg-barcode" width="286" height="45" viewBox="0 0 286 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.37207 45H0V0H4.37207V45ZM8.74023 45H6.55469V0H8.74023V45ZM14.5742 45H13.1172V0H14.5742V45ZM25.5059 45H23.3203V0H25.5059V45ZM32.0596 45H27.6875V0H32.0596V45ZM38.6152 45H36.4297V0H38.6152V45ZM51.0049 45H46.6328V0H51.0049V45ZM61.9326 45H55.375V0H61.9326V45ZM68.4902 45H66.3047V0H68.4902V45ZM72.1367 45H70.6797V0H72.1367V45ZM78.6924 45H74.3203V0H78.6924V45ZM85.248 45H83.0625V0H85.248V45ZM98.3643 45H93.9922V0H98.3643V45ZM108.568 45H106.383V0H108.568V45ZM112.936 45H110.75V0H112.936V45ZM119.498 45H117.312V0H119.498V45ZM129.696 45H123.867V0H129.696V45ZM138.442 45H134.07V0H138.442V45ZM142.811 45H140.625V0H142.811V45ZM155.927 45H151.555V0H155.927V45ZM161.756 45H159.57V0H161.756V45ZM168.317 45H163.945V0H168.317V45ZM179.248 45H177.062V0H179.248V45ZM185.803 45H183.617V0H185.803V45ZM191.63 45H187.258V0H191.63V45ZM202.558 45H196V0H202.558V45ZM209.115 45H206.93V0H209.115V45ZM213.49 45H211.305V0H213.49V45ZM219.317 45H214.945V0H219.317V45ZM225.881 45H223.695V0H225.881V45ZM238.989 45H234.617V0H238.989V45ZM249.193 45H247.008V0H249.193V45ZM253.561 45H251.375V0H253.561V45ZM260.123 45H257.938V0H260.123V45ZM272.511 45H268.867V0H272.511V45ZM279.068 45H276.883V0H279.068V45ZM285.622 0V45H281.25V0H285.622Z" fill="white" />
                                </svg>
                            </div>


                            <span class="equipment-slide-title"><?php echo $equipment_general_text ? esc_html($equipment_general_text['title']) : ''; ?></span>
                            <div class="equipment-slide-row">
                                <span class="equipment-slide-row-text"><?php echo $equipment_general_text ? esc_html($equipment_general_text['text_1']) : ''; ?></span>
                                <span class="equipment-slide-row-text">100%</span>
                            </div>
                            <div class="equipment-slide-row">
                                <span class="equipment-slide-row-text"><?php echo $equipment_general_text ? esc_html($equipment_general_text['text_2']) : ''; ?></span>
                                <span class="equipment-slide-row-text">100%</span>
                            </div>
                            <div class="equipment-slide-row">
                                <span class="equipment-slide-row-text"><?php echo $equipment_general_text ? esc_html($equipment_general_text['text_3']) : ''; ?></span>
                                <span class="equipment-slide-row-text">100%</span>
                            </div>
                            <div class="equipment-slide-row">
                                <span class="equipment-slide-row-text"><?php echo $equipment_general_text ? esc_html($equipment_general_text['text_4']) : ''; ?></span>
                                <span class="equipment-slide-row-text">100%</span>
                            </div>


                        </div>


                        <div class="scanning">
                            <div id="scanner" class="scanner">
                                <span class="scanner-bg"></span>
                            </div>
                        </div>






                    </div>




                    <div class="equipment-slider-btns">
                        <button class="equipment-slider-btn-prev">

                            <svg width="69" height="69" viewBox="0 0 69 69" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="34.5" cy="34.5" r="34" fill="white" fill-opacity="0.5" stroke="white" />
                                <path d="M42.0938 15L23.0019 34.0919L42.0938 53.1838" stroke="white" />
                            </svg>
                        </button>
                        <button class="equipment-slider-btn-next">

                            <svg width="69" height="69" viewBox="0 0 69 69" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="34.5" cy="34.5" r="34" fill="white" fill-opacity="0.5" stroke="white" />
                                <path d="M28.0938 15L47.1856 34.0919L28.0938 53.1838" stroke="white" />
                            </svg>
                        </button>
                    </div>


                </div>



                <?php



                $receipt_group_1 = $fields['equipment_receipt_group_1'];
                $receipt_group_2 = $fields['equipment_receipt_group_2'];
                $receipt_group_3 = $fields['equipment_receipt_group_3'];
                $receipt_group_4 = $fields['equipment_receipt_group_4'];
                $receipt_group_5 = $fields['equipment_receipt_group_5'];
                $receipt_group_6 = $fields['equipment_receipt_group_6'];
                $receipt_group_7 = $fields['equipment_receipt_group_7'];



                ?>


                <div class="receipt-wrap">

                    <span class="receipt-bg"></span>
                    <div class="receipt">

                        <div class="receipt-item">
                            <div class="receipt-item-row dashed">
                                <span class="receipt-logo"><?php echo $receipt_group_1 ? esc_html($receipt_group_1['text_1']) : ''; ?></span>
                                <span id="receipt-date" class="receipt-date">10.02.2026</span>
                            </div>
                            <div class="receipt-item-row dashed">
                                <span class="receipt-text"><?php echo $receipt_group_1 ? esc_html($receipt_group_1['text_2']) : ''; ?></span>
                            </div>
                        </div>


                        <div class="receipt-item">
                            <div class="receipt-item-row-product">
                                <span class="receipt-text"><?php echo $receipt_group_2 ? esc_html($receipt_group_2['text_1']) : ''; ?></span>
                                <span class="receipt-text"><?php echo $receipt_group_2 ? esc_html($receipt_group_2['text_2']) : ''; ?></span>
                            </div>
                            <div class="receipt-item-row-code">
                                <span class="receipt-text"><?php echo $receipt_group_2 ? esc_html($receipt_group_2['text_3']) : ''; ?></span>
                                <span class="receipt-text"><?php echo $receipt_group_2 ? esc_html($receipt_group_2['text_4']) : ''; ?></span>
                            </div>
                        </div>


                        <div class="receipt-item">
                            <div class="receipt-item-row-product">
                                <span class="receipt-text"><?php echo $receipt_group_3 ? esc_html($receipt_group_3['text_1']) : ''; ?></span>
                                <span class="receipt-text"><?php echo $receipt_group_3 ? esc_html($receipt_group_3['text_2']) : ''; ?></span>
                            </div>

                            <div class="receipt-item-row-code">
                                <span class="receipt-text"><?php echo $receipt_group_3 ? esc_html($receipt_group_3['text_3']) : ''; ?></span>
                                <span class="receipt-text"><?php echo $receipt_group_3 ? esc_html($receipt_group_3['text_4']) : ''; ?></span>
                            </div>
                        </div>


                        <div class="receipt-item">
                            <div class="receipt-item-row-product">
                                <span class="receipt-text"><?php echo $receipt_group_4 ? esc_html($receipt_group_4['text_1']) : ''; ?></span>
                                <span class="receipt-text"><?php echo $receipt_group_4 ? esc_html($receipt_group_4['text_2']) : ''; ?></span>
                            </div>

                            <div class="receipt-item-row-code">
                                <span class="receipt-text"><?php echo $receipt_group_4 ? esc_html($receipt_group_4['text_3']) : ''; ?></span>
                                <span class="receipt-text"><?php echo $receipt_group_4 ? esc_html($receipt_group_4['text_4']) : ''; ?></span>
                            </div>
                        </div>


                        <div class="receipt-item">
                            <div class="receipt-item-row-product">
                                <span class="receipt-text"><?php echo $receipt_group_5 ? esc_html($receipt_group_5['text_1']) : ''; ?></span>
                                <span class="receipt-text"><?php echo $receipt_group_5 ? esc_html($receipt_group_5['text_2']) : ''; ?></span>
                            </div>

                            <div class="receipt-item-row-code">
                                <span class="receipt-text"><?php echo $receipt_group_5 ? esc_html($receipt_group_5['text_3']) : ''; ?></span>
                                <span class="receipt-text"><?php echo $receipt_group_5 ? esc_html($receipt_group_5['text_4']) : ''; ?></span>
                            </div>
                        </div>





                        <!-- ? total -->
                        <div class="receipt-item">
                            <div class="receipt-item-total">
                                <span class="receipt-text"><?php echo $receipt_group_6 ? esc_html($receipt_group_6['text_1']) : ''; ?></span>
                                <span class="receipt-text"><?php echo $receipt_group_6 ? esc_html($receipt_group_6['text_2']) : ''; ?></span>
                                <span class="receipt-stars"></span>
                                <span class="receipt-barcode"></span>
                                <span class="receipt-text"><?php echo $receipt_group_6 ? esc_html($receipt_group_6['text_3']) : ''; ?></span>
                            </div>

                        </div>
                        <!-- ? info -->
                        <div class="receipt-item">

                            <span class="receipt-text"><?php echo $receipt_group_7 ? esc_html($receipt_group_7['text_1']) : ''; ?></span>
                            <div class="receipt-item-info">
                                <span class="receipt-text"><?php echo $receipt_group_7 ? esc_html($receipt_group_7['text_2']) : ''; ?></span>
                                <span class="receipt-text"><?php echo $receipt_group_7 ? esc_html($receipt_group_7['text_3']) : ''; ?></span>
                            </div>
                            <span class="receipt-text"><?php echo $receipt_group_7 ? esc_html($receipt_group_7['text_4']) : ''; ?></span>

                        </div>


                    </div>

                </div>


            </section>
        </div>




    </div>














    <!-- ? appointment -->
    <section class="appointment section-bg" style="--section-bg: #fff;">


        <?php get_template_part('template-parts/section', 'specialists'); ?>


    </section>







</main>



<?php get_footer(); ?>