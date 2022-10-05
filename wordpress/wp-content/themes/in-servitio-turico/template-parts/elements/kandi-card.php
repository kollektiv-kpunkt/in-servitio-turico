<?php
$kandi = $args["kandi"];
?>
<div class="ist-kandi">
    <div class="ist-kandi-img-wrapper mb-6 relative">
        <div class="ist-kandi-img">
            <img src="<?= wp_get_attachment_url(get_field("portrait", $kandi->ID)["ID"]) ?>" alt="Portrait <?= get_the_title($kandi->ID) ?>" class="kandi-ist-img-figure">
        </div>
        <?php
        if (isset(get_field("bisher", $kandi->ID)[0]) && get_field("bisher", $kandi->ID)[0] == "bisher") :
        ?>
            <div class="ist-kandi-bisher-wrapper">
                <div class="ist-kandi-bisher absolute top-0 left-0 px-6 py-2 bg-spblack text-white leading-none">
                    Bisher
                </div>
            </div>
        <?php
        endif
        ?>
    </div>
    <h3 class="ist-kandi-name text-2xl mb-0 text-spred"><?= get_field("vorname", $kandi->ID) ?> <?= get_field("rufname", $kandi->ID) ?> <?= get_field("nachname", $kandi->ID) ?></h3>
    <p class="ist-kandi-job"><?= get_field("berufsbezeichnung", $kandi->ID) ?></p>


</div>
<div class="ist-kandi-details-wrapper bg-spred-30 mt-10" hidden>
    <div class="ist-kandi-details-inner py-12">
        <div class="ist-kandi-container md-container">
            <div class="ist-kandi-quote text-spred-120 mb-10">
                <?= $kandi->post_content ?>
            </div>
            <h3 class="ist-kandi-name text-2xl mb-2 text-spred-120"><?= get_field("vorname", $kandi->ID) ?> <?= get_field("rufname", $kandi->ID) ?> <?= get_field("nachname", $kandi->ID) ?></h3>
            <p class="ist-kandi-details">
                <?php
                if (isset(get_field("bisher", $kandi->ID)[0]) && get_field("bisher", $kandi->ID)[0] == "bisher") :
                ?>
                Bisher |
                <?php
                endif;
                ?>
                <?php
                if (get_field("rufname", $kandi->ID) != "") :
                    echo(get_field("rufname", $kandi->ID)) . " | ";
                endif;
                if (get_field("berufsbezeichnung", $kandi->ID) != "" && get_field("berufsbezeichnung", $kandi->ID) != " ") :
                    echo(get_field("berufsbezeichnung", $kandi->ID)) . " | ";
                endif;
                if (get_field("listenplatz", $kandi->ID) != "") :
                    echo("Listenplatz " . get_field("listenplatz", $kandi->ID)) . " | ";
                endif;
                if (get_field("jahrgang", $kandi->ID) != "" && get_field("jahrgang", $kandi->ID) != "0") :
                    echo(get_field("jahrgang", $kandi->ID));
                endif;
                if (get_field("pronomen", $kandi->ID) != "") :
                    echo(" | " . get_field("pronomen", $kandi->ID));
                endif;
                ?>
            </p>
        </div>
    </div>
</div>