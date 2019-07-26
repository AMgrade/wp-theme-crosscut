<?php
/**
 * Template Name: Home Page
 */

get_header();

$top_content_title       = get_field('top_conent_title');
$top_content_content     = get_field('top_conent_content');
$top_content_button_text = get_field('top_conent_button_text');
$top_content_button_link = get_field('top_conent_button_link');
$top_content_image       = get_field('top_conent_image');

$feedback_title          = get_field('feedback_title');

$companies_title         = get_field('companies_title');

$news_title         = get_field('news_title');

?>

<section class="bold-line"></section>

<section class="headline headline__home headline__image">
    <?php get_template_part('template-parts/image', 'header'); ?>
</section>

<section class="section section__top container-width mb-80">
    <div class="section__title mb-80">
        <h2><?php echo $top_content_title; ?></h2>
    </div>
    <div class="section__content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="section__content_text">
                        <?php echo $top_content_content; ?>
                        <a href="<?php echo $top_content_button_link['url']; ?>" class="cross-btn mb-80"><?php echo $top_content_button_link['title']; ?></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="section__content_image">
                        <img src="<?php echo $top_content_image['url']; ?>" alt="<?php echo $top_content_image['alt']; ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section__feedback container-width mb-80">
    <div class="section__title mb-80">
        <h2><?php echo $feedback_title; ?></h2>
    </div>
    <div class="section__feedback-row feedback__desktop">

        <?php if( have_rows('feedbacks') ):

            $counter = 0; ?>

            <?php while( have_rows('feedbacks') ): the_row();

                $image       = get_sub_field('image');
                $logo        = get_sub_field('logo');
                $title       = get_sub_field('title');
                $content     = get_sub_field('content');
                $author_name = get_sub_field('author_name');
                $linkendin_link = get_sub_field('linkendin_link');
                $company_link = get_sub_field('company_link');

                $row_index = get_row_index();
                $item_class = 'news__item';

                if ($row_index == 2 || $row_index == 4) {
                    $item_class = 'news__item news__item-down';
                }

                if ($counter == 0) {
                    echo '<!-- open --><div class="news-slide">';
                } ?>

                <div class="<?php echo $item_class; ?>">
                    <div class="news__item-img">
                        <a href="<?php echo $linkendin_link; ?>">
                            <img class="lazy" data-src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                        </a>
                        <div class="news-cat__wrapper news-cat__wrapper-white">
                            <a href="<?php echo $company_link; ?>">
                                <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
                            </a>
                        </div>
                    </div>
                    <div class="news__item-title">
                        <p><?php echo $title; ?></p>
                    </div>
                    <div class="news__item-text">
                        <p><?php echo $content; ?></p>
                    </div>
                    <div class="news__item-author">
                        <p>&ndash; <?php echo $author_name; ?></p>
                    </div>
                </div>

            <?php $counter++;
            if ($counter == 2) {
                echo '</div><!-- close -->';
                $counter = 0;
            } endwhile; ?>

        <?php endif; ?>

    </div>

    <div class="section__feedback-row feedback__mobile news-slick">
        <?php if( have_rows('feedbacks') ): ?>

            <?php while( have_rows('feedbacks') ): the_row();

            $image       = get_sub_field('image');
            $logo        = get_sub_field('logo');
            $title       = get_sub_field('title');
            $content     = get_sub_field('content');
            $author_name = get_sub_field('author_name');
            $linkendin_link = get_sub_field('linkendin_link');
            $company_link = get_sub_field('company_link'); ?>

            <div class="news__item news__item-down">
                <div class="news__item-img">
                    <a href="<?php echo $linkendin_link; ?>">
                        <img class="lazy" data-src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                    </a>
                    <div class="news-cat__wrapper news-cat__wrapper-white">
                        <a href="<?php echo $company_link; ?>">
                            <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
                        </a>
                    </div>
                </div>
                <div class="news__item-title">
                    <p><?php echo $title; ?></p>
                </div>
                <div class="news__item-text">
                    <p><?php echo $content; ?></p>
                </div>
                <div class="news__item-author">
                    <p>&ndash; <?php echo $author_name; ?></p>
                </div>
            </div>

            <?php endwhile; ?>

        <?php endif; ?>
    </div>
