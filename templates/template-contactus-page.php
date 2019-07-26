<?php
/**
 * Template Name: Contact Us Page
 */

get_header();

$contact_title        = get_field('contact_title');
$contact_content      = get_field('contact_content');
$contact_address      = get_field('contact_address');
$contact_image        = get_field('contact_image');

?>

<section class="headline headline__contact">
    <div class="headline__logo-corner">
        <img src="<?php echo get_template_directory_uri() . '/assets/img/logo/corner.svg'; ?>" alt="">
        <a href="<?php echo home_url('/'); ?>"></a>
    </div>
    <div class="headline__text container-width">
        <div class="headline__text_title">
            <h1><?php echo $contact_title; ?></h1>
        </div>
        <div class="headline__text_content">
            <p><?php echo $contact_content; ?></p>
        </div>
        <div class="headline__contact_address">
            <?php echo $contact_address; ?>
        </div>
    </div>
</section>
<div class="contact__image_mobile">
    <img class="lazy" data-src="<?php echo $contact_image['url']; ?>" alt="<?php echo $contact_image['alt']; ?>">
</div>

<?php get_footer('form'); ?>
