<div class="py-20">
    <div class="lg-container">
        <div class="ist-kandigrid-wrapper">
            <div class="ist-kandigrid-inner flex flex-wrap">
                <?php
                $i = 0;
                foreach($args["kandis"] as $kandi) :
                    get_template_part( "template-parts/elements/kandi-card", "", array(
                        "kandi" => $kandi,
                        "kandiID" => $i
                    ));
                    $i++;
                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>