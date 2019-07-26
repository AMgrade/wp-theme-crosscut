<?php
/**
 * Template Name: About Us Page
 */

get_header();

$page_image = get_field('page_image'); ?>

    <section class="bold-line bold-line__about"></section>

    <section class="headline headline__about headline__image">
        <?php get_template_part('template-parts/image', 'header'); ?>
    </section>

    <section class="section section__image">
        <img src="<?php echo $page_image['url']; ?>" alt="<?php echo $page_image['alt']; ?>">
    </section>

    <section class="section section__about b-container-width">
        <div class="accordion" id="accordionAbout">

            <?php if( have_rows('about_us_accordion') ):

                while ( have_rows('about_us_accordion') ) : the_row();

                    $title                 = get_sub_field('title');
                    $header_content        = get_sub_field('header_content');
                    $collapse_button_title = get_sub_field('collapse_button_title');
                    $body_content          = get_sub_field('body_content');
                    $row_index             = get_row_index(); ?>

                    <div class="card about__card">
                        <div class="card-header about__card_header" id="heading-<?php echo $row_index; ?>">
                            <div class="num">
                                <span><?php echo '0' . $row_index; ?></span>
                            </div>
                            <div class="title">
                                <h2><?php echo $title; ?></h2>
                            </div>
                        </div>
                        <div class="about__card_subheader">
                            <div>
                                <?php echo $header_content; ?>
                            </div>
                            <div>
                                <div class="line"></div>
                                <button class="btn btn-link info__btn" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $row_index; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $row_index; ?>"><?php echo $collapse_button_title; ?></button>
                            </div>
                        </div>

                        <div id="collapse-<?php echo $row_index; ?>" class="collapse about__card_collapse" aria-labelledby="heading-<?php echo $row_index; ?>">
                            <div class="card-body about__card_body">
                                <?php echo $body_content; ?>
                            </div>
                        </div>
                    </div>

                <?php endwhile;

            endif; ?>

        </div>
    </section>

<?php get_footer(); ?>