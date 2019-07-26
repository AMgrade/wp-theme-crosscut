<?php
/**
 * Template Name: Team Page
 */

get_header();

?>

<section class="headline headline__team headline__image">
    <?php get_template_part('template-parts/image', 'header'); ?>
</section>

<section class="section section__team b-container-width mb-80">
    <div class="accordion" id="accordionTeam">

        <?php if( have_rows('team') ):

            while ( have_rows('team') ) : the_row();

                $team_member_photo          = get_sub_field('team_member_photo');
                $team_member_photo_open     = get_sub_field('team_member_photo_open');
                $team_member_postiton       = get_sub_field('team_member_postiton');
                $team_member_name           = get_sub_field('team_member_name');
                $team_member_linkendin_link = get_sub_field('team_member_linkendin_link');
                $row_index = get_row_index(); ?>

                <div class="card team__card">
                    <div class="card-header team__card_header" id="heading-<?php echo $row_index; ?>">
                        <div class="image" data-toggle="collapse" data-target="#collapse-<?php echo $row_index; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $row_index; ?>">
                            <img class="bw" src="<?php echo $team_member_photo['url']; ?>" alt="<?php echo $team_member_photo['alt']; ?>">
                            <img class="color" src="<?php echo $team_member_photo_open['url']; ?>" alt="<?php echo $team_member_photo_open['alt']; ?>" style="display: none">
                        </div>
                        <div class="info">
                            <div class="info__name">
                                <div class="info__name_position">
                                    <p><?php echo $team_member_postiton; ?></p>
                                </div>
                                <div class="info__name_name">
                                    <p>
                                        <span class="name-toggle" data-toggle="collapse" data-target="#collapse-<?php echo $row_index; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $row_index; ?>"><?php echo $team_member_name; ?></span>
                                        <?php if ($team_member_linkendin_link) : ?>
                                            <a href="<?php echo $team_member_linkendin_link; ?>"
                                               class="info__name_linkendin"></a>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                            <button class="btn btn-link info__btn" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $row_index; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $row_index; ?>"></button>
                        </div>
                    </div>

                    <div id="collapse-<?php echo $row_index; ?>" class="collapse team__card_collapse" aria-labelledby="heading-<?php echo $row_index; ?>">
                        <div class="card-body team__card_body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="title">
                                            <p>Stats</p>
                                        </div>
                                        <div class="bio-repeater">

                                            <?php if( have_rows('stats') ):

                                                while ( have_rows('stats') ) : the_row();

                                                    $title = get_sub_field('title');
                                                    $text = get_sub_field('text'); ?>

                                                    <div class="bio-repeater__row">
                                                        <div class="bio-repeater__title">
                                                            <?php echo $title; ?>
                                                        </div>
                                                        <div class="bio-repeater__text">
                                                            <?php echo $text; ?>
                                                        </div>
                                                    </div>

                                                <?php endwhile;

                                            endif; ?>

                                        </div>

                                        <div class="title">
                                            <p>Media</p>
                                        </div>
                                        <div class="bio-repeater">

                                            <?php if( have_rows('media') ):

                                                while ( have_rows('media') ) : the_row();

                                                    $media = get_sub_field('media_link'); ?>

                                                    <div class="bio-repeater__row">
                                                        <!--<div class="bio-repeater__title">
                                                            <?php /*echo $media['title']; */?>
                                                        </div>-->
                                                        <div class="bio-repeater__text">
                                                            <a href="<?php echo $media['url']; ?>" target="_blank"><?php echo $media['title']; ?></a>
                                                        </div>
                                                    </div>

                                                <?php endwhile;

                                            endif; ?>

                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="title">
                                            <p>Bio</p>
                                        </div>
                                        <div class="bio-repeater">
                                            <?php if( have_rows('bio') ):

                                                while ( have_rows('bio') ) : the_row();

                                                    $title = get_sub_field('title');
                                                    $text = get_sub_field('text'); ?>

                                                    <div class="bio-repeater__row">
                                                        <div class="bio-repeater__title">
                                                            <?php echo $title; ?>
                                                        </div>
                                                        <div class="bio-repeater__text">
                                                            <?php echo $text; ?>
                                                        </div>
                                                    </div>

                                                <?php endwhile;

                                            endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endwhile;

        endif; ?>

    </div>
</section>

<?php get_footer(); ?>

