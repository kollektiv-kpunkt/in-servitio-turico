<?php
use Jaybizzle\CrawlerDetect\CrawlerDetect;
$detect = new CrawlerDetect;
if ($detect->isCrawler()) {
    get_header();
    get_footer();
} else {
    $bezirk = get_field('bezirk', $post->ID)->post_name;
    wp_redirect( home_url() . "/bezirk/{$bezirk}##kandi={$post->post_name}" );
}
?>