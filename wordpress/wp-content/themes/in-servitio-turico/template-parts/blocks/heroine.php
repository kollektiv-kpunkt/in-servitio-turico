<?php

$anliegens = get_posts(array(
    'post_type' => 'anliegen',
    'posts_per_page' => -1,
));


if (isset($_GET["h"])) {
    $featured = get_posts(array(
        "name" => $_GET["h"],
        "post_type" => "anliegen",
        "posts_per_page" => 1
    ))[0];

    $anliegens = array_filter($anliegens, function ($anliegens) use ($featured) {
        return $anliegens->ID !== $featured->ID;
    });
    shuffle($anliegens);
} else {
    $featured = array_shift($anliegens);
}

$anliegens = [
    ...$anliegens,
    $featured
];

?>


<div class="ist-fp-heroine-wrapper">
    <div class="ist-fp-heroine-inner">
        <div class="ist-fp-featured-topic-bg">
        <?php
        $thumbnailID = get_post_thumbnail_id( $featured->ID);
        $img_src = wp_get_attachment_image_url( $thumbnailID, 'full' );
        $img_srcset = wp_get_attachment_image_srcset( $thumbnailID, 'full' );
        ?>
            <div class="ist-fp-featured-topic-img">
                <img src="<?php echo $img_src; ?>" srcset="<?php echo $img_srcset; ?>" sizes="(min-width: 1024px) 100vw, 1024px" alt="<?php echo $featured->post_title; ?>">
            </div>
            <div class="ist-fp-featured-topic-overlay"></div>
        </div>
        <div class="ist-fp-slides-wrapper">
            <div class="ist-slides-container lg-container">
                <div class="ist-fp-slides">
                    <?php
                    $i = 0;
                    foreach ($anliegens as $anliegen) :
                        $thumbnailID = get_post_thumbnail_id( $anliegen->ID);
                        $thmb_src = wp_get_attachment_image_url( $thumbnailID, 'full' );
                        $thmb_srcset = wp_get_attachment_image_srcset( $thumbnailID, 'full' );
                        $content = [
                            "slogan" => get_field("slogan", $anliegen->ID),
                            "title" => get_field("title", $anliegen->ID),
                            "link" => get_permalink($anliegen->ID),
                            "thumbnail" => [
                                "src" => $thmb_src,
                                "srcset" => $thmb_srcset,
                                "alt" => $anliegen->post_title
                            ]
                        ];
                        $attachment_id = get_field("preview_image", $anliegen->ID)["ID"];
                        $img_src = wp_get_attachment_image_url( $attachment_id, 'medium_large' );
                        $img_srcset = wp_get_attachment_image_srcset( $attachment_id, 'medium_large' );
                    ?>
                    <div class="ist-fp-slide" data-slide-content='<?= base64_encode(json_encode($content)) ?>' data-slide-slug="<?= $anliegen->post_name ?>">
                        <div class="ist-fp-slide-preview">
                            <a href="<?= get_permalink($anliegen->ID) ?>" class="ist-noline flex">
                                <img src="<?php echo esc_url( $img_src ); ?>"
                                    srcset="<?php echo esc_attr( $img_srcset ); ?>"
                                    sizes="(min-width: 981px) 300w, 680px"
                                    alt="<?= $anliegen->title ?>">
                            </a>
                        </div>
                    </div>
                    <?php
                    $i++;
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
        <div class="ist-fp-featured-topic-content-wrapper">
            <div class="ist-fp-featured-topic-content-container lg-container">
                <div class="ist-fp-featured-topic-content text-white">
                    <h1 class="ist-fp-featured-topic-title mb-2"><?= get_field("title", $featured->ID)?></h1>
                    <p class="ist-fp-featured-topic-slogan text-2xl"><?= get_field("slogan", $featured->ID) ?></p>
                    <a href="<?= get_permalink($featured->ID) ?>" class="ist-fp-featured-topic-link ist-button ist-button-next text-xl mt-4">Mehr erfahren</a>
                </div>
            </div>
        </div>
        <div class="ist-fp-slides-mobile-wrapper bg-spblack-90">
            <div class="ist-slides-mobile-container">
                <div class="ist-fp-slides-mobile flex gap-x-2">
                    <?php
                    $i = 0;
                    foreach ($anliegens as $anliegen) :
                        $attachment_id = get_field("preview_image", $anliegen->ID)["ID"];
                        $img_src = wp_get_attachment_image_url( $attachment_id, 'medium_large' );
                        $img_srcset = wp_get_attachment_image_srcset( $attachment_id, 'medium_large' );
                    ?>
                    <div class="ist-fp-mobile-slide" data-slide-slug="<?= $anliegen->post_name ?>">
                        <div class="ist-fp-mobile-preview">
                            <img src="<?php echo esc_url( $img_src ); ?>"
                                srcset="<?php echo esc_attr( $img_srcset ); ?>"
                                sizes="(min-width: 981px) 370px, 680px"
                                alt="<?= $anliegen->title ?>">
                        </div>
                    </div>
                    <?php
                    $i++;
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>