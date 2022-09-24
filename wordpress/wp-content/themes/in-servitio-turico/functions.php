<?php
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

function ist_scripts() {
    if ($_ENV["production"] == "true") {
        $version = wp_get_theme()->get( 'Version' );
    } else {
        $version = time();
    }
    wp_enqueue_style( 'bundle', get_template_directory_uri() . '/dist/bundle.min.css', [], $version );
    wp_enqueue_script( 'bundle', get_template_directory_uri() . '/dist/app.min.js', array(), $version, true );
}
add_action( 'wp_enqueue_scripts', 'ist_scripts' );

function ist_theme_support() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'editor-styles' );
    add_editor_style('dist/bundle.min.css' );
    add_editor_style('gutenberg/fixes.css' );
}
add_action( 'after_setup_theme', 'ist_theme_support' );

function ist_menus() {
  register_nav_menu('ist-main-nav',__( 'Main Navigation' ));
  register_nav_menu('ist-footer-nav',__( 'Footer Navigation' ));
}
add_action( 'init', 'ist_menus' );

// ist .HTACCESS
function ist_htaccess( $rules ) {
    $content = <<<EOD
    \n
    Options +FollowSymLinks -MultiViews
    RewriteEngine On
    RewriteBase /
    RewriteRule ^api/?$ /wp-content/themes/in-servitio-turico/api/index.php [L,NC]
    RewriteRule ^api/(.+)$ /wp-content/themes/in-servitio-turico/api/index.php [L,NC]\n\n
    EOD;
    return $content . $rules;
}
add_filter('mod_rewrite_rules', 'ist_htaccess');

function ist_enable_flush_rules() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
add_action( "admin_init", 'ist_enable_flush_rules' );


// ACF

function ist_acf() {
    define( 'MY_ACF_PATH', get_stylesheet_directory() . '/lib/acf/' );
    define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/lib/acf/' );
    include_once( MY_ACF_PATH . 'acf.php' );
    add_filter('acf/settings/url', 'my_acf_settings_url');
    function my_acf_settings_url( $url ) {
        return MY_ACF_URL;
    }

    add_filter('acf/settings/save_json', 'set_acf_json_save_folder');
    function set_acf_json_save_folder( $path ) {
        $path = MY_ACF_PATH . '/acf-json';
        return $path;
    }
    add_filter('acf/settings/load_json', 'add_acf_json_load_folder');
    function add_acf_json_load_folder( $paths ) {
        unset($paths[0]);
        $paths[] = MY_ACF_PATH . '/acf-json';;
        return $paths;
    }

    // (Optional) Hide the ACF admin menu item.
    // add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
    // function my_acf_settings_show_admin( $show_admin ) {
    //     return false;
    // }
}
ist_acf();

add_action('acf/init', 'ist_blocktypes');
function ist_blocktypes() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'heroine',
            'title'             => __('Heroine Section'),
            'description'       => __('Heroine Section for the homepage'),
            'render_template'   => 'template-parts/blocks/heroine.php',
            'category'          => 'ist',
            'icon'              => '',
            'keywords'          => array("hero", "heroine", "section"),
        ));

        acf_register_block_type(array(
            'name'              => 'intro',
            'title'             => __('Intro'),
            'description'       => __('Intro block for the homepage'),
            'render_template'   => 'template-parts/blocks/intro.php',
            'category'          => 'ist',
            'icon'              => '',
            'keywords'          => array("intro", "section"),
        ));

        acf_register_block_type(array(
            'name'              => 'shorts',
            'title'             => __('Short Arguments'),
            'description'       => __('Short Arguments block for the homepage'),
            'render_template'   => 'template-parts/blocks/shorts.php',
            'category'          => 'ist',
            'icon'              => '',
            'keywords'          => array("Arguments", "toggles", "section"),
        ));

        acf_register_block_type(array(
            'name'              => 'toggles',
            'title'             => __('Single Toggle'),
            'description'       => __('Single toggle'),
            'render_template'   => 'template-parts/blocks/toggle.php',
            'category'          => 'ist',
            'icon'              => '',
            'keywords'          => array("toggle", "section"),
        ));
    }
}