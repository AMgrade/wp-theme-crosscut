<?php

/**
 * Enqueue scripts and styles.
 */
function crosscut_scripts() {
	//css
	wp_register_style( 'crosscut-vendor-style', get_template_directory_uri() . '/assets/dist/css/vendor.css', null, CROSSCUT_THEME_VERSION );
	wp_enqueue_style( 'crosscut-main-style', get_template_directory_uri() . '/assets/dist/css/app.css', [ 'crosscut-vendor-style' ], CROSSCUT_THEME_VERSION );

	//js
	wp_deregister_script('jquery');
	wp_register_script( 'jquery', get_template_directory_uri() . '/assets/dist/js/jquery.min.js', CROSSCUT_THEME_VERSION, true );
	wp_register_script( 'popper', get_template_directory_uri() . '/assets/dist/js/popper.min.js', [ 'jquery' ], CROSSCUT_THEME_VERSION, true );
    wp_register_script( 'slick-slider', get_template_directory_uri() . '/assets/dist/js/slick.js', [ 'jquery' ], CROSSCUT_THEME_VERSION, true );
	wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/dist/js/bootstrap.min.js', [ 'jquery', 'popper' ], CROSSCUT_THEME_VERSION, true );
	wp_register_script( 'crosscut-vendor-script', get_template_directory_uri() . '/assets/dist/js/vendor.js', [ 'jquery', 'bootstrap' ], CROSSCUT_THEME_VERSION, true );
	wp_enqueue_script( 'crosscut-main-script', get_template_directory_uri() . '/assets/dist/js/app.js', [ 'crosscut-vendor-script', 'slick-slider' ], CROSSCUT_THEME_VERSION, true );

    global $wp_query;

    $template_file = get_post_meta( get_queried_object_id(), '_wp_page_template', true );

    switch($template_file) {
        case 'templates/template-portfolio-page.php':
            $load_more = [
                'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
                'posts' => json_encode( $wp_query->query_vars ),
                'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
                'max_page' => $wp_query->max_num_pages
            ];

            wp_enqueue_script('filter_script', get_template_directory_uri() . '/assets/dist/js/filter.js',  ['jquery'] , CROSSCUT_THEME_VERSION, true);
            wp_localize_script('filter_script', 'loadmore_params', $load_more);
            break;
    }

}

add_action( 'wp_enqueue_scripts', 'crosscut_scripts' );


/**
 * setup
 */
function crosscut_setup() {
	register_nav_menus( [
		'top'                 => 'Top menu',
	] );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
}


add_action( 'after_setup_theme', 'crosscut_setup' );