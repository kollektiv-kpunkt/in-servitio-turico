<div class="ist-pageheroine-wrapper mb-20">
<?php
if (isset($args["image"]) && $args["image"] != "") :
?>
    <div class="ist-pageheroine-with-image">
        <div class="ist-pageheroine-image">
            <?php
            $feaimg_scaling_width = get_field("feaimg_scaling_width");
            if ($feaimg_scaling_width) :
                ?>
            <img class="ist-pageheroine-image-scaling" src="<?= $args["image"] ?>" alt="<?= $args["title"] ?>">
            <img class="ist-pageheroine-image-bg" src="<?= $args["image"] ?>" alt="<?= $args["title"] ?>">
            <?php
            else : ?>
            <img src="<?= $args["image"] ?>" alt="<?= $args["title"] ?>">
            <?php endif; ?>
            <div class="ist-pageheroine-overlay"></div>
        </div>
        <div class="ist-pageheroine-content-wrapper text-white">
            <div class="ist-pageheroine-content<?= (!isset($args["subtitle"])) ? " ist-pageheroine-content-no-subtitle" : "" ?>">
                    <div class="md-container">
                    <h1 class="ist-pageheroine-title mb-2"><?= $args["title"] ?></h1>
                    <?php
                    if (isset($args["subtitle"])) :
                    ?>
                    <p class="ist-pageheroine-slogan text-3xl"><?= $args["subtitle"] ?></p>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php
else:
?>

    <div class="ist-pageheroine-without-image pt-28 pb-12 bg-spred">
        <div class="ist-pageheroine-container md-container">
            <div class="ist-pageheroine-breadcrumb">
                <?= the_breadcrumb(array(
                    "text-color" => "text-white",
                    "opacity" => "opacity-70"
                )) ?>
            </div>
            <div class="ist-pageheroine-title mt-8">
                <h1 class="text-white mb-0"><?= $args["title"] ?></h1>
            </div>
        </div>
    </div>

<?php
endif;
?>
</div>

<?php
if (isset($args["image"]) && $args["image"] != "") :
    ?>
    <div class="col1-container mb-8">
        <?php
        the_breadcrumb();
        ?>
    </div>
    <?php
endif;
?>