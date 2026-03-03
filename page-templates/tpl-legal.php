<?php

/**
 * Template Name: Юридическая страница
 */

get_header(); ?>

<main class="main-legal">
    <section class="legal-content section-bg" style="--section-bg: #fff;">
        <div class="container">

            <?php

            if (have_posts()) :
                while (have_posts()) : the_post(); ?>

            <h1 class="legal-title">
                <?php

                        the_title();

                        ?>
            </h1>

            <div class="legal-text-wrapper">
                <?php

                        the_content();

                        ?>
            </div>

            <?php endwhile;
            endif; ?>

        </div>
    </section>
</main>

<?php get_footer(); ?>