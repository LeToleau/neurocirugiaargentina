<?php

/**
 * This class setup all basic theme fetures 
 */

class ThemeSettings
{
    function __construct()
    {
        $this->releaseVersion();
        add_action('wp_enqueue_scripts', array($this, 'scripts'));
        add_action('admin_enqueue_scripts', array($this, 'adminScripts'));
        add_action('after_setup_theme', array($this, 'themeSupport'));
        $this->disableAdminBar();
        add_action('init', array($this, 'menus'));
    }

    function releaseVersion()
    {
        if (!defined('_S_VERSION')) {
            // Replace the version number of the theme on each release.
            define('_S_VERSION', '1.0.0');
        }
    }

    /**
     * Enqueue scripts and styles.
     */
    function scripts()
    {
        //we don't need the block editor css
        wp_dequeue_style('wp-block-library');

        $buildFilesPath = '/assets/build/';
        $absolutePath = array(
            'js' => get_template_directory() . $buildFilesPath,
            'css' => get_template_directory() . $buildFilesPath,
            'spa' => get_template_directory() . $buildFilesPath,
        );

        //Get file path
        if (!is_404()) {
            if (is_page()) {
                if (get_page_template_slug()) {
                    $jsFile = $buildFilesPath . str_replace(array('templates/', 'php'), array('', 'min.js'), get_page_template_slug());
                    $cssFile = $buildFilesPath . str_replace(array('templates/', 'php'), array('', 'min.css'), get_page_template_slug());
                    $absolutePath['js'] .= str_replace(array('templates/', 'php'), array('', 'min.js'), get_page_template_slug());
                    $absolutePath['css'] .= str_replace(array('templates/', 'php'), array('', 'min.css'), get_page_template_slug());
                } else {
                    $jsFile = $buildFilesPath . 'page.min.js';
                    $cssFile = $buildFilesPath . 'page.min.css';
                    $absolutePath['js'] .= 'page.min.js';
                    $absolutePath['css'] .= 'page.min.css';
                }
            } elseif (is_archive() && !is_tag() && !is_category() && !is_tax()) {
                $jsFile = $buildFilesPath . 'archive-' . str_replace(array(' '), array('_'), get_post_type()) . '.min.js';
                $cssFile = $buildFilesPath . 'archive-' . str_replace(array(' '), array('_'), get_post_type()) . '.min.css';
                $absolutePath['js'] .= 'archive-' . str_replace(array(' '), array('_'), get_post_type()) . '.min.js';
                $absolutePath['css'] .= 'archive-' . str_replace(array(' '), array('_'), get_post_type()) . '.min.css';
            } elseif (is_single()) {
                if (get_post_type() == 'post') {
                    $jsFile = $buildFilesPath . 'single.min.js';
                    $cssFile = $buildFilesPath . 'single.min.css';
                    $absolutePath['js'] .= 'single.min.js';
                    $absolutePath['css'] .= 'single.min.css';
                } else {
                    $jsFile = $buildFilesPath . 'single-' . get_post_type() . '.min.js';
                    $cssFile = $buildFilesPath . 'single-' . get_post_type() . '.min.css';
                    $absolutePath['js'] .= 'single-' . get_post_type() . '.min.js';
                    $absolutePath['css'] .= 'single-' . get_post_type() . '.min.css';
                }
            } elseif (is_category()) {
                $category = explode('/', get_category_template());
                $category = $category[count($category) - 1];
                $jsFile = $buildFilesPath . str_replace('php', 'min.js', $category);
                $cssFile = $buildFilesPath . str_replace('php', 'min.css', $category);
                $absolutePath['js'] .= str_replace('php', 'min.js', $category);
                $absolutePath['css'] .= str_replace('php', 'min.css', $category);
            } elseif (is_tag()) {
                $tag = explode('/', get_tag_template());
                $tag = $tag[count($tag) - 1];
                $jsFile = $buildFilesPath . str_replace('php', 'min.js', $tag);
                $cssFile = $buildFilesPath . str_replace('php', 'min.css', $tag);
                $absolutePath['js'] .= str_replace('php', 'min.js', $tag);
                $absolutePath['css'] .= str_replace('php', 'min.css', $tag);
            } elseif (is_tax()) {
                $taxonomy = explode('/', get_taxonomy_template());
                $taxonomy = $taxonomy[count($taxonomy) - 1];
                $jsFile = $buildFilesPath . str_replace('php', 'min.js', $taxonomy);
                $cssFile = $buildFilesPath . str_replace('php', 'min.css', $taxonomy);
                $absolutePath['js'] .= str_replace('php', 'min.js', $taxonomy);
                $absolutePath['css'] .= str_replace('php', 'min.css', $taxonomy);
            } else {
                $jsFile = $buildFilesPath . 'page.min.js';
                $cssFile = $buildFilesPath . 'page.min.css';
                $absolutePath['js'] .= 'page.min.js';
                $absolutePath['css'] .= 'page.min.css';
            }
        } else {
            $jsFile = $buildFilesPath . '404-page.min.js';
            $cssFile = $buildFilesPath . '404-page.min.css';
            $absolutePath['js'] .= '404-page.min.js';
            $absolutePath['css'] .= '404-page.min.css';
        }

        //Load Styles
        wp_enqueue_style('wcanvas-boilerplate-page-style', get_theme_file_uri($cssFile),  array(), filemtime($absolutePath['css']));

        //Load Scripts
        wp_enqueue_script('wcanvas-boilerplate-main', get_theme_file_uri($jsFile), get_field('use_jquery', 'option') ? array('jquery') : null, filemtime($absolutePath['js']), true);

        //Spa Scripts
        if (get_field('spa_web_page', 'option')) {
            wp_enqueue_script('wcanvas-boilerplate-theme-page-spa', get_theme_file_uri($buildFilesPath . 'spa-webpage.min.js'),  array(), filemtime($absolutePath['spa'] . 'spa-webpage.min.js'), true);
        }

        //Optional google maps api
        if (get_field('api_key', 'option')) {
            wp_register_script('google-maps-js', 'https://maps.googleapis.com/maps/api/js?key=' . get_field('api_key', 'option') . '&libraries=places');
            wp_enqueue_script('google-maps-js');
        }

        // Load API vars to Axios
        wp_localize_script('wcanvas-boilerplate-main', 'wcanvasBoilerplate', array(
            'rootapiurl' => esc_url_raw(rest_url()),
            'nonce' => wp_create_nonce('wp_rest')
        ));

        wp_localize_script('wcanvas-boilerplate-main', 'ajax', array(
            'url' => admin_url('admin-ajax.php')
        ));

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }

    function adminScripts()
    {
        $buildFilesPath = '/assets/build/';
        $cssFile = "{$buildFilesPath}admin.min.css";
        wp_enqueue_style('wcanvas-boilerplate-page-style', get_theme_file_uri($cssFile),  array(), filemtime(get_template_directory() . $buildFilesPath . 'admin.min.css'));
    }

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function themeSupport()
    {
        /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on wcanvas Boilerplate, use a find and replace
		 * to change 'wcanvas-boilerplate' to the name of your theme in all the template files.
		 */
        load_theme_textdomain('wcanvas-boilerplate', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support('title-tag');

        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'main-menu' => esc_html__('Primary', 'wcanvas-boilerplate'),
            )
        );

        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'wcanvas_boilerplate_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
                'header-text' => array('site-title', 'site-description'),
            )
        );
    }

    /**
     * Disable WordPress Admin Bar for all users
     */
    function disableAdminBar()
    {
        add_filter('show_admin_bar', '__return_false');
    }

    /**
     * Extra menu locations
     */
    function menus()
    {
        register_nav_menus(
            array(
                'simplest-navbar' => __('Simplest Navbar'),
                'extra-menu' => __('Extra Menu')
            )
        );
    }
}
