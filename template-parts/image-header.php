<?php
global $post;

$headline_image = get_field('headline_image', $post_id);
$headline_title = get_field('headline_title', $post_id);
$headline_text = get_field('headline_text', $post_id);
$headline_button = get_field('headline_button');

if (is_front_page()) { ?>
    <div class="page-line page-line__header">
        <div class="page-line__inside page-line__inside_header"></div>
    </div>
<?php } ?>
    <div class="headline__bg"></div>
    <div class="headline__image_wrap">
        <img class="lazy" data-src="<?php echo $headline_image['url']; ?>" alt="<?php echo $headline_image['alt']; ?>">
        <div class="overlay"></div>
    </div>
    <div class="headline__logo-corner">
        <img src="<?php echo get_template_directory_uri() . '/assets/img/logo/corner.svg'; ?>" alt="">
        <a href="<?php echo home_url('/'); ?>"></a>
    </div>
    <div class="headline__mobile-corner"></div>
<?php if ($headline_title) : ?>
    <div class="headline__text b-container-width">
        <div class="headline__text_title">
            <h1><?php echo $headline_title; ?></h1>
        </div>
        <?php if ($headline_text) : ?>
            <div class="headline__text_content">
                <p><?php echo $headline_text; ?></p>
            </div>
        <?php endif;
        if ($headline_button) : ?>
            <div class="headline__text_button">
                <a href="<?php echo $headline_button['url']; ?>"
                   class="cross-btn"><?php echo $headline_button['title']; ?></a>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>