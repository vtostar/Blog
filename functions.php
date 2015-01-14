<?php  
/**
 * functions and definitions
 *
 * @package classPlus
 */
define( 'THEME_URL', get_template_directory_uri() );
define( 'THEME_DIR', get_template_directory() );

/**
 * Require other function files.
 */
require THEME_DIR . '/inc/template-tags.php';
require THEME_DIR . '/inc/pagenavi.php';
require THEME_DIR . '/inc/widgets/posts-list.php';
require THEME_DIR . '/inc/customizer.php';
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if( ! isset( $content_width ) ) {
	$content_width = 920;/* pixels */
}

if( ! function_exists('classPlus_setup') ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function classPlus_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Class+, use a find and replace
	 * to change 'classPlus' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twenty-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 200, 200, true );
	add_image_size( 'column-image', 64, 64, true );
	add_image_size( '90x90', 90, 90, false );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Pirmary Menu', 'twenty-theme' )
	) );
	register_nav_menus( array(
		'side-nav' => __( 'Sidebar Menu', 'twenty-theme' )
	) );
	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'classPlus_custom_background_args', array(
		'default-color' => 'f8f8f8',
		'default-image' => '',
	) ) );
	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );
}
endif;
add_action( 'after_setup_theme', 'classPlus_setup' );

/* 
 * Register All widgets
 */
function classPlus_register_widget() {
    register_widget( 'ClassPlus_Posts_List' );
}
add_action( 'widgets_init', 'classPlus_register_widget' );
/**
 * Register sidebar
 */
function classPlus_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Default Sidebar', 'twenty-theme' ),
		'id'            => 'sidebar-default',
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s clearfix">',
		'after_widget'  =>'</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Sidebar', 'twenty-theme' ),
		'id'            => 'sidebar-footer',
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s clearfix">',
		'after_widget'  =>'</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'classPlus_widgets_init' );

/**
 * Custom Scripts
 */
function classPlus_scripts() {
	wp_enqueue_style( 'bootstrap-style', THEME_URL . '/css/bootstrap.css' );
	wp_enqueue_style( 'fontawesome-style', THEME_URL . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'classPlus-style', get_stylesheet_uri() );
	wp_enqueue_style( 'custom-css', THEME_URL . '/css/custom.css.php');
	
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'superfish-js', THEME_URL . '/js/superfish.js', array('jquery') );
	wp_enqueue_script( 'bootstrap-js', THEME_URL . '/js/bootstrap.min.js', array('jquery') );
	wp_enqueue_script( 'autosize-js', THEME_URL . '/js/jquery.autosize.js' );
	wp_enqueue_script( 'site-js', THEME_URL . '/js/site.js', array('jquery'), false, true );
}
add_action( 'wp_enqueue_scripts', 'classPlus_scripts' );


?>