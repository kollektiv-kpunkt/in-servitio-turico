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

        acf_register_block_type(array(
            'name'              => 'toggle',
            'title'             => __('Detail Toggle'),
            'description'       => __('Toggle that opens/closes based on user interaction'),
            'render_template'   => 'template-parts/blocks/toggle.php',
            'category'          => 'ist',
            'icon'              => '',
            'keywords'          => array("toggle", "detail"),
        ));

        acf_register_block_type(array(
            'name'              => 'constituencies',
            'title'             => __('Constituencies'),
            'description'       => __('Display a map of the consitutencies'),
            'render_template'   => 'template-parts/blocks/constituencies.php',
            'category'          => 'ist',
            'icon'              => '',
            'keywords'          => array("constituencies", "map"),
        ));
    }
}


add_filter( 'render_block', 'ist_wrap_blocks', 10, 2 );

function ist_wrap_blocks( $block_content, $block ) {
    $containers = [
        "fw" => [
            "acf/heroine",
            "core/buttons"
        ],
        "lg" => [

        ],
        "sm" => [

        ],
    ];

    if (!is_front_page()) {
        $containers["col1"] = [
            ""
        ];
        $containers["md"] = [
            "acf/topics"
        ];
    }

    if ($block['blockName'] == "") {
        return;
    }

    if ($block['blockName'] == "core/button") {
        return $block_content;
    }

    $containerClass = "";
    $customClasses = "";
    foreach ($containers as $key => $value) {
        if (in_array($block['blockName'], $value)) {
            $containerClass = $key . "-container";
        }
    }
    if ($containerClass == "") {
        if (!is_front_page()) {
            $containerClass = "col1-container";
        } else {
            $containerClass = "md-container";
        }
    }

    if ($block["blockName"] == "core/column") {
        $containerClass = "fw-container";
    }

    if (isset($block['attrs']['className'])) {
        if (strpos($block['attrs']["className"], "-container")) {
            $containerClass = $block['attrs']["className"];
            $block["attrs"]["className"] = str_replace("-container", "", $block['attrs']["className"]);
        }
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

/*=============================================
                BREADCRUMBS
=============================================*/
//  to include in functions.php
function the_breadcrumb()
{
    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter = '<i data-feather="arrow-right" class="inline h-4 w-4"></i>'; // delimiter between crumbs
    $home = get_bloginfo("name"); // text for the 'Home' link
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $before = '<span class="current">'; // tag before the current crumb
    $after = '</span>'; // tag after the current crumb

    global $post;
    $homeLink = get_bloginfo('url');
    if (is_home() || is_front_page()) {
        if ($showOnHome == 1) {
            echo '<div id="crumbs" class="ist-breadcrumbs text-spred text-sm"><a href="' . $homeLink . '">' . $home . '</a></div>';
        }
    } else {
        echo '<div id="crumbs" class="ist-breadcrumbs text-spred text-sm"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                echo get_category_parents($thisCat->parent, true, ' ' . $delimiter . ' ');
            }
            echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
        } elseif (is_search()) {
            echo $before . 'Search results for "' . get_search_query() . '"' . $after;
        } elseif (is_day()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('d') . $after;
        } elseif (is_month()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('F') . $after;
        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
                if ($showCurrent == 1) {
                    echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                }
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, true, ' ' . $delimiter . ' ');
                if ($showCurrent == 0) {
                    $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                }
                echo $cats;
                if ($showCurrent == 1) {
                    echo $before . get_the_title() . $after;
                }
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            echo get_category_parents($cat, true, ' ' . $delimiter . ' ');
            echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
            if ($showCurrent == 1) {
                echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
            }
        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1) {
                echo $before . get_the_title() . $after;
            }
        } elseif (is_page() && $post->post_parent) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
                if ($i != count($breadcrumbs)-1) {
                    echo ' ' . $delimiter . ' ';
                }
            }
            if ($showCurrent == 1) {
                echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
            }
        } elseif (is_tag()) {
            echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . 'Articles posted by ' . $userdata->display_name . $after;
        } elseif (is_404()) {
            echo $before . 'Error 404' . $after;
        }
        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                echo ' (';
            }
            echo __('Page') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                echo ')';
            }
        }
        echo '</div>';
    }
}

// Widgets

add_action( 'widgets_init', 'ist_register_widgets' );

function ist_register_widgets() {
	register_sidebar( array(
		'name'          => 'Footer Widget',
		'id'            => 'footer_widget',
		'before_widget' => '<div class="ist-footer-widget">',
		'after_widget'  => '</div>'
	) );
}