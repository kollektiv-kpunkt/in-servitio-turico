<div class="py-20">
    <div class="lg-container">
        <div class="ist-kandigrid-wrapper">
            <div class="ist-kandigrid-inner flex justify-center gap-12 flex-wrap">
                <?php
                foreach($args["kandis"] as $kandi) :
                    get_template_part( "template-parts/elements/kandi-card", "", array(
                        "kandi" => $kandi
                    ));
                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>