<?php

/**
 * Register Portfolio categories
 */
function portfolios_taxonomy() {
    register_taxonomy(
        'industry',
        'portfolio',
        array(
            'hierarchical' => true,
            'label' => 'Industry',
            'labels'                => array(
                'name'              => 'Industry',
                'singular_name'     => 'Industry',
                'search_items'      => 'Search Industry',
                'all_items'         => 'All Industries',
                'view_item '        => 'View Industry',
                'parent_item'       => 'Parent Industry',
                'parent_item_colon' => 'Parent Industry:',
                'edit_item'         => 'Edit Industry',
                'update_item'       => 'Update Industry',
                'add_new_item'      => 'Add New Industry',
                'new_item_name'     => 'New Portfolio Industry',
                'menu_name'         => 'Industry',
            ),
            'query_var' => true,
            'show_admin_column' => true,
            'rewrite' => array(
                'slug' => 'portfolio',
                'with_front' => false
            )
        )
    );

    register_taxonomy('location', 'portfolio',array(
        'hierarchical'  => true,
        'labels'        => array(
            'name'                        => _x( 'Locations', 'taxonomy general name' ),
            'singular_name'               => _x( 'Location', 'taxonomy singular name' ),
            'search_items'                =>  __( 'Search Locations' ),
            'popular_items'               => __( 'Popular Locations' ),
            'all_items'                   => __( 'All Locations' ),
            'parent_item'                 => null,
            'parent_item_colon'           => null,
            'edit_item'                   => __( 'Edit Location' ),
            'update_item'                 => __( 'Update Location' ),
            'add_new_item'                => __( 'Add New Location' ),
            'new_item_name'               => __( 'New Location Name' ),
            'separate_items_with_commas'  => __( 'Separate Locations with commas' ),
            'add_or_remove_items'         => __( 'Add or remove Locations' ),
            'choose_from_most_used'       => __( 'Choose from the most used Locations' ),
            'menu_name'                   => __( 'Locations' ),
        ),
        'show_ui'       => true,
        'query_var'     => true,
    ));

    /*register_taxonomy('investment', 'portfolio',array(
        'hierarchical'  => true,
        'labels'        => array(
            'name'                        => _x( 'Investments', 'taxonomy general name' ),
            'singular_name'               => _x( 'Investment', 'taxonomy singular name' ),
            'search_items'                =>  __( 'Search Investments' ),
            'popular_items'               => __( 'Popular Investments' ),
            'all_items'                   => __( 'All Investments' ),
            'parent_item'                 => null,
            'parent_item_colon'           => null,
            'edit_item'                   => __( 'Edit Investment' ),
            'update_item'                 => __( 'Update Investment' ),
            'add_new_item'                => __( 'Add New Investment' ),
            'new_item_name'               => __( 'New Investment Name' ),
            'separate_items_with_commas'  => __( 'Separate Investments with commas' ),
            'add_or_remove_items'         => __( 'Add or remove Investments' ),
            'choose_from_most_used'       => __( 'Choose from the most used Investments' ),
            'menu_name'                   => __( 'Investments' ),
        ),
        'show_ui'       => true,
        'query_var'     => true,
    ));*/
}
add_action( 'init', 'portfolios_taxonomy');

/**
 * Link custom post type Portfolios
 */
function filter_post_type_link($link, $post)
{
    if ($post->post_type != 'portfolio')
        return $link;

    if ($cats = get_the_terms($post->ID, 'industry'))
        $link = str_replace('%industry%', array_pop($cats)->slug, $link);
    return $link;
}
add_filter('post_type_link', 'filter_post_type_link', 10, 2);

/**
 * Register custom post type Portfolios
 */
function register_portfolio() {
    $labels = array(
        'name' => _x( 'Portfolio', 'my_custom_post','custom' ),
        'singular_name' => _x( 'Portfolio', 'my_custom_post', 'custom' ),
        'add_new' => _x( 'Add Portfolio', 'my_custom_post', 'custom' ),
        'add_new_item' => _x( 'Add New Portfolio', 'my_custom_post', 'custom' ),
        'edit_item' => _x( 'Edit Portfolio', 'my_custom_post', 'custom' ),
        'new_item' => _x( 'New Portfolio', 'my_custom_post', 'custom' ),
        'view_item' => _x( 'View Portfolio', 'my_custom_post', 'custom' ),
        'search_items' => _x( 'Search Portfolio', 'my_custom_post', 'custom' ),
        'not_found' => _x( 'No Portfolio found', 'my_custom_post', 'custom' ),
        'not_found_in_trash' => _x( 'No Portfolio found in Trash', 'my_custom_post', 'custom' ),
        'parent_item_colon' => _x( 'Parent Portfolio:', 'my_custom_post', 'custom' ),
        'menu_name' => _x( 'Portfolio', 'my_custom_post', 'custom' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Portfolio',
        'supports' => array( 'title','page-attributes',),
        'taxonomies' => array('industry', 'location', 'investment'),
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-images-alt2',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug' => 'portfolio/%industry%','with_front' => FALSE),
        'public' => true,
        'has_archive' => true,
        'capability_type' => 'post'
    );
    register_post_type( 'portfolio', $args );
}
add_action( 'init', 'register_portfolio', 20 );

/**
 * Default taxonomy term
 */
function default_taxonomy_term( $post_id, $post ) {
    if ( 'publish' === $post->post_status ) {
        $defaults = array(
            'industry' => array( 'Other'),

        );
        $taxonomies = get_object_taxonomies( $post->post_type );
        foreach ( (array) $taxonomies as $taxonomy ) {
            $terms = wp_get_post_terms( $post_id, $taxonomy );
            if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
                wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
            }
        }
    }
}
add_action( 'save_post', 'default_taxonomy_term', 100, 2 );