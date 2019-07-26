<?php
/**
 * Template Name: News page
 */
get_header();

$title_1 = get_field('title_1');
$title_2 = get_field('title_2');
$title_3 = get_field('title_3');

?>
    <section class="headline headline__news">
        <div class="headline__logo-corner">
            <img src="<?php echo get_template_directory_uri() . '/assets/img/logo/corner.svg'; ?>" alt="">
            <a href="<?php echo home_url('/'); ?>"></a>
        </div>
    </section>

    <section class="news__hero">
        <div class="news__hero-des"></div>

        <div class="container-width">
            <h1>
               <?php echo $title_1; ?>
            </h1>

            <div class="news-slide__wrapper news-slick">

                <?php if( have_rows('news') ):

                    while ( have_rows('news') ) : the_row();

                        $news_image       = get_sub_field('news_image');
                        $news_portal_name = get_sub_field('news_portal_name');
                        $news_title       = get_sub_field('news_title');
                        $news_link        = get_sub_field('news_link');

                        $news_index       = get_row_index();
                        $news_index = $news_index - 1;
                        $news_even = $news_index % 2;
                        if ($news_even == 0 ) {
                            $news_class = 'news__item news__item-down';
                            $cat_class = 'news-cat__green';
                        } else {
                            $news_class = 'news__item';
                            $cat_class = 'news-cat__blue';
                        } ?>

                        <div class="<?php echo $news_class; ?>">
                            <div class="news__item-img">
                                <img class="lazy"
                                     data-src="<?php echo $news_image['url']; ?>"
                                     alt="">
                                <div class="news-cat__wrapper">
                                    <span style="color:#fff;"><?php echo $news_portal_name; ?></span>
                                </div>
                            </div>
                            <a href="<?php echo $news_link; ?>" title="<?php echo $news_title; ?>">
                                <h2><?php echo $news_title; ?></h2>
                            </a>
                        </div>

                    <?php endwhile;

                endif; ?>

            </div>

            <!--<div class="news-slide__wrapper news-slick">
                <?php /*$posts = get_posts(array(
                    'posts_per_page' => -1,
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
                    $category = get_the_category($post->ID); */?>

                    <div class="<?php /*echo $post_class; */?>">
                        <div class="news__item-img">
                            <img class="lazy" data-src="<?php /*echo $thumb; */?>" alt="">
                            <div class="news-cat__wrapper">
                                <span class="<?php /*echo $cat_class; */?>"><?php /*echo $category[0]->name; */?></span>
                            </div>
                        </div>
                        <a href="<?php /*echo get_the_permalink(); */?>" title="<?php /*the_title(); */?>">
                            <h2><?php /*the_title(); */?></h2>
                        </a>
                    </div>

                    <?php /*$count_post++;
                }

                wp_reset_postdata(); */?>
            </div>-->
        </div>
    </section>

    <section class="news__social">
        <div class="news__social-des_1"></div>
        <div class="news__social-des_2"></div>
        <div class="container-width">
            <h1><?php echo $title_2; ?></h1>
            <?php echo do_shortcode('[scbw]'); ?>
        </div>
    </section>

    <section class="news__press">
        <div class="container-width">
            <h1 style="font-size: 60px;">
                <?php echo $title_3; ?>
            </h1>

            <div class="news-slide__wrapper news-slick">
                <?php $posts = get_posts(array(
                    'posts_per_page' => -1,
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
                            <div class="news-cat__wrapper news-cat__wrapper-blue">
                                <span><?php echo $category[0]->name; ?></span>
                            </div>
                        </div>
                        <a href="<?php echo get_the_permalink(); ?>" title="<?php the_title(); ?>">
                            <h2 class="color__d-blue"><?php the_title(); ?></h2>
                        </a>
                    </div>

                    <?php $count_post++;
                }

                wp_reset_postdata(); ?>
            </div>

        </div>
    </section>

<?php get_footer(); ?>