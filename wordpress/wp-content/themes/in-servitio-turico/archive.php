<?php
require(__DIR__ . "/../../../wp-load.php");
$links = [
    "bezirk" => "/#kantonsrat",
    "anliegen" => "/#anliegen",
];
$type = get_queried_object()->name;
wp_redirect(home_url( ) . "/{$links[$type]}");
?>