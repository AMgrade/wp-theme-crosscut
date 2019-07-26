<!doctype html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="theme-color" content="#ffffff">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <?php if (is_front_page()) { ?>
        <div class="page-line">
            <div class="page-line__inside"></div>
        </div>
    <?php }

    $template_file = get_post_meta( get_queried_object_id(), '_wp_page_template', true );
    $contact_image = get_field('contact_image', $post_id);

    switch ($template_file) {
        case 'templates/template-contactus-page.php':
            echo '<div class="contact__image contact__image_desktop">
    <img class="lazy" data-src="'.$contact_image['url'].'" alt="'.$contact_image['alt'].'">
</div>';
            break;
    }

    ?>

    <!-- Header -->
    <header class="header">
        <div class="container-fluid no-padding">
            <div class="top-nav b-container-width">
                <nav class="top-nav__navbar navbar navbar-expand-lg">
                    <button id="menuSpan" class="top-nav__navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="top-nav__navbar-toggler-icon navbar-toggler-icon"></span>
                        <span class="top-nav__navbar-toggler-icon navbar-toggler-icon"></span>
                        <span class="top-nav__navbar-toggler-icon navbar-toggler-icon"></span>
                    </button>
                    <div class="top-nav__collapse collapse navbar-collapse" id="navbarNav">
                        <?php wp_nav_menu(array(
                            'menu' => 'Top Menu',
                            'container' => false,
                            'walker' => new CSS_Menu_Walker()
                        )); ?>
                    </div>
                </nav>
            </div>
        </div>
    </header><!-- End header -->

    <!-- Main -->
    <div class="main">
        <?php if (!is_singular('post')): ?>
            <!--<div class="main__corner"></div>-->
        <?php endif; ?>