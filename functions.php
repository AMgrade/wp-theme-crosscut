<?php

define( 'CROSSCUT_THEME_VERSION', 0.1 );

show_admin_bar( false );

//Initials scripts
require_once( __DIR__ . '/inc/functions/init.php' );

//Assets
require_once( __DIR__ . '/inc/functions/assets.php' );

//Shortcodes compatibility
require_once( __DIR__ . '/inc/functions/shortcodes.php' );

//Register custom post types
require_once(__DIR__ . '/inc/functions/post_types/index.php');

//Register custom roles
require_once(__DIR__ . '/inc/functions/roles/index.php');

//Plugins compatibility
require_once( __DIR__ . '/inc/functions/plugins_compatibility/acf.php' );

//Menu walker
require_once( __DIR__ . '/inc/functions/walker.php' );

//Filter
require_once( __DIR__ . '/inc/functions/filter.php' );