<?php

add_action('wp_ajax_loadmorebutton', 'loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmorebutton', 'loadmore_ajax_handler');

function loadmore_ajax_handler() {

    global $post;

    $t = json_decode( stripslashes( $_POST['query'] ), true );
    $t = $t['pagename'];

    if($t !== '') {
        $args = isset( $_POST['query'] ) ? array_map( 'esc_attr', $_POST['query'] ) : array();
        $args['post_type'] = isset( $args['post_type'] ) ? esc_attr( $args['post_type'] ) : 'portfolio';
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
    } else {
        $args = json_decode( stripslashes( $_POST['query'] ), true );
    }

    $args['paged'] = esc_attr( $_POST['page'] ) + 1;
    $args['posts_per_page'] = 9;
    $args['post_status'] = 'publish';

    query_posts( $args );

    if( have_posts() ) :
        while( have_posts() ) : the_post();

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

            $industry_term            = get_the_terms( $post->ID, 'industry' );
            $location_term            = get_the_terms( $post->ID, 'location' );
            //$investment_term          = get_the_terms( $post->ID, 'investment' ); ?>

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
    endif;
    die;
}

add_action('wp_ajax_myfilter', 'filter_function');
add_action('wp_ajax_nopriv_myfilter', 'filter_function');

function filter_function() {

    $location = $_POST['location'];
    $industry = $_POST['industry'];
    $investment = $_POST['investment'];

    $tax_query = array();

    if( $location && $industry && $investment) {
        $tax_query['relation'] = 'AND';
    }

    if( $location ) {
        $tax_query[] = array (
            'taxonomy' => 'location',
            'field' => 'term_id',
            'terms' => $location,
        );
    }
    if( $industry ) {
        $tax_query[] = array (
            'taxonomy' => 'industry',
            'field' => 'term_id',
            'terms' => $industry,
        );
    }
    if( $investment ) {
        $tax_query[] = array (
            'taxonomy' => 'investment',
            'field' => 'term_id',
            'terms' => $investment,
        );
    }

    $args = isset( $_POST['query'] ) ? array_map( 'esc_attr', $_POST['query'] ) : array();
    $args['s'] = isset( $_POST['portfolioTitle'] ) ? esc_attr( $_POST['portfolioTitle'] ) : array();
    $args['post_type'] = isset( $args['post_type'] ) ? esc_attr( $args['post_type'] ) : 'portfolio';
    $args['orderby'] = 'date';
    $args['order'] = 'DESC';
    $args['posts_per_page'] = 9;
    $args['tax_query'] = $tax_query;
    $args['post_status'] = 'publish';

    query_posts( $args );

    global $wp_query, $post;

    if( have_posts() ) :

        ob_start();

        while( have_posts() ) : the_post();

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

            $industry_term            = get_the_terms( $post->ID, 'industry' );
            $location_term            = get_the_terms( $post->ID, 'location' );
            //$investment_term          = get_the_terms( $post->ID, 'investment' ); ?>

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
        $posts_html = ob_get_contents();
        ob_end_clean();
    else :
        $posts_html = '<p>Nothing found for your criteria.</p>';
    endif;

    echo json_encode( array(
        'posts' => json_encode( $wp_query->query_vars ),
        'max_page' => $wp_query->max_num_pages,
        'found_posts' => $wp_query->found_posts,
        'content' => $posts_html
    ) );

    die();
}