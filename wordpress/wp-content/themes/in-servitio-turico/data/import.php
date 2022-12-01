<?php
require(__DIR__ . "/../../../../wp-load.php");
$file = __DIR__ . "/kandis.csv";
$handle = fopen($file, "r");
$kandis = array();
while (($line = fgetcsv($handle, 0, ";")) !== FALSE) {
    $kandis[] = $line;
}
fclose($handle);
$keys = array_shift($kandis);

// Combine keys and values
$kandis = array_map(function($kandis) use ($keys) {
    if (count($keys) != count($kandis)) {
        return false;
    }
    return array_combine($keys, $kandis);
}, $kandis);

$missing_photos = array();

foreach ($kandis as $kandi) :
    $postdate = date("Y-m-d H:i:s");
    $new_post = array(
        'post_title'    =>   $kandi["Vorname"] . " " . $kandi["Nachname"],
        'post_date'     =>   $postdate,
        'post_type'     =>   'kandi',
        'post_content'  =>   $kandi["Quote"],
        'post_status'   =>   'publish',
    );
    // create post in wordpress. Yay!
    $new_post_id = wp_insert_post($new_post);


    $bisher = "";
    if ($kandi["Neu/Bisher"] == 1) {
        $bisher = "bisher";
    }

    update_field('bisher', $bisher, $new_post_id);

    update_field('vorname', $kandi["Vorname"], $new_post_id);
    update_field('nachname', $kandi["Nachname"], $new_post_id);
    update_field('rufname', $kandi["Rufname"], $new_post_id);
    update_field('listenplatz', $kandi["Listenplatz"], $new_post_id);
    update_field('berufsbezeichnung', $kandi["Berufsbezeichnung"], $new_post_id);
    update_field('jahrgang', $kandi["Jahrgang"], $new_post_id);
    update_field('pronomen', $kandi["Pronomen"], $new_post_id);
    update_field('bezirk', get_page_by_path(sanitize_title($kandi["Wahlkreis"]), OBJECT, "bezirk")->ID, $new_post_id);

    // $filename should be the path to a file in the upload directory.
    $fileSektion = $kandi["Wahlkreis"];
    if (strpos($kandi["Wahlkreis"], "Zürich") !== false) {
        $fileSektion = explode(" ", $kandi["Wahlkreis"])[1];
    } else if (strpos($kandi["Wahlkreis"], "Winterthur") !== false) {
        $fileSektion = "Winterthur";
    }
    $filename = $fileSektion . "_" . trim($kandi["Vorname"]) . " " . trim($kandi["Nachname"]) . "-RGB";
    $args           = array(
        'posts_per_page' => 1,
        'post_type'      => 'attachment',
        'name'           => sanitize_title($filename),
    );

    $get_attachment = new WP_Query( $args );
    $photos = $get_attachment->posts;
    if (!isset($photos[0])) {
        $missing_photos[] = $filename;
    } else {
        $photoID = $photos[0]->ID;
        update_field('portrait', $photoID, $new_post_id);
    }
endforeach;
print_r($missing_photos);

?>