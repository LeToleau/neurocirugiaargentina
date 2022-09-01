<?php

/**
 * Neurocirugia Argentina functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package NEUROCIRUGIA_ARGENTINA
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

// Autoload CPT Labels
function autoload_labels($singular, $plural) {
    $p_lower = strtolower($plural);
    $s_lower = strtolower($singular);

    return [
        'name' => $plural,
        'singular_name' => $singular,
        'add_new_item' => "New $singular",
        'edit_item' => "Edit $singular",
        'view_item' => "View $singular",
        'view_items' => "View $plural",
        'search_items' => "Search $plural",
        'not_found' => "No $p_lower found",
        'not_found_in_trash' => "No $p_lower found in trash",
        'parent_item_colon' => "Parent $singular",
        'all_items' => "All $plural",
        'archives' => "$singular Archives",
        'attributes' => "$singular Attributes",
        'insert_into_item' => "Insert into $s_lower",
        'uploaded_to_this_item' => "Uploaded to this $s_lower",
    ];
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
            'labels' => autoload_labels('Video', 'Videos'),
            'menu_icon' => 'dashicons-video-alt3',
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'videos'),
            'show_in_rest' => true,
  
        )
    );

    register_post_type( 'libros',
    // CPT Options
        array(
            'labels' => autoload_labels('Libro', 'Libros'),
            'menu_icon' => 'dashicons-book-alt',
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'libros'),
            'show_in_rest' => true,
  
        )
    );

    register_post_type( 'papers',
    // CPT Options
        array(
            'labels' => autoload_labels('Paper', 'Papers'),
            'menu_icon' => 'dashicons-welcome-learn-more',
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'papers'),
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
    $another_post_type = 'papers';
    remove_post_type_support( $another_post_type, 'editor');

}
add_action('init', 'init_remove_support',100);


// Shows which template is being used at any page
// DELETE AFTER DEV STAGE 
/*
function meks_which_template_is_loaded() {
	if ( is_super_admin() ) {
		global $template;
		print_r( $template );
	}
}
 
add_action( 'wp_footer', 'meks_which_template_is_loaded' ); */

// Get ID from videos for showing them in modals
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

// First Letter Filter for Alphabetical Functionality
function wpse_298888_posts_where( $where, $query ) {
    global $wpdb;

    $starts_with = esc_sql( $query->get( 'starts_with' ) );

    if ( $starts_with ) {
        $where .= " AND $wpdb->posts.post_title LIKE '$starts_with%'";
    }

    return $where;
}
add_filter( 'posts_where', 'wpse_298888_posts_where', 10, 2 );

// getter: first letter of post title
function getFirstLetter($my_title) {
    $firstCharacter = substr($my_title, 0, 1);

    return $firstCharacter;
}


// Remove useless items from Admin Bar
// Remove side menu
add_action( 'admin_menu', 'remove_default_post_type' );

function remove_default_post_type() {
    remove_menu_page( 'edit.php' );
    remove_menu_page( 'edit-comments.php' );
}

// Remove +New post in top Admin Menu Bar
add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );

function remove_default_post_type_menu_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'new-post' );
    $wp_admin_bar->remove_node( 'comments' );
    //$wp_admin_bar->remove_menu( 'new-resources' );
    //var_dump($wp_admin_bar->get_nodes());
}

// Remove Quick Draft Dashboard Widget
add_action( 'wp_dashboard_setup', 'remove_draft_widget', 999 );

function remove_draft_widget(){
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}

// End remove post type

// Removes from post and pages
add_action('init', 'remove_comment_support', 100);

function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}
