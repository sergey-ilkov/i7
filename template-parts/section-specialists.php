<!-- ? appointment -->
<?php

// Запрашиваем слайды
$slides = new \WP_Query(array(
    'post_type' => 'specialist_slides',
    'posts_per_page' => 4,
    'order' => 'ASC'
));

?>


<?php

$contacts_url = get_url_by_page_template('tpl-contacts.php'); // или 'contacts' / 'contacts.php'


if (!$contacts_url) {
    $contacts_url = home_url('/');
}
$direction = 1; // дефолт


$section_specialist_title = null;
$settings_id = get_site_settings_id();
if ($settings_id) {
    $section = get_field('section_specialist', $settings_id);
    if (is_array($section) && isset($section['title'])) {
        $section_specialist_title = $section['title'];
    }
}

?>






<div class="appointment-box">
    <div class="appointment-content">

        <h2 class="appointment__title">

            <?php echo $section_specialist_title ? esc_html($section_specialist_title) : ''; ?>

        </h2>

        <ul class="appointment__list">


            <?php if ($slides->have_posts()): while ($slides->have_posts()): $slides->the_post();
                    $direction_id = get_field('direction_id');
                    $direction_text = get_field('direction_text');
                    $color = get_field('color');

                    $full_url = esc_url(add_query_arg('direction', $direction_id, $contacts_url));
            ?>


                    <li class="appointment__item" style="--contact-color: <?php echo $color ? esc_attr($color) : '#0088ff'; ?>">

                        <a class="appointment__link" href="<?php echo $full_url; ?>">

                            <?php echo  $direction_text ? esc_html($direction_text) : ''; ?>

                        </a>
                    </li>

            <?php endwhile;
                wp_reset_postdata();


            endif; ?>



        </ul>
    </div>


    <div class="swiper appointment-slider">
        <div class="swiper-wrapper">


            <?php if ($slides->have_posts()): while ($slides->have_posts()): $slides->the_post();
                    $photo_left_id = get_field('photo_left'); // Это теперь ID (число), а не ссылка
                    $photo_front_id = get_field('photo_front'); // Это теперь ID (число), а не ссылка

                    $direction_id = get_field('direction_id');
                    $direction_text = get_field('direction_text');
                    $color = get_field('color');

                    $full_url = esc_url(add_query_arg('direction', $direction_id, $contacts_url));
            ?>



                    <div class="swiper-slide">
                        <div class="appointment-slide" style="--contact-color: <?php echo $color ? esc_attr($color) : '#0088ff'; ?>">
                            <div class="appointment-slide-images">

                                <?php


                                if ($photo_left_id) {
                                    echo wp_get_attachment_image($photo_left_id, 'full', false, array(
                                        'class' => 'specialist-card__img', // Твой класс для стилей
                                        'loading' => 'lazy'               // Нативная ленивая загрузка
                                    ));
                                }
                                if ($photo_front_id) {
                                    echo wp_get_attachment_image($photo_front_id, 'full', false, array(
                                        'class' => 'appointment-slide__img-face',
                                        'loading' => 'lazy'
                                    ));
                                }


                                ?>

                            </div>

                            <a class="appointment-slide__link" href="<?php echo $full_url; ?>">

                                <?php echo  $direction_text ? esc_html($direction_text) : ''; ?>

                            </a>
                        </div>
                    </div>


            <?php endwhile;
                wp_reset_postdata();


            endif; ?>



        </div>

    </div>

</div>