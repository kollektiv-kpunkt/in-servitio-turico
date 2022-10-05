<?php

$bezirk = get_queried_object();

$args = array(
	'post_type'   => 'kandi',
    "post_status" => "publish",
    "posts_per_page" => -1,
    'meta_query' => array(
        array(
            'key' => 'bezirk',
            'value' => $bezirk->ID ,
        ),
    ),
    "meta_key" => "listenplatz",
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
);
$kandis = new WP_Query( $args );
$kandis = $kandis->posts;

if ( have_posts() ) :
    while ( have_posts() ) :
        get_header("", array(
            "has_thumbnail" => has_post_thumbnail(),
        ));
        the_post();
        if ( has_post_thumbnail() ) {
            get_template_part( "template-parts/elements/page-heroine", "", array(
                "title" => get_the_title(),
                "image" => get_the_post_thumbnail_url()
            ));
        } else {
            get_template_part( "template-parts/elements/page-heroine", "", array(
                "title" => get_the_title(),
                "image" => ""
            ));
        }
        the_content();
        get_template_part( "template-parts/elements/kandigrid", "", array(
            "kandis" => $kandis
        ));
        ?>
        <div class="md-container">
            <div class="ist-block-content">
            <?php
            get_template_part( "template-parts/blocks/constituencies");
            ?>
            </div>
        </div>
        <?php
    endwhile;
endif;
?>
<?php
get_footer();
?>