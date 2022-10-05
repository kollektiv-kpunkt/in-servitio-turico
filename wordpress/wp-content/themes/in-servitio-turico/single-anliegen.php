<?php
if ( have_posts() ) :
    while ( have_posts() ) :
        get_header("", array(
            "has_thumbnail" => has_post_thumbnail(),
        ));
        the_post();
        if ( has_post_thumbnail() ) {
            get_template_part( "template-parts/elements/page-heroine", "", array(
                "title" => get_field("title"),
                "subtitle" => get_field("slogan"),
                "image" => get_the_post_thumbnail_url()
            ));
        } else {
            get_template_part( "template-parts/elements/page-heroine", "", array(
                "title" => get_field("title"),
                "subtitle" => get_field("slogan"),
            ));
        }
        the_content();
    endwhile;
endif;
?>
<?php
get_footer();
?>