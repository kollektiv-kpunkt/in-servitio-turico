<?php
require(__DIR__ . "/../../../../wp-load.php");

$args = [
    'post_type'   => 'kandi',
    "post_status" => "publish",
    "posts_per_page" => -1,
];
$kandis = new WP_Query( $args );
$kandis = $kandis->posts;

foreach ($kandis as $kandi) :
    $kandiID = $kandi->ID;
    $title = get_the_title($kandiID);
    $wpdb->query("INSERT INTO `wp_postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ($kandi->ID, '_genesis_title', 'Am 12. Februar: {$title} in den Kantonsrat wählen!')");
    $wpdb->query("INSERT INTO `wp_postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ($kandi->ID, '_tsf_title_no_blogname', 1)");

endforeach;