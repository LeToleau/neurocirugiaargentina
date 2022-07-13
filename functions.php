<?php

/**
 * wcanvas Boilerplate functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wcanvas_Boilerplate
 */

/**
 * Autoload and instance all theme setup classes
 */
$setup = new RecursiveDirectoryIterator(__DIR__ . '/inc/setup');
foreach (new RecursiveIteratorIterator($setup) as $file) {
	if ($file->getExtension() === 'php') {
		require $file;
		$class = basename($file, '.php');
		new $class;
	}
}

/**
 * Autoload all custom functionalities
 */
$functionalities = new RecursiveDirectoryIterator(__DIR__ . '/inc/functionalities');
foreach (new RecursiveIteratorIterator($functionalities) as $file) {
	if ($file->getExtension() === 'php') {
		require $file;
	}
}

// Our custom post type function
function create_posttype() {
  
    register_post_type( 'videos',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Videos' ),
                'singular_name' => __( 'Video' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'videos'),
            'show_in_rest' => true,
  
        )
    );

    register_post_type( 'libros',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Libros' ),
                'singular_name' => __( 'Libro' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'libros'),
            'show_in_rest' => true,
  
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

function init_remove_support(){
    $post_type = 'videos';
    remove_post_type_support( $post_type, 'editor');
    $other_post_type = 'libros';
    remove_post_type_support( $other_post_type, 'editor');

}
add_action('init', 'init_remove_support',100);

//For example, you can paste this into your theme functions.php file
 
function meks_which_template_is_loaded() {
	if ( is_super_admin() ) {
		global $template;
		print_r( $template );
	}
}
 
add_action( 'wp_footer', 'meks_which_template_is_loaded' );

function get_ID_from_embed($url) {
    $embedCode = $url;
    preg_match('/src="([^"]+)"/', $embedCode, $match);
    // Extract video url from embed code
    $videoLink = $match[1];
    $urlArr = explode("/",$videoLink);
    $urlArrNum = count($urlArr);
    // YouTube video ID
    $youtubeVideoId = $urlArr[$urlArrNum - 1];
    
    $regex = '/\?[a-zA-Z]+=[a-zA-Z]+/i';
    preg_match($regex, $youtubeVideoId, $matches);
    $realId = str_replace($matches[0], "", $youtubeVideoId);

    return $realId;
    
}

