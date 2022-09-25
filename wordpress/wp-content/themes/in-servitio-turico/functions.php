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
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => __( 'SP Red', 'themeLangDomain' ),
            'slug' => 'spred',
            'color' => '#E4002B',
        ),
        array(
            'name' => __( 'SP Red 120', 'themeLangDomain' ),
            'slug' => 'spred-120',
            'color' => '#B60022',
        ),
        array(
            'name' => __( 'SP Black', 'themeLangDomain' ),
            'slug' => 'spblack',
            'color' => '#000424',
        ),
        array(
            'name' => __( 'SP Black 90', 'themeLangDomain' ),
            'slug' => 'spblack-90',
            'color' => "#1A1E3A",
        ),
        array(
            'name' => __( 'White', 'themeLangDomain' ),
            'slug' => 'white',
            'color' => "#ffffff",
        ),
    ) );
}
add_action( 'after_setup_theme', 'ist_theme_support' );

function ist_menus() {
  register_nav_menu('ist-main-nav',__( 'Main Navigation' ));
  register_nav_menu('ist-footer-nav',__( 'Footer Navigation' ));
}
add_action( 'init', 'ist_menus' );

// ist .HTACCESS
// function ist_htaccess( $rules ) {
//     $content = <<<EOD
//     \n
//     Options +FollowSymLinks -MultiViews
//     RewriteEngine On
//     RewriteBase /
//     RewriteRule ^api/?$ /wp-content/themes/in-servitio-turico/api/index.php [L,NC]
//     RewriteRule ^api/(.+)$ /wp-content/themes/in-servitio-turico/api/index.php [L,NC]\n\n
//     EOD;
//     return $content . $rules;
// }
// add_filter('mod_rewrite_rules', 'ist_htaccess');

// function ist_enable_flush_rules() {
//     global $wp_rewrite;
//     $wp_rewrite->flush_rules();
// }
// add_action( "admin_init", 'ist_enable_flush_rules' );


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
            'title'             => __('Frontpage Heroine'),
            'description'       => __('Heroine for the frontpage'),
            'render_template'   => 'template-parts/blocks/heroine.php',
            'category'          => 'ist',
            'icon'              => '',
            'keywords'          => array( 'heroine', 'frontpage' ),
        ));

        acf_register_block_type(array(
            'name'              => 'link-toggle',
            'title'             => __('Link Toggle'),
            'description'       => __('Modern toggle with arrow and link'),
            'render_template'   => 'template-parts/blocks/link-toggle.php',
            'category'          => 'ist',
            'icon'              => '',
            'keywords'          => array("link", "toggle", "arrow"),
        ));

        acf_register_block_type(array(
            'name'              => 'topics',
            'title'             => __('Topics Gallery'),
            'description'       => __('Topics gallery to show on frontpage'),
            'render_template'   => 'template-parts/blocks/topics.php',
            'category'          => 'ist',
            'icon'              => '',
            'keywords'          => array("topics", "gallery", "frontpage"),
        ));
    }
}


add_filter( 'render_block', 'sic_wrap_blocks', 10, 2 );

function sic_wrap_blocks( $block_content, $block ) {
    $containers = [
        "fw" => [
            "acf/heroine"
        ],
        "lg" => [

        ],
        "sm" => [

        ],
    ];

    if ($block['blockName'] == "") {
        return;
    }

    $containerClass = "";
    foreach ($containers as $key => $value) {
        if (in_array($block['blockName'], $value)) {
            $containerClass = $key . "-container";
        }
    }
    if ($containerClass == "") {
        $containerClass = "md-container";
    }

    if ($block["blockName"] == "core/column") {
        $containerClass = "fw-container";
    }

    if (isset($block['attrs']['className'])) {
        $wrapperClass = "ist-block-wrapper {$block['attrs']['className']}";
    } else {
        $wrapperClass = "ist-block-wrapper";
    }

    if (isset($block['attrs']['verticalAlignment'])) {
        $wrapperClass .= " align-{$block['attrs']['verticalAlignment']}";
    }

    $debug = json_encode($block);
    // <!-- <script>
    //     console.log({$debug});
    // </script> -->
    $block_content = <<<EOD
    <div class="{$wrapperClass}" data-block-name='{$block["blockName"]}' >
        <div class='{$containerClass}'>
            <div class="ist-block-content">
                {$block_content}
            </div>
        </div>
    </div>
    EOD;
    return $block_content;
}