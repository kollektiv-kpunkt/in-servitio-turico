<div class="ist-pageheroine-wrapper mb-20">
<?php
if (isset($args["image"])) :
?>
    <div class="ist-pageheroine-with-image">
        <div class="ist-pageheroine-image">
            <img src="<?= $args["image"] ?>" alt="<?= $args["title"] ?>">
            <div class="ist-pageheroine-overlay"></div>
        </div>
        <div class="ist-pageheroine-content-wrapper text-white">
            <div class="ist-pageheroine-content">
                <h1 class="ist-pageheroine-title mb-2"><?= $args["title"] ?></h1>
                <p class="ist-pageheroine-slogan text-3xl"><?= $args["slogan"] ?></p>
            </div>
        </div>
    </div>

<?php
else:
    ?>
<?php
endif;
?>
</div>

<?php
if (isset($args["image"])) :
    ?>
    <div class="col1-container mb-8">
        <?php
        the_breadcrumb();
        ?>
    </div>
    <?php
endif;
?>