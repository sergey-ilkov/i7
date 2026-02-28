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



    <section class="contacts section-bg" style="--section-bg: #fff;">

        <span class="contacts-decor-1"></span>
        <span class="contacts-decor-2"></span>



        <div class="contacts__items">

            <div class="contacts__item">
                <div class="contacts-content">

                    <h1 class="contacts__title">

                        <?php echo $fields['contacts_title'] ?  esc_html($fields['contacts_title']) : ''; ?>

                    </h1>
                    <p class="contacts__desc">

                        <?php echo $fields['contacts_desc'] ?  esc_html($fields['contacts_desc']) : ''; ?>

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


                        <?php

                        // Запрашиваем слайды
                        $slides = new \WP_Query(array(
                            'post_type' => 'specialist_slides',
                            'posts_per_page' => 4,
                            'order' => 'ASC'
                        ));

                        $direction = 3; // дефолт

                        if ($slides->have_posts()): while ($slides->have_posts()): $slides->the_post();
                                $photo_left_id = get_field('photo_left'); // Это теперь ID (число), а не ссылка
                                $photo_front_id = get_field('photo_front'); // Это теперь ID (число), а не ссылка

                                $direction_id = intval(get_field('direction_id'));
                                $direction_text = get_field('direction_text');
                                $color = get_field('color');


                                static $matched = false;

                                if ($direction === $direction_id) {
                                    $class = 'active';
                                    $matched = true;
                                } else {

                                    if ($matched) {
                                        $class = 'image-left';
                                    } else {
                                        $class = 'image-right';
                                    }
                                }

                        ?>

                        <div class="swiper-slide">
                            <div class="contacts-slide <?php echo esc_attr($class); ?>" style="--contact-color:  <?php echo $color ? esc_attr($color) : '#0088ff'; ?>" data-direction="<?php echo $direction_id ? esc_attr($direction_id) : $direction; ?>">
                                <div class="contacts-slide-images">

                                    <?php

                                            if ($photo_left_id) {
                                                echo wp_get_attachment_image($photo_left_id, 'full', false, array(
                                                    'class' => 'contacts-slide__img',
                                                    'loading' => 'lazy'
                                                ));
                                            }
                                            if ($photo_front_id) {
                                                echo wp_get_attachment_image($photo_front_id, 'full', false, array(
                                                    'class' => 'contacts-slide__img-face',
                                                    'loading' => 'lazy'
                                                ));
                                            }


                                            ?>

                                </div>

                                <span class="contacts-slide__title">

                                    <?php echo  $direction_text ? esc_html($direction_text) : ''; ?>

                                </span>
                            </div>
                        </div>

                        <?php endwhile;
                            wp_reset_postdata();


                        endif; ?>



                    </div>

                </div>

            </div>
            <div class="contacts__item">

                <?php

                $form = $fields['contacts_form'];

                ?>

                <form id="contacts-form" class="contacts-form" action="#" style="--form-bg: #e5c100;">

                    <input id="direction_id" type="hidden" name="direction_id" value="2">

                    <div class="form-row">
                        <div class="form-group">
                            <label class="required-star" for="firstName"><?php echo  $form ? esc_html($form['label_1']) : ''; ?></label>
                            <input type="text" id="firstName" name="firstName" class="field" autocomplete="off" data-required="true" />
                            <span class="error-msg" data-for="firstName"></span>
                        </div>

                        <div class="form-group">
                            <label for="lastName"><?php echo  $form ? esc_html($form['label_2']) : ''; ?></label>
                            <input type="text" id="lastName" name="lastName" class="field" autocomplete="off" data-required="false" />
                            <span class="error-msg" data-for="lastName"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="required-star" for="phone"><?php echo  $form ? esc_html($form['label_3']) : ''; ?></label>
                            <input type="tel" id="phone" name="phone" class="field" autocomplete="off" data-required="true" />
                            <span class="error-msg" data-for="phone"></span>
                        </div>
                        <div class="form-group">
                            <label class="required-star" for="email"><?php echo  $form ? esc_html($form['label_4']) : ''; ?></label>
                            <input type="email" id="email" name="email" class="field" autocomplete="off" data-required="true" />
                            <span class="error-msg" data-for="email"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="company"><?php echo  $form ? esc_html($form['label_5']) : ''; ?></label>
                            <input type="text" id="company" name="company" class="field" autocomplete="off" data-required="false" />
                            <span class="error-msg" data-for="company"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="required-star" for="message"><?php echo  $form ? esc_html($form['label_6']) : ''; ?></label>
                            <input type="text" id="message" name="message" class="field" autocomplete="off" data-required="true" />
                            <span class="error-msg" data-for="message"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="required-star" for="source"><?php echo  $form ? esc_html($form['label_7']) : ''; ?></label>
                            <input type="text" id="source" name="source" class="field" autocomplete="off" data-required="true" />
                            <span class="error-msg" data-for="source"></span>
                        </div>
                    </div>

                    <div class="form-text">
                        <p>
                            <?php echo  $form ? esc_html($form['text']) : ''; ?>
                        </p>
                    </div>



                    <button id="submitBtn" type="button" class="contacts-form-btn">

                        <?php echo  $form ? esc_html($form['button']) : ''; ?>

                    </button>

                </form>
            </div>



        </div>



    </section>






</main>



<?php get_footer(); ?>