</section>

<section class="section section__company container-width mb-80">
    <div class="section__title mb-80">
        <h2><?php echo $companies_title; ?></h2>
    </div>

    <?php if( have_rows('companies_icons') ):

        $counter = 0; ?>

        <?php while( have_rows('companies_icons') ): the_row();

        $icon = get_sub_field('icon');
        $link = get_sub_field('link');

        if ($counter == 0) {
            echo '<!-- open --><div class="section__company_row">';
        } ?>

        <div class="img">
            <a href="<?php echo $link; ?>">
                <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
            </a>
        </div>

        <?php $counter++;
        if ($counter == 3) {
            echo '</div><!-- close -->';
            $counter = 0;
        } endwhile; ?>

    <?php endif; ?>

</section>

<section class="section section__news container-width mb-80">
    <div class="section__title mb-80">
        <h2><?php echo $news_title; ?></h2>
    </div>
    <div class="section__news_wrapper section__news_wrapper-desktop">
        <div class="news-slide">

            <?php $posts = get_posts( array(
                'numberposts' => 2,
                'category'    => 0,
                'orderby'     => 'date',
                'order'       => 'DESC',
                'post_type'   => 'post',
                'suppress_filters' => true,
            ) );

            $count_post = 1;

            foreach( $posts as $post ) {
                if($count_post == 2) {
                    $post_class = 'news__item';
                    $cat_class = 'news-cat__green';
                } else {
                    $post_class = 'news__item news__item-down';
                    $cat_class = 'news-cat__blue';
                }
                $thumb = get_the_post_thumbnail_url( $post->ID, 'large' );
                $category = get_the_category($post->ID); ?>

                <div class="<?php echo $post_class; ?>">
                    <div class="news__item-img">
                        <img class="lazy" data-src="<?php echo $thumb; ?>" alt="">
                        <div class="news-cat__wrapper news-cat__wrapper-white">
                            <span class="<?php echo $cat_class; ?>"><?php echo $category[0]->name; ?></span>
                        </div>
                    </div>
                    <a href="<?php echo get_the_permalink(); ?>" title="<?php the_title(); ?>">
                        <h2><?php the_title(); ?></h2>
                    </a>
                </div>

                <?php $count_post++; }

            wp_reset_postdata(); ?>

        </div>
    </div>

    <div class="section__news_wrapper section__news_wrapper-mobile">

        <div class="news-slide__wrapper news-slick">
            <?php $posts = get_posts(array(
                'numberposts' => 4,
                'category' => 0,
                'orderby' => 'date',
                'order' => 'DESC',
                'post_type' => 'post',
                'suppress_filters' => true,
            ));

            $count_post = 1;

            foreach ($posts as $post) {
                $count_even = $count_post % 2;
                if ($count_even == 0 ) {
                    $post_class = 'news__item';
                    $cat_class = 'news-cat__green';
                } else {
                    $post_class = 'news__item news__item-down';
                    $cat_class = 'news-cat__blue';
                }
                $thumb = get_the_post_thumbnail_url($post->ID, 'large');
                $category = get_the_category($post->ID); ?>

                <div class="<?php echo $post_class; ?>">
                    <div class="news__item-img">
                        <img class="lazy" data-src="<?php echo $thumb; ?>" alt="">
                        <div class="news-cat__wrapper">
                            <span class="<?php echo $cat_class; ?>"><?php echo $category[0]->name; ?></span>
                        </div>
                    </div>
                    <a href="<?php echo get_the_permalink(); ?>" title="<?php the_title(); ?>">
                        <h2><?php the_title(); ?></h2>
                    </a>
                </div>

                <?php $count_post++;
            }

            wp_reset_postdata(); ?>
        </div>

    </div>

</section>

<?php get_footer(); ?>
