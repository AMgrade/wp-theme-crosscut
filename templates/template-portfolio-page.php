<?php
/**
 * Template Name: Portfolio Page
 */

get_header(); ?>

<section class="headline headline__portfolio headline__image">
    <?php get_template_part('template-parts/image', 'header'); ?>
</section>

<section class="section section__portfolio b-container-width">
    <div class="portfolio__filter">

        <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
            <input type="hidden" name="action" value="myfilter">
            <div class="portfolio__filter_sort">
                <!--<div class="dropdown dropdown__sort">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sort by A-Z
                    </button>
                    <div class="arrow">
                        <img src="/wp-content/themes/crosscut/assets/img/team/arrow-down.svg" alt="">
                    </div>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="dropdown-item" data-value="ASC">Sort by A-Z</div>
                        <div class="dropdown-item" data-value="DESC">Sort by Z-A</div>
                    </div>
                    <input type="hidden" id="sortOrder" name="sortOrder">
                </div>-->
            </div>
            <div class="portfolio__filter_search">
                <div id="filterBtn" class="filters">
                    <img src="/wp-content/themes/crosscut/assets/img/portfolio/filter-icon.svg" alt="">
                </div>
                <div class="line"></div>
                <div id="searchBtn" class="search">
                    <img src="/wp-content/themes/crosscut/assets/img/portfolio/search-icon.svg" alt="">
                </div>
            </div>

            <div id="searchForm">
                <input type="text" class="form-control" id="portfolioTitle" name="portfolioTitle" placeholder="Search..." />
                <span id="closeSearchBtn">
                    <img src="/wp-content/themes/crosscut/assets/img/icons/cancel.svg" alt="">
                </span>
            </div>

            <div id="filterForm">
                <div id="closeForm">
                    <img src="/wp-content/themes/crosscut/assets/img/icons/cancel.svg" alt="">
                </div>
                <div>
                    <div class="location filter-col">
                        <div class="filter-col__title">
                            <h4>Location</h4>
                        </div>
                        <ul>

                            <?php $locationTerms = get_terms([
                                'taxonomy' => 'location',
                                'hide_empty' => true,
                            ]);

                            foreach ($locationTerms as $locationTerm) { ?>
                                <li>
                                    <label class="filter-col__label" for="location-<?php echo $locationTerm->term_id; ?>">
                                        <input name="location[]" type="checkbox" id="location-<?php echo $locationTerm->term_id; ?>" class="form-control filter-col__checkbox" value="<?php echo $locationTerm->term_id; ?>" />
                                        <span></span>
                                        <?php echo $locationTerm->name; ?>
                                    </label>
                                </li>
                            <?php } ?>

                        </ul>
                    </div>
                    <div class="industry filter-col">
                        <div class="filter-col__title">
                            <h4>Industry</h4>
                        </div>
                        <ul class="columns" data-columns="2">

                            <?php $industryTerms = get_terms([
                                'taxonomy' => 'industry',
                                'hide_empty' => true,
                            ]);

                            foreach ($industryTerms as $industryTerm) { ?>
                                <li>
                                    <label class="filter-col__label" for="industry-<?php echo $industryTerm->term_id; ?>">
                                        <input name="industry[]" type="checkbox" id="industry-<?php echo $industryTerm->term_id; ?>" class="form-control filter-col__checkbox" value="<?php echo $industryTerm->term_id; ?>" />
                                        <span></span>
                                        <?php echo $industryTerm->name; ?>
                                    </label>
                                </li>
                            <?php } ?>

                        </ul>
                    </div>
                    <!--<div class="investment filter-col">
                        <div class="filter-col__title">
                            <h4>Investment</h4>
                        </div>
                        <ul>

                            <?php /*$investmentTerms = get_terms([
                                'taxonomy' => 'investment',
                                'hide_empty' => true,
                            ]);

                            foreach ($investmentTerms as $investmentTerm) { */?>
                                <li>
                                    <label class="filter-col__label" for="investment-<?php /*echo $investmentTerm->term_id; */?>">
                                        <input name="investment[]" type="checkbox" id="investment-<?php /*echo $investmentTerm->term_id; */?>" class="form-control filter-col__checkbox" value="<?php /*echo $investmentTerm->term_id; */?>" />
                                        <span></span>
                                        <?php /*echo $investmentTerm->name; */?>
                                    </label>
                                </li>
                            <?php /*} */?>

                        </ul>
                    </div>-->
                </div>
                <div class="filter-buttons">
                    <div id="clearBtn" class="filter-buttons__clear cross-btn">Clear All</div>
                    <div id="filterBtnApply" class="filter-buttons__filter cross-btn">Filter</div>
                </div>
            </div>
        </form>

    </div>
    <div class="portfolio__items">
        <div class="container-fluid">
            <div id="response" class="row">

                <?php
                $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                $posts = array(
                    'posts_per_page'   => 9,
                    'orderby'			=> 'date',
                    'order'			    => 'DESC',
                    'post_type'        => 'portfolio',
                    'suppress_filters' => true,
                    'paged'     => $paged
                );

                $portfolio_query = new WP_Query( $posts );

                if( $portfolio_query->have_posts() ):
                    while( $portfolio_query->have_posts() ) : $portfolio_query->the_post();

                    $ctt                      = get_field('portfolio_ctt');
                    $logo                     = get_field('main_logo');
                    $portfolio_description    = get_field('portfolio_description');
                    $portfolio_founder_ceo    = get_field('portfolio_founder_ceo');
                    $portfolio_founder        = get_field('portfolio_founder');
                    $portfolio_strategy       = get_field('portfolio_strategy');
                    $portfolio_facebook_link  = get_field('portfolio_facebook_link');
                    $portfolio_twitter_link   = get_field('portfolio_twitter_link');
                    $portfolio_linkendin_link = get_field('portfolio_linkendin_link');
                    $portfolio_world_link     = get_field('portfolio_world_link');

                    $industry_term            = get_the_terms( $post_id, 'industry' );
                    $location_term            = get_the_terms( $post_id, 'location' );
                    $investment_term          = get_the_terms( $post_id, 'investment' ); ?>

                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="item">
                            <span><?php echo $ctt; ?></span>
                            <div class="item__logo">
                                <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
                            </div>
                            <div class="item__overlay">
                                <div class="item__overlay_header">
                                    <div class="cat">
                                        <div><?php echo $portfolio_strategy; ?></div>
                                        <!--<div><?php /*echo $industry_term[0]->name; */?></div>-->
                                    </div>
                                    <div class="title">
                                        <h3><?php the_title(); ?></h3>
                                    </div>
                                </div>
                                <?php if($portfolio_description) : ?>
                                <div class="item__overlay_body">
                                    <p><?php echo $portfolio_description; ?></p>
                                </div>
                                <?php endif; ?>
                                <div class="item__overlay_footer">
                                    <div class="col-f">
                                        <?php if($portfolio_founder_ceo) : ?>
                                        <div class="col-f__item">
                                            <div class="title">FOUNDER/CEO</div>
                                            <div class="text"><?php echo $portfolio_founder_ceo; ?></div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-f__item">
                                            <div class="title">LOCATION</div>
                                            <div class="text"><?php echo $location_term[0]->name; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-f">
                                        <?php if($portfolio_founder) : ?>
                                        <div class="col-f__item">
                                            <div class="title">FOUNDER</div>
                                            <div class="text"><?php echo $portfolio_founder; ?></div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-f__item">
                                            <div class="title">Category</div>
                                            <div class="text"><?php echo $industry_term[0]->name; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item__overlay_social">
                                    <?php if($portfolio_facebook_link) : ?>
                                    <div class="facebook">
                                        <a href="<?php echo $portfolio_facebook_link; ?>">
                                            <img src="/wp-content/themes/crosscut/assets/img/icons/facebook.svg" alt="">
                                        </a>
                                    </div>
                                    <?php endif;
                                    if($portfolio_twitter_link) : ?>
                                    <div class="twitter">
                                        <a href="<?php echo $portfolio_twitter_link; ?>">
                                            <img src="/wp-content/themes/crosscut/assets/img/icons/twitter.svg" alt="">
                                        </a>
                                    </div>
                                    <?php endif;
                                    if($portfolio_linkendin_link) : ?>
                                    <div class="linkendin">
                                        <a href="<?php echo $portfolio_linkendin_link; ?>">
                                            <img src="/wp-content/themes/crosscut/assets/img/icons/linkedin.svg" alt="">
                                        </a>
                                    </div>
                                    <?php endif;
                                    if($portfolio_world_link) : ?>
                                    <div class="link">
                                        <a href="<?php echo $portfolio_world_link; ?>">
                                            <img src="/wp-content/themes/crosscut/assets/img/icons/world-wide-web.svg" alt="">
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php endwhile;
                    wp_reset_postdata();
                endif;  ?>

            </div>

            <?php /*if ($portfolio_query->max_num_pages > 1) { */?><!--
                <div id="loadMore" class="cross-btn" style="margin-top: 150px;">Load More</div>
            --><?php /*} */?>

        </div>
    </div>
</section>

<?php get_footer(); ?>
