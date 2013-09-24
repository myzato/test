<?php
//この行が文字化けの要因のようだ
//define('HEADER_TEXTCOLOR', 'ffffff');
//define('HEADER_IMAGE','%s/images/header.jpg');
define('HEADER_IMAGE_WIDTH', '800');
define('HEADER_IMAGE_HEIGHT', '380');
define('NO_HEADER_TEXT',true);
//add_theme_support( 'custom-header' /* , $args*/ ); 
//function admin_header_style() {}
//<style type="text/css">
//#headimg  {width: 1000px!important}
//</style>

function twentytwelve_setup() {
	/*
	 * Makes Twenty Twelve available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Twelve, use a find and replace
	 * to change 'twentytwelve' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentytwelve', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.
	//register_nav_menu( 'navbar', __( 'navbar', 'OriginalTheme' ) );
    register_nav_menus(array(
            'navbar' => 'ナビゲーションバー'
    ));

	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 800,180,true ); // Unlimited height, soft crop
        add_theme_support('custom-header');
        //add_theme_support('menus');

    //ウィジェット機能追加
    register_sidebar();

}

function theme_scripts_styles() {

    //loaded in head
    wp_enqueue_style( 'clippy-style', get_stylesheet_directory_uri() . '/css/style.css' );


    wp_enqueue_script( 'masonry-js', get_stylesheet_directory_uri() . '/js/jquery.masonry_min.js', array('jquery'), '1.5.21', true );
    wp_enqueue_script( 'imagesloaded-js', get_stylesheet_directory_uri() . '/js/jquery.imagesloaded.min.js', array('jquery'), '1.5.21', true );
    wp_enqueue_script( 'infinitescroll-js', get_stylesheet_directory_uri() . '/js/jquery.infinitescroll.min.js', array('jquery'), '2.0', true );


    wp_enqueue_script( 'clippy-main-js', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), '1.0', true );
}

add_action( 'after_setup_theme', 'twentytwelve_setup','theme_scripts_styles' );



?>
