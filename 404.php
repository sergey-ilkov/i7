<?php get_header(); ?>

<main>
    <section class="error-404-page section-bg" style="--section-bg: #fff;">

        <div class="container text-center">
            <section class="error-content">
                <h1 class="error-title">404</h1>
                <h2 class="error-subtitle">
                    <?php pll_e('Oops! Page not found'); ?>
                </h2>
                <p class="error-text">
                    <?php pll_e("The link you followed may be broken"); ?>
                </p>

                <div class="error-actions">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="error-link">
                        <?php pll_e('Back to home'); ?>
                    </a>
                </div>
            </section>
        </div>
    </section>
</main>

<?php get_footer(); ?>