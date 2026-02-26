<?php

$settings_id = get_site_settings_id();
if ($settings_id) {
    $section = get_field('messages', $settings_id);
    if (is_array($section)) {

        $message_1 = $section['message_1'];
        $message_2 = $section['message_2'];
        $message_3 = $section['message_3'];
    }
}

?>





<div class="hero-message-box">
    <div class="hero-message">
        <span class="hero-message__icon"></span>
        <span class="hero-message__text">
            <?php echo $message_1 ? esc_html($message_1) : '';  ?>
        </span>
    </div>
    <div class="hero-message">
        <span class="hero-message__icon"></span>
        <span class="hero-message__text">
            <?php echo $message_2 ? esc_html($message_2) : '';  ?>
        </span>
    </div>
    <div class="hero-message">
        <span class="hero-message__icon"></span>
        <span class="hero-message__text">
            <?php echo $message_3 ? esc_html($message_3) : '';  ?>
        </span>
    </div>
</div>