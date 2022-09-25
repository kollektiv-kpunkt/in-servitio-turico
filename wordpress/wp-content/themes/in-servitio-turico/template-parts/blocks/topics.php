<?php
$anliegens = get_posts(array(
    'post_type' => 'anliegen',
    'posts_per_page' => -1,
));
?>

<div class="ist-topics-gallery-wrapper">
    <div class="ist-topics-gallery-container">
        <div class="ist-topics-gallery flex gap-x-12 gap-y-8 justify-center items-center flex-wrap">
            <div class="ist-topics-gallery-niche">
                <h2 class="text-spred mb-0"><?= get_field("title") ?></h2>
            </div>
            <?php
            foreach ($anliegens as $anliegen):
            ?>
            <div class="ist-topics-gallery-niche">
                <div class="ist-topic">
                    <div class="ist-topic-img">
                        <?php
                        $thumbnailID = get_post_thumbnail_id( $anliegen->ID);
                        $img_src = wp_get_attachment_image_url( $thumbnailID, 'medium_large' );
                        $img_srcset = wp_get_attachment_image_srcset( $thumbnailID, 'medium_large' );
                        ?>
                        <img src="<?php echo $img_src; ?>" srcset="<?php echo $img_srcset; ?>" sizes="(min-width: 1024px) 100vw, 1024px" alt="<?php echo $anliegen->post_title; ?>">
                        <div class="ist-img-overlay"></div>
                    </div>
                    <div class="ist-topic-content text-white">
                        <h3 class="ist-topic-title mb-2"><?php echo $anliegen->post_title; ?></h3>
                        <p class="ist-topic-slogan"><?php echo get_field("slogan", $anliegen->ID); ?></p>
                        <a href="<?php echo get_permalink($anliegen->ID); ?>" class="ist-topic-link ist-button ist-button-next mt-4">Mehr erfahren</a>
                    </div>
                </div>
            </div>
            <?php
            endforeach;
            ?>
        </div>
    </div>
    <div class="ist-gallery-more-button pb-4 cursor-pointer">
        <div class="ist-gallery-more flex justify-center gap-x-2 text-spred font-semibold text-xl">
            <span><?= get_field("more_button") ?></span>
            <i data-feather="arrow-down" class="h-6 w-6"></i>
        </div>
    </div>
</div>