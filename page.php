<?php
/*
Template Name: New Page
*/
?>

<?php get_header(); ?>

<main>

    <section class="main-default-page section-bg" style="--section-bg: #fff;">

        <div class="container">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('content-area'); ?>>
                <header class="page-header">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php
                            // Весь контент из редактора (текст, картинки, блоки)
                            the_content();
                            ?>
                </div>
            </article>

            <?php endwhile;
            endif; ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>