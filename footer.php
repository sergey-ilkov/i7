<footer class="footer section-bg" style="--section-bg: #0088ff;">

    <div class="container-max">
        <div class="footer-inner">


            <svg class="svg-footer-decor" viewBox="0 0 2480 580" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2420 0.5H479.5C446.639 0.5 420 27.1391 420 60V86C420 130.459 383.959 166.5 339.5 166.5H60C27.1391 166.5 0.5 193.139 0.5 226V520C0.500006 552.861 27.1391 579.5 60 579.5H2420C2452.86 579.5 2479.5 552.861 2479.5 520V60C2479.5 27.1391 2452.86 0.5 2420 0.5Z" stroke="url(#paint0_linear_5169_6241)" />
                <defs>
                    <linearGradient id="paint0_linear_5169_6241" x1="475.108" y1="155.708" x2="520.201" y2="390.365" gradientUnits="userSpaceOnUse">
                        <stop offset="0" stop-color="white" />
                        <stop offset="1" stop-color="white" stop-opacity="0" />
                    </linearGradient>
                </defs>
            </svg>


            <svg class="svg-footer-decor-mob" viewBox="0 0 335 509" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M152 0.25H311C324.117 0.25 334.75 10.8832 334.75 24V508.75H0.25V85.5C0.250004 72.3832 10.8832 61.75 24 61.75H91C111.575 61.75 128.25 44.7662 128.25 24.1963C128.25 11.0771 138.886 0.25 152 0.25Z" stroke="url(#paint0_linear_2661_7569)" stroke-width="0.5" />
                <defs>
                    <linearGradient id="paint0_linear_2661_7569" x1="288.5" y1="409" x2="245.331" y2="175.029" gradientUnits="userSpaceOnUse">
                        <stop offset="0" stop-color="white" stop-opacity="0" />
                        <stop offset="1" stop-color="white" />
                    </linearGradient>
                </defs>
            </svg>


            <?php


            $settings_id = get_site_settings_id();
            if ($settings_id) {
                $section = get_field('footer', $settings_id);
                if (is_array($section)) {

                    $footer_logo = $section['footer_logo'];
                    $contacts_link_text = $section['contacts_link_text'];
                    $btn_up = $section['btn_up'];
                    $copyright = $section['copyright'];

                    $footer_title_company = $section['footer_title_company'];
                    $footer_title_services = $section['footer_title_services'];

                    $footer_title_contacts = $section['footer_title_contacts'];
                    $phone_text = $section['phone_text'];
                    $phone = $section['phone'];
                    $email = $section['email'];
                }
            }

            $contacts_url = get_url_by_page_template('tpl-contacts.php');
            if (!$contacts_url) {
                $contacts_url = home_url('/');
            }

            ?>

            <div class="footer__items">
                <div class="footer__item">

                    <img width="380" height="140" class="footer-logo" src="<?php echo $footer_logo ? esc_url($footer_logo) : ''; ?>" alt="logo">


                    <a class="footer__link-contact" href="<?php echo esc_url($contacts_url); ?>">
                        <?php echo $contacts_link_text ? esc_html($contacts_link_text) : '';  ?>
                    </a>
                </div>

                <div class="footer__item">
                    <h3 class="footer-list__item-title">
                        <?php echo $footer_title_company ? esc_html($footer_title_company) : '';  ?>
                    </h3>

                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer_company',
                        'container'      => false,
                        'menu_class'     => 'footer-list',
                        'fallback_cb'    => false
                    ));

                    ?>


                </div>

                <div class="footer__item">
                    <h3 class="footer-list__item-title">
                        <?php echo $footer_title_services ? esc_html($footer_title_services) : '';  ?>
                    </h3>


                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer_services',
                        'container'      => false,
                        'menu_class'     => 'footer-list',
                        'fallback_cb'    => false
                    ));

                    ?>



                </div>


                <div class="footer__item">

                    <h3 class="footer-list__item-title">
                        <?php echo $footer_title_contacts ? esc_html($footer_title_contacts) : '';  ?>
                    </h3>
                    <ul class="footer-list">

                        <li class="footer-list__item">
                            <a class="footer-list__item-link" href="tel:<?php echo $phone ? esc_attr($phone) : '';  ?>">
                                <?php echo $phone_text  ? esc_html($phone_text) : '';  ?>
                            </a>
                        </li>
                        <li class="footer-list__item">
                            <a class="footer-list__item-link" href="mailto:<?php echo $email ? esc_attr($email) : '';  ?>">
                                <?php echo $email ? esc_html($email) : '';  ?>
                            </a>
                        </li>

                    </ul>

                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-bottom__item">

                    <button id="btn-up" class="btn-up">
                        <svg width="8" height="46" viewBox="0 0 8 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.03519 0.146446C3.83993 -0.0488167 3.52335 -0.0488167 3.32809 0.146446L0.146105 3.32843C-0.0491573 3.52369 -0.0491573 3.84027 0.146105 4.03553C0.341367 4.2308 0.65795 4.2308 0.853212 4.03553L3.68164 1.20711L6.51007 4.03553C6.70533 4.2308 7.02191 4.2308 7.21717 4.03553C7.41243 3.84027 7.41243 3.52369 7.21717 3.32843L4.03519 0.146446ZM4.18164 45.5L4.18164 0.5L3.18164 0.5L3.18164 45.5L4.18164 45.5Z" fill="url(#paint0_linear_1158_12445)" />
                            <defs>
                                <linearGradient id="paint0_linear_1158_12445" x1="4.18164" y1="0.5" x2="4.18164" y2="45.5" gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="currentColor" />
                                    <stop offset="1" stop-color="currentColor" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                        </svg>
                        <span>
                            <?php echo $btn_up ? esc_html($btn_up) : '';  ?>
                        </span>
                    </button>

                </div>

                <?php

                wp_nav_menu([
                    'theme_location' => 'footer_legal',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'fallback_cb'    => false,
                    'walker'         => new \Walker_No_LI(),
                ]);

                ?>


                <div class="footer-bottom__item">

                    <span class="copyright">© <?php echo $copyright ? esc_html($copyright) : '';  ?></span>
                </div>
            </div>

        </div>
    </div>




</footer>




</div>

<?php if (is_page_template(array('page-templates/tpl-solutions.php'))): ?>

<div id="custom-cursor" class="custom-cursor" aria-hidden="true">
    <img width="190" hidden="190" src="<?php echo get_template_directory_uri(); ?>/assets/images/solutions/cursor.png" alt="">
</div>

<?php endif; ?>


<?php wp_footer(); ?>

</body>

</html>