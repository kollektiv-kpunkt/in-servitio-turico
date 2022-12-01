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
    $imgID = (isset(get_field("portrait", $kandiID)["ID"]) ? get_field("portrait", $kandiID)["ID"] : "");
    if ($imgID != "") {
        set_post_thumbnail($kandiID, $imgID);
    }
endforeach;

?>