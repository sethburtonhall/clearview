<?php
/**
 * This makes the child theme work. If you need any
 * additional features or let's say menus, do it here.
 *
 * @return void
 */
function required_starter_themesetup() {

	load_child_theme_textdomain( 'requiredstarter', get_stylesheet_directory() . '/languages' );

	// Register an additional Menu Location
	register_nav_menus( array(
		'meta' => __( 'Meta Menu', 'requiredstarter' )
	) );

	// Add support for custom backgrounds and overwrite the parent backgorund color
	add_theme_support( 'custom-background', array( 'default-color' => 'f7f7f7' ) );

}
add_action( 'after_setup_theme', 'required_starter_themesetup' );

// Sidebars & Widgetizes Areas

//Remove Footer Widgets Areas
function clearview_unregister_sidebars() {
	unregister_sidebar( 'sidebar-footer-1' );
	unregister_sidebar( 'sidebar-footer-2' );
	unregister_sidebar( 'sidebar-footer-3' );
}
add_action( 'widgets_init', 'clearview_unregister_sidebars', 11 );

// Sidebars & Widgetizes Areas

//Add Home Page Widget Areas

register_sidebar( array(
	'name' => __( 'Main Sidebar', 'requiredfoundation' ),
	'id' => 'sidebar-main',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => "</aside>",
	'before_title' => '<h4 class="widget-title">',
	'after_title' => '</h4>',
) );

function clearview_register_sidebars() {
register_sidebar(array(
	'id' => 'news-feed',
	'name' => __('News Feed', 'requiredstarter'),
	'description' => __('This displays the two most recent News Posts in the home page widget area. Editing these settings may break your website layout. PLEASE PROCEED WITH CAUTION.', 'requiredstarter'),
	'before_widget' => '<div id="news-feed" class="news-feed">',
	'after_widget' => '</div>',
	'before_title' => '<a href="category/news"><h3 class="widgettitle">',
	'after_title' => '</h3></a>',
));

register_sidebar(array(
	'id' => 'our-story',
	'name' => __('Our Story', 'requiredstarter'),
	'description' => __('This displays an excerpt from the "Overview Page" in the home page widget area.', 'requiredstarter'),
	'before_widget' => '<div class="our-story">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widgettitle">',
	'after_title' => '</h3>',
));

register_sidebar(array(
	'id' => 'recent-posts',
	'name' => __('Most Recent Blog Post', 'requiredstarter'),
	'description' => __('This displays your most recent blog posts in the home page widget area. Editing these settings may break your website layout. PLEASE PROCEED WITH CAUTION.', 'requiredstarter'),
	'before_widget' => '<div class="recent-posts">',
	'after_widget' => '</div>',
	'before_title' => '<a href="blog"><h3 class="widgettitle">',
	'after_title' => '</h3></a>',
));

} // don't remove this bracket!

add_action( 'widgets_init', 'clearview_register_sidebars', 11 );

/**
 * With the following function you can disable theme features
 * used by the parent theme without breaking anything. Read the
 * comments on each and follow the link, if you happen to not
 * know what the function is for. Remove the // in front of the
 * remove_theme_support('...'); calls to make them execute.
 *
 * @return void
 */
function required_starter_after_parent_theme_setup() {

	/**
	 * Hack added: 2012-10-04, Silvan Hagen
	 *
	 * This is a hack, to calm down PHP Notice, since
	 * I'm not sure if it's a bug in WordPress or my
	 * bad I'll leave it here: http://wordpress.org/support/topic/undefined-index-custom_image_header-in-after_setup_theme-of-child-theme
	 */
	if ( ! isset( $GLOBALS['custom_image_header'] ) )
		$GLOBALS['custom_image_header'] = array();

	if ( ! isset( $GLOBALS['custom_background'] ) )
		$GLOBALS['custom_background'] = array();

	// Remove custom header support: http://codex.wordpress.org/Custom_Headers
	//remove_theme_support( 'custom-header' );

	// Remove support for post formats: http://codex.wordpress.org/Post_Formats
	//remove_theme_support( 'post-formats' );

	// Remove featured images support: http://codex.wordpress.org/Post_Thumbnails
	//remove_theme_support( 'post-thumbnails' );

	// Remove custom background support: http://codex.wordpress.org/Custom_Backgrounds
	//remove_theme_support( 'custom-background' );

	// Remove automatic feed links support: http://codex.wordpress.org/Automatic_Feed_Links
	//remove_theme_support( 'automatic-feed-links' );

	// Remove editor styles: http://codex.wordpress.org/Editor_Style
	//remove_editor_styles();

	// Remove a menu from the theme: http://codex.wordpress.org/Navigation_Menus
	//unregister_nav_menu( 'secondary' );

}
add_action( 'after_setup_theme', 'required_starter_after_parent_theme_setup', 11 );

/**
 * Add our theme specific js file and some Google Fonts
 * @return void
 */
function required_starter_scripts() {

	/**
	 * Registers the scripts.js
	 *
	 * Remove if you don't need this file,
	 * it's empty by default.
	 */
	wp_enqueue_script(
		'scripts-js',
		get_stylesheet_directory_uri() . '/javascripts/scripts-ck.js',
		array( 'theme-js' ),
		required_get_theme_version( false ),
		true
	);

	/**
	 * Registers the global.css
	 *
	 * If you don't need it, remove it.
	 * The file is empty by default.
	 */
	wp_register_style(
        'global-css', //handle
        get_stylesheet_directory_uri() . '/stylesheets/global.css',
        array( 'foundation-css' ),	// needs foundation
        required_get_theme_version( false ) //version
  	);
  	wp_enqueue_style( 'global-css' );

	/**
	 * Adding google fonts
	 *
	 * This is the proper code to add google fonts
	 * as seen in TwentyTwelve
	 */
	$protocol = is_ssl() ? 'https' : 'http';
	$query_args = array( 'family' => 'Open+Sans:300,600' );
	wp_enqueue_style(
		'open-sans',
		add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ),
		array(),
		null
	);
}
add_action('wp_enqueue_scripts', 'required_starter_scripts');

/**
 * Overwrite the default continue reading link
 *
 * This function is an example on how to overwrite
 * the parent theme function to create continue reading
 * links.
 *
 * @return string HTML link with text and permalink to the post/page/cpt
 */
function required_continue_reading_link() {
	return ' <a class="read-more" href="'. esc_url( get_permalink() ) . '">' . __( ' Read on! &rarr;', 'requiredstarter' ) . '</a>';
}

/**
 * Overwrite the defaults of the Orbit shortcode script
 *
 * Accepts all the parameters from http://foundation.zurb.com/docs/orbit.php#optCode
 * to customize the options for the orbit shortcode plugin.
 *
 * @param  array $args default args
 * @return array       your args
 */
function required_orbit_script_args( $defaults ) {
	$args = array(
		'animation' 	=> 'fade',
		'advanceSpeed' 	=> 8000,
	);
	return wp_parse_args( $args, $defaults );
}
add_filter( 'req_orbit_script_args', 'required_orbit_script_args' );
