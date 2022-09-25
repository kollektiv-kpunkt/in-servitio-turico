<?php
global $ist_page;
get_template_part( "template-parts/elements/credits");
?>
<!DOCTYPE html>
<?php
$rootclasses = "ist-root";
if (is_front_page()) {
    $rootclasses .= " ist-frontpage";
}
?>
<html <?php language_attributes(); ?> class="<?= $rootclasses ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    wp_head();
    ?>
</head>
<body>
    <!-- ist-nav-mobilemenu-open -->
    <nav class="ist-nav-outer">
        <?php
        get_template_part( "template-parts/elements/nav");
        ?>
    </nav>
    <div id="main-content">